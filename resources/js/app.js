// Theme Management
function initTheme() {
    const getTheme = () => {
        if (localStorage.getItem('theme')) {
            return localStorage.getItem('theme');
        }
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    };

    const setTheme = (theme) => {
        if (theme === 'dark') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        localStorage.setItem('theme', theme);
        updateThemeIcons(theme);
    };

    const updateThemeIcons = (theme) => {
        const sunIcons = document.querySelectorAll('#theme-icon-sun, #theme-icon-sun-mobile');
        const moonIcons = document.querySelectorAll('#theme-icon-moon, #theme-icon-moon-mobile');

        if (theme === 'dark') {
            sunIcons.forEach(icon => icon.classList.remove('hidden'));
            moonIcons.forEach(icon => icon.classList.add('hidden'));
        } else {
            sunIcons.forEach(icon => icon.classList.add('hidden'));
            moonIcons.forEach(icon => icon.classList.remove('hidden'));
        }
    };

    // Initialize theme
    const currentTheme = getTheme();
    setTheme(currentTheme);

    // Theme toggle handlers
    const toggleButtons = document.querySelectorAll('#theme-toggle, #theme-toggle-mobile');
    toggleButtons.forEach(button => {
        button.addEventListener('click', () => {
            const newTheme = getTheme() === 'dark' ? 'light' : 'dark';
            setTheme(newTheme);
        });
    });
}

// Navigation
function initNavigation() {
    const nav = document.getElementById('navigation');
    const menuToggle = document.getElementById('menu-toggle');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    const closeIcon = document.getElementById('close-icon');
    const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
    let isMenuOpen = false;

    // Scroll handler for navigation background
    const handleScroll = () => {
        if (window.scrollY > 50) {
            nav.classList.add('bg-background/80', 'backdrop-blur-xl', 'shadow-sm');
            nav.classList.remove('bg-transparent');
        } else {
            nav.classList.remove('bg-background/80', 'backdrop-blur-xl', 'shadow-sm');
            nav.classList.add('bg-transparent');
        }

        // Update active section
        if (window.location.pathname === '/') {
            updateActiveSection();
        }
    };

    // Update active section based on scroll position
    const updateActiveSection = () => {
        const sections = ['home', 'about', 'experience', 'services', 'skills', 'projects', 'contact'];
        const scrollPosition = window.scrollY + window.innerHeight / 3;

        for (const sectionId of sections) {
            const element = document.getElementById(sectionId);
            if (element) {
                const { offsetTop, offsetHeight } = element;
                if (scrollPosition >= offsetTop && scrollPosition < offsetTop + offsetHeight) {
                    // Remove active from all links
                    document.querySelectorAll('.nav-link').forEach(link => {
                        link.classList.remove('text-primary', 'after:w-full');
                        link.classList.add('text-muted-foreground', 'after:w-0');
                    });
                    document.querySelectorAll('.mobile-nav-link').forEach(link => {
                        link.classList.remove('text-primary', 'scale-110');
                        link.classList.add('text-muted-foreground');
                    });

                    // Add active to current section links
                    document.querySelectorAll(`[data-section="${sectionId}"]`).forEach(link => {
                        link.classList.add('text-primary');
                        link.classList.remove('text-muted-foreground');
                        if (link.classList.contains('nav-link')) {
                            link.classList.add('after:w-full');
                            link.classList.remove('after:w-0');
                        } else if (link.classList.contains('mobile-nav-link')) {
                            link.classList.add('scale-110');
                        }
                    });
                    break;
                }
            }
        }
    };

    // Mobile menu toggle
    const toggleMenu = () => {
        isMenuOpen = !isMenuOpen;

        if (isMenuOpen) {
            mobileMenu.classList.remove('opacity-0', 'invisible');
            mobileMenu.classList.add('opacity-100', 'visible');
            document.getElementById('mobile-menu-content').classList.remove('-translate-y-8');
            document.getElementById('mobile-menu-content').classList.add('translate-y-0');
            menuIcon.classList.add('hidden');
            closeIcon.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        } else {
            mobileMenu.classList.add('opacity-0', 'invisible');
            mobileMenu.classList.remove('opacity-100', 'visible');
            document.getElementById('mobile-menu-content').classList.add('-translate-y-8');
            document.getElementById('mobile-menu-content').classList.remove('translate-y-0');
            menuIcon.classList.remove('hidden');
            closeIcon.classList.add('hidden');
            document.body.style.overflow = '';
        }
    };

    if (menuToggle) {
        menuToggle.addEventListener('click', toggleMenu);
    }

    // Close button inside mobile menu
    const mobileMenuClose = document.getElementById('mobile-menu-close');
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', toggleMenu);
    }

    // Close mobile menu when clicking on a link
    mobileNavLinks.forEach(link => {
        link.addEventListener('click', () => {
            if (isMenuOpen) {
                toggleMenu();
            }
        });
    });

    // Scroll event
    handleScroll();
    window.addEventListener('scroll', handleScroll);
}

// Hero Canvas Animation
function initHeroCanvas() {
    const canvas = document.getElementById('hero-canvas');
    if (!canvas) return;

    const ctx = canvas.getContext('2d');
    if (!ctx) return;

    canvas.width = canvas.offsetWidth;
    canvas.height = canvas.offsetHeight;

    const shapes = [];
    for (let i = 0; i < 60; i++) {
        shapes.push({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height,
            size: Math.random() * 4 + 2,
            vx: (Math.random() - 0.5) * 0.8,
            vy: (Math.random() - 0.5) * 0.8,
            opacity: Math.random() * 0.5 + 0.2,
            rotation: Math.random() * Math.PI * 2,
            rotationSpeed: (Math.random() - 0.5) * 0.02,
            type: ['circle', 'triangle', 'square'][Math.floor(Math.random() * 3)]
        });
    }

    function animate() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);

        shapes.forEach(shape => {
            shape.x += shape.vx;
            shape.y += shape.vy;
            shape.rotation += shape.rotationSpeed;

            if (shape.x < 0 || shape.x > canvas.width) shape.vx *= -1;
            if (shape.y < 0 || shape.y > canvas.height) shape.vy *= -1;

            ctx.save();
            ctx.translate(shape.x, shape.y);
            ctx.rotate(shape.rotation);
            ctx.fillStyle = `rgba(33, 132, 108, ${shape.opacity})`;

            if (shape.type === 'circle') {
                ctx.beginPath();
                ctx.arc(0, 0, shape.size, 0, Math.PI * 2);
                ctx.fill();
            } else if (shape.type === 'triangle') {
                ctx.beginPath();
                ctx.moveTo(0, -shape.size);
                ctx.lineTo(shape.size, shape.size);
                ctx.lineTo(-shape.size, shape.size);
                ctx.closePath();
                ctx.fill();
            } else if (shape.type === 'square') {
                ctx.fillRect(-shape.size, -shape.size, shape.size * 2, shape.size * 2);
            }

            ctx.restore();
        });

        requestAnimationFrame(animate);
    }

    animate();

    // Handle resize
    window.addEventListener('resize', () => {
        canvas.width = canvas.offsetWidth;
        canvas.height = canvas.offsetHeight;
    });
}

// Intersection Observer for animations
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.2,
        rootMargin: '0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.remove('translate-y-8', 'translate-y-12', '-translate-x-12', 'translate-x-12', 'opacity-0');
                entry.target.classList.add('translate-y-0', 'translate-x-0', 'opacity-100');
            }
        });
    }, observerOptions);

    // Observe all animated elements
    const animatedElements = document.querySelectorAll(
        '.stat-card, .timeline-item, .service-card, .skill-card, .project-card, .article-card, .contact-info, .contact-form'
    );

    animatedElements.forEach(el => observer.observe(el));
}

// Back to Top Button
function initBackToTop() {
    const backToTopButton = document.getElementById('back-to-top');
    if (!backToTopButton) return;

    // Show/hide button based on scroll position
    const handleScroll = () => {
        if (window.scrollY > 300) {
            backToTopButton.classList.remove('opacity-0', 'pointer-events-none');
            backToTopButton.classList.add('opacity-100', 'pointer-events-auto');
        } else {
            backToTopButton.classList.add('opacity-0', 'pointer-events-none');
            backToTopButton.classList.remove('opacity-100', 'pointer-events-auto');
        }
    };

    // Scroll to top smoothly when clicked
    backToTopButton.addEventListener('click', () => {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    });

    // Listen to scroll events
    window.addEventListener('scroll', handleScroll);
    handleScroll(); // Initial check
}

// Initialize everything when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    initTheme();
    initNavigation();
    initHeroCanvas();
    initScrollAnimations();
    initBackToTop();
});
