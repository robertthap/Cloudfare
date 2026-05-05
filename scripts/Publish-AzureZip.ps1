<#
.SYNOPSIS
  Builds a Release publish folder and creates site.zip ready for Azure App Service (ZIP deploy).

.NOTES
  Run from anywhere:
    pwsh -File "c:\Users\rober\OneDrive\Desktop\Gharkowebsite\scripts\Publish-AzureZip.ps1"

  Upload site.zip in Azure Portal → your Web App → Deployment Center,
  or: az webapp deploy --resource-group RG --name APP --src-path site.zip --type zip
#>
Set-StrictMode -Version Latest
$ErrorActionPreference = "Stop"

$ScriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$RepoRoot = Resolve-Path (Join-Path $ScriptDir "..")
$Csproj = Join-Path $RepoRoot "Gharkowebsite\Gharkowebsite\Gharkowebsite.csproj"
$Artifacts = Join-Path $RepoRoot "artifacts"
$PublishDir = Join-Path $Artifacts "publish"
$ZipPath = Join-Path $Artifacts "site.zip"

if (-not (Test-Path $Csproj)) {
    Write-Error "Project file not found: $Csproj"
}

Write-Host "Publishing to: $PublishDir" -ForegroundColor Cyan
if (Test-Path $PublishDir) {
    Remove-Item $PublishDir -Recurse -Force
}

dotnet publish $Csproj -c Release -o $PublishDir
if ($LASTEXITCODE -ne 0) { exit $LASTEXITCODE }

$dll = Join-Path $PublishDir "Gharkowebsite.dll"
if (-not (Test-Path $dll)) {
    Write-Error "Expected Gharkowebsite.dll missing - publish layout wrong."
}

if (Test-Path $ZipPath) {
    Remove-Item $ZipPath -Force
}

Compress-Archive -Path (Join-Path $PublishDir "*") -DestinationPath $ZipPath -Force

$zipSize = (Get-Item $ZipPath).Length / 1MB
$zipMb = [math]::Round($zipSize, 2)
Write-Host ""
Write-Host "Done." -ForegroundColor Green
Write-Host "  Folder: $PublishDir"
Write-Host ('  ZIP:    ' + $ZipPath + ' (' + [string]$zipMb + ' MB)')
Write-Host ""
Write-Host "Next (your account):" -ForegroundColor Yellow
Write-Host '  1. Azure Portal -> Web App -> Deployment -> upload site.zip'
Write-Host '  2. Or: az login then run Deploy-AzureCLI.ps1'
Write-Host '  See scripts/GoDaddy-hosting.txt for GoDaddy Windows vs Linux limits.'
