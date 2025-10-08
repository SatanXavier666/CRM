// Fix Next.js image optimization URLs for static hosting
(function() {
    // Wait for DOM to load
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', fixImages);
    } else {
        fixImages();
    }
    
    function fixImages() {
        // Find all img tags with Next.js image optimization URLs
        const images = document.querySelectorAll('img[src*="/_next/image?"]');
        
        images.forEach(img => {
            try {
                const src = img.getAttribute('src');
                const srcset = img.getAttribute('srcset');
                
                // Extract the actual image URL from the optimization URL
                if (src && src.includes('/_next/image?')) {
                    const urlMatch = src.match(/url=([^&]+)/);
                    if (urlMatch) {
                        const decodedUrl = decodeURIComponent(urlMatch[1]);
                        // Convert to relative path
                        img.src = decodedUrl.startsWith('/') ? '.' + decodedUrl : decodedUrl;
                    }
                }
                
                // Fix srcset as well
                if (srcset && srcset.includes('/_next/image?')) {
                    const fixedSrcset = srcset.split(',').map(src => {
                        const urlMatch = src.match(/url=([^&]+)/);
                        if (urlMatch) {
                            const decodedUrl = decodeURIComponent(urlMatch[1]);
                            const relativePath = decodedUrl.startsWith('/') ? '.' + decodedUrl : decodedUrl;
                            // Keep the width descriptor
                            const widthMatch = src.match(/\s+(\d+w)$/);
                            return relativePath + (widthMatch ? ' ' + widthMatch[1] : '');
                        }
                        return src;
                    }).join(', ');
                    
                    img.srcset = fixedSrcset;
                }
            } catch (e) {
                console.warn('Failed to fix image:', img, e);
            }
        });
        
        console.log(`Fixed ${images.length} Next.js optimized images`);
    }
})();
