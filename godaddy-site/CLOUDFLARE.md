# Cloudflare Pages (free) + GoDaddy domain

This site is **PHP during development** and on Render. **Cloudflare Pages only serves static files**, so you deploy the output of a **PHP build** that writes HTML into **`cf-pages-out/`** at the repo root.

## Important: Cloudflare’s Git build cannot run PHP

Cloudflare Pages **does not ship `php`** in the build container, and **you cannot `apt-get install` packages** there. If you set **Build command** to `php scripts/Build-CloudflarePages.php`, the build fails with **`php: not found`**.

**Use GitHub Actions** (below) to run PHP on Ubuntu, then **`wrangler pages deploy`**. Optionally **disconnect** the Git repository from your Pages project so Cloudflare does not run a failing build on every push.

---

## 1. Build locally (optional, requires PHP 8.1+)

From the **repository root**:

```bash
php scripts/Build-CloudflarePages.php
```

Optional environment variables:

| Variable | Purpose |
|----------|---------|
| `PUBLIC_SITE_URL` | Canonical URL (default `https://namuna.com.au` if unset). |
| `WEB3FORMS_ACCESS_KEY` | Inlined into the contact form. |

Refresh the menu partial from the .NET project when needed:

```powershell
powershell.exe -ExecutionPolicy Bypass -File scripts/Export-GodaddySite.ps1
```

---

## 2. Recommended: GitHub Actions → Cloudflare Pages (free)

### A. Create the Pages project (once)

In [Cloudflare Dashboard](https://dash.cloudflare.com) → **Workers & Pages** → **Create** → **Pages**:

- Either create an **empty** project and note the **project name** (e.g. `cloudfare`), **or**
- Let the first successful **`wrangler pages deploy`** create it (depends on token permissions).

You do **not** need a working Git-connected build on Cloudflare for this flow.

### B. Disconnect failing Git builds (if you connected GitHub earlier)

**Pages** → your project → **Settings** → **Builds & deployments** (or **Connected Git**):

- **Disconnect** the repository so pushes do not trigger `php: not found` builds.

Deployments will come only from **GitHub Actions**.

### C. GitHub secrets and variables

Repo **Settings** → **Secrets and variables** → **Actions**:

| Type | Name | Value |
|------|------|--------|
| Secret | `CLOUDFLARE_API_TOKEN` | Token with **Account** → **Cloudflare Pages** → **Edit** (and read as needed) |
| Secret | `CLOUDFLARE_ACCOUNT_ID` | Account ID (dashboard sidebar) |
| Secret | `WEB3FORMS_ACCESS_KEY` | Web3Forms access key |
| Variable | `CLOUDFLARE_PAGES_PROJECT_NAME` | Exact Pages **project name** (e.g. `cloudfare`) |
| Variable (optional) | `PUBLIC_SITE_URL` | e.g. `https://namuna.com.au` |

### D. Run the workflow

Push to **`main`** or **Actions** → **Cloudflare Pages** → **Run workflow**.

Workflow file: [`.github/workflows/cloudflare-pages.yml`](../.github/workflows/cloudflare-pages.yml).

---

## 3. Custom domain (domain stays at GoDaddy)

1. **Pages** → your project → **Custom domains** → add **`namuna.com.au`** / **`www`** as needed.
2. Add the DNS records Cloudflare shows in **GoDaddy** → **namuna.com.au** → **DNS**.
3. Wait for verification and **HTTPS**.

Match **`PUBLIC_SITE_URL`** (GitHub variable) to your canonical URL.

---

## 4. Direct Upload (no GitHub Actions)

1. On your PC: `php scripts/Build-CloudflarePages.php` (with env vars set).
2. Cloudflare **Pages** → **Create** → upload the **`cf-pages-out`** folder, or use Wrangler:  
   `npx wrangler pages deploy cf-pages-out --project-name=YOUR_PROJECT`

---

## 5. Behaviour notes

- **Internal links** become **`.html`** during the static build (`CF_STATIC_BUILD` in [`includes/config.php`](includes/config.php)).
- **`_redirects`** maps **`.php`** → **`.html`** (301).
- **Contact thank-you:** [`contact.php`](contact.php) + `?sent=1` (see source).
- **Menu:** run [`scripts/Export-GodaddySite.ps1`](../scripts/Export-GodaddySite.ps1) before building when `Menu.cshtml` changes.

---

## 6. Render vs Pages

Use **one** primary host for **namuna.com.au** DNS to avoid duplicate/confusing setups.
