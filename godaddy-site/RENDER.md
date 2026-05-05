# Deploy Namuna PHP site on Render + use GoDaddy domain

Quick checklist: see **`NEXT-STEPS.txt`** in this folder.

Render does **not** run PHP on “Static Sites”. Use a **Web Service** with this folder’s **Dockerfile** (Apache + PHP 8.2).

## Monorepo (this Gharkowebsite repo)

The repo root has **`render.yaml`** pointing at **`godaddy-site/`**. Use **New → Blueprint** on Render and select this repo; set **`WEB3FORMS_ACCESS_KEY`** when asked.

`PUBLIC_SITE_URL` is preset to **`https://namuna.com.au`** in that Blueprint (change there if you use **www** only).

## 1. Push to GitHub

Run `scripts/Export-GodaddySite.ps1` locally so `includes/partials/menu-main.inc.php` and `images/` exist **before** you push.

## 2. Create the Web Service on Render (manual alternative to Blueprint)

1. [dashboard.render.com](https://dashboard.render.com) → **New +** → **Web Service**.
2. Connect your Git repo.
3. Settings:
   - **Runtime:** Docker  
   - If **Root Directory** is available: enter **`godaddy-site`** (monorepo). If this repo **is** only `godaddy-site`, leave root blank.
   - **Dockerfile path:** `Dockerfile`  
   - **Docker build context:** same directory as the Dockerfile (usually `.`).
4. **Instance type:** Free is OK; note [free tier limits](https://render.com/docs/free) (cold starts, spins down).
5. **Environment variables**:
   - `PUBLIC_SITE_URL` = `https://namuna.com.au` or `https://www.namuna.com.au` (no trailing slash). On Render, **`RENDER_EXTERNAL_URL`** is used automatically if this is unset (good for `*.onrender.com` until the custom domain is live).
   - `WEB3FORMS_ACCESS_KEY` = your Web3Forms key (secret).
6. Deploy. Wait until the service shows **Live** and opens the `*.onrender.com` URL.

## 3. Custom domain (namuna.com.au on GoDaddy)

1. Render → your service → **Settings** → **Custom Domains** → **Add** → enter `namuna.com.au` and/or `www.namuna.com.au`.
2. Render shows **DNS records** to create (often **CNAME** for `www`, and **A/ALIAS** or multiple **A** records for the apex — follow exactly what Render displays).
3. GoDaddy → **namuna.com.au** → **DNS** → add/update those records. Remove conflicting old **A/CNAME** rows if their wizard says so.
4. Wait for verification (minutes to hours). Render issues **HTTPS** automatically.

Pick **one** canonical host (`namuna.com.au` **or** `www`) in Render env **`PUBLIC_SITE_URL`** and add **both** domains on Render if you want; redirect www ↔ apex in Render if offered.

## 4. Blueprint files

- **Repo root** `render.yaml` → Docker context **`godaddy-site/`** (use **New → Blueprint**).
- **`godaddy-site/render.yaml`** → only if **`godaddy-site`** alone is the Git repo root.

## 5. Smoke tests

Open `https://namuna.com.au` → Home, Menu (tabs), Contact form submit.

If deploy fails: check **Logs** (Apache/PHP). If **403** on includes: normal for direct URLs; pages should still work.
