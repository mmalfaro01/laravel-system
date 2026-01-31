# 🧩 Burger Tropical - Component Specifications

> Detailed specifications for all UI components in Figma

---

## 📋 Table of Contents

1. [Buttons](#buttons)
2. [Form Elements](#form-elements)
3. [Cards](#cards)
4. [Navigation](#navigation)
5. [Badges & Tags](#badges--tags)
6. [Modals & Dialogs](#modals--dialogs)
7. [Tables](#tables)
8. [Alerts & Notifications](#alerts--notifications)
9. [Loading States](#loading-states)
10. [Icons](#icons)

---

## 🔘 Buttons

### Primary Button (Gradient)

#### Default State
```
Size: Medium (can vary)
Width: Auto (min-width: 120px)
Height: 48px
Padding: 12px 32px
Background: linear-gradient(135deg, #FF6B35, #E74C3C)
Border: none
Border Radius: 8px
Font Size: 16px
Font Weight: Bold (700)
Color: #FFFFFF
Shadow: 0 4px 15px rgba(255,107,53,0.4)
Icon: Optional (16px, 8px margin)
Cursor: pointer
```

#### Hover
```
Transform: translateY(-2px)
Shadow: 0 6px 20px rgba(255,107,53,0.5)
Transition: all 0.3s ease
```

#### Active
```
Transform: translateY(0)
Shadow: 0 2px 10px rgba(255,107,53,0.3)
```

#### Focus
```
Outline: 3px solid rgba(255,107,53,0.3)
Outline Offset: 2px
```

#### Disabled
```
Opacity: 0.5
Cursor: not-allowed
Pointer Events: none
```

#### Sizes

**Small**
```
Height: 36px
Padding: 8px 20px
Font Size: 14px
```

**Medium** (Default)
```
Height: 48px
Padding: 12px 32px
Font Size: 16px
```

**Large**
```
Height: 56px
Padding: 16px 40px
Font Size: 18px
```

### Secondary Button (Outline)

#### Default
```
Background: transparent
Border: 2px solid #FF6B35
Border Radius: 8px
Color: #FF6B35
Font Weight: 600
[Same sizes as Primary Button]
```

#### Hover
```
Background: rgba(255,107,53,0.1)
Border Color: #E74C3C
Color: #E74C3C
```

### Warning Button

```
Background: #ffc107
Border: none
Color: #333333
[Same structure as Primary]
```

### Success Button

```
Background: #28a745
Border: none
Color: #FFFFFF
[Same structure as Primary]
```

### Danger Button

```
Background: #dc3545
Border: none
Color: #FFFFFF
[Same structure as Primary]
```

### Icon Button

```
Width: 40px
Height: 40px
Padding: 8px
Border Radius: 50% (or 8px for square)
Background: transparent or light gray
Border: none
Icon Size: 24px
Icon Color: #6C757D
```

#### Hover
```
Background: rgba(255,107,53,0.1)
Icon Color: #FF6B35
```

---

## 📝 Form Elements

### Text Input

#### Default
```
Width: 100% (flexible)
Height: 48px
Padding: 12px 16px
Background: #FFFFFF
Border: 2px solid #E0E0E0
Border Radius: 8px
Font Size: 16px
Color: #343A40
Placeholder Color: #6C757D
Transition: border-color 0.3s
```

#### Focus
```
Border Color: #FF6B35
Box Shadow: 0 0 0 0.2rem rgba(255,107,53,0.25)
Outline: none
```

#### Error State
```
Border Color: #dc3545
Background: rgba(220,53,69,0.05)
```

#### Success State
```
Border Color: #28a745
Background: rgba(40,167,69,0.05)
```

#### Disabled
```
Background: #F8F9FA
Opacity: 0.6
Cursor: not-allowed
```

#### With Icon (Prefix/Suffix)
```
Padding Left (with icon): 48px
Icon Position: Absolute, left 16px
Icon Size: 20px
Icon Color: #6C757D
```

### Textarea

```
[Same as Text Input]
Min Height: 120px
Max Height: 300px
Resize: vertical
```

### Select Dropdown

```
[Same as Text Input]
Appearance: none
Background Image: Dropdown arrow icon
Background Position: right 16px center
Background Size: 16px
Padding Right: 40px
```

#### Dropdown Menu
```
Position: Absolute
Top: 100% + 4px
Width: 100%
Background: #FFFFFF
Border: 2px solid #FF6B35
Border Radius: 8px
Shadow: 0 8px 25px rgba(0,0,0,0.15)
Max Height: 300px
Overflow: auto
Z-Index: 1000
```

#### Option Item
```
Padding: 12px 16px
Font Size: 16px
Color: #343A40
Cursor: pointer
Transition: background 0.2s
```

#### Option Hover
```
Background: rgba(255,107,53,0.1)
```

#### Selected Option
```
Background: rgba(255,107,53,0.15)
Color: #FF6B35
Font Weight: 600
```

### Checkbox

```
Size: 20px × 20px
Border: 2px solid #E0E0E0
Border Radius: 4px
Background: #FFFFFF
Cursor: pointer
```

#### Checked
```
Background: #FF6B35
Border Color: #FF6B35
Checkmark: White, 14px
```

#### Focus
```
Box Shadow: 0 0 0 0.2rem rgba(255,107,53,0.25)
```

### Radio Button

```
Size: 20px × 20px
Border: 2px solid #E0E0E0
Border Radius: 50% (circle)
Background: #FFFFFF
Cursor: pointer
```

#### Selected
```
Border Color: #FF6B35
Inner Dot: 10px, #FF6B35
```

### Toggle Switch

```
Width: 48px
Height: 24px
Border Radius: 12px
Background: #E0E0E0
Position: relative
Cursor: pointer
Transition: background 0.3s
```

#### Switch Handle
```
Size: 20px × 20px
Border Radius: 50%
Background: #FFFFFF
Position: Absolute, left 2px
Transition: left 0.3s
Shadow: 0 2px 4px rgba(0,0,0,0.2)
```

#### Checked
```
Background: #28a745
Handle Position: left 26px
```

### File Upload

```
Container Height: 150px
Border: 2px dashed #E0E0E0
Border Radius: 8px
Background: #F8F9FA
Display: flex, center aligned
Cursor: pointer
Transition: all 0.3s
```

#### Hover
```
Border Color: #FF6B35
Background: rgba(255,107,53,0.05)
```

#### With Preview
```
Image Size: 100px × 100px
Border Radius: 8px
Object Fit: cover
```

---

## 🃏 Cards

### Standard Product Card

```
Width: 100% (col-md-4)
Background: #FFFFFF
Border: none
Border Radius: 16px
Shadow: 0 4px 15px rgba(0,0,0,0.1)
Overflow: hidden
Transition: all 0.3s
```

#### Hover
```
Transform: translateY(-8px)
Shadow: 0 8px 25px rgba(255,107,53,0.3)
```

#### Structure
```
┌────────────────────┐
│   Badge (TL/TR)    │
│                    │
│   Product Image    │ 280px height
│                    │
├────────────────────┤
│   Card Body        │
│   - Icon + Title   │
│   - Description    │
│   - Price & Stars  │
│   - Stock Info     │
├────────────────────┤
│   Card Footer      │
│   [Details] [Add]  │
└────────────────────┘
```

#### Image Section
```
Height: 280px
Object Fit: cover
Border Bottom: 4px solid #FF6B35
```

#### Badge (Top-left)
```
Position: Absolute, top 12px, left 12px
Z-Index: 2
```

#### Badge (Top-right)
```
Position: Absolute, top 12px, right 12px
Z-Index: 2
```

#### Card Body
```
Padding: 20px
Display: flex
Flex Direction: column
```

#### Title
```
Font Size: 20px
Font Weight: Bold (700)
Color: #8B4513
Margin Bottom: 12px
Icon: 20px, #FF6B35, margin-right 8px
```

#### Description
```
Font Size: 14px
Color: #6C757D
Margin Bottom: 16px
Max Lines: 3
Text Overflow: ellipsis
```

#### Price
```
Font Size: 24px
Font Weight: Bold (700)
Color: #E74C3C
```

#### Stars Rating
```
Star Size: 16px
Star Color: #FFD23F
Gap: 2px
```

#### Stock Info
```
Font Size: 14px
Icon: 16px, margin-right 4px
Color: #28a745 (if >5) or #dc3545 (if ≤5)
Font Weight: 600 (if low stock)
```

#### Card Footer
```
Padding: 12px 16px
Background: transparent
Border Top: none
Display: flex
Gap: 8px
```

### Dashboard Stat Card

```
Background: Gradient (varies)
Border: none
Border Radius: 16px
Padding: 24px
Shadow: 0 4px 15px rgba(0,0,0,0.1)
Color: #FFFFFF
Transition: all 0.3s
```

#### Hover
```
Transform: translateY(-5px)
Shadow: 0 8px 25px rgba(255,107,53,0.3)
```

#### Structure
```
┌────────────────────────┐
│ Label (small)          │
│ Value (h3, bold)       │
│ Badge (growth)         │
│            [Icon]      │
└────────────────────────┘
```

#### Label
```
Font Size: 14px
Opacity: 0.75
Margin Bottom: 8px
```

#### Value
```
Font Size: 28px
Font Weight: Bold (700)
Margin Bottom: 8px
```

#### Icon
```
Size: 48px
Opacity: 0.8
Position: Absolute, right 24px, bottom 24px
```

### Info Card (Gradient Background)

```
Background: linear-gradient(135deg, #FFF8DC, #FFE4B5)
Border: 3px solid #FF6B35
Border Radius: 24px
Padding: 48px 32px
Shadow: 0 8px 24px rgba(0,0,0,0.1)
```

---

## 🧭 Navigation

### Customer Navigation Bar

```
Height: 70px
Background: #FFFFFF
Shadow: 0 2px 10px rgba(0,0,0,0.1)
Position: sticky, top 0
Z-Index: 1000
Padding: 0 24px
```

#### Logo Section
```
Display: flex, align-items center
Gap: 12px
```

#### Logo Icon
```
Size: 40px
Color: #FF6B35
```

#### Logo Text
```
Font Size: 24px
Font Weight: Bold (700)
Color: #8B4513
```

#### Nav Items (Desktop)
```
Display: flex
Gap: 32px
Align Items: center
```

#### Nav Link
```
Font Size: 16px
Font Weight: 600
Color: #343A40
Padding: 8px 16px
Border Radius: 8px
Transition: all 0.3s
Text Decoration: none
```

#### Nav Link Hover
```
Background: rgba(255,107,53,0.1)
Color: #FF6B35
```

#### Nav Link Active
```
Background: rgba(255,107,53,0.15)
Color: #FF6B35
Font Weight: Bold (700)
```

#### Cart Icon
```
Size: 24px
Position: relative
```

#### Cart Badge
```
Position: Absolute, top -8px, right -8px
Size: 20px × 20px
Background: #dc3545
Color: #FFFFFF
Border Radius: 50%
Font Size: 12px
Font Weight: Bold
Display: flex, center
```

#### User Dropdown
```
Display: flex, align-items center
Gap: 8px
Padding: 8px 12px
Border Radius: 8px
Cursor: pointer
```

#### Avatar
```
Size: 36px × 36px
Border Radius: 50%
Border: 2px solid #FF6B35
```

### Mobile Hamburger Menu

```
Size: 32px × 32px
Background: transparent
Border: none
Display: none (mobile: block)
```

#### Menu Icon
```
3 horizontal lines
Width: 24px
Height: 2px
Background: #8B4513
Gap: 6px
```

### Admin Sidebar

```
Width: 250px
Background: #343A40 or gradient
Height: 100vh
Position: fixed, left 0
Padding: 24px 0
Z-Index: 1000
```

#### Logo Section
```
Padding: 0 24px 24px
Border Bottom: 1px solid rgba(255,255,255,0.1)
```

#### Menu Item
```
Padding: 12px 24px
Display: flex
Align Items: center
Gap: 12px
Color: rgba(255,255,255,0.8)
Cursor: pointer
Transition: all 0.3s
Text Decoration: none
```

#### Menu Item Hover
```
Background: rgba(255,107,53,0.1)
Color: #FFFFFF
```

#### Menu Item Active
```
Background: rgba(255,107,53,0.2)
Color: #FFFFFF
Border Left: 4px solid #FF6B35
```

#### Menu Icon
```
Size: 20px
Color: inherit
```

---

## 🏷️ Badges & Tags

### Badge (Standard)

```
Padding: 8px 16px
Border Radius: 16px
Font Size: 14px
Font Weight: 600
Text Transform: uppercase
Display: inline-flex
Align Items: center
Gap: 4px
```

#### Badge Variants

**Success**
```
Background: #28a745
Color: #FFFFFF
```

**Warning**
```
Background: #ffc107
Color: #333333
```

**Danger**
```
Background: #dc3545
Color: #FFFFFF
```

**Info**
```
Background: #17a2b8
Color: #FFFFFF
```

**Primary**
```
Background: linear-gradient(135deg, #FF6B35, #E74C3C)
Color: #FFFFFF
```

### Tag (Removable)

```
[Same as Badge]
With close icon (×)
Icon Size: 16px
Icon Position: right
Hover: Icon color changes
```

### Status Badge (Orders)

```
Padding: 6px 12px
Font Size: 12px
Border Radius: 12px
Font Weight: Bold (700)
```

---

## 🪟 Modals & Dialogs

### Modal Container

```
Position: Fixed, center of screen
Background: #FFFFFF
Border Radius: 16px
Shadow: 0 10px 40px rgba(0,0,0,0.3)
Z-Index: 1050
Max Width: 500px (sm), 700px (md), 900px (lg)
Width: 90% (mobile)
Max Height: 90vh
Overflow: auto
```

### Modal Backdrop

```
Position: Fixed, full screen
Background: rgba(0,0,0,0.5)
Z-Index: 1040
Backdrop Filter: blur(2px)
```

### Modal Header

```
Padding: 24px
Border Bottom: 1px solid #E0E0E0
Display: flex
Justify Content: space-between
Align Items: center
```

#### Modal Title
```
Font Size: 24px
Font Weight: Bold (700)
Color: #8B4513
```

#### Close Button
```
Size: 32px × 32px
Background: transparent
Border: none
Color: #6C757D
Font Size: 24px
Cursor: pointer
Transition: color 0.3s
```

#### Close Button Hover
```
Color: #FF6B35
```

### Modal Body

```
Padding: 24px
Max Height: calc(90vh - 160px)
Overflow: auto
```

### Modal Footer

```
Padding: 16px 24px
Border Top: 1px solid #E0E0E0
Display: flex
Justify Content: flex-end
Gap: 12px
```

### Confirmation Dialog

```
Max Width: 400px
Icon at top: Large (48px)
Title: Center aligned
Message: Center aligned
Buttons: Full width or side-by-side
```

---

## 📊 Tables

### Data Table Container

```
Background: #FFFFFF
Border Radius: 16px
Overflow: hidden
Shadow: 0 4px 15px rgba(0,0,0,0.1)
```

### Table Header

```
Background: linear-gradient(135deg, #FF6B35, #E74C3C)
Color: #FFFFFF
Font Weight: 600
Padding: 16px
```

#### Header Cell
```
Padding: 16px
Text Align: left
Font Size: 14px
Text Transform: uppercase
Letter Spacing: 0.05em
```

### Table Body

```
Background: #FFFFFF
```

#### Table Row
```
Border Bottom: 1px solid #E0E0E0
Transition: background 0.2s
```

#### Row Hover
```
Background: rgba(255,107,53,0.05)
```

#### Table Cell
```
Padding: 16px
Font Size: 14px
Color: #343A40
Vertical Align: middle
```

### Striped Table

```
Row:nth-child(even) {
  Background: #F8F9FA
}
```

### Responsive Table (Mobile)

```
Convert to card layout
Stack cells vertically
Show labels inline
```

---

## 🔔 Alerts & Notifications

### Alert Box

```
Padding: 16px 20px
Border Radius: 12px
Border Left: 5px solid
Display: flex
Align Items: start
Gap: 12px
Margin Bottom: 16px
Shadow: 0 4px 10px rgba(0,0,0,0.1)
```

#### Alert Icon
```
Size: 24px
Flex: 0 0 24px
```

#### Alert Content
```
Flex: 1
```

#### Alert Title
```
Font Weight: 600
Margin Bottom: 4px
```

#### Close Button
```
Size: 24px × 24px
Background: transparent
Border: none
Cursor: pointer
Opacity: 0.6
```

#### Close Hover
```
Opacity: 1
```

### Alert Variants

**Success**
```
Background: rgba(40,167,69,0.1)
Border Color: #28a745
Text Color: #28a745
Icon Color: #28a745
```

**Warning**
```
Background: rgba(255,193,7,0.1)
Border Color: #ffc107
Text Color: #856404
Icon Color: #ffc107
```

**Danger**
```
Background: rgba(220,53,69,0.1)
Border Color: #dc3545
Text Color: #dc3545
Icon Color: #dc3545
```

**Info**
```
Background: rgba(23,162,184,0.1)
Border Color: #17a2b8
Text Color: #17a2b8
Icon Color: #17a2b8
```

### Toast Notification

```
Position: Fixed, top-right 24px
Width: 320px
Background: #FFFFFF
Border Radius: 12px
Shadow: 0 8px 25px rgba(0,0,0,0.2)
Padding: 16px
Animation: slideInRight 0.3s
Z-Index: 2000
```

#### Toast Auto-dismiss
```
Duration: 5 seconds
Progress bar at bottom
```

---

## ⏳ Loading States

### Spinner

```
Size: 40px × 40px
Border: 4px solid rgba(255,107,53,0.2)
Border Top: 4px solid #FF6B35
Border Radius: 50%
Animation: spin 1s linear infinite
```

#### Spinner Sizes

**Small**
```
Size: 20px × 20px
Border: 2px
```

**Medium** (Default)
```
Size: 40px × 40px
Border: 4px
```

**Large**
```
Size: 60px × 60px
Border: 6px
```

### Button Loading State

```
[Same as button default]
Cursor: not-allowed
Pointer Events: none
```

#### Spinner in Button
```
Size: 16px × 16px
Margin Right: 8px
Display: inline-block
```

### Skeleton Loader

#### Card Skeleton
```
Background: linear-gradient(90deg, #F0F0F0 25%, #E0E0E0 50%, #F0F0F0 75%)
Background Size: 200% 100%
Animation: shimmer 2s infinite
Border Radius: 8px
```

#### Text Line Skeleton
```
Height: 16px
Width: varies (100%, 80%, 60%)
Margin Bottom: 12px
[Same shimmer effect]
```

#### Image Skeleton
```
Aspect Ratio: matches image
[Same shimmer effect]
```

### Loading Overlay

```
Position: Absolute/Fixed
Background: rgba(255,255,255,0.9)
Display: flex, center aligned
Z-Index: 999
```

---

## 🎨 Icons

### Icon Specifications

#### Size Scale
```
xs: 12px
sm: 16px
md: 20px (default)
lg: 24px
xl: 32px
2xl: 48px
3xl: 64px
```

#### Icon Colors
```
Default: #6C757D
Primary: #FF6B35
Success: #28a745
Warning: #ffc107
Danger: #dc3545
White: #FFFFFF
```

#### Icon with Text
```
Display: inline-flex
Align Items: center
Gap: 8px
```

### Common Icons Usage

| Icon | BoxIcon Class | Usage |
|------|---------------|-------|
| Burger | `bxs-burger` | Food, Products |
| Cart | `bxs-cart` | Shopping Cart |
| User | `bxs-user` | Profile, Account |
| Hot | `bxs-hot` | Trending, Popular |
| Star | `bxs-star` | Ratings, Favorites |
| Menu | `bx-menu` | Navigation Menu |
| Search | `bx-search` | Search function |
| Edit | `bx-edit` | Edit action |
| Trash | `bx-trash` | Delete action |
| Check | `bx-check` | Success, Confirm |
| X | `bx-x` | Close, Cancel |
| Arrow Right | `bx-right-arrow-alt` | Next, Continue |
| Arrow Left | `bx-left-arrow-alt` | Back, Previous |
| Package | `bx-package` | Orders, Stock |
| Truck | `bxs-truck` | Delivery |
| Money | `bx-money` | Price, Payment |

---

## 🎯 Interactive States Summary

### All Interactive Elements

| State | Visual Change |
|-------|---------------|
| Default | Base styling |
| Hover | Color/shadow change, slight lift |
| Active | Pressed appearance |
| Focus | Outline visible |
| Disabled | Opacity reduced, cursor disabled |
| Loading | Spinner shown, interactions disabled |
| Error | Red border/background tint |
| Success | Green border/background tint |

---

## 📏 Spacing Guidelines

### Component Internal Spacing

| Component | Padding | Margin |
|-----------|---------|--------|
| Button | 12px 32px | varies |
| Input | 12px 16px | varies |
| Card | 20px | 16px bottom |
| Modal | 24px | - |
| Alert | 16px 20px | 16px bottom |
| Badge | 8px 16px | 4px (inline) |
| Table Cell | 16px | - |

---

**Component Specifications Version:** 1.0  
**Last Updated:** December 17, 2025  
**Project:** Burger Tropical E-Commerce

