<?php
declare(strict_types=1);

/**
 * Renders godaddy-site PHP pages to static HTML for Cloudflare Pages (free tier).
 *
 * Usage (repo root):
 *   php scripts/Build-CloudflarePages.php
 *
 * Environment (optional):
 *   PUBLIC_SITE_URL — canonical site URL, e.g. https://namuna.com.au (default if unset)
 *   WEB3FORMS_ACCESS_KEY — inlined into contact form when set
 */
if (PHP_SAPI !== 'cli') {
    fwrite(STDERR, "Run from CLI only.\n");
    exit(1);
}

if (!defined('CF_STATIC_BUILD')) {
    define('CF_STATIC_BUILD', true);
}

$repoRoot = dirname(__DIR__);
$siteRoot = $repoRoot . DIRECTORY_SEPARATOR . 'godaddy-site';
$outRoot = $repoRoot . DIRECTORY_SEPARATOR . 'cf-pages-out';

if (!is_dir($siteRoot)) {
    fwrite(STDERR, "Missing directory: {$siteRoot}\n");
    exit(1);
}

$publicUrl = getenv('PUBLIC_SITE_URL');
if ($publicUrl === false || trim($publicUrl) === '') {
    putenv('PUBLIC_SITE_URL=https://namuna.com.au');
    $publicUrl = 'https://namuna.com.au';
}

$host = parse_host_from_url((string) $publicUrl);
if ($host === '') {
    $host = 'localhost';
}

function parse_host_from_url(string $url): string
{
    if (!preg_match('#^https?://#i', $url)) {
        $url = 'https://' . $url;
    }
    $parts = parse_url($url);

    return isset($parts['host']) ? (string) $parts['host'] : '';
}

function rrmdir(string $dir): void
{
    if (!is_dir($dir)) {
        return;
    }
    $it = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator($dir, FilesystemIterator::SKIP_DOTS),
        RecursiveIteratorIterator::CHILD_FIRST
    );
    foreach ($it as $item) {
        $path = $item->getPathname();
        if ($item->isDir()) {
            @rmdir($path);
        } else {
            @unlink($path);
        }
    }
    @rmdir($dir);
}

function copy_directory(string $src, string $dst): void
{
    if (!is_dir($src)) {
        return;
    }
    if (!is_dir($dst)) {
        mkdir($dst, 0755, true);
    }
    $root = new RecursiveDirectoryIterator($src, FilesystemIterator::SKIP_DOTS);
    $it = new RecursiveIteratorIterator($root, RecursiveIteratorIterator::SELF_FIRST);
    /** @var SplFileInfo $item */
    foreach ($it as $item) {
        $sub = str_replace(['/', '\\'], DIRECTORY_SEPARATOR, $it->getSubPathname());
        $target = $dst . DIRECTORY_SEPARATOR . $sub;
        if ($item->isDir()) {
            if (!is_dir($target)) {
                mkdir($target, 0755, true);
            }
        } else {
            $parent = dirname($target);
            if (!is_dir($parent)) {
                mkdir($parent, 0755, true);
            }
            copy($item->getPathname(), $target);
        }
    }
}

rrmdir($outRoot);
mkdir($outRoot, 0755, true);

$pages = [
    'index.php' => 'index.html',
    'menu.php' => 'menu.html',
    'about.php' => 'about.html',
    'reviews.php' => 'reviews.html',
    'order.php' => 'order.html',
    'contact.php' => 'contact.html',
    'qr.php' => 'qr.html',
    '404.php' => '404.html',
];

foreach ($pages as $phpFile => $htmlFile) {
    chdir($siteRoot);
    $_SERVER['SCRIPT_NAME'] = '/' . $phpFile;
    $_SERVER['PHP_SELF'] = '/' . $phpFile;
    $_SERVER['REQUEST_URI'] = '/' . $phpFile;
    $_SERVER['REQUEST_METHOD'] = 'GET';
    $_SERVER['HTTP_HOST'] = $host;
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = '443';
    $_SERVER['HTTP_X_FORWARDED_PROTO'] = 'https';
    $_SERVER['SERVER_NAME'] = $host;

    ob_start();
    include $siteRoot . DIRECTORY_SEPARATOR . $phpFile;
    $html = ob_get_clean();
    if ($html === false) {
        fwrite(STDERR, "Empty output for {$phpFile}\n");
        exit(1);
    }
    $outPath = $outRoot . DIRECTORY_SEPARATOR . $htmlFile;
    file_put_contents($outPath, $html);
    fwrite(STDOUT, "Wrote {$htmlFile}\n");
}

foreach (['css', 'images', 'js', 'lib', 'assets'] as $dir) {
    $from = $siteRoot . DIRECTORY_SEPARATOR . $dir;
    $to = $outRoot . DIRECTORY_SEPARATOR . $dir;
    copy_directory($from, $to);
    fwrite(STDOUT, "Copied {$dir}/\n");
}

$robots = $siteRoot . DIRECTORY_SEPARATOR . 'robots.txt';
if (is_file($robots)) {
    copy($robots, $outRoot . DIRECTORY_SEPARATOR . 'robots.txt');
    fwrite(STDOUT, "Copied robots.txt\n");
}

$redirects = <<<'REDIR'
/index.php /index.html 301
/menu.php /menu.html 301
/about.php /about.html 301
/reviews.php /reviews.html 301
/order.php /order.html 301
/contact.php /contact.html 301
/qr.php /qr.html 301

REDIR;
file_put_contents($outRoot . DIRECTORY_SEPARATOR . '_redirects', $redirects);
fwrite(STDOUT, "Wrote _redirects\n");

fwrite(STDOUT, "\nDone. Deploy folder: {$outRoot}\n");
