# Deeper content and publisher review — 3 November 2026

This follows the technical HTTP/HTML audit. It inspects the public rendered content captured during today's post-deployment crawl, excluding navigation, the shared footer, article sidebars, related cards and trust strips from the main-content comparison. It is not a Google indexing, legal-compliance or ranking certification.

## Assessment of the 28-day performance screenshots

The screenshots show about 4.4k impressions, 9 clicks, CTR 0.2% and average position 55.6 over the selected 28 days. This demonstrates organic visibility for relevant queries; it does not establish strong rankings, profitable traffic, growth against a previous period, or results attributable to today's changes. The displayed performance range ends on 1 November, before today's technical fixes. Site age should not be inferred from a 28-day report window.

## Confirmed strengths

- All six articles contain substantial rendered body text, actual crawlable links to relevant comparison pages, and at least one external reference/source link. No post-body link injection was needed.
- The Gasvergleich article's body has two links to `/gas/`, a link to the Gaspreis article, and links to Strom and DSL. The earlier statement that it lacked a Gas backlink was withdrawn; the current live HTML confirms the supplied article version.
- Approximate extracted body lengths range from 634 to 1,259 whitespace-separated tokens. These are diagnostic counts, not Google's word counts and not a ranking threshold.
- The core Strom, Gas and DSL pages provide different, topic-specific explanations outside the calculators. A comparison page and an informational article can legitimately cover related topics while meeting different user needs.
- Existing public metadata, readable main content, internal discovery, status codes and canonicals already passed the preceding technical audit. This review does not reverse those findings; it examines different questions.

| Article | Approximate body tokens | Relevant comparison links in body | External reference links |
| --- | ---: | --- | ---: |
| Gaspreis aktuell 2026 | 634 | Gas | 2 |
| Gasvergleich 2026 | 763 | Gas, Strom, DSL | 2 |
| Auto-Saisoncheck | 987 | Auto & Fahrzeuge, Mietwagen | 1 |
| Handy mit Vertrag ohne Anzahlung | 983 | Handy mit Vertrag, Mobilfunk | 3 |
| Handy mit oder ohne Vertrag | 1,259 | Handy mit Vertrag, Mobilfunk and tariff detail pages | 3 |
| Wie viel Datenvolumen brauche ich? | 1,144 | Mobilfunk and tariff detail pages | 2 |

Counts include reference links, not a judgment that every source is current, independent or supports every claim. No factual or legal rewrite of the article bodies was performed.

## Findings and priorities

### 1. Migration URL in author schema — theme correction

The six article pages output a Yoast `Person` node with a `sameAs` profile pointing to `http://trilacheck.local`. That development address is not an appropriate public author profile. A narrowly scoped Yoast filter removes only that verified migration hostname and preserves legitimate public profiles. No additional schema script is created. The underlying WordPress user website/profile settings should also be cleaned up when administrative access is available.

The visible article template does not currently display an author byline, while schema uses the generic account name `trilacheckadmin`. Accurate public authorship and a real profile/bio would improve clarity. The review does not invent a person, credentials, portrait or expert review. The owner must supply truthful authorship information before those can be added.

### 2. Publisher identity — owner-confirmed details, legal drafts prepared

The owner confirmed the legal name **TRILA GROUP L.L.C** and address **Jahnallee 14, 04109 Leipzig**, with no country added in the provider identity block. The site brand remains **TrilaCheck.de**. Yoast's existing Organization node receives `legalName`; its name, ID, logo, public URLs and social references remain unchanged.

The public pages currently disagree:

- Impressum and the controller paragraph in Datenschutz reference Zentrila Group LLC and a different address.
- AGB references TrilaCheck LLC and the Leipzig address.
- AGB/Datenschutz also contain the old brand TarifDetektiv, and Datenschutz references an email address on that old domain.

Three ready-to-paste HTML drafts normalize the provider identity, replace the old site's brand/company references, and use the already-published contact `kontakt@trilacheck.de`. References to countries in third-party addresses or legal provisions are not indiscriminately removed. Existing legal clauses, dates, processing descriptions and regulatory claims are not certified or rewritten by this identity edit.

**Publication limit:** the permission request to export the actual WordPress legal-post content over SSH was rejected. Therefore no database edits were attempted through that route. The drafts use the public rendered legal-page bodies and are not claimed to be a raw Gutenberg export. They have not been published to the live legal pages. They are provided separately as `trilacheck-legal-drafts-2026-11-03.zip` in the workspace root; they are not a theme/plugin ZIP.

### 3. Mobile tariff detail pages — distinguish the actual topics

The six detail pages (5 GB, 15 GB, 50 GB, Unlimited, Prepaid and young-person tariffs) have different titles and introductions, but much of their explanatory paragraph text is shared. A local five-word paragraph-shingle comparison found substantial overlap. This diagnostic is not Google's similarity metric, proof of duplicate indexing, or evidence of a penalty.

Useful editorial work would answer the specific questions for each page: typical usage and limitations for 5/15/50 GB, speed limits and fair-use restrictions for Unlimited, billing/top-up conditions for Prepaid, and eligibility/age restrictions for young-person offers. Add only verified, genuinely useful details. Do not expand pages to hit an arbitrary word target or repeat keyword variants. Existing content was left intact.

### 4. Vacation destination pages — little first-party explanation

The four pages for Mallorca, Gardasee, Allgäu and Istrien currently provide a destination heading, affiliate disclosure and a JavaScript requirement message in the initial first-party main HTML (roughly 29 whitespace tokens each in this extraction). Their calculator can render additional content via JavaScript or an external embed; this audit did not render that content or claim that Google cannot see any of it.

They would benefit from original, useful destination-specific explanation: what the comparison includes, how guests should compare locations, accommodation types, fees and cancellation conditions. Do not duplicate a generic paragraph across the four destinations or invent live availability/prices. These drafts require separate content work and verified sources; no new content sections were inserted during this audit.

### 5. Query-to-URL targeting — cannot be proven from totals

The homepage has a portal-wide title but a first-slider H1 about Strom. This may be worth reviewing against the queries for which Google selects the homepage versus `/strom/`. It is not by itself proof of keyword cannibalization. Likewise related mobile pages should be evaluated query by query before changing their targets.

To prioritize ranking work, use Search Console query filters and the Pages tab to see the actual query–URL pairs, then compare equal time periods. The supplied aggregate screenshots do not identify those pairs or conversions. Query and Pages exports would support a stronger priority list; no Search Console account connection was available in this session.

## Reference principles

- [Google: helpful, reliable content and accurate authorship](https://developers.google.com/search/docs/fundamentals/creating-helpful-content).
- [Google: view pages shown for a query](https://support.google.com/webmasters/answer/17010961?hl=en).
- [Yoast: Person schema and social-profile filters](https://developer.yoast.com/features/schema/pieces/person/).
- [Yoast: Organization schema customization](https://developer.yoast.com/features/schema/pieces/organization/).

## Validation

Metadata/robots tests were extended to cover removal of the verified migration profile while preserving genuine public profiles, and addition of the owner-confirmed legal name while retaining the existing Organization graph. Local tests passed. Live deployment verification is recorded after the CI/CD run; legal drafts remain explicitly separate from that theme deployment.
