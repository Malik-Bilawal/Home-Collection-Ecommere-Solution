@extends('user.layouts.master-layouts.plain');
<title>INHOME TEXTILES</title>
@section('content')

    <style>
        :root {
            --primary-color: #680626;
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
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--background-color);
        }
        
        .policy-section {
            scroll-margin-top: 120px;
        }
        
        .active-policy {
            background-color: rgba(107, 66, 38, 0.1);
            border-left: 4px solid var(--primary-color);
        }
    </style>
  

    <!-- Hero Section -->
    <section class="py-12 px-4" style="background-color: rgba(200, 161, 101, 0.1);">
        <div class="container mx-auto">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4" style="color: var(--primary-color);">INHOUSE TEXTILES Policies</h1>
                <p class="text-lg md:text-xl max-w-3xl mx-auto">Your trusted partner for premium bed sheets and textiles. Learn about our policies to ensure a seamless shopping experience.</p>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-12">
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Sidebar Navigation -->
            <div class="lg:w-1/4">
                <div class="sticky top-32 bg-white rounded-lg shadow-md p-6 border" style="border-color: var(--border-color);">
                    <h2 class="text-xl font-bold mb-6 pb-4 border-b" style="color: var(--primary-color); border-color: var(--border-color);">Policy Sections</h2>
                    <nav class="space-y-2">
                        <a href="#shipping" class="block py-3 px-4 rounded-md hover:bg-gray-50 transition policy-nav active-policy" style="border-left: 4px solid var(--primary-color);">
                            <div class="flex items-center">
                                <i class="fas fa-shipping-fast mr-3" style="color: var(--accent-color);"></i>
                                <span class="font-medium">Shipping Policy</span>
                            </div>
                        </a>
                        <a href="#privacy" class="block py-3 px-4 rounded-md hover:bg-gray-50 transition policy-nav">
                            <div class="flex items-center">
                                <i class="fas fa-shield-alt mr-3" style="color: var(--accent-color);"></i>
                                <span class="font-medium">Privacy Policy</span>
                            </div>
                        </a>
                        <a href="#warranty" class="block py-3 px-4 rounded-md hover:bg-gray-50 transition policy-nav">
                            <div class="flex items-center">
                                <i class="fas fa-certificate mr-3" style="color: var(--accent-color);"></i>
                                <span class="font-medium">Warranty Info</span>
                            </div>
                        </a>
                        <a href="#terms" class="block py-3 px-4 rounded-md hover:bg-gray-50 transition policy-nav">
                            <div class="flex items-center">
                                <i class="fas fa-file-contract mr-3" style="color: var(--accent-color);"></i>
                                <span class="font-medium">Terms of Service</span>
                            </div>
                        </a>
                    </nav>
                    
                    <!-- Contact Info -->
                    <div class="mt-8 pt-8 border-t" style="border-color: var(--border-color);">
                        <h3 class="font-bold mb-4" style="color: var(--primary-color);">Need Help?</h3>
                        <div class="space-y-3">
                            <div class="flex items-start">
                                <i class="fas fa-envelope mt-1 mr-3" style="color: var(--accent-color);"></i>
                                <span>support@inhousetextiles.pk</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-phone mt-1 mr-3" style="color: var(--accent-color);"></i>
                                <span>+92 300 1234567</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-clock mt-1 mr-3" style="color: var(--accent-color);"></i>
                                <span>Mon-Fri: 9am-6pm PKT</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Policy Content -->
            <div class="lg:w-3/4">
                <!-- Shipping Policy -->
                <section id="shipping" class="policy-section bg-white rounded-lg shadow-md p-6 md:p-8 mb-8 border" style="border-color: var(--border-color);">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4" style="background-color: rgba(107, 66, 38, 0.1);">
                            <i class="fas fa-shipping-fast text-xl" style="color: var(--primary-color);"></i>
                        </div>
                        <h2 class="text-3xl font-bold" style="color: var(--primary-color);">Shipping Policy</h2>
                    </div>
                    
                    <div class="mb-8">
                        <p class="text-lg mb-6">At INHOUSE TEXTILES, we strive to deliver your premium bed sheets and textiles as quickly and efficiently as possible. Below you'll find details about our shipping methods, delivery times, and costs.</p>
                        
                        <div class="grid md:grid-cols-2 gap-6 mb-8">
                            <div class="bg-gray-50 p-5 rounded-lg border" style="border-color: var(--border-color);">
                                <h3 class="font-bold text-lg mb-3" style="color: var(--accent-color);">Domestic Shipping</h3>
                                <ul class="space-y-2">
                                    <li class="flex items-start">
                                        <i class="fas fa-check mt-1 mr-2" style="color: var(--secondary-color);"></i>
                                        <span>Standard shipping: 3-5 business days</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check mt-1 mr-2" style="color: var(--secondary-color);"></i>
                                        <span>Express shipping: 1-2 business days</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check mt-1 mr-2" style="color: var(--secondary-color);"></i>
                                        <span>Free shipping on orders over $75</span>
                                    </li>
                                </ul>
                            </div>
                            
                            <div class="bg-gray-50 p-5 rounded-lg border" style="border-color: var(--border-color);">
                                <h3 class="font-bold text-lg mb-3" style="color: var(--accent-color);">International Shipping</h3>
                                <ul class="space-y-2">
                                    <li class="flex items-start">
                                        <i class="fas fa-check mt-1 mr-2" style="color: var(--secondary-color);"></i>
                                        <span>Available to 30+ countries</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check mt-1 mr-2" style="color: var(--secondary-color);"></i>
                                        <span>Delivery times vary by location</span>
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check mt-1 mr-2" style="color: var(--secondary-color);"></i>
                                        <span>Customs fees may apply</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        
                        <h3 class="text-xl font-bold mb-4" style="color: var(--accent-color);">Order Processing</h3>
                        <p class="mb-4">Orders are processed within 1-2 business days. You will receive a confirmation email with tracking information once your order has shipped. Please note that shipping times are estimates and may be affected by factors outside our control.</p>
                        
                        <div class="bg-gray-50 p-5 rounded-lg border" style="border-color: var(--border-color);">
                            <h4 class="font-bold mb-2" style="color: var(--accent-color);">Important Notes:</h4>
                            <ul class="space-y-1">
                                <li class="flex items-start">
                                    <i class="fas fa-info-circle mt-1 mr-2" style="color: var(--primary-color);"></i>
                                    <span>We do not ship on weekends or holidays</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-info-circle mt-1 mr-2" style="color: var(--primary-color);"></i>
                                    <span>Please ensure your shipping address is correct at checkout</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-info-circle mt-1 mr-2" style="color: var(--primary-color);"></i>
                                    <span>For expedited shipping, please place your order before 12 PM EST</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- Privacy Policy -->
                <section id="privacy" class="policy-section bg-white rounded-lg shadow-md p-6 md:p-8 mb-8 border" style="border-color: var(--border-color);">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4" style="background-color: rgba(107, 66, 38, 0.1);">
                            <i class="fas fa-shield-alt text-xl" style="color: var(--primary-color);"></i>
                        </div>
                        <h2 class="text-3xl font-bold" style="color: var(--primary-color);">Privacy Policy</h2>
                    </div>
                    
                    <div class="mb-8">
                        <p class="text-lg mb-6">INHOUSE TEXTILES respects your privacy and is committed to protecting your personal data. This privacy policy explains how we collect, use, and safeguard your information when you visit our website or make a purchase.</p>
                        
                        <h3 class="text-xl font-bold mb-4" style="color: var(--accent-color);">Information We Collect</h3>
                        <p class="mb-4">We collect information that you provide directly to us, such as when you create an account, make a purchase, or contact us. This may include:</p>
                        
                        <div class="grid md:grid-cols-2 gap-4 mb-6">
                            <div class="flex items-start p-3 rounded border" style="border-color: var(--border-color);">
                                <i class="fas fa-user mt-1 mr-3" style="color: var(--secondary-color);"></i>
                                <div>
                                    <h4 class="font-bold">Personal Information</h4>
                                    <p class="text-sm">Name, email address, phone number, shipping/billing address</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start p-3 rounded border" style="border-color: var(--border-color);">
                                <i class="fas fa-credit-card mt-1 mr-3" style="color: var(--secondary-color);"></i>
                                <div>
                                    <h4 class="font-bold">Payment Information</h4>
                                    <p class="text-sm">Payment card details (processed securely through our payment gateway)</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start p-3 rounded border" style="border-color: var(--border-color);">
                                <i class="fas fa-shopping-cart mt-1 mr-3" style="color: var(--secondary-color);"></i>
                                <div>
                                    <h4 class="font-bold">Order Information</h4>
                                    <p class="text-sm">Products purchased, order history, preferences</p>
                                </div>
                            </div>
                            
                            <div class="flex items-start p-3 rounded border" style="border-color: var(--border-color);">
                                <i class="fas fa-laptop mt-1 mr-3" style="color: var(--secondary-color);"></i>
                                <div>
                                    <h4 class="font-bold">Technical Information</h4>
                                    <p class="text-sm">IP address, browser type, device information, browsing behavior</p>
                                </div>
                            </div>
                        </div>
                        
                        <h3 class="text-xl font-bold mb-4" style="color: var(--accent-color);">How We Use Your Information</h3>
                        <p class="mb-4">We use the information we collect to:</p>
                        
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-check-circle mt-1 mr-2" style="color: var(--secondary-color);"></i>
                                <span>Process and fulfill your orders</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle mt-1 mr-2" style="color: var(--secondary-color);"></i>
                                <span>Communicate with you about orders, products, and promotions</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle mt-1 mr-2" style="color: var(--secondary-color);"></i>
                                <span>Improve our website, products, and customer service</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle mt-1 mr-2" style="color: var(--secondary-color);"></i>
                                <span>Prevent fraud and enhance security</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-check-circle mt-1 mr-2" style="color: var(--secondary-color);"></i>
                                <span>Comply with legal obligations</span>
                            </li>
                        </ul>
                        
                        <div class="bg-gray-50 p-5 rounded-lg border" style="border-color: var(--border-color);">
                            <h4 class="font-bold mb-2" style="color: var(--accent-color);">Data Protection</h4>
                            <p>We implement appropriate technical and organizational measures to protect your personal data against unauthorized access, alteration, disclosure, or destruction. Your payment information is encrypted using SSL technology and processed by PCI-compliant payment processors.</p>
                        </div>
                    </div>
                </section>

                <!-- Warranty Info -->
                <section id="warranty" class="policy-section bg-white rounded-lg shadow-md p-6 md:p-8 mb-8 border" style="border-color: var(--border-color);">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4" style="background-color: rgba(107, 66, 38, 0.1);">
                            <i class="fas fa-certificate text-xl" style="color: var(--primary-color);"></i>
                        </div>
                        <h2 class="text-3xl font-bold" style="color: var(--primary-color);">Warranty Information</h2>
                    </div>
                    
                    <div class="mb-8">
                        <p class="text-lg mb-6">INHOUSE TEXTILES stands behind the quality of our bed sheets and textiles. We offer comprehensive warranties to ensure your complete satisfaction with our premium products.</p>
                        
                        <div class="mb-8 p-6 rounded-lg" style="background-color: rgba(200, 161, 101, 0.1); border-color: var(--secondary-color); border: 1px solid var(--border-color);">
                            <h3 class="text-xl font-bold mb-4" style="color: var(--accent-color);">Our Warranty Promise</h3>
                            <p class="mb-4">All INHOUSE TEXTILES products come with a <span class="font-bold">7 Days warranty</span> against manufacturing defects in materials and workmanship.</p>
                            <div class="flex items-center">
                                <i class="fas fa-award text-3xl mr-4" style="color: var(--primary-color);"></i>
                                <p>Premium collections feature an extended <span class="font-bold">7 Days warranty</span> for added peace of mind.</p>
                            </div>
                        </div>
                        
                        <h3 class="text-xl font-bold mb-4" style="color: var(--accent-color);">What's Covered</h3>
                        
                        <div class="overflow-x-auto mb-6">
                            <table class="min-w-full border" style="border-color: var(--border-color);">
                                <thead>
                                    <tr class="bg-gray-50">
                                        <th class="py-3 px-4 text-left font-bold" style="color: var(--primary-color); border-color: var(--border-color); border-bottom: 2px solid;">Issue Type</th>
                                        <th class="py-3 px-4 text-left font-bold" style="color: var(--primary-color); border-color: var(--border-color); border-bottom: 2px solid;">Coverage Period</th>
                                        <th class="py-3 px-4 text-left font-bold" style="color: var(--primary-color); border-color: var(--border-color); border-bottom: 2px solid;">Resolution</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="border-b" style="border-color: var(--border-color);">
                                        <td class="py-3 px-4">Manufacturing defects (seams, threads)</td>
                                        <td class="py-3 px-4">2 years from purchase</td>
                                        <td class="py-3 px-4">Replacement or repair</td>
                                    </tr>
                                    <tr class="border-b" style="border-color: var(--border-color);">
                                        <td class="py-3 px-4">Fabric quality issues (pilling, fading)</td>
                                        <td class="py-3 px-4">1 year from purchase</td>
                                        <td class="py-3 px-4">Replacement</td>
                                    </tr>
                                    <tr class="border-b" style="border-color: var(--border-color);">
                                        <td class="py-3 px-4">Colorfastness issues</td>
                                        <td class="py-3 px-4">2 years from purchase</td>
                                        <td class="py-3 px-4">Replacement</td>
                                    </tr>
                                    <tr>
                                        <td class="py-3 px-4">Elastic deterioration (fitted sheets)</td>
                                        <td class="py-3 px-4">3 years from purchase</td>
                                        <td class="py-3 px-4">Replacement of elastic band</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        
                        <h3 class="text-xl font-bold mb-4" style="color: var(--accent-color);">Warranty Claim Process</h3>
                        <ol class="space-y-4 mb-6">
                            <li class="flex items-start">
                                <span class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-white font-bold" style="background-color: var(--primary-color);">1</span>
                                <div>
                                    <h4 class="font-bold">Contact Support</h4>
                                    <p>Email our support team at warranty@inhousetextiles.com with your order number and photos of the issue.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-white font-bold" style="background-color: var(--primary-color);">2</span>
                                <div>
                                    <h4 class="font-bold">Evaluation</h4>
                                    <p>Our quality team will review your claim and determine if it's covered under warranty.</p>
                                </div>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0 w-8 h-8 rounded-full flex items-center justify-center mr-3 text-white font-bold" style="background-color: var(--primary-color);">3</span>
                                <div>
                                    <h4 class="font-bold">Resolution</h4>
                                    <p>If approved, we'll ship a replacement or provide a repair solution at no cost to you.</p>
                                </div>
                            </li>
                        </ol>
                        
                        <div class="bg-gray-50 p-5 rounded-lg border" style="border-color: var(--border-color);">
                            <h4 class="font-bold mb-2" style="color: var(--accent-color);">Important Notes:</h4>
                            <ul class="space-y-1">
                                <li class="flex items-start">
                                    <i class="fas fa-exclamation-triangle mt-1 mr-2" style="color: var(--primary-color);"></i>
                                    <span>Warranty does not cover damage from improper care, accidents, or normal wear and tear</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-exclamation-triangle mt-1 mr-2" style="color: var(--primary-color);"></i>
                                    <span>Always follow care instructions on product labels to maintain warranty coverage</span>
                                </li>
                                <li class="flex items-start">
                                    <i class="fas fa-exclamation-triangle mt-1 mr-2" style="color: var(--primary-color);"></i>
                                    <span>Warranty is non-transferable and applies only to the original purchaser</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>

                <!-- Terms of Service -->
                <section id="terms" class="policy-section bg-white rounded-lg shadow-md p-6 md:p-8 mb-8 border" style="border-color: var(--border-color);">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 rounded-full flex items-center justify-center mr-4" style="background-color: rgba(107, 66, 38, 0.1);">
                            <i class="fas fa-file-contract text-xl" style="color: var(--primary-color);"></i>
                        </div>
                        <h2 class="text-3xl font-bold" style="color: var(--primary-color);">Terms of Service</h2>
                    </div>
                    
                    <div class="mb-8">
                        <p class="text-lg mb-6">Welcome to INHOUSE TEXTILES. By accessing or using our website, you agree to be bound by these Terms of Service. Please read them carefully before making a purchase.</p>
                        
                        <h3 class="text-xl font-bold mb-4" style="color: var(--accent-color);">General Terms</h3>
                        <p class="mb-4">These terms govern your use of the INHOUSE TEXTILES website and services. We reserve the right to update these terms at any time without prior notice. Continued use of our site after changes constitutes acceptance of the new terms.</p>
                        
                        <h3 class="text-xl font-bold mb-4" style="color: var(--accent-color);">Account Registration</h3>
                        <p class="mb-4">To make purchases or access certain features, you may need to create an account. You are responsible for:</p>
                        
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-user-shield mt-1 mr-2" style="color: var(--secondary-color);"></i>
                                <span>Maintaining the confidentiality of your account credentials</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-user-shield mt-1 mr-2" style="color: var(--secondary-color);"></i>
                                <span>All activities that occur under your account</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-user-shield mt-1 mr-2" style="color: var(--secondary-color);"></i>
                                <span>Providing accurate and complete information</span>
                            </li>
                        </ul>
                        
                        <h3 class="text-xl font-bold mb-4" style="color: var(--accent-color);">Product Information & Pricing</h3>
                        <p class="mb-4">We strive to display accurate product information, including descriptions, images, and prices. However, we cannot guarantee that all information is error-free. We reserve the right to correct any errors and to update information at any time without prior notice.</p>
                        
                        <div class="grid md:grid-cols-2 gap-6 mb-6">
                            <div class="p-5 rounded-lg border" style="border-color: var(--border-color);">
                                <h4 class="font-bold mb-3" style="color: var(--accent-color);">Order Acceptance</h4>
                                <p>Your receipt of an order confirmation does not constitute our acceptance of your order. We reserve the right to refuse or cancel any order for any reason, including product availability, errors in pricing, or suspicion of fraud.</p>
                            </div>
                            
                            <div class="p-5 rounded-lg border" style="border-color: var(--border-color);">
                                <h4 class="font-bold mb-3" style="color: var(--accent-color);">Payment Terms</h4>
                                <p>All payments are processed through secure payment gateways. By providing payment information, you represent that you are authorized to use the payment method. We use encryption and other security measures to protect your payment information.</p>
                            </div>
                        </div>
                        
                        <h3 class="text-xl font-bold mb-4" style="color: var(--accent-color);">Returns & Exchanges</h3>
                        <p class="mb-4">Please refer to our separate Return Policy for detailed information. In general:</p>
                        
                        <ul class="space-y-2 mb-6">
                            <li class="flex items-start">
                                <i class="fas fa-exchange-alt mt-1 mr-2" style="color: var(--secondary-color);"></i>
                                <span>Items must be returned within 7 days of delivery</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-exchange-alt mt-1 mr-2" style="color: var(--secondary-color);"></i>
                                <span>Products must be unused, unwashed, and in original packaging</span>
                            </li>
                            <li class="flex items-start">
                                <i class="fas fa-exchange-alt mt-1 mr-2" style="color: var(--secondary-color);"></i>
                                <span>Return shipping costs are the customer's responsibility unless the item is defective</span>
                            </li>
                        </ul>
                        
                        <h3 class="text-xl font-bold mb-4" style="color: var(--accent-color);">Intellectual Property</h3>
                        <p class="mb-6">All content on this website, including text, graphics, logos, images, and software, is the property of INHOUSE TEXTILES and protected by intellectual property laws. You may not use, reproduce, or distribute any content without our express written permission.</p>
                        
                        <div class="bg-gray-50 p-5 rounded-lg border" style="border-color: var(--border-color);">
                            <h4 class="font-bold mb-2" style="color: var(--accent-color);">Limitation of Liability</h4>
                            <p>INHOUSE TEXTILES shall not be liable for any indirect, incidental, special, or consequential damages arising from your use of our website or products. Our total liability for any claim related to our products or services shall not exceed the purchase price of the product in question.</p>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <!-- Footer -->


    <script>
        // Mobile menu toggle
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.classList.toggle('hidden');
        });
        
        // Highlight active policy in sidebar when scrolling
        document.addEventListener('DOMContentLoaded', function() {
            const policySections = document.querySelectorAll('.policy-section');
            const policyNavLinks = document.querySelectorAll('.policy-nav');
            
            function highlightActivePolicy() {
                let currentSection = '';
                
                policySections.forEach(section => {
                    const sectionTop = section.offsetTop - 150;
                    const sectionHeight = section.clientHeight;
                    if (window.scrollY >= sectionTop && window.scrollY < sectionTop + sectionHeight) {
                        currentSection = section.getAttribute('id');
                    }
                });
                
                policyNavLinks.forEach(link => {
                    link.classList.remove('active-policy');
                    if (link.getAttribute('href') === `#${currentSection}`) {
                        link.classList.add('active-policy');
                    }
                });
            }
            
            // Highlight on scroll
            window.addEventListener('scroll', highlightActivePolicy);
            
            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    const targetId = this.getAttribute('href');
                    if (targetId === '#') return;
                    
                    const targetElement = document.querySelector(targetId);
                    if (targetElement) {
                        window.scrollTo({
                            top: targetElement.offsetTop - 100,
                            behavior: 'smooth'
                        });
                        
                        // Update active policy in sidebar
                        policyNavLinks.forEach(link => {
                            link.classList.remove('active-policy');
                            if (link.getAttribute('href') === targetId) {
                                link.classList.add('active-policy');
                            }
                        });
                        
                        // Close mobile menu if open
                        const mobileMenu = document.getElementById('mobile-menu');
                        if (!mobileMenu.classList.contains('hidden')) {
                            mobileMenu.classList.add('hidden');
                        }
                    }
                });
            });
            
            // Initialize with first policy active
            highlightActivePolicy();
        });
    </script>
@endsection
