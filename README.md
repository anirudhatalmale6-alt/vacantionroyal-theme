# Vacantion Royal WordPress Theme

A luxury vacation rental theme for vacantionroyal.com.

## Features

- Custom Property post type with details (price, bedrooms, bathrooms, guests, sqft, amenities)
- Custom Destination post type for location pages
- Booking inquiry form with email notifications
- Contact form with email notifications
- Responsive design (mobile, tablet, desktop)
- SEO-friendly structure
- Property search functionality
- Related properties display

## Installation

### Step 1: Upload Theme

1. Log in to your WordPress admin panel (vacantionroyal.com/wp-admin)
2. Go to **Appearance > Themes**
3. Click **Add New** at the top
4. Click **Upload Theme**
5. Choose the `vacantionroyal-theme.zip` file
6. Click **Install Now**
7. After installation, click **Activate**

### Step 2: Configure Email Settings

1. Go to **Appearance > Customize**
2. Click **Contact Settings**
3. Enter your contact details:
   - Phone: +212 600 000 000
   - Email: office@vacantionroyal.com
   - Address: 12 Rue Bani Marine, Marrakesh 40000, Maroc
4. Click **Publish**

### Step 3: Create Required Pages

Create these pages in **Pages > Add New**:

1. **Home** - Set as Homepage
   - Title: Home
   - Template: Default (front-page.php handles it automatically)

2. **Properties** - Property listing page
   - Title: Properties
   - Permalink: /properties/
   - Leave content empty (uses archive template)

3. **Contact** - Contact page
   - Title: Contact
   - Template: Contact Page (select from Page Attributes)

4. **Terms & Conditions**
   - Title: Terms & Conditions
   - Add your terms content

5. **Privacy Policy**
   - Title: Privacy Policy
   - Add your privacy content

### Step 4: Set Homepage

1. Go to **Settings > Reading**
2. Select "A static page"
3. Set "Homepage" to your Home page
4. Click **Save Changes**

### Step 5: Create Menu

1. Go to **Appearance > Menus**
2. Create a new menu called "Primary Menu"
3. Add pages: Home, Properties, Destinations, Contact
4. Set location to "Primary Menu"
5. Save Menu

### Step 6: Add Properties

1. Go to **Properties > Add New**
2. Enter property title and description
3. Set featured image (property photo)
4. Fill in property details:
   - Price per night
   - Bedrooms, Bathrooms
   - Max guests
   - Square feet
   - Amenities (comma-separated: WiFi, Pool, Kitchen, etc.)
   - Address
5. Assign a Location (taxonomy)
6. Publish

### Step 7: Add Destinations

1. Go to **Destinations > Add New**
2. Enter destination name and description
3. Set featured image
4. Publish

## Email Notifications

When someone submits a booking inquiry:
- Admin receives email at office@vacantionroyal.com
- Guest receives confirmation email

When someone submits contact form:
- Admin receives email at office@vacantionroyal.com
- Guest receives confirmation email

## Customization

### Colors (in style.css)

```css
:root {
    --primary-color: #1e3a5f;      /* Dark blue */
    --secondary-color: #c9a227;    /* Gold */
    --text-color: #333333;
    --text-light: #666666;
}
```

### Logo

Replace the logo image in:
`/assets/images/logo.png`

## Support

For questions or customization requests, contact your developer.

---
Theme built for Vacantion Royale Sarl
