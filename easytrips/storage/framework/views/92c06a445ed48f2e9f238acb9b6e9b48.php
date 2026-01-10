<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- Hero Section -->
    <section class="tours-hero">
        <div class="container">
           
                    <div class="hero-content">
                        <div class="row">
                            <div class="col-lg-7">
                            <h1 class="hero-title"><?php echo e(__('frontend.discover_amazing_tours')); ?></h1>
                            <p class="hero-subtitle"><?php echo e(__('frontend.explore_destinations_subtitle')); ?></p>
                            </div>
                            <div class="col-lg-5">
                            <div class="hero-search">
                            <form method="GET" action="<?php echo e(route('tours.list')); ?>" class="search-form">
                                <div class="search-input-group">
                                    <i class="fas fa-search search-icon"></i>
                                    <input type="text" name="keyword" placeholder="<?php echo e(__('frontend.search_tours_destinations')); ?>" value="<?php echo e(request('keyword')); ?>" class="search-input">
                                    <button type="submit" class="search-button">
                                        <span><?php echo e(__('frontend.search')); ?></span>
                                        <i class="fas fa-arrow-right"></i>
                                    </button>
                                </div>
                            </form>
                        </div> 
                            </div>
                        </div>
                       
                                                      
                    </div>
        </div>
    </section>

    <!-- Filters Section -->
    <section class="tours-filters-section d-none">
        <div class="container">
            <div class="filters-card">
              
                <div class="filters-body">
                    <form method="GET" action="<?php echo e(route('tours.list')); ?>" id="filterForm">
                        <div class="row g-3">                           
                            <div class="col-lg-4 col-md-6">
                                <div class="filter-group">
                                    <label class="filter-label"><?php echo e(__('frontend.tour_type')); ?></label>
                                    <select name="tour_type" class="filter-select">
                                        <option value=""><?php echo e(__('frontend.all_tour_types')); ?></option>
                                        <?php $__currentLoopData = $tourTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($type->id); ?>" <?php echo e(request('tour_type') == $type->id ? 'selected' : ''); ?>>
                                                <?php echo e($type->title); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="filter-group">
                                    <label class="filter-label"><?php echo e(__('frontend.departure_country')); ?></label>
                                    <select name="departure_country" class="filter-select">
                                        <option value=""><?php echo e(__('frontend.all_countries')); ?></option>
                                        <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($country->id); ?>" <?php echo e(request('departure_country') == $country->id ? 'selected' : ''); ?>>
                                                <?php echo e($country->name); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <div class="filter-group">
                                    <label class="filter-label"><?php echo e(__('frontend.sort_by')); ?></label>
                                    <select name="sort" class="filter-select">
                                        <option value="latest" <?php echo e(request('sort') == 'latest' ? 'selected' : ''); ?>><?php echo e(__('frontend.latest')); ?></option>
                                        <option value="price_low" <?php echo e(request('sort') == 'price_low' ? 'selected' : ''); ?>><?php echo e(__('frontend.price_low_to_high')); ?></option>
                                        <option value="price_high" <?php echo e(request('sort') == 'price_high' ? 'selected' : ''); ?>><?php echo e(__('frontend.price_high_to_low')); ?></option>
                                        <option value="duration_short" <?php echo e(request('sort') == 'duration_short' ? 'selected' : ''); ?>><?php echo e(__('frontend.duration_short')); ?></option>
                                        <option value="duration_long" <?php echo e(request('sort') == 'duration_long' ? 'selected' : ''); ?>><?php echo e(__('frontend.duration_long')); ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-2 col-md-6">
                                <div class="filter-group">
                                    <label class="filter-label">&nbsp;</label>
                                    <button type="submit" class="filter-button">
                                        <i class="fas fa-search"></i>
                                        <?php echo e(__('frontend.apply')); ?>

                                    </button>
                                </div>
                            </div>                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Tours Grid Section -->
    <section class="tours-grid-section">
        <div class="container">
            <!-- Results Header -->
            <div class="results-header">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <h2 class="results-title">
                            <i class="fas fa-map-marked-alt"></i>
                            <?php echo e(__('frontend.available_tours')); ?>

                        </h2>
                       
                    </div>
                    <div class="col-lg-6"> <p class="results-subtitle"><?php echo e(__('frontend.found_tours', ['count' => $tours->total()])); ?></p></div>
                </div>
            </div>

            <!-- Tours Grid -->
            <div class="tours-grid" id="toursGrid">
                <div class="row">
                    <?php $__empty_1 = true; $__currentLoopData = $tours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-xl-4 col-lg-6 col-md-6 mb-4">
                            <div class="tour-card">
                                <div class="tour-card-image">
                                <a href="<?php echo e(route('tour.detail', $tour->slug)); ?>" class="tour-image-link">
                                        <?php if($tour->image): ?>
                                            <img src="<?php echo e(asset('images/' . $tour->image)); ?>" alt="<?php echo e($tour->getTranslatedTitle()); ?>" class="tour-img">
                                        <?php else: ?>
                                            <img src="<?php echo e(asset('images/tour-placeholder.jpg')); ?>" alt="<?php echo e($tour->getTranslatedTitle()); ?>" class="tour-img">
                                        <?php endif; ?>
                                    </a>
                                    
                                    <!-- Tour Badges -->
                                    <div class="tour-badges">
                                        <?php if($tour->extra_field_3): ?>
                                            <span class="tour-badge tour-days-badge">
                                                <i class="fas fa-calendar-day"></i>
                                                <?php echo e($tour->getTranslatedExtraField(3)); ?> <?php echo e(__('frontend.days')); ?>

                                            </span>
                                        <?php endif; ?>
                                        <?php if($tour->departureCountry): ?>
                                            <span class="tour-badge tour-location-badge">
                                                <i class="fas fa-map-marker-alt"></i>
                                                <?php echo e($tour->departureCity->name ?? 'N/A'); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>

                                    <!-- Tour Type Badge -->
                                    <?php if($tour->tourType): ?>
                                        <div class="tour-type-badge">
                                            <span><?php echo e($tour->tourType->title); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                
                                <div class="tour-card-content">
                                    <div class="tour-card-header">
                                        <h3 class="tour-card-title">
                                            <a href="<?php echo e(route('tour.detail', $tour->slug)); ?>"><?php echo e($tour->getTranslatedTitle()); ?></a>
                                        </h3>
                                    </div>

                                    <div class="tour-card-meta">
                                        <?php if($tour->extra_field_1): ?>
                                            <div class="tour-meta-item">
                                                <i class="fas fa-calendar-alt"></i>
                                                <span><?php echo e(__('frontend.starts')); ?>: <?php echo e(date('d M Y', strtotime($tour->getTranslatedExtraField(1)))); ?></span>
                                            </div>
                                        <?php endif; ?>
                                        
                                        <?php if($tour->extra_field_2): ?>
                                            <div class="tour-meta-item">
                                                <i class="fas fa-calendar-check"></i>
                                                <span><?php echo e(__('frontend.ends')); ?>: <?php echo e(date('d M Y', strtotime($tour->getTranslatedExtraField(2)))); ?></span>
                                            </div>
                                        <?php endif; ?>

                                        <?php if($tour->extra_field_4): ?>
                                            <div class="tour-meta-item">
                                                <i class="fas fa-moon"></i>
                                                <span><?php echo e($tour->getTranslatedExtraField(4)); ?> <?php echo e(__('frontend.nights')); ?></span>
                                            </div>
                                        <?php endif; ?>
                                    </div>

                                    <div class="tour-card-footer">
                                        <div class="tour-price-section">
                                            <?php if($tour->extra_field_8): ?>
                                                <div class="tour-price">
                                                    <span class="price-amount"><?php echo e(\App\Helpers\CurrencyHelper::formatPrice($tour->getTranslatedExtraField(8))); ?></span>
                                                    <span class="price-unit"><?php echo e(__('frontend.per_person')); ?></span>
                                                </div>
                                            <?php else: ?>
                                                <div class="tour-price">
                                                    <span class="price-amount"><?php echo e(__('frontend.contact_for_price')); ?></span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        
                                        <div class="tour-actions">
                                            <a href="<?php echo e(route('tour.detail', $tour->slug)); ?>" class="tour-details-btn">
                                                <span><?php echo e(__('frontend.view_details')); ?></span>
                                                <i class="fas fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="col-12">
                            <div class="no-tours-found">
                                <div class="no-tours-content text-center py-5">
                                    <div class="no-tours-icon">
                                        <i class="fas fa-map-marked-alt"></i>
                                    </div>
                                    <h3 class="no-tours-title"><?php echo e(__('frontend.no_tours_found')); ?></h3>
                                    <p class="no-tours-message"><?php echo e(__('frontend.no_tours_found_message')); ?></p>
                                    <a href="<?php echo e(route('tours.list')); ?>" class="no-tours-button">
                                        <i class="fas fa-refresh"></i>
                                        <?php echo e(__('frontend.view_all_tours')); ?>

                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Pagination -->
            <?php if($tours->hasPages()): ?>
                <div class="pagination-section">
                    <div class="pagination-wrapper">
                        <nav aria-label="Tours pagination" class="pagination-nav">
                            <ul class="pagination">
                                <!-- Previous Page Link -->
                                <?php if($tours->onFirstPage()): ?>
                                    <li class="page-item disabled">
                                        <span class="page-link">
                                            <i class="fas fa-chevron-left"></i>
                                        </span>
                                    </li>
                                <?php else: ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo e($tours->previousPageUrl()); ?>" rel="prev">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </li>
                                <?php endif; ?>

                                <!-- Page Numbers -->
                                <?php $__currentLoopData = $tours->getUrlRange(1, $tours->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($page == $tours->currentPage()): ?>
                                        <li class="page-item active">
                                            <span class="page-link"><?php echo e($page); ?></span>
                                        </li>
                                    <?php else: ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                        </li>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                <!-- Next Page Link -->
                                <?php if($tours->hasMorePages()): ?>
                                    <li class="page-item">
                                        <a class="page-link" href="<?php echo e($tours->nextPageUrl()); ?>" rel="next">
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                <?php else: ?>
                                    <li class="page-item disabled">
                                        <span class="page-link">
                                            <i class="fas fa-chevron-right"></i>
                                        </span>
                                    </li>
                                <?php endif; ?>
                            </ul>
                        </nav>
                        
                        <!-- Page Info -->
                        <div class="page-info">
                            <p class="page-info-text">
                                <?php echo e(__('frontend.showing_tours', ['first' => $tours->firstItem() ?? 0, 'last' => $tours->lastItem() ?? 0, 'total' => $tours->total()])); ?>

                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>


    <?php $__env->startPush('js'); ?>
    <script>
        $(document).ready(function() {
            // Auto submit form when filters change
            $('#filterForm select').change(function() {
                $('#filterForm').submit();
            });

            // View options functionality
            $('.view-option').click(function() {
                $('.view-option').removeClass('active');
                $(this).addClass('active');
                
                const view = $(this).data('view');
                if (view === 'list') {
                    $('#toursGrid .row').addClass('list-view');
                } else {
                    $('#toursGrid .row').removeClass('list-view');
                }
            });

            // Smooth scroll for pagination
            $('.pagination a').click(function(e) {
                e.preventDefault();
                let url = $(this).attr('href');
                if (url) {
                    window.location.href = url;
                    $('html, body').animate({
                        scrollTop: $('.tours-grid-section').offset().top - 100
                    }, 500);
                }
            });

            // Add loading animation for form submission
            $('#filterForm').submit(function() {
                $('.filter-button').html('<i class="fas fa-spinner fa-spin"></i> <?php echo e(__('frontend.loading')); ?>');
            });
        });
    </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /home/icherrish.com/public_html/easytrips/resources/views/tours/index.blade.php ENDPATH**/ ?>