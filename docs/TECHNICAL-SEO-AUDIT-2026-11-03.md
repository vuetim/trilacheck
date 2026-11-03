# Technical SEO audit — 3 November 2026

Scope: all 31 published WordPress pages, 6 published posts and 8 category archives (45 public HTML landing URLs), all 41 URLs listed by Yoast's sitemap, and 82 first-party image/CSS/JavaScript resources. Additional probes covered robots.txt, core/Yoast sitemap routes, feeds, REST discovery, a nonexistent URL, a disabled author archive, search routing, HTTP/HTTPS, www/non-www, slash normalization and one legacy internal URL. Read-only public HTTP responses and server-rendered HTML were used. The crawl and private working data remain outside the Git index in ignored local audit files.

## Changes implemented

- Header search uses the same icon/toggle on desktop and mobile. Both right-hand controls have matching 44 × 48 px boxes and centered 24 px icons. The grid control retains its full accessible name and shows the small visible label “Alle”. Escape closes search and returns focus; an existing query remains visible; without JavaScript the regular GET search form remains available.
- Removed nested main landmarks from 15 templates. The shared header/footer still provide one main landmark; wrapper classes and contents are unchanged.
- Category archives now have one archive H1, including when empty. Existing result-title classes are preserved on H2 elements.
- Added a helpful 404 template while retaining WordPress's HTTP 404 response.
- Added missing-description defaults through Yoast's supported filters for cookies, contract cancellation, the Gasvergleich 2026 article and the Auto & Fahrzeuge category. Nonempty editor/plugin descriptions are preserved. No extra meta-description tag is echoed by the theme.
- Empty category archives receive noindex through the existing robots tag; their routes and category hierarchy are unchanged. Archives with posts remain indexable. Yoast already excludes the empty categories from its sitemap.
- No extra JSON-LD, review/rating markup, certifications, competitor text, keyword tags, or guaranteed price/ranking claims were introduced. Affiliate widgets, article bodies, canonicals, URLs and category assignments were preserved.

## Checks that passed before changes

- All 45 landing URLs and 41 sitemap URLs returned HTTP 200. The intentionally missing route and disabled author route returned real 404 responses.
- HTTP, www and slash variants redirect permanently to the preferred HTTPS/non-www/slash form. The legacy /mobilfunk/prepaid-tarife/ URL already has a 301 redirect to the published route.
- robots.txt allows public crawling and advertises the working Yoast sitemap index. /wp-sitemap.xml redirects to that index.
- Every landing URL has one title, a self-referencing canonical, a German document language and a mobile viewport declaration. No duplicate page titles or nonempty descriptions were found.
- No orphaned landing pages, unresolved internal page destinations or broken same-page fragment targets were found within the crawled navigation/content graph. Existing body links were preserved.
- All 82 checked first-party resources returned 200. Server-rendered images have alt attributes and width/height attributes; decorative images may correctly have empty alt text.
- Each landing URL has one parseable Yoast JSON-LD script. Comparison pages use WebPage/BreadcrumbList/WebSite/Organization graphs; articles additionally use Article and relevant image/author entities. This is a syntax/structure check, not a Google Rich Results Test certification.
- The first-party HTML contains explanatory content and crawlable internal links outside third-party comparison iframes. Robots/status checks apply to Trilacheck pages, not to CHECK24's independent indexing policy.

## Page-by-page baseline

The table records conditions found before this change. “nested-main” is a semantic/accessibility defect, not evidence of a Google ranking penalty. Empty-category missing H1 and multiple archive H1 issues are corrected by the archive change; missing descriptions are filled only at the four listed routes.

| URL | Baseline findings |
| --- | --- |
| [/cookies/](https://trilacheck.de/cookies/) | description |
| [/blog/](https://trilacheck.de/blog/) | nested-main |
| [/](https://trilacheck.de/) | No issue in checked fields |
| [/vergleiche/](https://trilacheck.de/vergleiche/) | nested-main |
| [/vertrag-kuendigen/](https://trilacheck.de/vertrag-kuendigen/) | description, nested-main |
| [/datenschutz/](https://trilacheck.de/datenschutz/) | nested-main |
| [/agb/](https://trilacheck.de/agb/) | nested-main |
| [/impressum/](https://trilacheck.de/impressum/) | nested-main |
| [/sachversicherungen/](https://trilacheck.de/sachversicherungen/) | nested-main |
| [/krankenversicherungen/](https://trilacheck.de/krankenversicherungen/) | nested-main |
| [/vorsorge-versicherungen/](https://trilacheck.de/vorsorge-versicherungen/) | nested-main |
| [/auto-fahrzeuge/](https://trilacheck.de/auto-fahrzeuge/) | nested-main |
| [/versicherungen/](https://trilacheck.de/versicherungen/) | nested-main |
| [/girokonto/](https://trilacheck.de/girokonto/) | nested-main |
| [/mietwagen/](https://trilacheck.de/mietwagen/) | nested-main |
| [/dsl/](https://trilacheck.de/dsl/) | nested-main |
| [/gas/](https://trilacheck.de/gas/) | nested-main |
| [/prepaid-tarife/](https://trilacheck.de/prepaid-tarife/) | nested-main |
| [/tarife-fur-junge-leute/](https://trilacheck.de/tarife-fur-junge-leute/) | nested-main |
| [/handytarife-unlimited/](https://trilacheck.de/handytarife-unlimited/) | nested-main |
| [/mobilfunk/](https://trilacheck.de/mobilfunk/) | No issue in checked fields |
| [/strom/](https://trilacheck.de/strom/) | nested-main |
| [/handy-mit-vertrag/](https://trilacheck.de/handy-mit-vertrag/) | No issue in checked fields |
| [/handytarife-50gb/](https://trilacheck.de/handytarife-50gb/) | nested-main |
| [/handytarife-15gb/](https://trilacheck.de/handytarife-15gb/) | nested-main |
| [/handytarife-5gb/](https://trilacheck.de/handytarife-5gb/) | nested-main |
| [/reise/](https://trilacheck.de/reise/) | No issue in checked fields |
| [/ferienwohnungen-istrien/](https://trilacheck.de/ferienwohnungen-istrien/) | No issue in checked fields |
| [/ferienwohnungen-allgaeu/](https://trilacheck.de/ferienwohnungen-allgaeu/) | No issue in checked fields |
| [/ferienwohnungen-gardasee/](https://trilacheck.de/ferienwohnungen-gardasee/) | No issue in checked fields |
| [/ferienwohnungen-mallorca/](https://trilacheck.de/ferienwohnungen-mallorca/) | No issue in checked fields |
| [/gaspreis-aktuell-2026/](https://trilacheck.de/gaspreis-aktuell-2026/) | nested-main |
| [/gasvergleich-2026-worauf-sollte-man-beim-gastarif-achten/](https://trilacheck.de/gasvergleich-2026-worauf-sollte-man-beim-gastarif-achten/) | description, nested-main |
| [/auto-saisoncheck-reifen-oel-bremsen/](https://trilacheck.de/auto-saisoncheck-reifen-oel-bremsen/) | nested-main |
| [/handy-mit-vertrag-ohne-anzahlung/](https://trilacheck.de/handy-mit-vertrag-ohne-anzahlung/) | nested-main |
| [/handy-mit-oder-ohne-vertrag/](https://trilacheck.de/handy-mit-oder-ohne-vertrag/) | nested-main |
| [/wie-viel-datenvolumen-brauche-ich/](https://trilacheck.de/wie-viel-datenvolumen-brauche-ich/) | nested-main |
| [/category/auto-fahrzeuge/](https://trilacheck.de/category/auto-fahrzeuge/) | description |
| [/category/strom-gas/gas/](https://trilacheck.de/category/strom-gas/gas/) | h1:2 |
| [/category/internet-mobilfunk/](https://trilacheck.de/category/internet-mobilfunk/) | h1:3 |
| [/category/konto-finanzen/](https://trilacheck.de/category/konto-finanzen/) | h1:0 |
| [/category/reise-mietwagen/](https://trilacheck.de/category/reise-mietwagen/) | h1:0 |
| [/category/strom-gas/strom/](https://trilacheck.de/category/strom-gas/strom/) | h1:0 |
| [/category/strom-gas/](https://trilacheck.de/category/strom-gas/) | h1:2 |
| [/category/versicherungen/](https://trilacheck.de/category/versicherungen/) | h1:0 |

## CHECK24 and Google reference comparison

The reference patterns are topic-specific comparison titles, an identifiable comparison form, explanatory content, related topic navigation, publisher/contact information and clear descriptions of the service. CHECK24.net's public [homepage](https://www.check24.net/) and [Stromvergleich page](https://www.check24.net/stromvergleich/) were reviewed, together with indexed CHECK24.de [DSL](https://www.check24.de/dsl/) and [Stromvergleichsrechner](https://www.check24.de/strom/stromvergleichsrechner/) pages. The direct CHECK24.de Strom entry redirects to a calculator endpoint which the research browser could not fetch; this was not treated as a complete technical crawl of CHECK24. No competitor content, trust claims or certificates were copied.

Google creates search-result titles and snippets automatically; good metadata supplies signals, not a guaranteed visual result. See [title links](https://developers.google.com/search/docs/appearance/title-link) and [search appearance FAQ](https://developers.google.com/search/help/site-appearance-faq). Canonicals and sitemaps were evaluated against Google's [canonicalization](https://developers.google.com/search/docs/crawling-indexing/canonicalization) and [sitemap](https://developers.google.com/search/docs/crawling-indexing/sitemaps/build-sitemap) guidance. Empty-archive indexing policy follows Google's [noindex guidance](https://developers.google.com/search/docs/crawling-indexing/block-indexing). Description fixes use the documented [Yoast description API](https://developer.yoast.com/features/seo-tags/descriptions/api/).

## Limits and remaining work

- This audit cannot verify Google's actual indexed URL inventory, chosen canonicals, search queries, clicks, manual actions or historical Core Web Vitals without the property's Google Search Console data. A site: query is not a reliable indexing audit. No ranking or “100% SEO” guarantee is made.
- The public PageSpeed API returned HTTP 429 (daily quota exceeded). No valid new Lighthouse performance score or field Core Web Vitals result was obtained. Render-time performance, third-party widget cost and mobile layout need a separate permitted browser/Lighthouse run or Search Console field data.
- Browser-based visual/geometry verification has not been run in this session. Header layout is implemented with equal-sized controls, and keyboard/toggle interactions are covered by automated tests.
- Schema was parsed locally, not submitted to Google's Rich Results Test. No certification of rich-result eligibility is claimed. General commercial FAQs do not automatically qualify for Google's restricted FAQ rich results.
- This was not an editorial accuracy, legal compliance, security penetration or full third-party checkout audit. Thin-topic coverage remains an editorial opportunity: Strom and the other empty categories need useful original articles rather than manufactured links or invented claims.
- Audit data is a point-in-time snapshot. Future WordPress content/plugin changes should be checked again.

## Validation / deployment

Local PHP syntax checks, responsive search interaction tests, metadata/robots regression tests and theme package checks are run before committing. GitHub Actions repeats them on PHP 8.2/8.3, creates the validated package, backs up the current production theme and deploys only the theme. A full HTTP/HTML recrawl after deployment will be recorded below; the baseline above must not be mistaken for that follow-up.

## Post-deployment verification

Code commit `4bd47e3655b13b4df872ea520da90ee240d6ce3d` was deployed successfully in [GitHub Actions run 41632474244](https://github.com/vuetim/trilacheck/actions/runs/41632474244). PHP 8.2/8.3, search interactions, metadata/robots regression checks, package validation and the backed-up server deployment all passed.

A fresh crawl of all 45 landing URLs and all 41 sitemap URLs confirmed:

- All landing URLs return 200, with exactly one H1, one main landmark and one nonempty meta description. No nested main landmarks remain.
- All 41 indexable landing URLs retain one self-referencing canonical.
- Four empty category archives now have `noindex, follow`: Konto & Finanzen, Reise & Mietwagen, Strom and Versicherungen. Yoast intentionally omits the canonical tag for these noindex archives; this is not reported as an error. Their category routes remain available, and they stay outside the sitemap. Their indexing restriction clears automatically when the archive contains published posts.
- Missing descriptions at all four affected routes were confirmed present in live HTML. Existing nonempty descriptions remained unchanged.
- No duplicate page titles/descriptions, orphaned landing URLs or broken same-page fragment targets were found in the follow-up crawl. Schema remains one valid JSON-LD script per landing URL.
- The missing-URL probe still returns HTTP 404 and now includes the explicit “Seite nicht gefunden” H1.
- Header HTML contains the “Alle” label, and shared interaction tests cover collapsed/open search and Escape behavior on both desktop and mobile. Browser geometry was not measured; equal icon/control dimensions are implemented in CSS.

These results close the specific technical issues found by this audit. The Search Console, field performance, Rich Results Test and browser-verification limits above still apply.