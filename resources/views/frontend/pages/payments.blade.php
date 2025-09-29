{{-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Payment Portal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 min-h-screen">
    <!-- Header -->
    <header class="bg-indigo-700 text-white shadow-md">
        <div class="container mx-auto px-4 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-graduation-cap text-2xl"></i>
                    <h1 class="text-xl font-bold">Greenwood High School</h1>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="hidden md:inline">Welcome, Sarah Johnson</span>
                    <div class="w-10 h-10 rounded-full bg-indigo-500 flex items-center justify-center">
                        <i class="fas fa-user"></i>
                    </div>
                </div>
            </div>
        </div>
    </header> --}}

@extends('frontend.layout.app')
@section('content')


    <!-- Main Content -->
    <main class="container mx-auto px-4 py-11">
        <div class="max-w-4xl mx-auto">
            <!-- Page Title -->
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800">Student Payment Portal</h2>
                <p class="text-gray-600 mt-2">Complete your payment securely</p>
            </div>

            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Payment Form -->
                <div class="lg:w-2/3">
                    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Payment Information</h3>

                        <!-- Payment Method Selection -->
                        <div class="mb-6">
                            <h4 class="text-lg font-medium text-gray-700 mb-3">Payment Method</h4>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                <button class="payment-method-btn border-2 border-gray-300 rounded-lg p-4 text-center hover:border-indigo-500 transition-colors">
                                    <i class="fab fa-cc-visa text-3xl text-blue-600 mb-2"></i>
                                    <p class="font-medium">Credit Card</p>
                                </button>
                                <button class="payment-method-btn border-2 border-gray-300 rounded-lg p-4 text-center hover:border-indigo-500 transition-colors">
                                    <i class="fab fa-cc-mastercard text-3xl text-red-600 mb-2"></i>
                                    <p class="font-medium">Debit Card</p>
                                </button>
                                <button class="payment-method-btn border-2 border-gray-300 rounded-lg p-4 text-center hover:border-indigo-500 transition-colors">
                                    <i class="fas fa-university text-3xl text-green-600 mb-2"></i>
                                    <p class="font-medium">Bank Transfer</p>
                                </button>
                            </div>
                        </div>

                        <!-- Card Details Form -->
                        <form id="payment-form">
                            <div class="mb-4">
                                <label for="card-number" class="block text-gray-700 mb-2">Card Number</label>
                                <div class="relative">
                                    <input type="text" id="card-number" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="1234 5678 9012 3456">
                                    <i class="fab fa-cc-visa absolute right-3 top-3 text-gray-400"></i>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-4">
                                <div>
                                    <label for="expiry-date" class="block text-gray-700 mb-2">Expiry Date</label>
                                    <input type="text" id="expiry-date" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="MM/YY">
                                </div>
                                <div>
                                    <label for="cvv" class="block text-gray-700 mb-2">CVV</label>
                                    <input type="text" id="cvv" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="123">
                                </div>
                            </div>

                            <div class="mb-6">
                                <label for="cardholder-name" class="block text-gray-700 mb-2">Cardholder Name</label>
                                <input type="text" id="cardholder-name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-transparent" placeholder="John Doe">
                            </div>

                            <div class="flex items-center mb-6">
                                <input type="checkbox" id="save-card" class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                <label for="save-card" class="ml-2 block text-sm text-gray-700">Save card details for future payments</label>
                            </div>

                            <button type="submit" class="w-full bg-indigo-600 text-white py-3 px-4 rounded-lg font-medium hover:bg-indigo-700 transition-colors focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Pay Now
                            </button>
                        </form>
                    </div>

                    <!-- Security Notice -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-start">
                        <i class="fas fa-shield-alt text-blue-500 text-xl mt-1 mr-3"></i>
                        <div>
                            <h4 class="font-medium text-blue-800">Secure Payment</h4>
                            <p class="text-blue-700 text-sm mt-1">Your payment information is encrypted and secure. We do not store your card details.</p>
                        </div>
                    </div>
                </div>

                <!-- Payment Summary -->
                <div class="lg:w-1/3">
                    <div class="bg-white rounded-lg shadow-md p-6 sticky top-6">
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">Payment Summary</h3>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tuition Fee</span>
                                <span class="font-medium">$450.00</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Library Fee</span>
                                <span class="font-medium">$25.00</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Activity Fee</span>
                                <span class="font-medium">$35.00</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Technology Fee</span>
                                <span class="font-medium">$15.00</span>
                            </div>
                            <div class="border-t border-gray-200 pt-2 mt-2">
                                <div class="flex justify-between">
                                    <span class="text-gray-800 font-medium">Total Amount</span>
                                    <span class="text-indigo-600 font-bold text-lg">$525.00</span>
                                </div>
                            </div>
                        </div>

                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <h4 class="font-medium text-gray-700 mb-2">Student Information</h4>
                            <div class="text-sm text-gray-600">
                                <p>Sarah Johnson</p>
                                <p>Grade 10, Section B</p>
                                <p>Student ID: STU-2023-0456</p>
                            </div>
                        </div>

                        <div class="text-center text-sm text-gray-500">
                            <p>Payment due by: October 15, 2023</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

 @endsection

    {{-- <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8 mt-12">
        <div class="container mx-auto px-4">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="mb-4 md:mb-0">
                    <h3 class="text-xl font-bold">Greenwood High School</h3>
                    <p class="text-gray-400 mt-1">Excellence in Education Since 1985</p>
                </div>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-6 pt-6 text-center text-gray-400 text-sm">
                <p>&copy; 2023 Greenwood High School. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Simple JavaScript for payment method selection
        document.addEventListener('DOMContentLoaded', function() {
            const paymentMethodBtns = document.querySelectorAll('.payment-method-btn');

            paymentMethodBtns.forEach(btn => {
                btn.addEventListener('click', function() {
                    // Remove active class from all buttons
                    paymentMethodBtns.forEach(b => {
                        b.classList.remove('border-indigo-500', 'bg-indigo-50');
                        b.classList.add('border-gray-300');
                    });

                    // Add active class to clicked button
                    this.classList.remove('border-gray-300');
                    this.classList.add('border-indigo-500', 'bg-indigo-50');
                });
            });

            // Form submission
            document.getElementById('payment-form').addEventListener('submit', function(e) {
                e.preventDefault();
                alert('Payment processing would happen here in a real application!');
            });
        });
    </script>
</body>
</html> --}}
