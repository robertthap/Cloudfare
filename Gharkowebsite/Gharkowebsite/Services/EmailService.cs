using System.Net;
using MailKit.Net.Smtp;
using MailKit.Security;
using Microsoft.Extensions.Options;
using MimeKit;

namespace Gharkowebsite.Services;

public class EmailService : IEmailService
{
    private readonly SmtpSettings _settings;
    private readonly ILogger<EmailService> _logger;

    public EmailService(IOptions<SmtpSettings> options, ILogger<EmailService> logger)
    {
        _settings = options.Value;
        _logger = logger;
    }

    public async Task SendContactEmailAsync(
        string senderName,
        string senderEmail,
        string? senderPhone,
        string? subject,
        string message,
        CancellationToken cancellationToken = default)
    {
        if (string.IsNullOrWhiteSpace(_settings.Host))
        {
            throw new InvalidOperationException(
                "SMTP is not configured. Set SmtpSettings:Host (and other values) in configuration or user secrets.");
        }

        var fromAddress = string.IsNullOrWhiteSpace(_settings.FromAddress)
            ? _settings.Username
            : _settings.FromAddress;

        var toAddress = string.IsNullOrWhiteSpace(_settings.ToAddress)
            ? SiteConfig.SupportEmail
            : _settings.ToAddress;

        var displaySubject = string.IsNullOrWhiteSpace(subject) ? "(no subject)" : subject;
        var displayPhone = string.IsNullOrWhiteSpace(senderPhone) ? "(not provided)" : senderPhone;
        var receivedAt = DateTime.Now.ToString("dddd, d MMMM yyyy 'at' h:mm tt");

        var mail = new MimeMessage();
        mail.From.Add(new MailboxAddress(_settings.FromName, fromAddress));
        mail.To.Add(new MailboxAddress(_settings.ToName, toAddress));
        mail.ReplyTo.Add(new MailboxAddress(senderName, senderEmail));
        mail.Subject = string.IsNullOrWhiteSpace(subject)
            ? $"New website enquiry from {senderName}"
            : $"[Namuna Website] {subject}";

        var builder = new BodyBuilder
        {
            TextBody = BuildPlainTextBody(senderName, senderEmail, displayPhone, displaySubject, message, receivedAt),
            HtmlBody = BuildHtmlBody(senderName, senderEmail, senderPhone, displayPhone, displaySubject, message, receivedAt),
        };

        mail.Body = builder.ToMessageBody();

        using var client = new SmtpClient();
        try
        {
            var socketOptions = _settings.UseSsl
                ? SecureSocketOptions.SslOnConnect
                : (_settings.UseStartTls ? SecureSocketOptions.StartTls : SecureSocketOptions.Auto);

            await client.ConnectAsync(_settings.Host, _settings.Port, socketOptions, cancellationToken);

            if (!string.IsNullOrWhiteSpace(_settings.Username))
            {
                await client.AuthenticateAsync(_settings.Username, _settings.Password, cancellationToken);
            }

            await client.SendAsync(mail, cancellationToken);
            await client.DisconnectAsync(true, cancellationToken);

            _logger.LogInformation("Contact form email sent from {Sender} to {Recipient}", senderEmail, toAddress);
        }
        catch (Exception ex)
        {
            _logger.LogError(ex, "Failed to send contact form email from {Sender}", senderEmail);
            throw;
        }
    }

    private static string BuildPlainTextBody(
        string senderName,
        string senderEmail,
        string displayPhone,
        string displaySubject,
        string message,
        string receivedAt)
    {
        return
$@"NEW WEBSITE ENQUIRY — Namuna Foods
==============================================

Received: {receivedAt}

From:    {senderName}
Email:   {senderEmail}
Phone:   {displayPhone}
Subject: {displaySubject}

----------------------------------------------
MESSAGE
----------------------------------------------
{message}

----------------------------------------------
You can reply directly to this email — replies
will go to {senderEmail}.
";
    }

    private static string BuildHtmlBody(
        string senderName,
        string senderEmail,
        string? rawPhone,
        string displayPhone,
        string displaySubject,
        string message,
        string receivedAt)
    {
        string Encode(string value) => WebUtility.HtmlEncode(value);
        string Br(string value) => Encode(value).Replace("\n", "<br />");

        var phoneCell = string.IsNullOrWhiteSpace(rawPhone)
            ? $"<span style=\"color:#9ca3af;\">{Encode(displayPhone)}</span>"
            : $"<a href=\"tel:{Encode(rawPhone!.Replace(" ", string.Empty))}\" style=\"color:#E85C0D;text-decoration:none;\">{Encode(rawPhone!)}</a>";

        return $@"<!doctype html>
<html lang=""en"">
<head>
    <meta charset=""utf-8"" />
    <meta name=""viewport"" content=""width=device-width, initial-scale=1"" />
    <title>New website enquiry</title>
</head>
<body style=""margin:0;padding:0;background-color:#F7F7F7;font-family:-apple-system,BlinkMacSystemFont,'Segoe UI',Roboto,'Helvetica Neue',Arial,sans-serif;color:#1f2937;"">
    <table role=""presentation"" width=""100%"" cellpadding=""0"" cellspacing=""0"" border=""0"" style=""background-color:#F7F7F7;padding:24px 12px;"">
        <tr>
            <td align=""center"">
                <table role=""presentation"" width=""600"" cellpadding=""0"" cellspacing=""0"" border=""0"" style=""max-width:600px;width:100%;background-color:#ffffff;border-radius:14px;overflow:hidden;box-shadow:0 4px 14px rgba(0,0,0,0.06);"">
                    <tr>
                        <td style=""background:linear-gradient(135deg,#E85C0D 0%,#D94F0A 100%);padding:28px 32px;color:#ffffff;"">
                            <div style=""font-size:13px;letter-spacing:0.12em;text-transform:uppercase;opacity:0.85;margin-bottom:6px;"">Namuna Foods · Website</div>
                            <div style=""font-size:24px;font-weight:700;line-height:1.25;"">New website enquiry</div>
                            <div style=""font-size:13px;opacity:0.9;margin-top:6px;"">{Encode(receivedAt)}</div>
                        </td>
                    </tr>

                    <tr>
                        <td style=""padding:28px 32px 8px;"">
                            <div style=""font-size:15px;color:#374151;margin-bottom:16px;"">
                                You've received a new message from the contact form on
                                <span style=""color:#E85C0D;font-weight:600;"">namuna.com.au</span>.
                            </div>

                            <table role=""presentation"" width=""100%"" cellpadding=""0"" cellspacing=""0"" border=""0"" style=""background-color:#FBE7D9;border-radius:10px;padding:18px 20px;"">
                                <tr>
                                    <td style=""font-size:14px;color:#374151;line-height:1.7;"">
                                        <table role=""presentation"" width=""100%"" cellpadding=""0"" cellspacing=""0"" border=""0"">
                                            <tr>
                                                <td width=""90"" style=""color:#6b7280;font-weight:600;padding:4px 0;"">Name</td>
                                                <td style=""color:#111827;font-weight:600;padding:4px 0;"">{Encode(senderName)}</td>
                                            </tr>
                                            <tr>
                                                <td width=""90"" style=""color:#6b7280;font-weight:600;padding:4px 0;"">Email</td>
                                                <td style=""padding:4px 0;""><a href=""mailto:{Encode(senderEmail)}"" style=""color:#E85C0D;text-decoration:none;font-weight:600;"">{Encode(senderEmail)}</a></td>
                                            </tr>
                                            <tr>
                                                <td width=""90"" style=""color:#6b7280;font-weight:600;padding:4px 0;"">Phone</td>
                                                <td style=""padding:4px 0;"">{phoneCell}</td>
                                            </tr>
                                            <tr>
                                                <td width=""90"" style=""color:#6b7280;font-weight:600;padding:4px 0;"">Subject</td>
                                                <td style=""color:#111827;padding:4px 0;"">{Encode(displaySubject)}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <tr>
                        <td style=""padding:8px 32px 0;"">
                            <div style=""font-size:13px;letter-spacing:0.08em;text-transform:uppercase;color:#6b7280;font-weight:700;margin:24px 0 10px;"">Message</div>
                            <div style=""font-size:15px;line-height:1.7;color:#111827;background-color:#ffffff;border-left:4px solid #E85C0D;padding:14px 18px;background-color:#fafafa;border-radius:6px;"">
                                {Br(message)}
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style=""padding:24px 32px 8px;"">
                            <table role=""presentation"" cellpadding=""0"" cellspacing=""0"" border=""0"">
                                <tr>
                                    <td style=""background-color:#E85C0D;border-radius:8px;"">
                                        <a href=""mailto:{Encode(senderEmail)}?subject=Re:%20{Encode(displaySubject)}"" style=""display:inline-block;padding:12px 22px;color:#ffffff;text-decoration:none;font-weight:600;font-size:15px;"">Reply to {Encode(senderName)}</a>
                                    </td>
                                </tr>
                            </table>
                            <div style=""font-size:13px;color:#6b7280;margin-top:10px;"">
                                Or just hit <strong>Reply</strong> on this email — it goes straight to {Encode(senderEmail)}.
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td style=""padding:24px 32px 28px;border-top:1px solid #E0E0E0;"">
                            <div style=""font-size:12px;color:#9ca3af;line-height:1.6;"">
                                This message was sent from the contact form on the Namuna Foods website.<br />
                                {Encode(SiteConfig.RestaurantName)} · {Encode(SiteConfig.Address)} · {Encode(SiteConfig.DisplayPhone)}
                            </div>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>";
    }
}
