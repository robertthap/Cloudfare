namespace Gharkowebsite.Services;

/// <summary>Hosting-specific options (cheap shared hosts, external form handlers).</summary>
public sealed class HostingOptions
{
    public const string SectionName = "Hosting";

    /// <summary>Public site URL with scheme, e.g. https://www.yournamuna.com — used for Web3Forms redirect after submit.</summary>
    public string? PublicSiteUrl { get; set; }

    public ExternalContactFormOptions ExternalContactForm { get; set; } = new();
}

public sealed class ExternalContactFormOptions
{
    /// <summary>
    /// Access key from https://web3forms.com — posts directly from the browser (no SMTP on your server).
    /// Leave empty to use built-in SMTP email via MailKit instead.
    /// </summary>
    public string? Web3FormsAccessKey { get; set; }
}
