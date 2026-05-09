# Cloudflare Pages (free) + GoDaddy domain

This site is **PHP during development** and on Render. **Cloudflare Pages only serves static files**, so you deploy the output of a **one-time PHP build** that writes HTML into **`cf-pages-out/`** at the repo root.

## 1. Build locally (requires PHP 8.1+)

From the **repository root**:

```bash
php scripts/Build-CloudflarePages.php
```

Optional environment variables:

| Variable | Purpose |
|----------|---------|
| `PUBLIC_SITE_URL` | Canonical URL (default `https://namuna.com.au` if unset). Used for meta tags and Web3Forms redirect. |
| `WEB3FORMS_ACCESS_KEY` | Inlined into the contact form so submissions work on static hosting. |

Before building, refresh the menu partial from the .NET project when needed:

```powershell
powershell.exe -ExecutionPolicy Bypass -File scripts/Export-GodaddySite.ps1
```

## 2. Create a Cloudflare Pages project (free)

1. Sign in to [Cloudflare Dashboard](https://dash.cloudflare.com) → **Workers & Pages** → **Create** → **Pages** → **Connect to Git** (recommended) **or** **Direct Upload**.
2. If **Connect to Git**:
   - Select this repo and branch **`main`**.
   - **Framework preset:** None.
   - **Build command:** `php scripts/Build-CloudflarePages.php`
   - **Build output directory:** `cf-pages-out`
   - **Root directory:** `/` (repo root).
   - Add **environment variables** in the project settings: `PUBLIC_SITE_URL`, `WEB3FORMS_ACCESS_KEY` (secret), and ensure the Cloudflare build image has **PHP** (if not, use the GitHub Action below instead of Cloudflare’s build).
3. If **Direct Upload**: run the build locally or in CI, then upload the **`cf-pages-out`** folder (or use Wrangler as below).

## 3. Custom domain (domain stays at GoDaddy)

You can keep **domain registration** at GoDaddy and only change **DNS**:

1. In **Pages** → your project → **Custom domains** → add **`namuna.com.au`** and optionally **`www.namuna.com.au`**.
2. Cloudflare shows the **DNS records** you must create (often **CNAME** for `www`; apex may use specific **A** records or CNAME flattening — follow their UI exactly).
3. In **GoDaddy** → **namuna.com.au** → **DNS** → add or update those records. Remove conflicting old **A/CNAME** rows if their instructions say so.
4. Wait until the domain shows **Active** / **Verified** on Pages. **HTTPS** is issued automatically on the free tier.

Set **`PUBLIC_SITE_URL`** in the build environment to match your **canonical** URL (`https://namuna.com.au` or `https://www.namuna.com.au`).

## 4. GitHub Actions (optional, free)

If Cloudflare’s build environment does not include PHP, use **GitHub Actions** to run the PHP build and deploy with Wrangler.

1. In Cloudflare: **My Profile** → **API Tokens** → create a token with **Cloudflare Pages — Edit** (and account read as needed).
2. Copy **Account ID** from the Cloudflare dashboard sidebar.
3. In GitHub: **Settings** → **Secrets and variables** → **Actions**:
   - Secrets: `CLOUDFLARE_API_TOKEN`, `CLOUDFLARE_ACCOUNT_ID`, `WEB3FORMS_ACCESS_KEY`
   - Variables: `CLOUDFLARE_PAGES_PROJECT_NAME` (must match an **existing** Pages project name), optional `PUBLIC_SITE_URL`

Push to **`main`** triggers [`.github/workflows/cloudflare-pages.yml`](../.github/workflows/cloudflare-pages.yml).

## 5. Behaviour notes

- **Internal links** become **`.html`** during the static build (`CF_STATIC_BUILD` in [`includes/config.php`](includes/config.php)).
- **`_redirects`** maps old **`.php`** URLs to **`.html`** (301) for bookmarks.
- **Contact thank-you:** [`contact.php`](contact.php) shows success after redirect using **`?sent=1`** (server or client).
- **Menu** content still comes from [`scripts/Export-GodaddySite.ps1`](../scripts/Export-GodaddySite.ps1) → [`includes/partials/menu-main.inc.php`](includes/partials/menu-main.inc.php); re-export before each build when the Razor menu changes.

## 6. Render vs Pages

You can run **Render** and **Pages** at the same time for testing; for production pick **one** primary host and point **DNS** accordingly.
