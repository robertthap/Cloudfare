<#
.SYNOPSIS
  Deploys artifacts/site.zip to Azure App Service (requires Azure CLI + az login).

.EXAMPLE
  .\Deploy-AzureCLI.ps1 -ResourceGroup "namuna-rg" -WebAppName "namuna-foods-web"
#>
param(
    [Parameter(Mandatory = $true)][string]$ResourceGroup,
    [Parameter(Mandatory = $true)][string]$WebAppName
)

Set-StrictMode -Version Latest
$ErrorActionPreference = "Stop"

$ScriptDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$RepoRoot = Resolve-Path (Join-Path $ScriptDir "..")
$ZipPath = Join-Path $RepoRoot "artifacts\site.zip"

if (-not (Test-Path $ZipPath)) {
    Write-Error "Missing $ZipPath — run Publish-AzureZip.ps1 first."
}

$az = Get-Command az -ErrorAction SilentlyContinue
if (-not $az) {
    Write-Error "Azure CLI not found. Install: https://learn.microsoft.com/cli/azure/install-azure-cli-windows"
}

Write-Host "Deploying $ZipPath → $WebAppName ..." -ForegroundColor Cyan
az webapp deploy --resource-group $ResourceGroup --name $WebAppName --src-path $ZipPath --type zip
if ($LASTEXITCODE -ne 0) { exit $LASTEXITCODE }

Write-Host "Deploy finished." -ForegroundColor Green
