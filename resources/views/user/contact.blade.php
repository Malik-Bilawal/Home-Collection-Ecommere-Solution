@extends("user.layouts.master-layouts.plain")

@section("title", "Footwear Premium | Contact")
<meta name="csrf-token" content="{{ csrf_token() }}">

@push("style")
<style>
    :root {
        --primary-color: #111827;
        --accent-color: #10b981;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-15px); }
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }
</style>
@endpush

@section("content")

<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center bg-[var(--primary-color)] overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-[0.05]" 
         style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%2310b981\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
    
    <!-- Floating Elements -->
    <div class="absolute top-20 right-10 w-20 h-20 rounded-full bg-emerald-500/10 animate-float"></div>
    <div class="absolute bottom-20 left-10 w-16 h-16 rounded-full bg-emerald-500/10 animate-float" style="animation-delay: -2s"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="max-w-2xl text-center mx-auto">
            <span class="text-xs font-bold text-emerald-400 uppercase tracking-[0.3em]">Get In Touch</span>
            <h1 class="text-5xl md:text-6xl font-serif font-bold text-white mt-4 mb-6">Contact Us</h1>
            <p class="text-lg text-white/70 leading-relaxed">
                Have a question or need assistance? We're here to help. Reach out to us through any of the channels below.
            </p>
        </div>
    </div>
</section>

<!-- Contact Info Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Phone -->
            <div class="text-center p-8 rounded-2xl border border-gray-100 hover:border-emerald-500/30 hover:shadow-lg transition-all duration-300">
                <div class="w-16 h-16 mx-auto rounded-full bg-emerald-100 flex items-center justify-center mb-4">
                    <i class="fas fa-phone text-2xl text-emerald-600"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Phone</h3>
                <p class="text-gray-600 text-sm mb-2">Mon-Sat: 9AM - 9PM</p>
                <a href="tel:+923001234567" class="text-emerald-600 font-medium">+92 300 1234567</a>
            </div>

            <!-- Email -->
            <div class="text-center p-8 rounded-2xl border border-gray-100 hover:border-emerald-500/30 hover:shadow-lg transition-all duration-300">
                <div class="w-16 h-16 mx-auto rounded-full bg-emerald-100 flex items-center justify-center mb-4">
                    <i class="fas fa-envelope text-2xl text-emerald-600"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Email</h3>
                <p class="text-gray-600 text-sm mb-2">We reply within 24 hours</p>
                <a href="mailto:info@footwear.com" class="text-emerald-600 font-medium">info@footwear.com</a>
            </div>

            <!-- Address -->
            <div class="text-center p-8 rounded-2xl border border-gray-100 hover:border-emerald-500/30 hover:shadow-lg transition-all duration-300">
                <div class="w-16 h-16 mx-auto rounded-full bg-emerald-100 flex items-center justify-center mb-4">
                    <i class="fas fa-map-marker-alt text-2xl text-emerald-600"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Address</h3>
                <p class="text-gray-600 text-sm">123 Shoe Market<br>Lahore, Pakistan</p>
            </div>

            <!-- Live Chat -->
            <div class="text-center p-8 rounded-2xl border border-gray-100 hover:border-emerald-500/30 hover:shadow-lg transition-all duration-300">
                <div class="w-16 h-16 mx-auto rounded-full bg-emerald-100 flex items-center justify-center mb-4">
                    <i class="fas fa-comments text-2xl text-emerald-600"></i>
                </div>
                <h3 class="font-semibold text-gray-900 mb-2">Live Chat</h3>
                <p class="text-gray-600 text-sm mb-2">Available 24/7</p>
                <button class="text-emerald-600 font-medium">Start Chat</button>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-start">
            
            <!-- Form -->
            <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-100">
                <div class="mb-8">
                    <span class="text-xs font-bold text-emerald-600 uppercase tracking-[0.3em]">Send Us A Message</span>
                    <h2 class="text-3xl font-serif font-bold text-gray-900 mt-2">Get In Touch</h2>
                    <p class="text-gray-600 mt-2">Fill out the form below and we'll get back to you as soon as possible.</p>
                </div>

                <form id="contact-form" class="space-y-6">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">First Name *</label>
                            <input type="text" name="first_name" required 
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all"
                                   placeholder="John">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Last Name *</label>
                            <input type="text" name="last_name" required 
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all"
                                   placeholder="Doe">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                            <input type="email" name="email" required 
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all"
                                   placeholder="john@example.com">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Phone</label>
                            <input type="tel" name="phone" 
                                   class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all"
                                   placeholder="+92 300 1234567">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Subject *</label>
                        <select name="subject" required 
                                class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all">
                            <option value="">Select a subject</option>
                            <option value="order">Order Inquiry</option>
                            <option value="product">Product Question</option>
                            <option value="return">Returns & Exchanges</option>
                            <option value="support">Technical Support</option>
                            <option value="feedback">Feedback</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Message *</label>
                        <textarea name="message" rows="5" required 
                                  class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-500/20 outline-none transition-all resize-none"
                                  placeholder="How can we help you?"></textarea>
                    </div>

                    <button type="submit" 
                            class="w-full py-4 bg-gray-900 text-white font-semibold rounded-xl hover:bg-emerald-600 transition-all duration-300 flex items-center justify-center gap-3">
                        <i class="fas fa-paper-plane"></i>
                        Send Message
                    </button>
                </form>
            </div>

            <!-- Map & Additional Info -->
            <div class="space-y-8">
                <!-- Map Placeholder -->
                <div class="rounded-2xl overflow-hidden h-64 bg-gray-200 relative">
                    <iframe 
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3402.563564383662!2d74.30950931514148!3d31.520369981359186!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3919048c63d4d93b%3A0xad1b6f0e0c6e4c4d!2sLahore%2C%20Punjab%2C%20Pakistan!5e0!3m2!1sen!2s!4v1620000000000!5m2!1sen!2s"
                        width="100%" 
                        height="100%" 
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                </div>

                <!-- Business Hours -->
                <div class="bg-white p-8 rounded-2xl border border-gray-100">
                    <h3 class="text-xl font-serif font-bold text-gray-900 mb-6">Business Hours</h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                            <span class="text-gray-600">Monday - Friday</span>
                            <span class="font-medium text-gray-900">9:00 AM - 9:00 PM</span>
                        </div>
                        <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                            <span class="text-gray-600">Saturday</span>
                            <span class="font-medium text-gray-900">10:00 AM - 8:00 PM</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-600">Sunday</span>
                            <span class="font-medium text-gray-900">12:00 PM - 6:00 PM</span>
                        </div>
                    </div>
                </div>

                <!-- Social Links -->
                <div class="bg-white p-8 rounded-2xl border border-gray-100">
                    <h3 class="text-xl font-serif font-bold text-gray-900 mb-6">Follow Us</h3>
                    <div class="flex gap-4">
                        <a href="#" class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-emerald-500 hover:text-white transition-all">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-emerald-500 hover:text-white transition-all">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-emerald-500 hover:text-white transition-all">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-12 h-12 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-emerald-500 hover:text-white transition-all">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <span class="text-xs font-bold text-emerald-600 uppercase tracking-[0.3em]">Need Help?</span>
            <h2 class="text-4xl md:text-5xl font-serif font-bold text-gray-900 mt-3">Frequently Asked Questions</h2>
        </div>

        <div class="max-w-3xl mx-auto space-y-4">
            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button class="w-full flex items-center justify-between p-6 text-left hover:bg-gray-50 transition-colors faq-btn">
                    <span class="font-medium text-gray-900">What are your shipping options?</span>
                    <i class="fas fa-chevron-down text-emerald-500 transition-transform"></i>
                </button>
                <div class="px-6 pb-6 text-gray-600 hidden">
                    We offer free shipping on orders over Rs.5000. Standard delivery takes 3-5 business days. Express delivery is available for an additional fee.
                </div>
            </div>

            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button class="w-full flex items-center justify-between p-6 text-left hover:bg-gray-50 transition-colors faq-btn">
                    <span class="font-medium text-gray-900">How can I return a product?</span>
                    <i class="fas fa-chevron-down text-emerald-500 transition-transform"></i>
                </button>
                <div class="px-6 pb-6 text-gray-600 hidden">
                    We offer a 30-day return policy. Please ensure the product is unused and in original packaging. Contact our support team to initiate a return.
                </div>
            </div>

            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button class="w-full flex items-center justify-between p-6 text-left hover:bg-gray-50 transition-colors faq-btn">
                    <span class="font-medium text-gray-900">Do you offer size exchanges?</span>
                    <i class="fas fa-chevron-down text-emerald-500 transition-transform"></i>
                </button>
                <div class="px-6 pb-6 text-gray-600 hidden">
                    Yes, we offer free size exchanges within 30 days of purchase. Simply contact us with your order details and preferred size.
                </div>
            </div>

            <div class="border border-gray-200 rounded-xl overflow-hidden">
                <button class="w-full flex items-center justify-between p-6 text-left hover:bg-gray-50 transition-colors faq-btn">
                    <span class="font-medium text-gray-900">How can I track my order?</span>
                    <i class="fas fa-chevron-down text-emerald-500 transition-transform"></i>
                </button>
                <div class="px-6 pb-6 text-gray-600 hidden">
                    Once your order is shipped, you'll receive a tracking number via email. You can also track your order through our website using the order ID.
                </div>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // FAQ Toggle
    const faqBtns = document.querySelectorAll('.faq-btn');
    faqBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const icon = this.querySelector('i');
            
            content.classList.toggle('hidden');
            icon.classList.toggle('rotate-180');
        });
    });

    // Form Submit
    const form = document.getElementById('contact-form');
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(this);
        
        fetch('{{ route("contact.store") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                alert('Thank you for your message! We will get back to you soon.');
                this.reset();
            } else {
                alert('Something went wrong. Please try again.');
            }
        })
        .catch(error => {
            alert('Thank you for your message! We will get back to you soon.');
            this.reset();
        });
    });
});
</script>

@endsection