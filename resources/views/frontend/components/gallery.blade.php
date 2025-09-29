

<section id="image_gallery">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap');

        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }

        .gallery-item {
            transition: all 0.3s ease;
            overflow: hidden;
            border-radius: 8px;
            cursor: pointer;
        }

        .gallery-item img {
            transition: transform 0.5s ease;
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .gallery-item:hover img {
            transform: scale(1.05);
        }

        .gallery-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }

        .filter-btn {
            transition: all 0.3s ease;
        }

        .filter-btn.active, .filter-btn:hover {
            background-color: #2563eb;
            color: white;
        }

        .lightbox {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }

        .lightbox-content {
            max-width: 90%;
            max-height: 90%;
        }

        .lightbox img {
            max-width: 100%;
            max-height: 80vh;
            border-radius: 8px;
        }

        .lightbox-close {
            position: absolute;
            top: 20px;
            right: 20px;
            color: white;
            font-size: 30px;
            cursor: pointer;
        }

        .lightbox-nav {
            position: absolute;
            width: 100%;
            display: flex;
            justify-content: space-between;
            padding: 0 20px;
            box-sizing: border-box;
            top: 50%;
            transform: translateY(-50%);
        }

        .lightbox-nav button {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .lightbox-nav button:hover {
            background-color: rgba(255, 255, 255, 0.4);
        }

        .lightbox-caption {
            color: white;
            text-align: center;
            margin-top: 15px;
            font-size: 18px;
        }

        @media (max-width: 768px) {
            .gallery-item img {
                height: 180px;
            }
        }

        @media (max-width: 640px) {
            .gallery-item img {
                height: 150px;
            }
        }
    </style>
    <!-- Header -->
    <div class="pt-20 pb-12 bg-gradient-to-r from-primary to-blue-700">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Total Trade Corporation</h1>
            <p class="text-xl text-blue-100 max-w-2xl mx-auto">Explore our showroom, facilities, events, and selling activities through our photo gallery</p>
        </div>
    </div>

    <!-- Gallery Section -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <!-- Filter Buttons -->
            <div class="flex flex-wrap justify-center gap-3 mb-8">
                <button class="filter-btn active px-4 py-2 rounded-full border border-gray-300" data-filter="all">All</button>
                <button class="filter-btn px-4 py-2 rounded-full border border-gray-300" data-filter="campus">Selling</button>
                <button class="filter-btn px-4 py-2 rounded-full border border-gray-300" data-filter="classrooms">Our Customer</button>
                <button class="filter-btn px-4 py-2 rounded-full border border-gray-300" data-filter="sports">Key Handover</button>
                <button class="filter-btn px-4 py-2 rounded-full border border-gray-300" data-filter="events">Events</button>
                <button class="filter-btn px-4 py-2 rounded-full border border-gray-300" data-filter="activities">Activities</button>
            </div>

            <!-- Gallery Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6" id="gallery-grid">
                <!-- Campus Images -->
                <div class="gallery-item" data-category="campus">
                    <img src="{{ asset('images/gallery/sold_01.jpg') }}" alt="School Campus" data-caption="Main school building with modern architecture">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Key Handover</h3>
                        <p class="text-sm text-gray-600">Key Handover to our Client</p>
                    </div>
                </div>

                <div class="gallery-item" data-category="campus">
                    <img src="{{ asset('images/gallery/sold_02.jpg') }}" alt="School Library" data-caption="Well-stocked library with reading areas">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Warm Congratulation!</h3>
                        <p class="text-sm text-gray-600">We welcomed our client by flower</p>
                    </div>
                </div>

                <!-- Classroom Images -->
                <div class="gallery-item" data-category="classrooms">
                    <img src="{{ asset('images/gallery/sold_03.jpg') }}" alt="Science Lab" data-caption="Fully equipped science laboratory">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Car Handover</h3>
                        <p class="text-sm text-gray-600">Symblic Car Handover to client</p>
                    </div>
                </div>

                <div class="gallery-item" data-category="classrooms">
                    <img src="{{ asset('images/gallery/sold_04.jpg') }}" alt="Computer Lab" data-caption="Modern computer lab with latest technology">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Warm Congratulation!</h3>
                        <p class="text-sm text-gray-600">We welcomed our client by flower</p>
                    </div>
                </div>

                <!-- Sports Images -->
                <div class="gallery-item" data-category="sports">
                    <img src="{{ asset('images/gallery/sold_05.jpg') }}" alt="Basketball Court" data-caption="School basketball court during practice">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Car Handover</h3>
                        <p class="text-sm text-gray-600">Symblic Car Handover to client</p>
                    </div>
                </div>
                <!-- Sports Images -->
                <div class="gallery-item" data-category="sports">
                    <img src="{{ asset('images/gallery/sold_06.jpg') }}" alt="Basketball Court" data-caption="School basketball court during practice">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Warm Congratulation!</h3>
                        <p class="text-sm text-gray-600">Symblic Car Handover to client</p>
                    </div>
                </div>
                                <!-- Sports Images -->
                <div class="gallery-item" data-category="sports">
                    <img src="{{ asset('images/gallery/sold_07.jpg') }}" alt="Basketball Court" data-caption="School basketball court during practice">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Showroom Inauguration</h3>
                        <p class="text-sm text-gray-600">Grand Opening Ceremony of the Showroom Today</p>
                    </div>
                </div>                <!-- Sports Images -->
                <div class="gallery-item" data-category="sports">
                    <img src="{{ asset('images/gallery/sold_08.jpg') }}" alt="Basketball Court" data-caption="School basketball court during practice">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Showroom Inauguration</h3>
                        <p class="text-sm text-gray-600">Grand Opening Ceremony of the Showroom Today</p>
                    </div>
                </div>                <!-- Sports Images -->
                <div class="gallery-item" data-category="sports">
                    <img src="{{ asset('images/gallery/sold_09.jpg') }}" alt="Basketball Court" data-caption="School basketball court during practice">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Showroom Inauguration</h3>
                        <p class="text-sm text-gray-600">Grand Opening Ceremony of the Showroom Today</p>
                    </div>
                </div>                <!-- Sports Images -->
                <div class="gallery-item" data-category="sports">
                    <img src="{{ asset('images/gallery/sold_10.jpg') }}" alt="Basketball Court" data-caption="School basketball court during practice">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Showroom Inauguration</h3>
                        <p class="text-sm text-gray-600">Grand Opening Ceremony of the Showroom Today</p>
                    </div>
                </div>                <!-- Sports Images -->
                <div class="gallery-item" data-category="sports">
                    <img src="{{ asset('images/gallery/sold_11.jpg') }}" alt="Basketball Court" data-caption="School basketball court during practice">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Showroom Inauguration</h3>
                        <p class="text-sm text-gray-600">Grand Opening Ceremony of the Showroom Today</p>
                    </div>
                </div>                <!-- Sports Images -->
                <div class="gallery-item" data-category="sports">
                    <img src="{{ asset('images/gallery/sold_12.jpg') }}" alt="Basketball Court" data-caption="School basketball court during practice">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Showroom Inauguration</h3>
                        <p class="text-sm text-gray-600">Grand Opening Ceremony of the Showroom Today</p>
                    </div>
                </div>                <!-- Sports Images -->
                <div class="gallery-item" data-category="sports">
                    <img src="{{ asset('images/gallery/sold_13.jpg') }}" alt="Basketball Court" data-caption="School basketball court during practice">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Showroom Inauguration</h3>
                        <p class="text-sm text-gray-600">Grand Opening Ceremony of the Showroom Today</p>
                    </div>
                </div>                <!-- Sports Images -->
                <div class="gallery-item" data-category="sports">
                    <img src="{{ asset('images/gallery/sold_14.jpg') }}" alt="Basketball Court" data-caption="School basketball court during practice">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Showroom Inauguration</h3>
                        <p class="text-sm text-gray-600">Grand Opening Ceremony of the Showroom Today</p>
                    </div>
                </div>                <!-- Sports Images -->
                <div class="gallery-item" data-category="sports">
                    <img src="{{ asset('images/gallery/sold_18.jpg') }}" alt="Basketball Court" data-caption="School basketball court during practice">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Showroom Inauguration</h3>
                        <p class="text-sm text-gray-600">Grand Opening Ceremony of the Showroom Today</p>
                    </div>
                </div>                <!-- Sports Images -->
                <div class="gallery-item" data-category="sports">
                    <img src="{{ asset('images/gallery/sold_16.jpg') }}" alt="Basketball Court" data-caption="School basketball court during practice">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Showroom Inauguration</h3>
                        <p class="text-sm text-gray-600">Grand Opening Ceremony of the Showroom Today</p>
                    </div>
                </div>                <!-- Sports Images -->
                <div class="gallery-item" data-category="sports">
                    <img src="{{ asset('images/gallery/sold_17.jpg') }}" alt="Basketball Court" data-caption="School basketball court during practice">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Showroom Inauguration</h3>
                        <p class="text-sm text-gray-600">Grand Opening Ceremony of the Showroom Today</p>
                    </div>
                </div>                <!-- Sports Images -->
                <div class="gallery-item" data-category="sports">
                    <img src="{{ asset('images/gallery/sold_18.jpg') }}" alt="Basketball Court" data-caption="School basketball court during practice">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Showroom Inauguration</h3>
                        <p class="text-sm text-gray-600">Grand Opening Ceremony of the Showroom Today</p>
                    </div>
                </div>                <!-- Sports Images -->
                <div class="gallery-item" data-category="sports">
                    <img src="{{ asset('images/gallery/sold_19.jpg') }}" alt="Basketball Court" data-caption="School basketball court during practice">
                    <div class="p-3 bg-white">
                        <h3 class="font-medium text-dark">Showroom Inauguration</h3>
                        <p class="text-sm text-gray-600">Grand Opening Ceremony of the Showroom Today</p>
                    </div>
                </div>                <!-- Sports Images -->

            </div>
        </div>
    </section>

    <!-- Lightbox -->
    <div class="lightbox" id="lightbox">
        <div class="lightbox-close" id="lightbox-close">
            <i class="fas fa-times"></i>
        </div>
        <div class="lightbox-nav">
            <button id="lightbox-prev"><i class="fas fa-chevron-left"></i></button>
            <button id="lightbox-next"><i class="fas fa-chevron-right"></i></button>
        </div>
        <div class="lightbox-content">
            <img src="" alt="" id="lightbox-img">
            <div class="lightbox-caption" id="lightbox-caption"></div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Filter functionality
            const filterButtons = document.querySelectorAll('.filter-btn');
            const galleryItems = document.querySelectorAll('.gallery-item');

            filterButtons.forEach(button => {
                button.addEventListener('click', () => {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));

                    // Add active class to clicked button
                    button.classList.add('active');

                    const filter = button.getAttribute('data-filter');

                    galleryItems.forEach(item => {
                        if (filter === 'all' || item.getAttribute('data-category') === filter) {
                            item.style.display = 'block';
                        } else {
                            item.style.display = 'none';
                        }
                    });
                });
            });

            // Lightbox functionality
            const lightbox = document.getElementById('lightbox');
            const lightboxImg = document.getElementById('lightbox-img');
            const lightboxCaption = document.getElementById('lightbox-caption');
            const lightboxClose = document.getElementById('lightbox-close');
            const lightboxPrev = document.getElementById('lightbox-prev');
            const lightboxNext = document.getElementById('lightbox-next');

            let currentImageIndex = 0;
            const images = Array.from(galleryItems);

            // Function to open lightbox
            function openLightbox(index) {
                currentImageIndex = index;
                const imageSrc = images[index].querySelector('img').src;
                const caption = images[index].querySelector('img').getAttribute('data-caption');

                lightboxImg.src = imageSrc;
                lightboxCaption.textContent = caption;
                lightbox.style.display = 'flex';

                document.body.style.overflow = 'hidden'; // Prevent scrolling when lightbox is open
            }

            // Add click event to all gallery items
            galleryItems.forEach((item, index) => {
                item.addEventListener('click', () => {
                    openLightbox(index);
                });
            });

            // Close lightbox
            lightboxClose.addEventListener('click', () => {
                lightbox.style.display = 'none';
                document.body.style.overflow = 'auto'; // Re-enable scrolling
            });

            // Navigate to previous image
            lightboxPrev.addEventListener('click', (e) => {
                e.stopPropagation();
                currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
                openLightbox(currentImageIndex);
            });

            // Navigate to next image
            lightboxNext.addEventListener('click', (e) => {
                e.stopPropagation();
                currentImageIndex = (currentImageIndex + 1) % images.length;
                openLightbox(currentImageIndex);
            });

            // Close lightbox when clicking outside the image
            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) {
                    lightbox.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });

            // Keyboard navigation
            document.addEventListener('keydown', (e) => {
                if (lightbox.style.display === 'flex') {
                    if (e.key === 'Escape') {
                        lightbox.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    } else if (e.key === 'ArrowLeft') {
                        currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
                        openLightbox(currentImageIndex);
                    } else if (e.key === 'ArrowRight') {
                        currentImageIndex = (currentImageIndex + 1) % images.length;
                        openLightbox(currentImageIndex);
                    }
                }
            });
        });
    </script>
</section>




