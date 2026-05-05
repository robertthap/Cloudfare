namespace Gharkowebsite.Services;

/// <summary>Sample guest quotes used before Google Maps rating integration.</summary>
/// <param name="AvatarSeed">Passed to the avatar renderer so each guest keeps a stable “profile” look.</param>
public sealed record WireframeTestimonial(string Quote, string Author, string Subtitle, string AvatarSeed);

public sealed class WireframeTestimonialsListVm
{
    public required IReadOnlyList<WireframeTestimonial> Items { get; init; }

    /// <summary>2 or 3 columns on wide breakpoints (matches <c>.grid-2</c> / <c>.grid-3</c>).</summary>
    public int Columns { get; init; } = 3;
}

public static class WireframeTestimonials
{
    public const string AvatarImageBase = "https://api.dicebear.com/9.x/avataaars/svg";

    public static IReadOnlyList<WireframeTestimonial> ForHome { get; } =
    [
        new WireframeTestimonial(
            "Hands down the best momos we've found outside Nepal — fresh, juicy, and that chilli dip is addictive.",
            "Jessica M.",
            "Pennant Hills · dine-in guest",
            "jessica-m"),
        new WireframeTestimonial(
            "Cracking burgers and genuinely friendly service. Great to have Himalayan flavours done properly in the Hills.",
            "Ryan T.",
            "Local regular",
            "ryan-t"),
        new WireframeTestimonial(
            "Our family's go-to for Friday nights — the chowmein is packed with flavour and portions are generous.",
            "Amelia K.",
            "Takeaway favourite",
            "amelia-k"),
    ];

    public static IReadOnlyList<WireframeTestimonial> ForReviews { get; } =
    [
        ..ForHome,
        new WireframeTestimonial(
            "Vegetarian options aren't an afterthought here. Loved the veg momos and garlic naan.",
            "Marcus L.",
            "Vegetarian diner",
            "marcus-l"),
        new WireframeTestimonial(
            "Ordered pizzas and chips for delivery — arrived hot and tasted fantastic. We'll order again.",
            "Sophie & Dan",
            "Delivery",
            "sophie-dan"),
        new WireframeTestimonial(
            "Warm, welcoming staff and food that feels homemade. Already planning our next visit.",
            "Nina P.",
            "First-time visitor",
            "nina-p"),
    ];
}
