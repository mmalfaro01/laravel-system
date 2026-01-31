# 🎨 Burger Tropical - Color Palette & Visual Styles

## Complete Color System for Figma

### Primary Brand Colors

| Color Name | Hex Code | RGB | Usage |
|------------|----------|-----|-------|
| Tropical Orange | `#FF6B35` | rgb(255, 107, 53) | Primary CTAs, Links, Accents |
| Tropical Red | `#E74C3C` | rgb(231, 76, 60) | Secondary Accents, Highlights |
| Tropical Yellow | `#FFD23F` | rgb(255, 210, 63) | Badges, Stars, Highlights |
| Tropical Brown | `#8B4513` | rgb(139, 69, 19) | Headings, Primary Text |
| Tropical Green | `#28a745` | rgb(40, 167, 69) | Success States |

### Secondary Colors

| Color Name | Hex Code | RGB | Usage |
|------------|----------|-----|-------|
| Success Green | `#20c997` | rgb(32, 201, 151) | Success Messages, Badges |
| Warning Yellow | `#ffc107` | rgb(255, 193, 7) | Warning States, Alerts |
| Warning Orange | `#ff9800` | rgb(255, 152, 0) | Secondary Warnings |
| Danger Red | `#dc3545` | rgb(220, 53, 69) | Error States, Delete Actions |
| Info Blue | `#17a2b8` | rgb(23, 162, 184) | Information Messages |
| Purple | `#6f42c1` | rgb(111, 66, 193) | Special Features |

### Neutral Colors

| Color Name | Hex Code | RGB | Usage |
|------------|----------|-----|-------|
| White | `#FFFFFF` | rgb(255, 255, 255) | Backgrounds, Cards |
| Light Cream | `#FFF8DC` | rgb(255, 248, 220) | Alternate Backgrounds |
| Light Peach | `#FFE4B5` | rgb(255, 228, 181) | Info Sections |
| Light Gray | `#F8F9FA` | rgb(248, 249, 250) | Subtle Backgrounds |
| Medium Gray | `#6C757D` | rgb(108, 117, 125) | Secondary Text |
| Dark Gray | `#343A40` | rgb(52, 58, 64) | Body Text |
| Black | `#000000` | rgb(0, 0, 0) | Pure Black (rare use) |

### Border Colors

| Color Name | Hex Code | Opacity | Usage |
|------------|----------|---------|-------|
| Light Border | `#E0E0E0` | 100% | Form borders, dividers |
| Medium Border | `#CCCCCC` | 100% | Card borders |
| Orange Border | `#FF6B35` | 100% | Active/Focus states |
| Shadow Color | `#000000` | 10-20% | Drop shadows |

### Background Gradients

#### Primary Gradient (Orange to Red)
```css
background: linear-gradient(135deg, #FF6B35 0%, #E74C3C 100%);
```
**Use for:** Primary CTAs, Hero sections, Admin headers

#### Success Gradient (Green)
```css
background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
```
**Use for:** Success metrics, earnings cards

#### Warning Gradient (Yellow to Orange)
```css
background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
```
**Use for:** Warning states, pending orders

#### Info Gradient (Cream)
```css
background: linear-gradient(135deg, #FFF8DC 0%, #FFE4B5 100%);
```
**Use for:** Info sections, highlights, backgrounds

#### Purple Gradient
```css
background: linear-gradient(135deg, #6f42c1 0%, #5a32a3 100%);
```
**Use for:** Premium features, special sections

### Overlay Gradients

#### Dark Overlay (for images)
```css
background: linear-gradient(135deg, rgba(0,0,0,0.5) 0%, rgba(0,0,0,0.3) 100%);
```

#### Orange Overlay (hover effects)
```css
background: linear-gradient(135deg, rgba(255,107,53,0.1) 0%, rgba(231,76,60,0.1) 100%);
```

### Text Colors

| Usage | Color | Hex |
|-------|-------|-----|
| Primary Headings | Tropical Brown | `#8B4513` |
| Body Text | Dark Gray | `#343A40` |
| Secondary Text | Medium Gray | `#6C757D` |
| Link Text | Tropical Orange | `#FF6B35` |
| Link Hover | Tropical Red | `#E74C3C` |
| Price Text | Tropical Red | `#E74C3C` |
| Success Text | Green | `#28a745` |
| Error Text | Danger Red | `#dc3545` |
| Muted Text | Medium Gray | `#6C757D` |

### Shadow Styles

#### Small Shadow
```css
box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
```
**Use for:** Cards, buttons (default state)

#### Medium Shadow
```css
box-shadow: 0 8px 25px rgba(0, 0, 0, 0.2);
```
**Use for:** Modals, elevated cards

#### Large Shadow (Orange tint)
```css
box-shadow: 0 12px 30px rgba(255, 107, 53, 0.3);
```
**Use for:** Hover states, featured elements

#### Button Shadow
```css
box-shadow: 0 4px 15px rgba(255, 107, 53, 0.4);
```
**Use for:** Primary CTA buttons

#### Inner Shadow
```css
box-shadow: inset 0 2px 4px rgba(0, 0, 0, 0.1);
```
**Use for:** Input fields, pressed states

### Border Styles

#### Default Border
```css
border: 1px solid #E0E0E0;
```

#### Focus Border
```css
border: 2px solid #FF6B35;
```

#### Accent Border
```css
border: 3px solid #FF6B35;
```

#### Bottom Border (thick)
```css
border-bottom: 4px solid #FF6B35;
```

### Opacity Levels

| Usage | Opacity |
|-------|---------|
| Disabled elements | 0.5 (50%) |
| Secondary icons | 0.8 (80%) |
| Hover overlay | 0.05-0.1 (5-10%) |
| Modal backdrop | 0.5 (50%) |
| Watermark | 0.1 (10%) |

---

## 📐 Spacing System

### Margin & Padding Scale

| Size | rem | px | Usage |
|------|-----|----|----|
| xs | 0.25rem | 4px | Tight spacing |
| sm | 0.5rem | 8px | Small gaps |
| md | 1rem | 16px | Default spacing |
| lg | 1.5rem | 24px | Section spacing |
| xl | 2rem | 32px | Large gaps |
| 2xl | 2.5rem | 40px | Extra large |
| 3xl | 3rem | 48px | Section headers |
| 4xl | 4rem | 64px | Page sections |
| 5xl | 5rem | 80px | Hero spacing |

---

## 🔤 Typography System

### Font Stack
```css
font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
```

### Font Sizes

| Name | Size (rem) | Size (px) | Line Height | Weight | Usage |
|------|------------|-----------|-------------|--------|-------|
| Display 1 | 6rem | 96px | 1.1 | 800 | Hero titles |
| Display 4 | 3.5rem | 56px | 1.2 | 700 | Page headers |
| Display 5 | 3rem | 48px | 1.2 | 700 | Section headers |
| H1 | 2.5rem | 40px | 1.3 | 700 | Main headings |
| H2 | 2rem | 32px | 1.4 | 700 | Subheadings |
| H3 | 1.75rem | 28px | 1.4 | 600 | Card titles |
| H4 | 1.5rem | 24px | 1.5 | 600 | Sub-sections |
| H5 | 1.25rem | 20px | 1.5 | 600 | Small headings |
| Lead | 1.25rem | 20px | 1.6 | 400 | Lead paragraphs |
| Body Large | 1.15rem | 18.4px | 1.6 | 400 | Important text |
| Body | 1rem | 16px | 1.5 | 400 | Default text |
| Small | 0.875rem | 14px | 1.5 | 400 | Secondary info |

### Font Weights

| Name | Weight | Usage |
|------|--------|-------|
| Light | 300 | Decorative text |
| Regular | 400 | Body text |
| Semi-Bold | 600 | Headings, emphasis |
| Bold | 700 | Important headings |
| Extra Bold | 800 | Display text |

### Text Transforms

| Style | CSS | Usage |
|-------|-----|-------|
| Uppercase | `text-transform: uppercase` | Badges, labels |
| Capitalize | `text-transform: capitalize` | Titles |
| Lowercase | `text-transform: lowercase` | Rare use |

### Letter Spacing

| Size | Value | Usage |
|------|-------|-------|
| Tight | -0.025em | Large headings |
| Normal | 0 | Body text |
| Wide | 0.025em | Buttons, labels |
| Wider | 0.05em | Badges (uppercase) |

---

## 🎭 State Styles

### Button States

#### Default State
```css
background: linear-gradient(135deg, #FF6B35, #E74C3C);
color: white;
border: none;
box-shadow: 0 4px 15px rgba(255,107,53,0.4);
```

#### Hover State
```css
transform: translateY(-2px);
box-shadow: 0 6px 20px rgba(255,107,53,0.5);
```

#### Active/Pressed State
```css
transform: translateY(0);
box-shadow: 0 2px 10px rgba(255,107,53,0.3);
```

#### Focus State
```css
outline: 3px solid rgba(255,107,53,0.3);
outline-offset: 2px;
```

#### Disabled State
```css
opacity: 0.5;
cursor: not-allowed;
pointer-events: none;
```

### Input States

#### Default
```css
border: 2px solid #E0E0E0;
background: white;
```

#### Focus
```css
border: 2px solid #FF6B35;
box-shadow: 0 0 0 0.2rem rgba(255,107,53,0.25);
```

#### Error
```css
border: 2px solid #dc3545;
background: rgba(220,53,69,0.05);
```

#### Success
```css
border: 2px solid #28a745;
background: rgba(40,167,69,0.05);
```

#### Disabled
```css
background: #F8F9FA;
cursor: not-allowed;
opacity: 0.6;
```

---

## 🖼️ Image Treatments

### Product Images

#### Default
- Border: 4px solid #FF6B35 (bottom only)
- Border radius: 0
- Object-fit: cover

#### Hover
- Filter: brightness(1.1)
- Transform: scale(1.05)

### Thumbnail Images

#### Small (Cart)
- Size: 80×80px
- Border: 3px solid #FF6B35
- Border radius: 10px

#### Medium (Profile)
- Size: 150×150px
- Border: 4px solid #FF6B35
- Border radius: 50% (circle)

---

## 📊 Data Visualization Colors

### Chart Colors (Chart.js)

| Usage | Color | Hex |
|-------|-------|-----|
| Primary bars | Orange | `#FF6B35` |
| Bar border | Red | `#E74C3C` |
| Grid lines | Light Orange | `rgba(255,107,53,0.1)` |
| Hover state | Red | `rgba(231,76,60,0.9)` |
| Text/Labels | Brown | `#8B4513` |

---

## ✨ Animation Timings

| Animation | Duration | Easing |
|-----------|----------|--------|
| Button hover | 0.3s | ease |
| Card hover | 0.3s | ease |
| Page transition | 0.5s | ease-in-out |
| Fade in | 0.5s | ease-in |
| Slide in | 0.6s | ease-out |
| Bounce | 2s | infinite |
| Pulse | 1.5s | infinite |

---

## 🎯 Accessibility

### Minimum Contrast Ratios

| Text Size | Background | Minimum Ratio |
|-----------|------------|---------------|
| Normal text | Any | 4.5:1 |
| Large text (18pt+) | Any | 3:1 |
| Interactive elements | Any | 3:1 |

### Color Contrast Checks

✅ **Pass**
- White text on #FF6B35 (Orange) - 3.8:1
- White text on #E74C3C (Red) - 4.2:1
- #8B4513 (Brown) on White - 6.9:1
- #343A40 (Dark Gray) on White - 12.6:1

⚠️ **Warning**
- #FFD23F (Yellow) on White - Use dark text instead

### Focus Indicators

All interactive elements must have visible focus indicators:
```css
outline: 3px solid rgba(255,107,53,0.3);
outline-offset: 2px;
```

---

## 🔗 Quick Reference

### Most Used Color Combinations

#### Primary CTA
- Background: Orange-Red Gradient
- Text: White
- Shadow: Orange tint

#### Secondary Button
- Background: Transparent
- Border: 2px Orange
- Text: Orange

#### Card
- Background: White
- Border: None
- Shadow: Light (10% black)

#### Badge Success
- Background: #28a745
- Text: White

#### Badge Warning
- Background: #ffc107
- Text: Dark (#333)

#### Badge Danger
- Background: #dc3545
- Text: White

---

**Color Palette Version:** 1.0  
**Last Updated:** December 17, 2025  
**Project:** Burger Tropical E-Commerce

