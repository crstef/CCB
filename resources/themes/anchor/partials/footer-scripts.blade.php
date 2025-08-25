@filamentScripts
@livewireScripts
@if(config('wave.dev_bar'))
    @include('theme::partials.dev_bar')
@endif

{{-- @yield('javascript') --}}

<!-- Global Scroll to Top Button -->
<style>
    .global-scroll-to-top {
        position: fixed;
        bottom: 2rem;
        right: 2rem;
        width: 3rem;
        height: 3rem;
        background: rgba(59, 130, 246, 0.9);
        color: white;
        border: none;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        opacity: 0;
        visibility: hidden;
        transform: translateY(20px);
        z-index: 1000;
        backdrop-filter: blur(8px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }
    
    .global-scroll-to-top.visible {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }
    
    .global-scroll-to-top:hover {
        background: rgba(59, 130, 246, 1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
    }
    
    @media (max-width: 768px) {
        .global-scroll-to-top {
            bottom: 1.5rem;
            right: 1.5rem;
            width: 2.5rem;
            height: 2.5rem;
        }
    }
</style>

<button class="global-scroll-to-top" id="globalScrollToTop" onclick="globalScrollToTop()">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
    </svg>
</button>

<script>
// Global scroll to top functionality
function globalScrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
}

// Show/hide global scroll to top button
window.addEventListener('scroll', function() {
    const scrollButton = document.getElementById('globalScrollToTop');
    if (scrollButton && window.pageYOffset > 300) {
        scrollButton.classList.add('visible');
    } else if (scrollButton) {
        scrollButton.classList.remove('visible');
    }
});

// Hide duplicate buttons - if page has its own scroll button, hide global one
document.addEventListener('DOMContentLoaded', function() {
    const pageScrollButton = document.getElementById('scrollToTop');
    const globalScrollButton = document.getElementById('globalScrollToTop');
    
    if (pageScrollButton && globalScrollButton) {
        globalScrollButton.style.display = 'none';
    }
});
</script>

@if(setting('site.google_analytics_tracking_id', ''))
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ setting('site.google_analytics_tracking_id') }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', '{{ setting("site.google_analytics_tracking_id") }}');
    </script>
@endif