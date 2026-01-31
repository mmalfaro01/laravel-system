# 🍔 Burger Tropical E-Commerce - Figma UI Documentation

> Complete UI/UX Design Specifications for Laravel E-Commerce Application

---

## 📋 Table of Contents

1. [Design System](#design-system)
2. [Customer Interfaces](#customer-interfaces)
3. [Admin Interfaces](#admin-interfaces)
4. [Components Library](#components-library)
5. [User Flows](#user-flows)
6. [Responsive Design Guidelines](#responsive-design-guidelines)

---

## 🎨 Design System

### Color Palette

#### Primary Colors
```
--tropical-orange: #FF6B35 (Main CTA buttons, accents)
--tropical-red: #E74C3C (Secondary accents, highlights)
--tropical-yellow: #FFD23F (Badges, indicators)
--tropical-brown: #8B4513 (Headings, text)
--tropical-green: #28a745 (Success states)
```

#### Gradients
```
Primary Gradient: linear-gradient(135deg, #FF6B35, #E74C3C)
Info Gradient: linear-gradient(135deg, #FFF8DC, #FFE4B5)
Success Gradient: linear-gradient(135deg, #28a745, #20c997)
Warning Gradient: linear-gradient(135deg, #ffc107, #ff9800)
```

#### Background Colors
```
White: #FFFFFF
Light Cream: #FFF8DC
Light Peach: #FFE4B5
Light Gray: #F8F9FA
```

### Typography

#### Font Family
- Primary: System UI, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto

#### Font Sizes
- Display 1: 6rem (96px)
- Display 4: 3.5rem (56px)
- Display 5: 3rem (48px)
- H1: 2.5rem (40px)
- H2: 2rem (32px)
- H3: 1.75rem (28px)
- H4: 1.5rem (24px)
- H5: 1.25rem (20px)
- Body Large: 1.15rem (18.4px)
- Body: 1rem (16px)
- Small: 0.875rem (14px)

#### Font Weights
- Light: 300
- Regular: 400
- Semi-Bold: 600
- Bold: 700
- Extra Bold: 800

### Icons
**Icon Library:** BoxIcons (bx / bxs prefix)
**Common Icons:**
- `bxs-burger` - Burger/Food items
- `bxs-cart` - Shopping cart
- `bxs-user` - User profile
- `bx-menu` - Menu/Navigation
- `bxs-hot` - Hot/Popular items
- `bxs-star` - Ratings
- `bx-search` - Search functionality

### Spacing System
- xs: 0.25rem (4px)
- sm: 0.5rem (8px)
- md: 1rem (16px)
- lg: 1.5rem (24px)
- xl: 2rem (32px)
- 2xl: 2.5rem (40px)
- 3xl: 3rem (48px)

### Border Radius
- Small: 0.5rem (8px)
- Medium: 1rem (16px)
- Large: 1.5rem (24px)
- Extra Large: 2rem (32px)

### Shadows
```css
Small: 0 4px 15px rgba(0,0,0,0.1)
Medium: 0 8px 25px rgba(0,0,0,0.2)
Large: 0 12px 30px rgba(255, 107, 53, 0.3)
```

---

## 🛍️ Customer Interfaces

### 1. Welcome/Landing Page (`welcome.blade.php`)

#### Layout Structure
```
┌─────────────────────────────────────┐
│         Navigation Bar              │
├─────────────────────────────────────┤
│                                     │
│     Hero Carousel (Auto-slide)      │
│      - 3 Slides, 4s interval        │
│      - Full width, 75vh height      │
│                                     │
├─────────────────────────────────────┤
│                                     │
│    Why Choose Section               │
│    (2 columns, features grid)       │
│                                     │
├─────────────────────────────────────┤
│                                     │
│    Signature Burgers Section        │
│    (3 cards in row)                 │
│                                     │
├─────────────────────────────────────┤
│                                     │
│    Customer Reviews Section         │
│    (3 review cards)                 │
│                                     │
├─────────────────────────────────────┤
│            Footer                   │
└─────────────────────────────────────┘
```

#### Components

**Hero Carousel**
- Dimensions: Full width × 75vh
- Features:
  - Auto-sliding (4 seconds interval)
  - Fade transition effect
  - Overlay: Semi-transparent gradient
  - Carousel indicators: Yellow circular dots
  - Caption position: Center, with white text
  - Main CTA button: Large, white background, orange text

**Info Section Card**
- Background: Cream gradient (FFF8DC → FFE4B5)
- Border: 3px solid orange
- Border radius: 1.5rem
- Padding: 3rem 2rem
- Shadow: 0 8px 24px rgba(0,0,0,0.1)
- Contains:
  - Centered heading with fire icons
  - Feature list in 2 columns
  - Each feature has icon + bold text + description
  - CTA button at bottom

**Signature Burger Cards**
- Layout: 3 columns on desktop
- Card style:
  - White background
  - No border
  - Large shadow
  - Center-aligned content
  - Icon at top (3rem size)
  - Title in brown
  - Description in gray
  - Badge at bottom (colored)

**Review Cards**
- White background
- 5-star rating display (golden stars)
- Italic quote text
- Customer name in gray at bottom
- Equal height cards

### 2. Products Listing Page (`products/index.blade.php`)

#### Layout Structure
```
┌─────────────────────────────────────┐
│         Navigation Bar              │
├─────────────────────────────────────┤
│     Page Header (centered)          │
│     - Burger icon (display-1)       │
│     - Title + Subtitle              │
├─────────────────────────────────────┤
│  [Search Bar]    [Category Filter]  │
├─────────────────────────────────────┤
│  ┌─────┐  ┌─────┐  ┌─────┐         │
│  │ P1  │  │ P2  │  │ P3  │         │
│  │     │  │     │  │     │         │
│  └─────┘  └─────┘  └─────┘         │
│  ┌─────┐  ┌─────┐  ┌─────┐         │
│  │ P4  │  │ P5  │  │ P6  │         │
│  └─────┘  └─────┘  └─────┘         │
├─────────────────────────────────────┤
│         Pagination                  │
├─────────────────────────────────────┤
│            Footer                   │
└─────────────────────────────────────┘
```

#### Search & Filter Section
- Layout: 2 columns (search left, filter right)
- Search input:
  - Width: 50% of container
  - Placeholder: "Search products..."
  - Button: Primary blue
- Category filter:
  - Dropdown select
  - Button: Outline secondary gray

#### Product Card
- Grid: 3 columns (col-md-4)
- Card features:
  - Border: None
  - Border radius: Default
  - Shadow: Large on hover
  - Hover effect: Slight overlay with orange tint
  - Image height: 280px (object-fit: cover)
  - Bottom border on image: 4px solid orange

**Badge positions:**
- Top-left: Stock warning (if stock ≤ 5)
  - Red background
  - "Almost Gone!" text
  - Pulsing animation
- Top-right: Hot badge
  - Orange-red gradient
  - Fire icon

**Card Body:**
- Product name: Bold, brown color, burger icon prefix
- Description: Gray, truncated to 100 chars
- Price: Large (h4), bold, red color
- Rating: 5 golden stars (4.5 display)
- Stock info: 
  - Success green if stock > 5
  - Danger red if stock ≤ 5

**Card Footer:**
- 2 buttons side by side
- Details button: Outline warning, 50% width
- Add to Cart button: Gradient background, white text, 50% width

### 3. Shopping Cart Page (`cart/index.blade.php`)

#### Layout Structure
```
┌─────────────────────────────────────┐
│         Navigation Bar              │
├─────────────────────────────────────┤
│     Cart Header (gradient card)     │
│     - Cart icon (display-1)         │
│     - Title + Subtitle              │
├─────────────────────────────────────┤
│                                     │
│          Cart Table                 │
│  ┌─────┬─────┬─────┬─────┬─────┐  │
│  │Item │Price│ Qty │Total│Action│  │
│  ├─────┼─────┼─────┼─────┼─────┤  │
│  │ ... │ ... │ ... │ ... │ ... │  │
│  └─────┴─────┴─────┴─────┴─────┘  │
│                                     │
│     Order Summary Section           │
│     (cream gradient background)     │
│                                     │
├─────────────────────────────────────┤
│  [Continue Shopping]  [Checkout]    │
├─────────────────────────────────────┤
│            Footer                   │
└─────────────────────────────────────┘
```

#### Cart Header
- Background: Orange-red gradient
- Text color: White
- Border radius: 1.5rem
- Padding: 2rem
- Shadow: Medium
- Cart icon size: Display-1 (6rem)

#### Cart Table
- Container: White background, rounded, shadowed
- Table header:
  - Background: Orange-red gradient
  - Text: White
  - Padding: py-3
  - Icons prefix each column

**Table Row (Cart Item):**
- Product cell:
  - Product image: 80×80px, rounded, 3px orange border
  - Product name: Bold, brown
  - "Fresh & Hot" label below
- Price: Bold, red color
- Quantity: 
  - Number input (width: 70px)
  - Border: 2px orange
  - Update button: Warning yellow
- Total: Bold, large (fs-5), orange color
- Remove button: Small, danger red

#### Order Summary
- Background: Cream gradient
- Padding: 1.5rem
- Layout: 2 columns
- Left: Free delivery badge/message
- Right: Subtotal display (large, bold, red)

#### Action Buttons
- Continue Shopping: Outline warning, large, left
- Checkout: Gradient background, large, right, with arrow icon

**Empty Cart State:**
- Large cart icon
- Centered message
- Browse menu CTA button

### 4. Checkout Page

#### Layout
```
┌─────────────────────────────────────┐
│         Navigation Bar              │
├─────────────────────────────────────┤
│        Checkout Header              │
├─────────────────────────────────────┤
│  ┌──────────────┐  ┌──────────────┐│
│  │   Delivery   │  │    Order     ││
│  │    Form      │  │   Summary    ││
│  │              │  │              ││
│  │              │  │              ││
│  └──────────────┘  └──────────────┘│
├─────────────────────────────────────┤
│        [Place Order Button]         │
├─────────────────────────────────────┤
│            Footer                   │
└─────────────────────────────────────┘
```

#### Delivery Information Form
- Card with orange border
- Fields:
  - Full Name (required)
  - Phone Number (required)
  - Address (textarea, required)
  - Delivery Notes (optional)
- All inputs: Orange focus border

#### Order Summary Card
- Cream background
- Lists each cart item
- Shows subtotal, delivery fee
- Total in large bold text

### 5. User Dashboard/Home (`home.blade.php`)

#### Layout Structure
```
┌─────────────────────────────────────┐
│         Navigation Bar              │
├─────────────────────────────────────┤
│     Welcome Banner (gradient)       │
│     - Burger icon                   │
│     - "Welcome back, [Name]"        │
├─────────────────────────────────────┤
│  ┌─────┐  ┌─────┐  ┌─────┐         │
│  │Menu │  │Cart │  │Orders│        │
│  │Card │  │Card │  │Card │         │
│  └─────┘  └─────┘  └─────┘         │
├─────────────────────────────────────┤
│            Footer                   │
└─────────────────────────────────────┘
```

#### Welcome Banner
- Background: Orange-red gradient
- Border radius: 1.5rem
- Centered content
- Burger icon at top
- Large display heading
- Subtitle with emoji

#### Dashboard Cards
- 3 columns layout
- Each card:
  - White background
  - Large shadow
  - Center aligned
  - Icon in circular gradient background
  - Title in brown
  - Description text
  - Colored badge at bottom
  - Hover effect: Lift up, stronger shadow

### 6. Orders History Page (`orders/index.blade.php`)

#### Layout
```
┌─────────────────────────────────────┐
│         Navigation Bar              │
├─────────────────────────────────────┤
│         Orders Header               │
├─────────────────────────────────────┤
│  ┌─────────────────────────────┐   │
│  │  Order #1 - Status Badge    │   │
│  │  Date | Total | [View]      │   │
│  └─────────────────────────────┘   │
│  ┌─────────────────────────────┐   │
│  │  Order #2 - Status Badge    │   │
│  └─────────────────────────────┘   │
├─────────────────────────────────────┤
│            Footer                   │
└─────────────────────────────────────┘
```

#### Order Card
- White background with shadow
- Header: Order number + status badge
- Status badges:
  - Pending: Yellow/Warning
  - Processing: Blue/Info
  - Completed: Green/Success
  - Cancelled: Red/Danger
- Order details: Date, total price
- View details button

### 7. Order Details Page (`orders/show.blade.php`)

#### Layout
```
┌─────────────────────────────────────┐
│         Navigation Bar              │
├─────────────────────────────────────┤
│     Order Details Header            │
│     Order #[ID] - Status Badge      │
├─────────────────────────────────────┤
│  ┌──────────────┐  ┌──────────────┐│
│  │   Delivery   │  │   Payment    ││
│  │     Info     │  │     Info     ││
│  └──────────────┘  └──────────────┘│
├─────────────────────────────────────┤
│         Order Items Table           │
├─────────────────────────────────────┤
│         Order Total Summary         │
├─────────────────────────────────────┤
│  [Back to Orders]                   │
└─────────────────────────────────────┘
```

### 8. User Profile Page (`profile/show.blade.php`)

#### Layout
```
┌─────────────────────────────────────┐
│         Navigation Bar              │
├─────────────────────────────────────┤
│        Profile Header               │
├─────────────────────────────────────┤
│  ┌────────────────────────────┐    │
│  │   Profile Information      │    │
│  │   - Avatar                 │    │
│  │   - Name                   │    │
│  │   - Email                  │    │
│  │   - Phone                  │    │
│  │   [Edit Profile]           │    │
│  └────────────────────────────┘    │
├─────────────────────────────────────┤
│  ┌────────────────────────────┐    │
│  │   Change Password          │    │
│  │   - Current Password       │    │
│  │   - New Password           │    │
│  │   - Confirm Password       │    │
│  │   [Update Password]        │    │
│  └────────────────────────────┘    │
└─────────────────────────────────────┘
```

### 9. Authentication Pages

#### Login Page (`auth/login.blade.php`)

```
┌─────────────────────────────────────┐
│         Simple Nav/Logo             │
├─────────────────────────────────────┤
│                                     │
│     ┌──────────────────┐           │
│     │   Login Card     │           │
│     │                  │           │
│     │  Email           │           │
│     │  Password        │           │
│     │  [Remember Me]   │           │
│     │                  │           │
│     │  [Login Button]  │           │
│     │                  │           │
│     │  Social Login:   │           │
│     │  [Google] [FB]   │           │
│     │                  │           │
│     │  Forgot Password?│           │
│     │  Register Link   │           │
│     └──────────────────┘           │
│                                     │
└─────────────────────────────────────┘
```

**Login Card Specs:**
- Max width: 450px
- Centered on page
- White background
- Large shadow
- Border radius: 1rem
- Padding: 2.5rem

**Social Login Buttons:**
- Google: Red/White
- Facebook: Blue/White
- Icon + Text
- Full width
- Margin between buttons

#### Register Page (`auth/register.blade.php`)

Similar to login but with additional fields:
- Name
- Email
- Password
- Password Confirmation
- Terms acceptance checkbox

### 10. Static Pages

#### About Page (`pages/about.blade.php`)
- Hero section with image
- Company story
- Mission/Vision cards
- Team section (optional)

#### Contact Page (`pages/contact.blade.php`)
- Contact form
- Business information
- Map integration (optional)
- Social media links

#### FAQ Page (`faq/index.blade.php`)
- Accordion-style questions
- Search functionality
- Category filtering

---

## 🔧 Admin Interfaces

### Admin Layout Structure (`layouts/admin.blade.php`)

```
┌─────┬───────────────────────────────┐
│     │     Top Navigation Bar        │
│     │    (Admin name, notifications)│
│ S   ├───────────────────────────────┤
│ I   │                               │
│ D   │                               │
│ E   │      Main Content Area        │
│ B   │                               │
│ A   │                               │
│ R   │                               │
│     │                               │
│     ├───────────────────────────────┤
│     │          Footer               │
└─────┴───────────────────────────────┘
```

### Admin Sidebar
- Fixed left position
- Width: 250px
- Dark/Colored background
- Logo at top
- Navigation menu items with icons:
  - Dashboard
  - Products
  - Orders
  - Users
  - Stores
  - Categories
  - Reports
  - Settings

### 1. Admin Dashboard (`admin/dashboard.blade.php`)

#### Layout Structure
```
┌─────────────────────────────────────┐
│     Welcome Header (gradient)       │
├─────────────────────────────────────┤
│  ┌───┐  ┌───┐  ┌───┐  ┌───┐        │
│  │ $ │  │ 🍔│  │ 📦│  │ 👥│        │
│  │   │  │   │  │   │  │   │        │
│  └───┘  └───┘  └───┘  └───┘        │
│  Stats   Stats  Stats  Stats        │
├─────────────────────────────────────┤
│                                     │
│      Monthly Sales Chart            │
│      (Bar/Line Chart)               │
│                                     │
├─────────────────────────────────────┤
│  ┌─────┐  ┌─────┐  ┌─────┐         │
│  │Menu │  │Orders│ │Users│         │
│  │Mgmt │  │ Mgmt │ │Mgmt │         │
│  └─────┘  └─────┘  └─────┘         │
│    Quick Actions                    │
└─────────────────────────────────────┘
```

#### Statistics Cards (Top Row)
- 4 cards in a row
- Each card:
  - Gradient background (different colors)
  - White text
  - Large icon (3rem)
  - Metric value (h3, bold)
  - Label (small text)
  - Growth badge
  - Hover effect: Lift and shadow

**Card Colors:**
1. **Total Earnings:** Green gradient (#28a745 → #20c997)
2. **Total Products:** Orange gradient (brand colors)
3. **Total Orders:** Yellow gradient (#ffc107 → #ff9800)
4. **Total Users:** Purple gradient (#6f42c1 → #5a32a3)

#### Monthly Sales Chart
- Container: White card with orange border
- Chart type: Bar chart (Chart.js)
- Chart features:
  - Responsive
  - Orange bars with red border
  - Rounded corners on bars
  - Hover effects
  - Y-axis: Currency format (₱)
  - X-axis: Month names

#### Quick Action Cards
- 3 cards in row
- Each card:
  - White background
  - Colored border (3px)
  - Large icon at top
  - Title and description
  - Action button at bottom
  - Center aligned content

### 2. Products Management (`admin/products/index.blade.php`)

#### Layout Structure
```
┌─────────────────────────────────────┐
│  Products Header                    │
│  [Add New Product Button]           │
├─────────────────────────────────────┤
│  [Search] [Category Filter]         │
├─────────────────────────────────────┤
│                                     │
│        Products Data Table          │
│  ┌──┬─────┬──────┬─────┬────────┐  │
│  │ID│Name │Price │Stock│Actions │  │
│  ├──┼─────┼──────┼─────┼────────┤  │
│  │..│.... │..... │.... │ [E][D] │  │
│  └──┴─────┴──────┴─────┴────────┘  │
│                                     │
├─────────────────────────────────────┤
│         Pagination                  │
└─────────────────────────────────────┘
```

#### Add Product Button
- Position: Top right
- Style: Large, gradient background
- Icon: Plus symbol
- Text: "Add New Product"

#### Products Table
- Striped rows
- Hover effect on rows
- Columns:
  - ID (narrow)
  - Image (thumbnail, 50×50px)
  - Name (bold)
  - Price (currency format, orange)
  - Stock (colored: green if >5, red if ≤5)
  - Category
  - Actions (Edit/Delete buttons)

**Action Buttons:**
- Edit: Small, warning/blue, pencil icon
- Delete: Small, danger/red, trash icon
  - Confirmation modal before delete

#### Product Form (Create/Edit)
```
┌─────────────────────────────────────┐
│     Product Form Header             │
├─────────────────────────────────────┤
│  Product Name:     [________]       │
│  Description:      [________]       │
│  Price:            [________]       │
│  Stock:            [________]       │
│  Category:         [Dropdown]       │
│  Image Upload:     [Browse]         │
│                    [Preview]        │
├─────────────────────────────────────┤
│  [Cancel]              [Save]       │
└─────────────────────────────────────┘
```

### 3. Orders Management (`admin/orders/index.blade.php`)

#### Layout Structure
```
┌─────────────────────────────────────┐
│     Orders Management Header        │
├─────────────────────────────────────┤
│  [Status Filter] [Date Range]       │
├─────────────────────────────────────┤
│                                     │
│         Orders Data Table           │
│  ┌───┬────┬─────┬──────┬────────┐  │
│  │ID │User│Total│Status│Actions │  │
│  ├───┼────┼─────┼──────┼────────┤  │
│  │...│... │.... │Badge │ [V][E] │  │
│  └───┴────┴─────┴──────┴────────┘  │
│                                     │
└─────────────────────────────────────┘
```

#### Status Filter
- Dropdown with options:
  - All Orders
  - Pending
  - Processing
  - Completed
  - Cancelled

#### Orders Table
- Columns:
  - Order ID
  - Customer Name
  - Order Date
  - Total Amount (large, bold)
  - Status (colored badge)
  - Actions (View/Edit)

**Status Badges:**
- Pending: `bg-warning` (yellow)
- Processing: `bg-info` (blue)
- Completed: `bg-success` (green)
- Cancelled: `bg-danger` (red)

#### Order Edit Modal/Page
- Order details (read-only)
- Status dropdown (editable)
- Update button
- Sends notification to customer

### 4. Users Management (`admin/users/index.blade.php`)

#### Layout Structure
```
┌─────────────────────────────────────┐
│     Users Management Header         │
│     [Add Admin Button]              │
├─────────────────────────────────────┤
│  [Search Users]                     │
├─────────────────────────────────────┤
│                                     │
│         Users Data Table            │
│  ┌───┬─────┬──────┬──────┬───────┐ │
│  │ID │Name │Email │Role  │Actions│ │
│  ├───┼─────┼──────┼──────┼───────┤ │
│  │...│.... │..... │Badge │ [Del] │ │
│  └───┴─────┴──────┴──────┴───────┘ │
│                                     │
└─────────────────────────────────────┘
```

#### Users Table
- Columns:
  - User ID
  - Name
  - Email
  - Phone
  - Role (badge: Admin/Customer)
  - Registration Date
  - Actions (Delete for customers only)

### 5. Stores Management (`admin/stores/index.blade.php`)

#### Layout Structure
```
┌─────────────────────────────────────┐
│     Stores Header                   │
│     [Add New Store Button]          │
├─────────────────────────────────────┤
│                                     │
│  ┌─────┐  ┌─────┐  ┌─────┐         │
│  │Store│  │Store│  │Store│         │
│  │  1  │  │  2  │  │  3  │         │
│  │     │  │     │  │     │         │
│  └─────┘  └─────┘  └─────┘         │
│                                     │
└─────────────────────────────────────┘
```

#### Store Card
- Image/Logo at top
- Store name (bold)
- Location info
- Status badge
- Action buttons (View Products, Edit, Delete)

---

## 🧩 Components Library

### 1. Navigation Bar

#### Customer Navigation
```
┌──────────────────────────────────────────┐
│ 🍔 Logo    Home Products Cart  Profile 👤│
└──────────────────────────────────────────┘
```

**Specifications:**
- Height: 70px
- Background: White with bottom shadow
- Logo: Left aligned, with burger icon + text
- Menu items: Center (desktop) / Hamburger (mobile)
- User menu: Right aligned
  - Cart icon with badge (item count)
  - User dropdown or login button

**Cart Badge:**
- Position: Top-right of cart icon
- Background: Red
- Text: White, small
- Border radius: Circle
- Shows item count

#### Admin Navigation
```
┌──────────────────────────────────────────┐
│ 🍔 Admin Panel              Admin Name 👤│
└──────────────────────────────────────────┘
```

**Specifications:**
- Height: 60px
- Background: Dark or gradient
- Left: Logo + "Admin Panel" text
- Right: Notifications icon + Admin dropdown

### 2. Buttons

#### Primary Button (CTA)
```css
background: linear-gradient(135deg, #FF6B35, #E74C3C);
color: white;
border: none;
border-radius: 0.5rem;
padding: 0.75rem 2rem;
font-weight: bold;
box-shadow: 0 4px 15px rgba(255,107,53,0.4);
transition: all 0.3s;
```

**Hover State:**
- Transform: translateY(-2px)
- Shadow: Larger

#### Secondary Button (Outline)
```css
background: transparent;
color: #FF6B35;
border: 2px solid #FF6B35;
border-radius: 0.5rem;
padding: 0.75rem 2rem;
font-weight: 600;
```

**Button Sizes:**
- Small: `padding: 0.375rem 1rem; font-size: 0.875rem`
- Medium: `padding: 0.75rem 2rem; font-size: 1rem`
- Large: `padding: 1rem 2.5rem; font-size: 1.125rem`

### 3. Form Controls

#### Text Input
```css
border: 2px solid #E0E0E0;
border-radius: 0.5rem;
padding: 0.75rem 1rem;
font-size: 1rem;
transition: border-color 0.3s;

/* Focus State */
border-color: #FF6B35;
box-shadow: 0 0 0 0.2rem rgba(255, 107, 53, 0.25);
```

#### Select Dropdown
- Same styling as text input
- Dropdown arrow icon
- Options list with hover states

#### File Upload
- Custom styled upload button
- Image preview area
- Drag & drop zone (optional)

### 4. Cards

#### Standard Card
```css
background: white;
border: none;
border-radius: 1rem;
box-shadow: 0 4px 15px rgba(0,0,0,0.1);
overflow: hidden;
transition: all 0.3s;

/* Hover State */
transform: translateY(-5px);
box-shadow: 0 8px 25px rgba(0,0,0,0.15);
```

#### Info Card (with gradient)
```css
background: linear-gradient(135deg, #FFF8DC, #FFE4B5);
border: 3px solid #FF6B35;
border-radius: 1.5rem;
padding: 2rem;
box-shadow: 0 8px 24px rgba(0,0,0,0.1);
```

### 5. Badges

#### Status Badge
```css
padding: 0.5rem 1rem;
border-radius: 1rem;
font-weight: 600;
font-size: 0.875rem;
text-transform: uppercase;
```

**Badge Colors:**
- Success: `background: #28a745; color: white`
- Warning: `background: #ffc107; color: #333`
- Danger: `background: #dc3545; color: white`
- Info: `background: #17a2b8; color: white`

### 6. Modals

#### Standard Modal
```
┌────────────────────────────────┐
│  ×                             │
│  Modal Title                   │
├────────────────────────────────┤
│                                │
│  Modal Content                 │
│                                │
├────────────────────────────────┤
│        [Cancel]  [Confirm]     │
└────────────────────────────────┘
```

**Specifications:**
- Max width: 500px (sm), 700px (md), 900px (lg)
- Border radius: 1rem
- Shadow: Large
- Backdrop: Semi-transparent dark
- Close button: Top right corner

### 7. Data Tables

#### Table Structure
```css
background: white;
border-radius: 1rem;
overflow: hidden;
box-shadow: 0 4px 15px rgba(0,0,0,0.1);
```

**Table Header:**
```css
background: linear-gradient(135deg, #FF6B35, #E74C3C);
color: white;
font-weight: 600;
padding: 1rem;
```

**Table Rows:**
```css
border-bottom: 1px solid #E0E0E0;
padding: 0.75rem 1rem;
transition: background 0.2s;

/* Hover State */
background: rgba(255, 107, 53, 0.05);
```

### 8. Pagination

#### Pagination Component
```
[Previous] [1] [2] [3] ... [10] [Next]
```

**Specifications:**
- Active page: Gradient background, white text
- Inactive pages: White background, orange text
- Hover: Light orange background
- Disabled: Gray, not clickable

### 9. Alerts/Notifications

#### Alert Box
```css
border-radius: 0.75rem;
padding: 1rem 1.5rem;
border-left: 5px solid;
box-shadow: 0 4px 10px rgba(0,0,0,0.1);
```

**Alert Types:**
- Success: Green left border, light green background
- Warning: Yellow left border, light yellow background
- Error: Red left border, light red background
- Info: Blue left border, light blue background

### 10. Loading States

#### Spinner
- Color: Orange (#FF6B35)
- Size: 40px (default)
- Animation: Smooth rotation

#### Skeleton Loader
- Gray shimmer effect
- Used for: Product cards, table rows

---

## 🔄 User Flows

### 1. Customer Purchase Flow

```
Landing Page
    ↓
Browse Products (Search/Filter)
    ↓
View Product Details
    ↓
Add to Cart
    ↓
View Cart (Update Quantities)
    ↓
[Login/Register] (if not logged in)
    ↓
Checkout (Enter Delivery Info)
    ↓
Confirm Order
    ↓
Order Confirmation Page
    ↓
View Order Status
```

### 2. User Registration Flow

```
Click Register
    ↓
Fill Registration Form
    ↓
[Optional: Social Login]
    ↓
Verify Email (if enabled)
    ↓
Login
    ↓
Dashboard
```

### 3. Admin Product Management Flow

```
Admin Login
    ↓
Admin Dashboard
    ↓
Navigate to Products
    ↓
Click "Add New Product"
    ↓
Fill Product Form
    ↓
Upload Product Image
    ↓
Save Product
    ↓
Product appears in list
    ↓
[Edit/Delete as needed]
```

### 4. Admin Order Processing Flow

```
Admin Dashboard
    ↓
View Orders List
    ↓
Click on Order
    ↓
View Order Details
    ↓
Update Order Status
    ↓
Customer receives notification
    ↓
Order status updated in list
```

---

## 📱 Responsive Design Guidelines

### Breakpoints

```css
/* Mobile First Approach */
xs: 0px (default)
sm: 576px
md: 768px
lg: 992px
xl: 1200px
xxl: 1400px
```

### Mobile Design (< 768px)

#### Navigation
- Hamburger menu icon
- Full-screen overlay menu
- Simplified navigation items

#### Product Grid
- 1 column layout
- Larger product cards (full width)
- Stack all content vertically

#### Cart Table
- Convert to card-style layout
- Stack product info vertically
- Larger touch targets (min 44×44px)

#### Forms
- Full width inputs
- Larger spacing between fields
- Sticky submit buttons

### Tablet Design (768px - 991px)

#### Product Grid
- 2 column layout
- Maintain card proportions

#### Dashboard
- 2 columns for quick action cards
- Stats cards: 2 columns (stack to 1 on smaller tablets)

### Desktop Design (≥ 992px)

#### Product Grid
- 3 column layout (as designed)
- Hover effects enabled

#### Dashboard
- All 4 stat cards in one row
- Full data tables
- Sidebar always visible

### Touch-Friendly Design

- Minimum button size: 44×44px
- Adequate spacing between clickable elements
- No hover-dependent functionality
- Larger form inputs
- Swipe gestures for carousels

---

## 🎯 Accessibility Guidelines

### Color Contrast
- Text on background: Minimum 4.5:1 ratio
- Large text (18pt+): Minimum 3:1 ratio
- Interactive elements: Clear visual states

### Keyboard Navigation
- All interactive elements: Tab accessible
- Focus indicators: Visible outline
- Skip navigation link
- Logical tab order

### Screen Reader Support
- Alt text for all images
- ARIA labels for icons
- Descriptive link text
- Form labels properly associated

### Text and Readability
- Font size: Minimum 16px for body text
- Line height: 1.5 for body text
- Paragraph width: Max 75 characters
- Resizable text support

---

## 📐 Grid System

### Container Widths
```css
sm: 540px
md: 720px
lg: 960px
xl: 1140px
xxl: 1320px
```

### Column System
- 12 column grid
- Gutter width: 1.5rem (24px)
- Column padding: 0.75rem (12px) each side

### Common Layouts

**2 Column:**
- `col-md-6` × 2

**3 Column:**
- `col-md-4` × 3

**4 Column:**
- `col-md-3` × 4

**Sidebar Layout:**
- `col-md-8` (main) + `col-md-4` (sidebar)

---

## 🖼️ Image Guidelines

### Product Images
- Aspect ratio: 4:3
- Minimum size: 800×600px
- Maximum file size: 2MB
- Format: JPG or PNG
- Optimization: Required

### Carousel/Hero Images
- Aspect ratio: 16:9
- Minimum size: 1920×1080px
- Maximum file size: 500KB
- Format: JPG
- Optimization: Required
- Brightness: Slightly dimmed for text overlay

### Category Images
- Aspect ratio: 1:1 (square)
- Size: 400×400px
- Format: JPG or PNG

### User Avatars
- Aspect ratio: 1:1 (circle)
- Size: 200×200px
- Format: JPG or PNG
- Default avatar: Provided

---

## ✨ Animations & Transitions

### Button Hover
```css
transition: all 0.3s ease;
transform: translateY(-2px);
box-shadow: [enhanced];
```

### Card Hover
```css
transition: all 0.3s ease;
transform: translateY(-5px);
box-shadow: [enhanced];
```

### Fade In
```css
animation: fadeIn 0.5s ease-in;
```

### Slide In
```css
animation: slideInUp 0.6s ease-out;
```

### Page Transitions
- Duration: 0.3s
- Easing: ease-in-out
- Type: Fade or slide

---

## 🛠️ Implementation Notes

### CSS Framework
- **Bootstrap 5.x**
- Custom CSS for brand colors
- Utility classes for spacing
- Flexbox/Grid for layouts

### Icons
- **BoxIcons** (primary)
- Font Awesome (alternative)
- Inline SVGs for custom icons

### JavaScript Libraries
- jQuery (for Bootstrap components)
- Chart.js (for admin charts)
- Alpine.js or Vue.js (optional, for interactivity)

### Fonts
- System fonts for performance
- Google Fonts (optional): Poppins, Inter, or Nunito

---

## 📋 Checklist for Figma Design

### Pages to Design
- [ ] Landing/Welcome page
- [ ] Products listing page
- [ ] Product detail page
- [ ] Shopping cart page
- [ ] Checkout page
- [ ] User dashboard
- [ ] Orders history page
- [ ] Order details page
- [ ] User profile page
- [ ] Login page
- [ ] Register page
- [ ] Password reset page
- [ ] FAQ page
- [ ] About page
- [ ] Contact page
- [ ] Admin dashboard
- [ ] Admin products management
- [ ] Admin orders management
- [ ] Admin users management
- [ ] Admin stores management
- [ ] 404 error page

### Components to Design
- [ ] Navigation bars (customer & admin)
- [ ] Buttons (all variants)
- [ ] Form controls (inputs, selects, textareas)
- [ ] Cards (product, dashboard, info)
- [ ] Badges and tags
- [ ] Modals
- [ ] Alerts/notifications
- [ ] Data tables
- [ ] Pagination
- [ ] Breadcrumbs
- [ ] Dropdowns
- [ ] Tooltips
- [ ] Loading states
- [ ] Empty states
- [ ] Footer

### States to Include
- [ ] Default
- [ ] Hover
- [ ] Active/Pressed
- [ ] Focus
- [ ] Disabled
- [ ] Loading
- [ ] Error
- [ ] Success

### Responsive Variants
- [ ] Mobile (375px)
- [ ] Tablet (768px)
- [ ] Desktop (1440px)

---

## 🎨 Figma Organization Tips

### Layer Naming
- Use descriptive names
- Group related elements
- Prefix components with underscore (_)

### Artboard Structure
```
📁 01 - Design System
  ├─ Colors
  ├─ Typography
  ├─ Icons
  └─ Spacing

📁 02 - Components
  ├─ Buttons
  ├─ Forms
  ├─ Cards
  └─ Navigation

📁 03 - Customer Pages
  ├─ Landing
  ├─ Products
  ├─ Cart & Checkout
  └─ User Account

📁 04 - Admin Pages
  ├─ Dashboard
  ├─ Management
  └─ Settings

📁 05 - Mobile Designs
```

### Component Organization
- Create master components
- Use variants for states
- Create instances in designs
- Use auto-layout for flexibility

---

## 📞 Contact & Questions

For any questions or clarifications about this UI documentation, please refer to:
- Design system specifications above
- Existing codebase views
- Brand guidelines (if available)

---

**Document Version:** 1.0  
**Last Updated:** December 17, 2025  
**Project:** Burger Tropical E-Commerce Platform

