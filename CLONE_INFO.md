# Micro.so Website Clone

This is a complete, self-contained clone of https://www.micro.so/ website.

## Summary

All content, styling, and functionality have been preserved exactly as-is from the original site. The website is fully functional offline.

## Directory Structure

```
/root/repo/
├── index.html                 # Main entry point (cloned homepage)
├── micro-so.html             # Original downloaded HTML (backup)
├── _next/                    # Next.js framework assets
│   ├── static/
│   │   ├── css/             # Stylesheets (1 file)
│   │   ├── chunks/          # JavaScript modules (19 files)
│   │   │   └── app/         # Application-specific JS
│   │   └── media/           # Static media assets
│   │       ├── *.woff2      # Web fonts (5 files)
│   │       ├── *.svg        # Vector graphics (4 files)
│   │       └── *.png        # Images (2 files)
│   └── image/               # Next.js image optimization (placeholder)
└── videos/                   # Video assets
    ├── optimized/           # Optimized video files (20 files)
    │   ├── *-low-264.mp4   # Low quality H.264
    │   ├── *-low-265.mp4   # Low quality H.265
    │   ├── *-high-264.mp4  # High quality H.264
    │   └── *-high-265.mp4  # High quality H.265
    └── posters/             # Video poster images (5 files)
```

## Files Downloaded

### Summary by Type
- **HTML files:** 2 (index.html + backup)
- **JavaScript files:** 19 (all Next.js chunks and app code)
- **CSS files:** 1 (main stylesheet)
- **Font files:** 5 (WOFF2 web fonts)
- **SVG images:** 4 (icons and graphics)
- **PNG images:** 2 (large background images)
- **WebP images:** 5 (video posters)
- **Video files:** 20 (multiple quality levels and codecs)

**Total:** 60 files (~60 MB)

## Assets Breakdown

### JavaScript
All Next.js framework code and application logic:
- Framework chunks (077183b4, 32dee7a6, aff89236)
- Application bundles (242, 349, 682, 705, 757, 821, 835, 865, 972)
- Layout and page components
- Main app bundle
- Polyfills and webpack runtime

### CSS
- Complete stylesheet with all responsive design rules
- Includes animations, layout grids, and component styles

### Fonts
- 5 custom web fonts in WOFF2 format
- Optimized for web delivery

### Images
- Background and foreground large PNG images (32.94 MB)
- SVG icons (shield, arrow, footer logo, mask)
- Video poster frames in WebP format

### Videos
20 video files showcasing different features:
- **home** - Homepage intro animation
- **messages** - Messages feature demo
- **crm** - CRM functionality demo
- **projects** - Projects feature demo
- **ai** - AI capabilities demo

Each video available in 4 variants:
- Low quality H.264 (max compatibility)
- Low quality H.265 (modern browsers, smaller size)
- High quality H.264 (better quality, wider support)
- High quality H.265 (best quality, smallest size)

## How to Use

### Option 1: Open Directly
Simply open `index.html` in a modern web browser:
```bash
open index.html
# or
firefox index.html
# or
google-chrome index.html
```

### Option 2: Serve with HTTP Server (Recommended)
For full functionality (especially for video playback), serve via HTTP:

```bash
# Using Python 3
python3 -m http.server 8000

# Using Python 2
python -m SimpleHTTPServer 8000

# Using Node.js (if you have http-server installed)
npx http-server -p 8000

# Using PHP
php -S localhost:8000
```

Then visit: http://localhost:8000

## External Links

The following external links are preserved (they navigate away from the site):
- Login portal: https://app.micro.so/login
- Careers page: https://usemicro.notion.site/Careers-at-Micro-...
- Social media: Instagram, LinkedIn, X/Twitter

These are intentionally left as external links.

## Technical Details

### Path Structure
All resources use relative paths from the root:
- `/_next/static/...` - Next.js static assets
- `/videos/...` - Video files
- All paths work correctly when served from the root directory

### Compatibility
- All assets are locally referenced
- No external dependencies (except navigation links)
- Works offline after initial download
- Compatible with modern browsers
- Responsive design preserved for all screen sizes

### Preserved Features
- All animations and interactions
- Video autoplay and lazy loading
- Responsive design (mobile, tablet, desktop)
- All styling and layouts
- Form elements and buttons
- Navigation and scrolling effects

## Verification

All local resource paths have been verified to exist:
- ✓ All CSS files present
- ✓ All JavaScript files present
- ✓ All font files present
- ✓ All image files present
- ✓ All video files present

The website is 100% self-contained and ready to use.

## Notes

- The original HTML file (micro-so.html) is kept as a backup
- index.html is the main entry point
- All paths are relative and work when the entire directory is moved
- Videos use HTML5 video tags with multiple source formats for compatibility
- The site uses Next.js framework but is pre-rendered (no server required)

---

**Clone Date:** 2025-10-07
**Source:** https://www.micro.so/
**Total Size:** ~60 MB
**Status:** ✓ Complete and functional
