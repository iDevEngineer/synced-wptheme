# Synced WP Theme

A clean, modern WordPress starter theme by [Synced](https://synced.agency).

Built from scratch — no bloat, no third-party starter. Owns Tailwind CSS v4 configuration directly in CSS, uses Vite as the build tool, and vanilla PHP templates following the standard WordPress template hierarchy.

## Stack

- **Tailwind CSS v4** — CSS-first config, no `tailwind.config.js`
- **Vite 6** — dev server with HMR, production manifest builds
- **Vanilla PHP** — standard WordPress template hierarchy
- **CSS custom properties** — brand colours and typography via `@theme`
- No jQuery, no Bootstrap, no ACF, no bloat

## Prerequisites

- Node.js 18+
- npm 9+
- WordPress 6.0+

## Installation

```bash
# Install dependencies
npm install

# Start the Vite dev server (HMR on port 3000)
npm run dev

# Production build — outputs to assets/dist/
npm run build
```

After running `npm run build`, activate the theme in WordPress. The built CSS and JS are loaded automatically via the Vite manifest in `functions.php`.

## Directory Structure

```
synced-wptheme/
├── style.css              # WordPress theme header (required)
├── functions.php          # Theme setup + Vite manifest asset loading
├── index.php              # Fallback template
├── front-page.php         # Homepage template
├── page.php               # Default page template
├── single.php             # Single post template
├── archive.php            # Archive/category/tag template
├── 404.php                # 404 template
├── header.php             # Site header partial
├── footer.php             # Site footer partial
├── templates/
│   └── full-width.php     # Full-width page template (selectable in WP admin)
├── parts/
│   ├── content.php        # Post card partial (index/archive)
│   ├── content-none.php   # No-results partial
│   └── nav.php            # Post-to-post navigation partial
├── assets/
│   ├── src/
│   │   ├── css/
│   │   │   ├── app.css        # Entry point — imports all CSS
│   │   │   ├── variables.css  # @theme block (colours, fonts, spacing)
│   │   │   ├── base.css       # Reset and typography defaults
│   │   │   └── components.css # Reusable UI components
│   │   └── js/
│   │       └── app.js         # JS entry point (minimal)
│   └── dist/              # Built assets — gitignored
├── vite.config.js
└── package.json
```

## Customising Colours

Edit `assets/src/css/variables.css`. All brand tokens live in the `@theme` block:

```css
@theme {
  --color-primary: #ffffff;
  --color-secondary: #1a1a1a;
  --color-accent: #6366f1;
  --color-accent-dark: #4f46e5;
  --font-sans: 'Inter', system-ui, sans-serif;
}
```

Tailwind v4 reads these as design tokens. Any `--color-*` or `--font-*` variables defined here are automatically available as Tailwind utilities (e.g. `bg-accent`, `text-secondary`, `font-sans`).

After changes, rebuild: `npm run build`.

## Vite Manifest Loading

Vite writes a `assets/dist/.vite/manifest.json` on production builds. The theme reads this manifest in `functions.php` to resolve the correct hashed file paths:

```php
function synced_vite_asset_url( string $entry ): ?string {
    $manifest = synced_vite_manifest();
    if ( empty( $manifest[ $entry ] ) ) {
        return null;
    }
    return get_template_directory_uri() . '/assets/dist/' . $manifest[ $entry ]['file'];
}
```

This means asset URLs are always correct regardless of hash changes between builds. The dev server (port 3000) is separate — for HMR during development you'd point WordPress at the Vite dev server directly, or run both and use the manifest in production mode.

## Adding Page Templates

1. Create a new file in `templates/`, e.g. `templates/landing.php`
2. Add the template header comment at the top:
   ```php
   <?php
   /**
    * Template Name: Landing Page
    */
   ```
3. WordPress will list it automatically in the Page Attributes panel.

## Licence

GPL-2.0-or-later — see [https://www.gnu.org/licenses/gpl-2.0.html](https://www.gnu.org/licenses/gpl-2.0.html).
