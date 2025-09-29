<section class="bg-gray-100 min-h-screen py-8">
    <style>
        .imageContainer {
            position: relative;
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 800px;
            margin: 0 auto;
        }

        .centered {
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 25px;
            position: relative;
            min-height: 450px;
            overflow: hidden;
        }

        #mainImage {
            width: 100%;
            max-width: 800px;
            height: 450px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            transition: opacity 0.5s ease-in-out;
            display: block;
        }

        .arrow {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            font-size: 24px;
            color: #2c3e50;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0.9;
        }

        .arrow:hover {
            background-color: #2c3e50;
            color: white;
        }

        .left {
            left: 15px;
        }

        .right {
            right: 15px;
        }

        #thumbnails {
            display: flex;
            gap: 12px;
            padding: 15px;
            overflow-x: auto;
            max-width: 100%;
            scroll-behavior: smooth;
            background-color: #f8f9fa;
            border-radius: 10px;
            position: relative;
        }

        #thumbnails::-webkit-scrollbar {
            height: 8px;
        }

        #thumbnails::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        #thumbnails::-webkit-scrollbar-thumb {
            background: #c2c7d0;
            border-radius: 10px;
        }

        #thumbnails::-webkit-scrollbar-thumb:hover {
            background: #2c3e50;
        }

        .thumbnail {
            width: 100px;
            height: 70px;
            object-fit: cover;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s ease;
            opacity: 0.7;
            flex-shrink: 0;
        }

        .thumbnail:hover {
            opacity: 0.9;
            transform: scale(1.05);
        }

        .thumbnail.selected {
            opacity: 1;
            border: 3px solid #3498db;
            box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
        }

        .thumb-controls {
            display: flex;
            gap: 10px;
            margin-top: 15px;
            justify-content: center;
        }

        .thumb-btn {
            background-color: rgba(255, 255, 255, 0.9);
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            font-size: 18px;
            color: #2c3e50;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .thumb-btn:hover {
            background-color: #2c3e50;
            color: white;
        }

        .gallery-title {
            text-align: center;
            font-size: 2.5rem;
            color: #2c3e50;
            margin-bottom: 15px;
            font-weight: 700;
        }

        .gallery-subtitle {
            text-align: center;
            color: #7f8c8d;
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto 40px;
            line-height: 1.6;
        }

        .gallery-section {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 20px;
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        @media (max-width: 768px) {
            .gallery-title {
                font-size: 2rem;
            }

            #mainImage {
                height: 350px;
            }

            .arrow {
                width: 40px;
                height: 40px;
                font-size: 18px;
            }

            .centered {
                min-height: 350px;
            }
        }

        @media (max-width: 480px) {
            #mainImage {
                height: 250px;
            }

            .centered {
                min-height: 250px;
            }

            .thumbnail {
                width: 80px;
                height: 60px;
            }
        }

        .car-info-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 60%, transparent 100%);
            color: white;
            padding: 20px;
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 0 0 10px 10px;
            pointer-events: none;
        }

        .centered:hover .car-info-overlay {
            opacity: 1;
        }

        .car-title {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .car-price {
            font-size: 1.2rem;
            font-weight: bold;
            color: #3498db;
            margin-bottom: 10px;
        }

        .car-details {
            display: flex;
            justify-content: space-between;
            font-size: 0.9rem;
        }

        .view-details-btn {
            display: inline-block;
            background-color: #3498db;
            color: white;
            padding: 8px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 10px;
            transition: background-color 0.3s ease;
            pointer-events: auto;
            cursor: pointer;
        }

        .view-details-btn:hover {
            background-color: #2980b9;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        @media (max-width: 480px) {
            .modal {
                width: 40%;
                height: 100%;
            }
        }
        .modal.active {
            display: flex;
            opacity: 1;
        }

        .modal-content {
            background-color: white;
            border-radius: 10px;
            width: 90%;
            max-width: 700px;
            max-height: 90vh;
            overflow-y: auto;
            position: relative;
            transform: scale(0.9);
            transition: transform 0.3s ease;
        }

        .modal.active .modal-content {
            transform: scale(1);
        }

        .modal-header {
            padding: 20px;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .modal-body {
            padding: 20px;
        }

        .close-modal {
            background: none;
            border: none;
            font-size: 24px;
            cursor: pointer;
            color: #777;
        }

        .close-modal:hover {
            color: #333;
        }

        .car-specs {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 20px;
        }

        .spec-item {
            display: flex;
            align-items: center;
        }

        .spec-icon {
            width: 30px;
            height: 30px;
            background-color: #f3f4f6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
            color: #3498db;
        }
    </style>
    <div class="gallery-section">
        <h2 class="gallery-title">Car Gallery</h2>
        <p class="gallery-subtitle">Explore our premium collection of vehicles</p>

        <div class="imageContainer">
            <button id="prev" class="arrow left"><i class="fas fa-chevron-left"></i></button>

            <div class="centered">
                <img id="mainImage" src="images/01 (86).jpeg" alt="Main Image" />

                <div class="car-info-overlay">
                    <div class="car-title" id="carTitle">BMW X5</div>
                    <div class="car-details">
                        <span><i class="fas fa-calendar-alt mr-1"></i> <span id="carYear">2022</span></span>
                        <span><i class="fas fa-road mr-1"></i> <span id="carMileage">12,000 mi</span></span>
                        <span><i class="fas fa-gas-pump mr-1"></i> <span id="carFuel">Hybrid</span></span>
                    </div>
                    <button class="view-details-btn" id="viewDetailsBtn">View Details</button>
                </div>
            </div>

            <button id="next" class="arrow right"><i class="fas fa-chevron-right"></i></button>

            <div id="thumbnails">
            </div>

            <div class="thumb-controls">
                <button id="thumbPrev" class="thumb-btn"><i class="fas fa-chevron-left"></i></button>
                <button id="thumbNext" class="thumb-btn"><i class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal" id="carModal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="text-xl font-bold" id="modalCarTitle">Car Details</h2>
                <button class="close-modal" id="closeModal">&times;</button>
            </div>
            <div class="modal-body">
                <img src="" alt="" class="w-full h-64 object-cover rounded-lg mb-4" id="modalCarImage">
                <div class="car-specs">
                    <div class="spec-item">
                        <div class="spec-icon">
                            <i class="fas fa-tag"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Price</div>
                            <div class="font-semibold text-blue-600" id="modalCarPrice">$65,400</div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-icon">
                            <i class="fas fa-calendar-alt"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Year</div>
                            <div class="font-semibold" id="modalCarYear">2022</div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-icon">
                            <i class="fas fa-road"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Mileage</div>
                            <div class="font-semibold" id="modalCarMileage">12,000 mi</div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-icon">
                            <i class="fas fa-gas-pump"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Fuel Type</div>
                            <div class="font-semibold" id="modalCarFuel">Hybrid</div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-icon">
                            <i class="fas fa-cog"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Transmission</div>
                            <div class="font-semibold" id="modalCarTransmission">Automatic</div>
                        </div>
                    </div>
                    <div class="spec-item">
                        <div class="spec-icon">
                            <i class="fas fa-tachometer-alt"></i>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Engine</div>
                            <div class="font-semibold" id="modalCarEngine">3.0L V6</div>
                        </div>
                    </div>
                </div>
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">Description</h3>
                    <p id="modalCarDescription">Luxury SUV with premium features and advanced technology. The BMW X5 combines sporty performance with premium comfort. It features a spacious interior with high-quality materials, advanced technology including a digital dashboard and large infotainment screen, and a powerful yet efficient hybrid engine.</p>
                </div>
                <div class="mt-6">
                    <h3 class="text-lg font-semibold mb-2">Features</h3>
                    <ul class="list-disc list-inside" id="modalCarFeatures">
                        <li>Leather seats</li>
                        <li>Navigation system</li>
                        <li>Premium sound system</li>
                        <li>Panoramic sunroof</li>
                        <li>Heated seats</li>
                    </ul>
                </div>
                <button class="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-semibold mt-6">
                    <a href="#fleet">
                        <i class="fas fa-calendar-alt mr-2"></i> Schedule Test Drive
                    </a>
                </button>
            </div>
        </div>
    </div>

    {{-- <script>
        $(document).ready(function() {
            // Data comes from database table name : cars
            const cars = [
                @foreach($cars as $car)
                {
                    id: {{ $car->id }},
                    title: "{{ $car->make }} {{ $car->model }}",
                    image: "{{ $car->images->count() > 0 ? asset('storage/'.$car->images->first()->photo_path) : asset('default-image.jpg') }}",
                    thumb: "{{ $car->images->count() > 0 ? asset('storage/'.$car->images->first()->photo_path) : asset('default-image.jpg') }}",
                    // price: "${{ number_format($car->selling_price, 2) }}",
                    price: "Call For Price",
                    year: "{{ $car->manufacture_year }}",
                    mileage: "{{ number_format($car->mileage) }} mi",
                    fuel: "{{ $car->fuel_type }}",
                    description: "{{ $car->description }}",
                    features: [
                        @foreach(json_decode($car->features, true) ?? [] as $feature)
                            "{{ $feature }}",
                        @endforeach
                    ],
                    transmission: "{{ $car->transmission }}",
                    engine: "{{ $car->engine_capacity }}"
                },
                @endforeach
            ];

            // Get DOM elements
            const mainImage = $('#mainImage');
            const prevButton = $('#prev');
            const nextButton = $('#next');
            const thumbPrevButton = $('#thumbPrev');
            const thumbNextButton = $('#thumbNext');
            const thumbnailsContainer = $('#thumbnails');
            const carTitle = $('#carTitle');
            const carPrice = $('#carPrice');
            const carYear = $('#carYear');
            const carMileage = $('#carMileage');
            const carFuel = $('#carFuel');
            const viewDetailsBtn = $('#viewDetailsBtn');
            const modal = $('#carModal');
            const closeModal = $('#closeModal');

            let currentIndex = 0;

            // Generate thumbnails
            function generateThumbnails() {
                thumbnailsContainer.empty();

                cars.forEach((car, index) => {
                    const thumb = $('<img>')
                        .attr('src', car.thumb)
                        .attr('alt', car.title)
                        .attr('data-large', car.image)
                        .addClass('thumbnail')
                        .data('car-index', index);

                    if (index === 0) {
                        thumb.addClass('selected');
                    }

                    thumbnailsContainer.append(thumb);
                });
            }

            // Function to update main image
            function updateMainImage(index) {
                const car = cars[index];

                // Remove selected class from all thumbnails
                $('.thumbnail').removeClass('selected');

                // Add selected class to current thumbnail
                $(`.thumbnail[data-car-index=${index}]`).addClass('selected');

                // Update main image with fade effect
                mainImage.css('opacity', 0);

                setTimeout(() => {
                    mainImage.attr('src', car.image)
                             .attr('alt', car.title)
                             .css('opacity', 1);

                    // Update car info
                    carTitle.text(car.title);
                    carPrice.text(car.price);
                    carYear.text(car.year);
                    carMileage.text(car.mileage);
                    carFuel.text(car.fuel);
                    viewDetailsBtn.data('car-id', car.id);
                }, 300);

                // Scroll thumbnail into view
                const thumb = $(`.thumbnail[data-car-index=${index}]`)[0];
                if (thumb) {
                    thumb.scrollIntoView({
                        behavior: 'smooth',
                        block: 'nearest',
                        inline: 'center'
                    });
                }

                currentIndex = index;
            }

            // Function to update modal content
            function updateModalContent(carId) {
                const car = cars.find(c => c.id === carId);

                if (car) {
                    $('#modalCarTitle').text(car.title);
                    $('#modalCarImage').attr('src', car.image).attr('alt', car.title);
                    $('#modalCarPrice').text(car.price);
                    $('#modalCarYear').text(car.year);
                    $('#modalCarMileage').text(car.mileage);
                    $('#modalCarFuel').text(car.fuel);
                    $('#modalCarTransmission').text(car.transmission);
                    $('#modalCarEngine').text(car.engine);
                    $('#modalCarDescription').text(car.description);

                    // Update features list
                    const featuresList = $('#modalCarFeatures');
                    featuresList.empty();
                    car.features.forEach(feature => {
                        featuresList.append(`<li>${feature}</li>`);
                    });
                }
            }

            // Next image function
            function nextImage() {
                let nextIndex = currentIndex + 1;
                if (nextIndex >= cars.length) {
                    nextIndex = 0;
                }
                updateMainImage(nextIndex);
            }

            // Previous image function
            function prevImage() {
                let prevIndex = currentIndex - 1;
                if (prevIndex < 0) {
                    prevIndex = cars.length - 1;
                }
                updateMainImage(prevIndex);
            }

            // Set up event listeners
            nextButton.click(nextImage);
            prevButton.click(prevImage);

            thumbNextButton.click(function() {
                thumbnailsContainer.animate({ scrollLeft: '+=200' }, 300);
            });

            thumbPrevButton.click(function() {
                thumbnailsContainer.animate({ scrollLeft: '-=200' }, 300);
            });

            // Add click event to each thumbnail
            thumbnailsContainer.on('click', '.thumbnail', function() {
                const index = $(this).data('car-index');
                updateMainImage(index);
            });

            // View details button click
            viewDetailsBtn.click(function() {
                const carId = $(this).data('car-id');
                updateModalContent(carId);
                modal.addClass('active');
            });

            // Close modal button
            closeModal.click(function() {
                modal.removeClass('active');
            });

            // Close modal when clicking outside
            $(window).click(function(event) {
                if ($(event.target).is(modal)) {
                    modal.removeClass('active');
                }
            });

            // Keyboard navigation
            $(document).keydown(function(event) {
                if (event.key === 'ArrowRight') {
                    nextImage();
                } else if (event.key === 'ArrowLeft') {
                    prevImage();
                } else if (event.key === 'Escape') {
                    modal.removeClass('active');
                }
            });

            // Auto-play functionality (optional)
            let autoPlayInterval = setInterval(nextImage, 5000);

            // Pause auto-play when hovering over gallery
            $('.imageContainer').hover(
                function() {
                    clearInterval(autoPlayInterval);
                },
                function() {
                    autoPlayInterval = setInterval(nextImage, 5000);
                }
            );

            // Initialize the gallery
            generateThumbnails();
            updateMainImage(0);
        });
    </script> --}}
</section>
