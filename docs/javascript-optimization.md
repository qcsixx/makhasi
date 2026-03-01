# JavaScript Optimization Guide

## Current Implementation

The application currently loads all JavaScript libraries on every page, which is not optimal for performance.

## Optimization Strategy

### 1. Conditional Script Loading

Only load scripts when needed:

```blade
{{-- In layouts/app.blade.php --}}
@stack('scripts')

{{-- In specific views that need Isotope --}}
@push('scripts')
    <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
@endpush
```

### 2. Defer Non-Critical Scripts

Add `defer` attribute to scripts that don't need to run immediately:

```html
<script src="js/custom.js" defer></script>
<script src="https://unpkg.com/aos@next/dist/aos.js" defer></script>
```

### 3. Async Loading for Third-Party Scripts

```html
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js" async></script>
```

### 4. Bundle and Minify

Use Laravel Mix or Vite to bundle JavaScript:

```javascript
// vite.config.js
export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
    ],
    build: {
        rollupOptions: {
            output: {
                manualChunks: {
                    'vendor': ['jquery', 'bootstrap'],
                    'carousel': ['owl.carousel'],
                }
            }
        }
    }
});
```

### 5. Remove Unused Libraries

Audit and remove libraries not being used:
- ✅ jQuery - Used (but could be replaced with vanilla JS)
- ✅ Bootstrap - Used
- ✅ Owl Carousel - Used on home page only
- ✅ Isotope - Used on menu page only
- ❓ Nice Select - Check if actually used

### 6. Lazy Load Images

Already implemented with `loading="lazy"` attribute ✅

## Implementation Steps

1. **Create a base layout** with conditional script loading
2. **Move page-specific scripts** to @push directives
3. **Add defer/async** attributes where appropriate
4. **Bundle common scripts** using Vite
5. **Test thoroughly** to ensure functionality

## Expected Performance Gains

- **Reduced initial page load**: 30-40% faster
- **Better caching**: Separate bundles cache independently
- **Improved mobile performance**: Less JavaScript to parse

## Files to Modify

- `resources/views/layouts/app.blade.php` (create if not exists)
- `resources/views/home.blade.php`
- `resources/views/menu.blade.php`
- `resources/views/detail.blade.php`
- `vite.config.js`

## Testing Checklist

- [ ] Home page carousel works
- [ ] Menu page filtering works
- [ ] Detail page interactions work
- [ ] Mobile navigation works
- [ ] All animations trigger correctly
- [ ] Page load time improved (use Lighthouse)
