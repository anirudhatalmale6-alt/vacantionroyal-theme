/**
 * Vacantion Royal Theme - Main JavaScript
 *
 * @package VacantionRoyal
 */

(function($) {
    'use strict';

    // Header scroll effect
    function handleHeaderScroll() {
        const header = document.getElementById('site-header');
        if (!header) return;

        if (window.scrollY > 100) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    }

    // Mobile menu toggle
    function initMobileMenu() {
        const toggle = document.getElementById('mobile-menu-toggle');
        const nav = document.getElementById('main-nav');

        if (!toggle || !nav) return;

        toggle.addEventListener('click', function() {
            nav.classList.toggle('active');
            toggle.classList.toggle('active');
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (!toggle.contains(e.target) && !nav.contains(e.target)) {
                nav.classList.remove('active');
                toggle.classList.remove('active');
            }
        });
    }

    // Set minimum date for date inputs
    function initDateInputs() {
        const today = new Date().toISOString().split('T')[0];
        const checkinInputs = document.querySelectorAll('input[name="checkin"]');
        const checkoutInputs = document.querySelectorAll('input[name="checkout"]');

        checkinInputs.forEach(input => {
            input.setAttribute('min', today);
            input.addEventListener('change', function() {
                const checkoutInput = this.closest('form').querySelector('input[name="checkout"]');
                if (checkoutInput) {
                    checkoutInput.setAttribute('min', this.value);
                    if (checkoutInput.value && checkoutInput.value <= this.value) {
                        checkoutInput.value = '';
                    }
                }
            });
        });

        checkoutInputs.forEach(input => {
            input.setAttribute('min', today);
        });
    }

    // Handle booking form submission
    function initBookingForm() {
        const form = document.getElementById('booking-form');
        if (!form) return;

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoading = submitBtn.querySelector('.btn-loading');
            const messageDiv = document.getElementById('booking-form-message');

            // Show loading state
            submitBtn.disabled = true;
            if (btnText) btnText.style.display = 'none';
            if (btnLoading) btnLoading.style.display = 'inline-block';

            // Clear previous messages
            if (messageDiv) {
                messageDiv.innerHTML = '';
                messageDiv.className = '';
            }

            // Send AJAX request
            fetch(vacantionroyal_ajax.ajax_url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (messageDiv) {
                    if (data.success) {
                        messageDiv.className = 'form-message success';
                        messageDiv.innerHTML = data.data.message;
                        form.reset();
                    } else {
                        messageDiv.className = 'form-message error';
                        messageDiv.innerHTML = data.data.message || 'An error occurred. Please try again.';
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (messageDiv) {
                    messageDiv.className = 'form-message error';
                    messageDiv.innerHTML = 'An error occurred. Please try again.';
                }
            })
            .finally(() => {
                submitBtn.disabled = false;
                if (btnText) btnText.style.display = 'inline';
                if (btnLoading) btnLoading.style.display = 'none';
            });
        });
    }

    // Handle contact form submission
    function initContactForm() {
        const form = document.getElementById('contact-form');
        if (!form) return;

        form.addEventListener('submit', function(e) {
            e.preventDefault();

            const formData = new FormData(form);
            const submitBtn = form.querySelector('button[type="submit"]');
            const btnText = submitBtn.querySelector('.btn-text');
            const btnLoading = submitBtn.querySelector('.btn-loading');
            const messageDiv = document.getElementById('contact-form-message');

            // Show loading state
            submitBtn.disabled = true;
            if (btnText) btnText.style.display = 'none';
            if (btnLoading) btnLoading.style.display = 'inline-block';

            // Clear previous messages
            if (messageDiv) {
                messageDiv.innerHTML = '';
                messageDiv.className = '';
            }

            // Send AJAX request
            fetch(vacantionroyal_ajax.ajax_url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (messageDiv) {
                    if (data.success) {
                        messageDiv.className = 'form-message success';
                        messageDiv.innerHTML = data.data.message;
                        form.reset();
                    } else {
                        messageDiv.className = 'form-message error';
                        messageDiv.innerHTML = data.data.message || 'An error occurred. Please try again.';
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (messageDiv) {
                    messageDiv.className = 'form-message error';
                    messageDiv.innerHTML = 'An error occurred. Please try again.';
                }
            })
            .finally(() => {
                submitBtn.disabled = false;
                if (btnText) btnText.style.display = 'inline';
                if (btnLoading) btnLoading.style.display = 'none';
            });
        });
    }

    // Smooth scroll for anchor links
    function initSmoothScroll() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const target = document.querySelector(this.getAttribute('href'));
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

    // Initialize all functions on DOM ready
    document.addEventListener('DOMContentLoaded', function() {
        handleHeaderScroll();
        initMobileMenu();
        initDateInputs();
        initBookingForm();
        initContactForm();
        initSmoothScroll();
    });

    // Handle header on scroll
    window.addEventListener('scroll', handleHeaderScroll);

})(jQuery);
