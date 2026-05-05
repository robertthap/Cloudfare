using System.ComponentModel.DataAnnotations;
using Gharkowebsite.Services;
using Microsoft.AspNetCore.Mvc;
using Microsoft.AspNetCore.Mvc.RazorPages;
using Microsoft.Extensions.Options;

namespace Gharkowebsite.Pages;

public class ContactModel : PageModel
{
    private readonly IEmailService _emailService;
    private readonly ILogger<ContactModel> _logger;
    private readonly HostingOptions _hosting;

    public ContactModel(
        IEmailService emailService,
        ILogger<ContactModel> logger,
        IOptions<HostingOptions> hostingOptions)
    {
        _emailService = emailService;
        _logger = logger;
        _hosting = hostingOptions.Value;
    }

    [BindProperty]
    public ContactInput Input { get; set; } = new();

    public bool ShowSuccessMessage { get; set; }

    public string? ErrorMessage { get; set; }

    /// <summary>Browser POST to Web3Forms — no SMTP on your server (good for tight hosting).</summary>
    public bool UseWeb3Forms =>
        !string.IsNullOrWhiteSpace(_hosting.ExternalContactForm?.Web3FormsAccessKey);

    public string Web3FormsAccessKey => _hosting.ExternalContactForm!.Web3FormsAccessKey!.Trim();

    public string? Web3FormsRedirectUrl
    {
        get
        {
            var baseUrl = _hosting.PublicSiteUrl?.Trim();
            if (string.IsNullOrEmpty(baseUrl))
                return null;
            return $"{baseUrl.TrimEnd('/')}/contact?sent=1#contact-form";
        }
    }

    public void OnGet()
    {
        if (Request.Query.ContainsKey("sent") && Request.Query["sent"] == "1")
        {
            ShowSuccessMessage = true;
        }
    }

    public async Task<IActionResult> OnPostAsync(CancellationToken cancellationToken)
    {
        if (UseWeb3Forms)
        {
            return RedirectToPage("/Contact");
        }

        if (!ModelState.IsValid)
        {
            return Page();
        }

        try
        {
            await _emailService.SendContactEmailAsync(
                senderName: Input.Name!.Trim(),
                senderEmail: Input.Email!.Trim(),
                senderPhone: Input.Phone?.Trim(),
                subject: Input.Subject?.Trim(),
                message: Input.Message!.Trim(),
                cancellationToken: cancellationToken);

            return RedirectToPage(
                pageName: null,
                pageHandler: null,
                routeValues: new { sent = 1 },
                fragment: "contact-form");
        }
        catch (Exception ex)
        {
            _logger.LogError(ex, "Contact form submission failed");
            ErrorMessage = "Sorry, we couldn't send your message right now. Please try again later or call us directly.";
            return Page();
        }
    }

    public class ContactInput
    {
        [Required(ErrorMessage = "Please enter your name.")]
        [StringLength(120, MinimumLength = 2, ErrorMessage = "Name must be between 2 and 120 characters.")]
        [Display(Name = "Name")]
        public string? Name { get; set; }

        [Required(ErrorMessage = "Please enter your email.")]
        [EmailAddress(ErrorMessage = "Please enter a valid email address.")]
        [StringLength(200)]
        [Display(Name = "Email")]
        public string? Email { get; set; }

        [Phone(ErrorMessage = "Please enter a valid phone number.")]
        [StringLength(40)]
        [Display(Name = "Phone")]
        public string? Phone { get; set; }

        [StringLength(150)]
        [Display(Name = "Subject")]
        public string? Subject { get; set; }

        [Required(ErrorMessage = "Please enter a message.")]
        [StringLength(4000, MinimumLength = 5, ErrorMessage = "Message must be between 5 and 4000 characters.")]
        [Display(Name = "Message")]
        public string? Message { get; set; }
    }
}
