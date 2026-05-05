namespace Gharkowebsite.Services;

public interface IEmailService
{
    Task SendContactEmailAsync(
        string senderName,
        string senderEmail,
        string? senderPhone,
        string? subject,
        string message,
        CancellationToken cancellationToken = default);
}
