#!/usr/bin/env bash
set -Eeuo pipefail

sha="${1:?Missing commit SHA}"
target="${2:?Missing theme directory}"
expected='/home/u360970731/domains/trilacheck.de/public_html/wp-content/themes/trilacheck'
[[ "$sha" =~ ^[0-9a-f]{40}$ ]] || { echo 'Invalid SHA'; exit 1; }
[[ "$target" == "$expected" ]] || { echo 'Refusing unexpected deployment target'; exit 1; }
[[ "$(realpath "$target")" == "$expected" ]] || { echo 'Refusing redirected theme directory'; exit 1; }

base='/home/u360970731/trilacheck-deploy'
release="$base/releases/$sha"
wordpress='/home/u360970731/domains/trilacheck.de/public_html'
test -f "$release/style.css"
test -f "$release/index.php"
find "$release" -name '*.php' -print0 | xargs -0 -n1 php -l > /dev/null
cd "$wordpress"
[[ "$(wp option get stylesheet)" == 'trilacheck' ]] || { echo 'Unexpected active theme'; exit 1; }
[[ "$(wp option get home)" == 'https://trilacheck.de' ]] || { echo 'Unexpected WordPress site'; exit 1; }

mkdir -p "$base/backups"
backup="$base/backups/theme-$(date -u +%Y%m%dT%H%M%SZ)-$sha.tar.gz"
tar -czf "$backup" -C "$(dirname "$target")" trilacheck
tar -tzf "$backup" > /dev/null
echo "Theme backup: $backup"

rollback() {
  status=$?
  trap - ERR
  echo 'Deployment failed; attempting to restore the previous theme.'
  restore="$(mktemp -d "$base/restore.XXXXXX")"
  if tar -xzf "$backup" -C "$restore" && rsync -a --delete "$restore/trilacheck/" "$target/"; then
    wp cache flush || true
    echo 'Previous theme restored.'
  else
    echo "Automatic restore failed. Backup remains at $backup"
  fi
  exit "$status"
}
trap rollback ERR

# The checked, fixed target is the theme directory only; no WordPress data is synced.
rsync -a --delete "$release/" "$target/"
differences="$(rsync -rcn --delete --out-format='%n' "$release/" "$target/")"
if [[ -n "$differences" ]]; then
  echo 'Deployed files do not match the tested release'
  false
fi
wp theme is-active trilacheck
wp eval 'if ( ! function_exists("trilacheck_landing_articles") || ! function_exists("trilacheck_article_comparison") ) { throw new Exception("Missing internal link helpers"); }'
wp cache flush
if wp plugin is-active litespeed-cache; then
  wp litespeed-purge all
fi
curl --fail --silent --show-error --location --retry 2 --max-time 30 'https://trilacheck.de/gas/' -o "$base/last-gas-check.html"
grep -q 'tc-comparison-trust' "$base/last-gas-check.html"
printf '%s\n' "$sha" > "$base/current-commit"
trap - ERR
echo "Deployed theme commit $sha successfully."
