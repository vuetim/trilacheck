# Trilacheck WordPress theme

Custom theme for https://trilacheck.de. This repository contains only the theme, not WordPress core, database exports, uploads or plugins.

## Automatic deployment

Push to `main` runs PHP 8.2/8.3 syntax checks, JavaScript syntax checks and theme/package checks. After all checks pass, GitHub Actions deploys the tested ZIP to Hostinger. Pull requests run checks without deployment. Manual runs from `main` use the same checks.

The `trilacheck-theme` Actions artifact is an installable ZIP with `trilacheck/style.css` and standard ZIP paths.

Required repository Actions secret: **SSH_PRIVATE_KEY**, the private key matching the dedicated `github-actions-trilacheck` public key registered in Hostinger. Never commit this key. The local `.deploy/` directory is ignored.

Production settings are in `.github/workflows/theme.yml`. The destination is strictly restricted in `.github/scripts/deploy.sh` to `/home/u360970731/domains/trilacheck.de/public_html/wp-content/themes/trilacheck`. Server identity is pinned in `.github/known_hosts`; the ED25519 fingerprint was verified against Hostinger's panel: `SHA256:2FHp1/FM//L5YKxNEZ6cXkDVigs8ZwJAdH+dLy+p178`.

Each deployment stages the release outside the web root, runs PHP checks on the server, verifies the active theme/site, then backs up the old theme outside `public_html` before syncing only this theme. WordPress post content, options, uploads, plugins and database structure are not deployed. Object/page caches are purged after a successful sync. Server-side verification failures attempt automatic restoration of the theme backup; backups are retained for manual rollback.

Backups: `/home/u360970731/trilacheck-deploy/backups/`.
Releases: `/home/u360970731/trilacheck-deploy/releases/<commit-sha>/`.

## Rollback

Select the previous working commit in Git, revert the bad commit, and push to `main` to run the same checked deployment. If Actions or WordPress cannot start, restore the selected theme tarball on Hostinger from the backup directory. Restore only the `trilacheck` theme directory, then clear page/object caches. Keep the backup until the restored site has been verified.

## Checks and limits

CI validates syntax, theme structure and packaging. Deployment verifies WordPress can load the theme and the public Gas page contains the trust strip. These checks are not a full SEO audit, browser regression suite, or a guarantee about Google rankings.
