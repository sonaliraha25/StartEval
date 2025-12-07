
document.addEventListener('DOMContentLoaded', function() {
    // Initialize all interactive components
    initializeSearch();
    initializeFavorites();
    initializeAnimations();
    initializeFilters();
    initializeNotifications();
    initializeStartupCards();
});

// Search functionality
function initializeSearch() {
    const searchInput = document.querySelector('.search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function(e) {
            const query = e.target.value.toLowerCase();
            const startupCards = document.querySelectorAll('.startup-card');
            
            startupCards.forEach(card => {
                const title = card.querySelector('h5').textContent.toLowerCase();
                const description = card.querySelector('.description').textContent.toLowerCase();
                const category = card.querySelector('.category').textContent.toLowerCase();
                
                if (title.includes(query) || description.includes(query) || category.includes(query)) {
                    card.style.display = 'block';
                    card.style.opacity = '1';
                } else {
                    card.style.opacity = '0.3';
                }
            });
        });
    }
}

// Favorite functionality
function initializeFavorites() {
    const favoriteButtons = document.querySelectorAll('.favorite-btn');
    
    favoriteButtons.forEach(btn => {
        btn.addEventListener('click', function(e) {
            e.stopPropagation();
            const icon = this.querySelector('i');
            
            if (icon.classList.contains('far')) {
                icon.classList.remove('far');
                icon.classList.add('fas');
                this.style.background = '#EF4444';
                this.style.color = 'white';
                this.style.borderColor = '#EF4444';
                showToast('Added to favorites!', 'success');
            } else {
                icon.classList.remove('fas');
                icon.classList.add('far');
                this.style.background = 'var(--surface-color)';
                this.style.color = 'var(--text-muted)';
                this.style.borderColor = 'var(--border-color)';
                showToast('Removed from favorites!', 'info');
            }
        });
    });
}

// Smooth animations
function initializeAnimations() {
    // Animate elements on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    }, observerOptions);
    
    // Observe startup cards and stat cards
    document.querySelectorAll('.startup-card, .stat-card').forEach(el => {
        observer.observe(el);
    });
    
    // Hero section animation
    const heroTitle = document.querySelector('.hero-title');
    const heroSubtitle = document.querySelector('.hero-subtitle');
    const heroActions = document.querySelector('.hero-actions');
    
    if (heroTitle) {
        setTimeout(() => heroTitle.classList.add('animate-slide-in-left'), 100);
        setTimeout(() => heroSubtitle.classList.add('animate-fade-in-up'), 300);
        setTimeout(() => heroActions.classList.add('animate-fade-in-up'), 500);
    }
}

// Filter functionality
function initializeFilters() {
    const filterSelects = document.querySelectorAll('.filters-section select');
    const applyButton = document.querySelector('.filters-section .btn-primary');
    
    if (applyButton) {
        applyButton.addEventListener('click', function() {
            const industry = filterSelects[0]?.value;
            const revenue = filterSelects[1]?.value;
            const location = filterSelects[2]?.value;
            
            // Simulate filtering
            showToast(`Filters applied: ${industry}, ${revenue}, ${location}`, 'info');
            
            // Add loading state
            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Applying...';
            this.disabled = true;
            
            setTimeout(() => {
                this.innerHTML = '<i class="fas fa-filter me-2"></i>Apply Filters';
                this.disabled = false;
            }, 2000);
        });
    }
}

// Notification functionality
function initializeNotifications() {
    const notificationBell = document.querySelector('.notification-bell');
    
    if (notificationBell) {
        notificationBell.addEventListener('click', function() {
            showToast('Notifications panel would open here', 'info');
            
            // Animate the bell
            this.style.transform = 'scale(0.9)';
            setTimeout(() => {
                this.style.transform = 'scale(1)';
            }, 150);
        });
    }
}

// Startup card interactions
function initializeStartupCards() {
    const startupCards = document.querySelectorAll('.startup-card');
    
    startupCards.forEach(card => {
        // View Details button
        const viewDetailsBtn = card.querySelector('.btn-primary');
        if (viewDetailsBtn) {
            viewDetailsBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                const startupName = card.querySelector('h5').textContent;
                showToast(`Opening details for ${startupName}`, 'info');
                
                // Simulate navigation
                setTimeout(() => {
                    window.location.href = 'startup-detail.html';
                }, 1000);
            });
        }
        
        // Contact button
        const contactBtn = card.querySelector('.btn-outline-primary');
        if (contactBtn) {
            contactBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                const startupName = card.querySelector('h5').textContent;
                showToast(`Contacting ${startupName}...`, 'success');
            });
        }
        
        // Card hover effects
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-8px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });
}

// Toast notification system
function showToast(message, type = 'info') {
    // Remove existing toasts
    const existingToasts = document.querySelectorAll('.toast-notification');
    existingToasts.forEach(toast => toast.remove());
    
    // Create toast element
    const toast = document.createElement('div');
    toast.className = `toast-notification toast-${type}`;
    toast.innerHTML = `
        <div class="toast-content">
            <i class="fas fa-${getToastIcon(type)}"></i>
            <span>${message}</span>
        </div>
        <button class="toast-close">
            <i class="fas fa-times"></i>
        </button>
    `;
    
    // Add styles
    toast.style.cssText = `
        position: fixed;
        top: 100px;
        right: 20px;
        background: white;
        border-radius: 12px;
        padding: 1rem 1.5rem;
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        border-left: 4px solid var(--${type === 'success' ? 'success' : type === 'error' ? 'danger' : 'primary'}-color);
        z-index: 1000;
        display: flex;
        align-items: center;
        gap: 1rem;
        min-width: 300px;
        transform: translateX(100%);
        transition: transform 0.3s ease;
    `;
    
    // Add to page
    document.body.appendChild(toast);
    
    // Animate in
    setTimeout(() => {
        toast.style.transform = 'translateX(0)';
    }, 100);
    
    // Close button
    const closeBtn = toast.querySelector('.toast-close');
    closeBtn.addEventListener('click', () => {
        toast.style.transform = 'translateX(100%)';
        setTimeout(() => toast.remove(), 300);
    });
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        if (toast.parentNode) {
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => toast.remove(), 300);
        }
    }, 5000);
}

function getToastIcon(type) {
    switch (type) {
        case 'success': return 'check-circle';
        case 'error': return 'exclamation-circle';
        case 'warning': return 'exclamation-triangle';
        default: return 'info-circle';
    }
}

// Smooth scrolling for navigation links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add loading states to buttons
document.querySelectorAll('.btn').forEach(btn => {
    btn.addEventListener('click', function() {
        if (!this.classList.contains('btn-primary') || this.textContent.includes('Apply')) {
            return; // Skip for specific buttons
        }
        
        const originalText = this.innerHTML;
        this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
        this.disabled = true;
        
        setTimeout(() => {
            this.innerHTML = originalText;
            this.disabled = false;
        }, 2000);
    });
});

// Add parallax effect to hero section
window.addEventListener('scroll', function() {
    const scrolled = window.pageYOffset;
    const heroSection = document.querySelector('.hero-section');
    
    if (heroSection) {
        const rate = scrolled * -0.5;
        heroSection.style.transform = `translateY(${rate}px)`;
    }
});

// Add keyboard navigation
document.addEventListener('keydown', function(e) {
    // Ctrl/Cmd + K for search focus
    if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
        e.preventDefault();
        const searchInput = document.querySelector('.search-input');
        if (searchInput) {
            searchInput.focus();
        }
    }
    
    // Escape to close any open modals or clear search
    if (e.key === 'Escape') {
        const searchInput = document.querySelector('.search-input');
        if (searchInput && document.activeElement === searchInput) {
            searchInput.value = '';
            searchInput.blur();
        }
    }
});

// Add search input focus styles
const searchInput = document.querySelector('.search-input');
if (searchInput) {
    searchInput.addEventListener('focus', function() {
        this.parentElement.style.transform = 'scale(1.05)';
    });
    
    searchInput.addEventListener('blur', function() {
        this.parentElement.style.transform = 'scale(1)';
    });
}

console.log('StartEval - Modern UI initialized successfully! 🚀');
