# Namuna Foods Website

A simple, mobile-first restaurant website built with ASP.NET Core Razor Pages (.NET 8) for Namuna Foods.

## Overview

This is a marketing/menu website that links to OrderUp for all ordering functionality. The site does not handle cart, checkout, payments, or product management - all ordering is handled by OrderUp's hosted ordering page.

## Project Structure

- **Pages/** - Razor Pages (Home, Menu, Order, Contact, QR)
- **Pages/Shared/** - Layout files (_Layout.cshtml, _QrLayout.cshtml)
- **Services/SiteConfig.cs** - Configuration constants (restaurant info, URLs)
- **wwwroot/css/site.css** - Mobile-first CSS with orange branding

## Pages

1. **/** (Home) - Hero section with tagline, order buttons, call button, address/hours
2. **/menu** - Full menu display with all sections and prices
3. **/order** - Online ordering page with OrderUp link and iframe (if allowed)
4. **/contact** - Contact information, form placeholder, map placeholder
5. **/qr** - QR menu-only page (no navbar, sticky bottom action bar)

## Configuration

All configuration is in `Services/SiteConfig.cs`. Update the following constants:

### Restaurant Information
- `RestaurantName` - Restaurant name (currently "NAMUNA FOODS")
- `Tagline` - Tagline text (currently "A Bold Fusion of East and West")
- `PhoneNumber` - Phone number in tel: format (e.g., "tel:+1234567890")
- `DisplayPhone` - Formatted phone number for display (e.g., "(123) 456-7890")
- `Address` - Restaurant address
- `Hours` - Opening hours text

### Ordering Links
- `OrderUpUrl` - OrderUp hosted ordering page URL
- `UberEatsUrl` - Uber Eats restaurant link
- `DoorDashUrl` - DoorDash restaurant link

## Updating the Menu

The menu is hardcoded in the Razor Pages:
- **Regular menu**: `Pages/Menu.cshtml`
- **QR menu**: `Pages/Qr.cshtml`

To update menu items:
1. Open the appropriate `.cshtml` file
2. Find the menu section you want to update
3. Modify the menu items following the existing structure:
   ```html
   <div class="menu-item">
       <div class="menu-item-full">
           <div class="menu-item-name">Item Name</div>
           <div class="menu-item-price">$XX.XX</div>
           <div class="menu-item-description">Optional description</div>
       </div>
   </div>
   ```
4. Update both `Menu.cshtml` and `Qr.cshtml` to keep them in sync

## Branding Colors

The site uses the following orange color scheme:
- Primary Orange: `#E85C0D`
- Dark Orange: `#D94F0A`
- Accent Orange: `#F26A1B`

Colors are defined as CSS variables in `wwwroot/css/site.css` and can be updated there.

## Building and Running

1. Open the solution in Visual Studio 2022
2. Ensure .NET 8 SDK is installed
3. Build the project (Ctrl+Shift+B)
4. Run the project (F5)

The site will run on `https://localhost:5001` (or the port configured in launchSettings.json).

## Testing PDF Menu Loading

To verify PDFs are serving correctly:

1. Run the site (F5)
2. Open `/assets/menu.pdf` directly in the browser (e.g., `https://localhost:5001/assets/menu.pdf`)
3. If the PDF opens/downloads successfully, the menu viewer on the Menu page will work correctly
4. If you see an error, check that:
   - `app.UseStaticFiles()` is in `Program.cs` before `app.UseRouting()`
   - PDF files exist in `wwwroot/assets/` with no spaces in filenames
   - PDF files are not corrupted

## Notes

- All external links (OrderUp, Uber Eats, DoorDash) open in a new tab
- The QR page (`/qr`) has no navigation bar and uses a different layout
- The contact form is a UI placeholder only - form submission is not configured
- The Google Maps iframe on the contact page is a placeholder - replace with actual embed code
- The OrderUp iframe on the order page may be blocked by OrderUp's X-Frame-Options - if so, users should use the "Order on Website" button

## Future Enhancements

If you need to add functionality later:
- Form submission handling for the contact form
- Google Maps integration
- Menu management (if moving away from hardcoded menu)
- Analytics integration
