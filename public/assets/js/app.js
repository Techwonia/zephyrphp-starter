/**
 * ZephyrPHP Starter Application JavaScript
 *
 * Initialize your application's interactivity here
 */

(function() {
    'use strict';

    /**
     * Initialize the application
     */
    function init() {
        console.log('⚡ ZephyrPHP Application Initialized');

        // Add smooth scroll behavior for anchor links
        initSmoothScroll();

        // Add any other initialization here
    }

    /**
     * Enable smooth scrolling for anchor links
     */
    function initSmoothScroll() {
        const links = document.querySelectorAll('a[href^="#"]');

        links.forEach(link => {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');

                // Skip if it's just "#"
                if (href === '#') {
                    return;
                }

                const target = document.querySelector(href);

                if (target) {
                    e.preventDefault();
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    }

    /**
     * DOM Content Loaded Event
     */
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }

})();
