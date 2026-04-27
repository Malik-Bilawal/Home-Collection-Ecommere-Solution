@extends("user.layouts.master-layouts.plain")

@section("title", "Inhouse Textiles | Contact")
<meta name="csrf-token" content="{{ csrf_token() }}">
@push("style")
<style>
    :root {
        --primary-color: #111827;
        --primary-hover: #52041E;
        --secondary-color: #B89A6B;
        --secondary-hover: #967B52;
        --accent-color: #D6CEC3;
        --accent-hover: #C8BFB3;
        --text-on-primary: #FFFFFF;
        --text-on-secondary: #2A2A2A;
        --background-color: #FBF7EE;
        --surface-color: #FFFFFF;
        --border-color: #E2DBD1;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Cormorant Garamond', serif;
        background-color: var(--background-color);
        color: var(--text-on-secondary);
        overflow-x: hidden;
        letter-spacing: 0.5px;
    }

    /* Luxury Typography */
    .luxury-title {
        font-family: 'Cormorant Garamond', serif;
        font-weight: 300;
        letter-spacing: 1px;
    }

    .luxury-subtitle {
        font-family: 'Inter', sans-serif;
        font-weight: 300;
        letter-spacing: 2px;
        text-transform: uppercase;
    }

    .luxury-hero {
    position: relative;
    min-height: 100vh;

    /* Use CSS variables from :root for gradient overlay */
    background: linear-gradient(
                    rgba(104, 6, 38, 0.85),  /* --primary-color */
                    rgba(184, 154, 107, 0.9) /* --secondary-color */
                ),
                url('https://images.unsplash.com/photo-1616486338812-3dadae4b4ace?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
    background-size: cover;
    background-position: center;

    display: flex;
    align-items: center;
    overflow: hidden;
    clip-path: polygon(0 0, 100% 0, 100% 90%, 0 100%);

    /* Text color from theme */
    color: var(--text-on-primary);
}


    .hero-content {
        position: relative;
        z-index: 10;
        padding: 0 2rem;
    }

    .hero-title {
        font-size: 5.5rem;
        font-weight: 300;
        color: var(--text-on-primary);
        line-height: 1;
        margin-bottom: 2rem;
    }

    .hero-title span {
        color: var(--secondary-color);
        font-style: italic;
    }

    .hero-divider {
        width: 120px;
        height: 2px;
        background: var(--secondary-color);
        margin: 3rem 0;
    }

    .hero-subtitle {
        font-size: 1.2rem;
        color: rgba(255, 255, 255, 0.9);
        max-width: 600px;
        line-height: 1.8;
        font-weight: 300;
    }

    /* Luxury Form */
    .luxury-form-container {
        background: var(--surface-color);
        padding: 4rem;
        position: relative;
        isolation: isolate;
        border: 1px solid var(--border-color);
    }

    .form-background {
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, var(--background-color), #F0ECE8);
        opacity: 0.3;
        z-index: -1;
    }

    .form-title {
        font-size: 2.5rem;
        font-weight: 300;
        color: var(--primary-color);
        margin-bottom: 3rem;
        position: relative;
    }

    .form-title:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -10px;
        width: 60px;
        height: 1px;
        background: var(--secondary-color);
    }

    .luxury-input-group {
        position: relative;
        margin-bottom: 2.5rem;
    }

    .luxury-input {
        width: 100%;
        padding: 1.2rem 0;
        background: transparent;
        border: none;
        border-bottom: 1px solid var(--border-color);
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        color: var(--text-on-secondary);
        transition: all 0.3s ease;
    }

    .luxury-input:focus {
        outline: none;
        border-bottom-color: var(--accent-color);
    }

    .luxury-label {
        position: absolute;
        left: 0;
        top: 1.2rem;
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        color: var(--accent-color);
        pointer-events: none;
        transition: all 0.3s ease;
    }

    .luxury-input:focus + .luxury-label,
    .luxury-input:not(:placeholder-shown) + .luxury-label {
        top: -0.5rem;
        font-size: 0.85rem;
        color: var(--primary-color);
    }

    .luxury-textarea {
        min-height: 150px;
        resize: vertical;
    }

    .luxury-select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%238C5E3C' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: right 0.5rem center;
        background-size: 1.5em;
        padding-right: 2.5rem;
    }

    .luxury-checkbox {
        position: relative;
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .checkbox-input {
        display: none;
    }

    .checkbox-box {
        width: 20px;
        height: 20px;
        border: 1px solid var(--border-color);
        position: relative;
        transition: all 0.3s ease;
    }

    .checkbox-input:checked + .checkbox-box {
        background: var(--accent-color);
        border-color: var(--accent-color);
    }

    .checkbox-input:checked + .checkbox-box:after {
        content: '';
        position: absolute;
        left: 6px;
        top: 2px;
        width: 6px;
        height: 10px;
        border: solid white;
        border-width: 0 2px 2px 0;
        transform: rotate(45deg);
    }

    .checkbox-label {
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        color: var(--accent-color);
    }

    /* Luxury Button */
    .luxury-btn {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 1rem;
        padding: 1.2rem 3rem;
        background: var(--primary-color);
        color: var(--text-on-primary);
        border: 1px solid var(--primary-color);
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }

    .luxury-btn:hover {
        background: transparent;
        color: var(--primary-color);
    }

    .luxury-btn:before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: var(--surface-color);
        transition: left 0.4s ease;
        z-index: -1;
    }

    .luxury-btn:hover:before {
        left: 0;
    }

    .luxury-btn-outline {
        background: transparent;
        color: var(--primary-color);
        border-color: var(--primary-color);
    }

    .luxury-btn-outline:hover {
        background: var(--primary-color);
        color: var(--text-on-primary);
    }

    .luxury-btn-outline:hover:before {
        background: var(--primary-color);
    }

    /* Contact Cards */
    .luxury-contact-card {
        background: var(--surface-color);
        padding: 2.5rem;
        position: relative;
        transition: all 0.4s ease;
        border-bottom: 4px solid transparent;
        border: 1px solid var(--border-color);
    }

    .luxury-contact-card:hover {
        transform: translateY(-10px);
        border-bottom-color: var(--secondary-color);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.08);
    }

    .contact-icon {
        width: 60px;
        height: 60px;
        background: var(--background-color);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1.5rem;
        color: var(--primary-color);
        font-size: 1.5rem;
        border: 1px solid var(--border-color);
    }

    .contact-title {
        font-size: 1.2rem;
        font-weight: 500;
        color: var(--primary-color);
        margin-bottom: 0.5rem;
    }

    .contact-details {
        color: var(--accent-color);
        line-height: 1.8;
    }

    /* FAQ Section */
    .luxury-faq-section {
        background: linear-gradient(135deg, var(--primary-color), var(--accent-color));
        color: var(--text-on-primary);
        padding: 6rem 0;
        position: relative;
    }

    .faq-title {
        font-size: 3rem;
        font-weight: 300;
        color: var(--text-on-primary);
        margin-bottom: 3rem;
        text-align: center;
    }

    .faq-item {
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        padding: 2rem 0;
        cursor: pointer;
    }

    .faq-question {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 1.1rem;
        font-weight: 400;
        color: var(--text-on-primary);
    }

    .faq-icon {
        color: var(--secondary-color);
        transition: transform 0.3s ease;
    }

    .faq-item.active .faq-icon {
        transform: rotate(45deg);
    }

    .faq-answer {
        max-height: 0;
        overflow: hidden;
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.8;
        transition: max-height 0.5s ease;
    }

    .faq-item.active .faq-answer {
        max-height: 300px;
        margin-top: 1.5rem;
    }

    /* Map Section */
    .luxury-map-section {
    position: relative;
    height: 500px;
    overflow: hidden;
}

.map-overlay {
    position: absolute;
    inset: 0;

    /* Use theme colors with adjusted opacity */
    background: linear-gradient(
        rgba(var(--primary-color-rgb), 0.4),   /* --primary-color with 40% opacity */
        rgba(var(--secondary-color-rgb), 0.6)  /* --secondary-color with 60% opacity */
    );

    z-index: 1;
    pointer-events: none;
}


    .map-content {
        position: absolute;
        bottom: 3rem;
        left: 3rem;
        z-index: 2;
        color: var(--text-on-primary);
    }

    .map-title {
        font-size: 2.5rem;
        font-weight: 300;
        margin-bottom: 1rem;
    }

    /* Footer */
    .luxury-footer {
        background: var(--primary-color);
        color: var(--text-on-primary);
        padding: 4rem 0 2rem;
    }

    .footer-logo {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2rem;
        font-weight: 300;
        color: var(--text-on-primary);
        margin-bottom: 2rem;
    }

    .footer-divider {
        width: 100%;
        height: 1px;
        background: rgba(255, 255, 255, 0.1);
        margin: 3rem 0;
    }

    .social-links {
        display: flex;
        gap: 1rem;
    }

    .social-link {
        width: 40px;
        height: 40px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--text-on-primary);
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .social-link:hover {
        border-color: var(--secondary-color);
        color: var(--secondary-color);
        transform: translateY(-3px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 3rem;
        }
        
        .luxury-form-container {
            padding: 2rem;
        }
        
        .form-title {
            font-size: 2rem;
        }
        
        .luxury-btn {
            padding: 1rem 2rem;
        }
        
        .map-content {
            left: 1.5rem;
            bottom: 1.5rem;
        }
        
        .map-title {
            font-size: 1.8rem;
        }
    }

    /* Animations */
    .fade-in {
        opacity: 0;
        transform: translateY(30px);
        transition: all 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .fade-in.visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* Scroll Indicator */
    .scroll-indicator {
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        color: rgba(255, 255, 255, 0.7);
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translate(-50%, 0); }
        40% { transform: translate(-50%, -10px); }
        60% { transform: translate(-50%, -5px); }
    }

    /* Accent Elements */
    .accent-line {
        width: 60px;
        height: 1px;
        background: var(--secondary-color);
        margin: 2rem 0;
    }

    .accent-text {
        color: var(--secondary-color);
    }

    /* Floating Elements */
    .floating-element {
        position: absolute;
        border: 1px solid rgba(200, 161, 101, 0.1);
        pointer-events: none;
    }

    .element-1 {
        width: 200px;
        height: 200px;
        top: 20%;
        right: 10%;
        border-radius: 50%;
        animation: float 20s infinite linear;
    }

    .element-2 {
        width: 300px;
        height: 300px;
        bottom: 15%;
        left: 5%;
        border-radius: 40% 60% 60% 40%;
        animation: float 25s infinite linear reverse;
    }

    @keyframes float {
        0% { transform: translate(0, 0) rotate(0deg); }
        100% { transform: translate(50px, 50px) rotate(360deg); }
    }
</style>

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<!-- GSAP -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js"></script>
@endpush

@section("content")
<!-- Luxury Hero Section -->
<section class="luxury-hero">
    <div class="container mx-auto px-4">
        <div class="hero-content max-w-4xl">
            <h1 class="hero-title luxury-title">
                Connect With<br>
                <span>Our Team</span>
            </h1>
            <div class="hero-divider"></div>
            <p class="hero-subtitle luxury-subtitle">
                Experience exceptional service and personalized attention. 
                Our dedicated team is ready to assist you with all your home collection needs.
            </p>
        </div>
    </div>
    
    <!-- Floating Elements -->
    <div class="floating-element element-1"></div>
    <div class="floating-element element-2"></div>
    
    <!-- Scroll Indicator -->
    <div class="scroll-indicator">
        <i class="fas fa-chevron-down text-2xl"></i>
    </div>
</section>

<!-- Contact Form & Info -->
<section class="py-20" style="background-color: var(--background-color);">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Luxury Contact Form -->
            <div class="luxury-form-container">
                <div class="form-background"></div>
                <h2 class="form-title luxury-title">Send Us a Message</h2>
                
                <form action="{{ route('contact.store') }}" method="POST" id="luxury-contact-form" class="space-y-4">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="luxury-input-group">
                            <input type="text" name="first_name" id="first-name" class="luxury-input" placeholder=" " required>
                            <label for="first-name" class="luxury-label">First Name</label>
                        </div>
                        <div class="luxury-input-group">
                            <input type="text" name="last_name" id="last-name" class="luxury-input" placeholder=" ">
                            <label for="last-name" class="luxury-label">Last Name</label>
                        </div>
                    </div>
                    
                    <div class="luxury-input-group">
                        <input type="email" name="email" id="email" class="luxury-input" placeholder=" " required>
                        <label for="email" class="luxury-label">Email Address</label>
                    </div>
                    
                    <div class="luxury-input-group">
                        <input type="tel" name="phone" id="phone" class="luxury-input" placeholder=" ">
                        <label for="phone" class="luxury-label">Phone Number</label>
                    </div>
                    
                    <div class="luxury-input-group">
                        <select name="subject" id="subject" class="luxury-input luxury-select" required>
                            <option value="" selected disabled>Select a subject</option>
                            <option value="product-inquiry">Product Inquiry</option>
                            <option value="custom-order">Custom Order</option>
                            <option value="collaboration">Collaboration</option>
                            <option value="press">Press & Media</option>
                            <option value="other">Other</option>
                        </select>
                        <label for="subject" class="luxury-label">Subject</label>
                    </div>
                    
                    <div class="luxury-input-group">
                        <textarea name="message" id="message" class="luxury-input luxury-textarea" placeholder=" " required></textarea>
                        <label for="message" class="luxury-label">Your Message</label>
                    </div>
                    
                    <div class="luxury-checkbox">
                        <input type="checkbox" id="newsletter" name="newsletter" class="checkbox-input">
                        <span class="checkbox-box"></span>
                        <label for="newsletter" class="checkbox-label">
                            Subscribe to our newsletter for curated collections and exclusive offers
                        </label>
                    </div>
                    
                    <button type="submit" class="luxury-btn">
                        <span>Send Message</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
            
            <!-- Contact Information -->
            <div class="space-y-8">
                <div class="text-center mb-12">
                    <h2 class="text-4xl font-light luxury-title mb-4" style="color: var(--primary-color);">Contact Information</h2>
                    <div class="accent-line mx-auto"></div>
                    <p class="text-gray-600">
                        Our team is available to provide personalized guidance and exceptional service.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Contact Card 1 -->
                    <div class="luxury-contact-card fade-in">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <h3 class="contact-title">Visit Our Store</h3>
                        <div class="contact-details">
                            <p>Your Inhouse Textiles Address</p>
                            <p>Design District</p>
                            <p>Karachi, Pakistan</p>
                            <p class="mt-2"><strong>Hours:</strong> Mon-Sat 10AM-7PM</p>
                        </div>
                    </div>
                    
                    <!-- Contact Card 2 -->
                    <div class="luxury-contact-card fade-in" style="transition-delay: 0.1s">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <h3 class="contact-title">Call Us</h3>
                        <div class="contact-details">
                            <p>+92 300 1234567</p>
                            <p class="mt-2"><strong>Customer Service:</strong> +92 300 7654321</p>
                            <p><strong>Hours:</strong> 9AM-6PM PST</p>
                        </div>
                    </div>
                    
                    <!-- Contact Card 3 -->
                    <div class="luxury-contact-card fade-in" style="transition-delay: 0.2s">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <h3 class="contact-title">Email Us</h3>
                        <div class="contact-details">
                            <p>info@homecollection.com</p>
                            <p>support@homecollection.com</p>
                            <p class="mt-2"><strong>Response Time:</strong> Within 24 hours</p>
                        </div>
                    </div>
                    
                    <!-- Contact Card 4 -->
                    <div class="luxury-contact-card fade-in" style="transition-delay: 0.3s">
                        <div class="contact-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <h3 class="contact-title">Schedule Appointment</h3>
                        <div class="contact-details">
                            <p>Schedule a private consultation</p>
                            <p class="mt-2"><strong>Available by appointment</strong></p>
                            <a href="#" class="text-[var(--secondary-color)] hover:underline mt-2 inline-block">
                                Book consultation →
                            </a>
                        </div>
                    </div>
                </div>
                
                <!-- Social Media -->
                <div class="mt-12">
                    <h3 class="text-xl font-light luxury-title mb-6" style="color: var(--primary-color);">Follow Us</h3>
                    <div class="social-links">
                        <a href="#" class="social-link" style="background: var(--primary-color);">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="social-link" style="background: var(--primary-color);">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="social-link" style="background: var(--primary-color);">
                            <i class="fab fa-pinterest"></i>
                        </a>
                        <a href="#" class="social-link" style="background: var(--primary-color);">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="luxury-faq-section">
    <div class="container mx-auto px-4">
        <h2 class="faq-title luxury-title">Frequently Asked Questions</h2>
        
        <div class="max-w-3xl mx-auto">
            <!-- FAQ Item 1 -->
            <div class="faq-item" onclick="toggleFAQ(this)">
                <div class="faq-question">
                    <span>Do you offer custom orders?</span>
                    <i class="fas fa-plus faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>Yes, we offer custom order services for discerning clients. 
                    Our skilled artisans can create custom pieces tailored to your specific 
                    requirements, from fabric selection to unique design elements. 
                    Contact our custom order department for a consultation.</p>
                </div>
            </div>
            
            <!-- FAQ Item 2 -->
            <div class="faq-item" onclick="toggleFAQ(this)">
                <div class="faq-question">
                    <span>What is your delivery process?</span>
                    <i class="fas fa-plus faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>We provide premium delivery service for all our items. 
                    Each piece is carefully packaged and delivered with care. 
                    Delivery timelines vary based on customization and location, 
                    typically 2-4 weeks for standard pieces.</p>
                </div>
            </div>
            
            <!-- FAQ Item 3 -->
            <div class="faq-item" onclick="toggleFAQ(this)">
                <div class="faq-question">
                    <span>Do you provide nationwide shipping?</span>
                    <i class="fas fa-plus faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>Yes, we ship throughout Pakistan with full tracking and insurance. 
                    We offer express delivery options for major cities. 
                    Our logistics team ensures safe and timely delivery of all products.</p>
                </div>
            </div>
            
            <!-- FAQ Item 4 -->
            <div class="faq-item" onclick="toggleFAQ(this)">
                <div class="faq-question">
                    <span>What is your return policy?</span>
                    <i class="fas fa-plus faq-icon"></i>
                </div>
                <div class="faq-answer">
                    <p>We accept returns within 7 days of delivery for items in original 
                    condition. Custom and bespoke pieces are final sale. Returns are 
                    processed within 3-5 business days. Our team will guide you through 
                    the return process.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="luxury-map-section">
    <iframe 
        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3620.548612293214!2d67.02885817534243!3d24.851615545807127!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3eb33e5da5f1cae1%3A0x9b727d5c6b5e7c0e!2sKarachi%2C%20Pakistan!5e0!3m2!1sen!2sus!4v1629990000000!5m2!1sen!2sus" 
        width="100%" 
        height="100%" 
        style="border:0;" 
        allowfullscreen="" 
        loading="lazy"
        referrerpolicy="no-referrer-when-downgrade">
    </iframe>
    
    <div class="map-overlay"></div>
    
    <div class="map-content">
        <h3 class="map-title luxury-title">Visit Our Showroom</h3>
        <p class="text-white/80 mb-4">Experience our collections in person at our flagship showroom</p>
        <a href="#" class="luxury-btn luxury-btn-outline">
            <span>Get Directions</span>
            <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</section>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/gsap.min.js" integrity="sha512-lzTRe5slJYRCf0aXolSlYy/n7ExkWQ7/yA6xyt4gDN7M6q6nCicGmcKXnAk6xexKv0Bge7u0F92qolx/2Vf83A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.13.0/ScrollTrigger.min.js" integrity="sha512-2y6c/3VLCjK/Xg3/BV6zWgxQeHn+u5c6YF6iH+VfBBHx1CO2uJiwf/0k5rFRkYhYk47wGh6wXqxxz1VrHDNTLw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@endsection

@push("script")
<script>
    gsap.registerPlugin(ScrollTrigger);

    gsap.from(".hero-title", {
        duration: 1.5,
        y: 50,
        opacity: 0,
        ease: "power3.out"
    });

    gsap.from(".hero-subtitle", {
        duration: 1.5,
        y: 30,
        opacity: 0,
        delay: 0.5,
        ease: "power3.out"
    });

    gsap.utils.toArray('.fade-in').forEach((el, i) => {
        gsap.from(el, {
            scrollTrigger: {
                trigger: el,
                start: "top 80%",
                end: "bottom 20%",
                toggleActions: "play none none none"
            },
            y: 30,
            opacity: 0,
            duration: 1,
            delay: i * 0.1,
            ease: "power3.out"
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('luxury-contact-form');
        
        if (form) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const submitBtn = form.querySelector('button[type="submit"]');
                const originalText = submitBtn.innerHTML;
                
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Sending...';
                submitBtn.disabled = true;
                
                const formData = new FormData(form);
                
                fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Message Sent',
                        text: 'Thank you for your inquiry. Our team will contact you shortly.',
                        confirmButtonColor: '#6B4226',
                        background: '#F8F5F2',
                        customClass: {
                            title: 'font-serif text-2xl',
                            confirmButton: 'px-6 py-3'
                        }
                    });
                    
                    form.reset();
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'There was an error sending your message. Please try again.',
                        confirmButtonColor: '#6B4226',
                        background: '#F8F5F2'
                    });
                })
                .finally(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                });
            });
        }
        
        window.toggleFAQ = function(element) {
            const isActive = element.classList.contains('active');
            
            document.querySelectorAll('.faq-item').forEach(item => {
                item.classList.remove('active');
            });
            
            if (!isActive) {
                element.classList.add('active');
            }
        };
        
        document.querySelectorAll('.luxury-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (this.value === '') {
                    this.parentElement.classList.remove('focused');
                }
            });
            
            if (input.value !== '') {
                input.parentElement.classList.add('focused');
            }
        });
        
        document.querySelectorAll('.checkbox-input').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const box = this.nextElementSibling;
                if (this.checked) {
                    gsap.to(box, {
                        scale: 1.1,
                        duration: 0.2,
                        yoyo: true,
                        repeat: 1
                    });
                }
            });
        });
        
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') return;
                
                e.preventDefault();
                const target = document.querySelector(href);
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 100,
                        behavior: 'smooth'
                    });
                }
            });
        });
    });

    gsap.to(".luxury-hero", {
        backgroundPosition: "50% 100%",
        ease: "none",
        scrollTrigger: {
            trigger: ".luxury-hero",
            start: "top top",
            end: "bottom top",
            scrub: true
        }
    });

    gsap.utils.toArray('.luxury-contact-card').forEach((card, i) => {
        card.addEventListener('mouseenter', () => {
            gsap.to(card, {
                y: -10,
                duration: 0.4,
                ease: "power2.out"
            });
        });
        
        card.addEventListener('mouseleave', () => {
            gsap.to(card, {
                y: 0,
                duration: 0.4,
                ease: "power2.out"
            });
        });
    });
</script>

<!-- SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush