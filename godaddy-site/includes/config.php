<?php
declare(strict_types=1);

require_once __DIR__ . '/bootstrap.php';

if (!defined('CF_STATIC_BUILD')) {
    define('CF_STATIC_BUILD', false);
}

const SITE_DISPLAY_NAME = 'Namuna Foods';
const SITE_LEGAL_NAME = 'NAMUNA FOODS';
const SITE_TAGLINE = 'A Bold Fusion of East and West';
const SITE_PHONE_DISPLAY = '02 9446 7113';
const SITE_PHONE_TEL = 'tel:+61294467113';
const SITE_EMAIL = 'support@namuna.com.au';
const SITE_ADDRESS = '84-86 Yarrara Road, Pennant Hills NSW 2120';

const ORDER_UP_URL = 'https://wildcaktus.orderup.com.au/stores/namuna-foods';
const UBER_EATS_URL = 'https://www.ubereats.com/au/store/namuna-foods/OLmJZlbYTPSyYyByzzjAyg?diningMode=DELIVERY&sc=SEARCH_SUGGESTION';
const DOORDASH_URL = 'https://www.doordash.com/store/namuna-foods-pennant-hills-37794397/94067946/?pickup=false';

const GOOGLE_MAPS_REVIEWS = 'https://www.google.com/maps?cid=7982895822049931000';

/** Paste Web3Forms access key from https://web3forms.com — empty = mail-only notice */
const WEB3FORMS_ACCESS_KEY = '';

/** https://www.yourdomain.com — for contact form redirect */
const PUBLIC_SITE_URL = '';

/** Subfolder: '' or '/folder' without trailing slash */
const SITE_PREFIX = '';

/** Prefer env (e.g. Render dashboard); falls back to WEB3FORMS_ACCESS_KEY constant. */
function web3forms_access_key(): string
{
    $e = getenv('WEB3FORMS_ACCESS_KEY');

    if ($e !== false && trim($e) !== '') {
        return trim($e);
    }

    return WEB3FORMS_ACCESS_KEY;
}

/** Prefer env PUBLIC_SITE_URL; else Render’s default URL; else constant. No trailing slash. */
function public_site_url(): string
{
    $e = getenv('PUBLIC_SITE_URL');
    if ($e !== false && trim($e) !== '') {
        return rtrim(trim($e), '/');
    }
    if (!CF_STATIC_BUILD) {
        $renderUrl = getenv('RENDER_EXTERNAL_URL');
        if ($renderUrl !== false && trim($renderUrl) !== '') {
            return rtrim(trim($renderUrl), '/');
        }
    }

    return rtrim(PUBLIC_SITE_URL, '/');
}

function url(string $path): string
{
    $query = '';
    $pathOnly = $path;
    if (str_contains($path, '?')) {
        $parts = explode('?', $path, 2);
        $pathOnly = $parts[0];
        $query = '?' . $parts[1];
    }
    $p = '/' . ltrim($pathOnly, '/');
    if (CF_STATIC_BUILD && preg_match('#\.php$#i', $p)) {
        $p = preg_replace('#\.php$#i', '.html', $p);
    }
    $pre = rtrim(SITE_PREFIX, '/');

    return ($pre === '' ? $p : $pre . $p) . $query;
}

/** https://current-host or PUBLIC_SITE_URL when set (no trailing slash). */
function request_origin(): string
{
    $pub = public_site_url();
    if ($pub !== '') {
        return $pub;
    }
    $host = isset($_SERVER['HTTP_HOST']) ? (string) $_SERVER['HTTP_HOST'] : '';
    if ($host === '') {
        return '';
    }
    $https = (!empty($_SERVER['HTTPS']) && (string) $_SERVER['HTTPS'] !== 'off')
        || (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && (string) $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https');
    $scheme = $https ? 'https' : 'http';

    return $scheme . '://' . $host;
}

/** Canonical absolute URL for a site path (uses PUBLIC_SITE_URL when configured). */
function absolute_url(string $path): string
{
    $origin = request_origin();

    return $origin !== '' ? $origin . url($path) : url($path);
}

function mailto_support(): string
{
    return 'mailto:' . SITE_EMAIL;
}
