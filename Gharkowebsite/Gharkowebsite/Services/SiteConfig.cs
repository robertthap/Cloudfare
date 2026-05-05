namespace Gharkowebsite.Services;

public static class SiteConfig
{
    // Restaurant Information
    public const string RestaurantName = "NAMUNA FOODS";
    public const string Tagline = "A Bold Fusion of East and West";
    public const string PhoneNumber = "tel:+61294467113";
    public const string DisplayPhone = "02 9446 7113";
    public static string PhoneDisplay = "02 9446 7113";
    public static string PhoneTel = "tel:+61294467113";
    public const string Address = "84-86 Yarrara Road, Pennant Hills NSW 2120";
    public const string Hours = "Monday: CLOSED, Tuesday to Sunday: 11:30 AM - 8:30 PM";
    public const string SupportEmail = "support@namuna.com.au";
    public static string MailToSupport => $"mailto:{SupportEmail}";

    /// <summary>Google Maps listing when Places API URI is unavailable.</summary>
    public const string GoogleMapsReviewsUrl = "https://www.google.com/maps?cid=7982895822049931000";

    // Ordering Links
    public static string OrderUpUrl = "https://wildcaktus.orderup.com.au/stores/namuna-foods";
    public const string UberEatsUrl = "https://www.ubereats.com/au/store/namuna-foods/OLmJZlbYTPSyYyByzzjAyg?diningMode=DELIVERY&sc=SEARCH_SUGGESTION";
    public const string DoorDashUrl = "https://www.doordash.com/store/namuna-foods-pennant-hills-37794397/94067946/?cursor=eyJzZWFyY2hfaXRlbV9jYXJvdXNlbF9jdXJzb3IiOnsicXVlcnkiOiJOQU1VTkEgRk9PRFMiLCJpdGVtX2lkcyI6W10sInNlYXJjaF90ZXJtIjoiTkFNVU5BIEZPT0RTIiwidmVydGljYWxfaWQiOi05OTksInZlcnRpY2FsX25hbWUiOiJhbGwiLCJxdWVyeV9pbnRlbnQiOiJTVE9SRV9SWCJ9LCJzdG9yZV9wcmltYXJ5X3ZlcnRpY2FsX2lkcyI6WzEsMTEwMDQ1LDRdfQ==&pickup=false";
}
