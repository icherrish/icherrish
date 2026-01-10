<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? (array) $attributes->getIterator() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag && $constructor = (new ReflectionClass(App\View\Components\AppLayout::class))->getConstructor()): ?>
<?php $attributes = $attributes->except(collect($constructor->getParameters())->map->getName()->all()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $widget = widget(31); ?>
    <?php $img = asset('images/' . $widget->extra_image_1); ?>
    <div id="home" class="parallax-section" style="background: url(<?php echo e($img); ?>) no-repeat;">
        <!--     <div class="overlay"></div>-->
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="slide-text">
                        <h1><?php echo e($widget->getTranslatedExtraField(1)); ?></h1>
                        <p><?php echo e($widget->getTranslatedDescription()); ?></p>
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab"
                                data-bs-target="#flightsearch" type="button" role="tab"
                                aria-controls="flight-tab-pane" aria-selected="true"><i class="fas fa-plane"></i>
                                <?php echo e(__('frontend.flights')); ?></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#hotelsearch"
                                type="button" role="tab" aria-controls="hotel-tab-pane" aria-selected="false"><i
                                    class="fas fa-hotel"></i> <?php echo e(__('frontend.hotels')); ?></button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link" id="profile-tab" href="<?php echo e(url('/tours')); ?>"><i
                                    class="fas fa-tree"></i> <?php echo e(__('frontend.tours')); ?></a>
                        </li>
                    </ul>
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="flightsearch" role="tabpanel"
                            aria-labelledby="flight-tab" tabindex="0">
                            <form action="<?php echo e(url('/flights/search')); ?>" method="GET">
                                <div class="searchintbox">
                                    <div class="tripetype" role="group">
                                        <input type="radio" class="btn-check" name="triptype" id="onewayflight"
                                            value="oneway" checked>
                                        <label class="btn btn-outline-primary" for="onewayflight"><?php echo e(__('frontend.one_way')); ?></label>
                                        <input type="radio" class="btn-check" name="triptype" id="twowayflight"
                                            value="twoway">
                                        <label class="btn btn-outline-primary" for="twowayflight"><?php echo e(__('frontend.round_trip')); ?></label>
                                        <input type="radio" class="btn-check" name="triptype" id="Multi-city"
                                            value="Multicity">
                                        <label class="btn btn-outline-primary" for="Multi-city"><?php echo e(__('frontend.multi_city')); ?></label>
                                    </div>
                                    <?php
                                        $slices = request('slices');
                                    ?>
                                    <div class="row single-city">
                                        <div class="col">
                                            <div class="mt-3">
                                                <label><?php echo e(__('frontend.from')); ?></label>
                                                <input type="text" class="form-control from_location"
                                                    name="slices[0][from_location]" id="from_location"
                                                    placeholder="<?php echo e(request('from_type') == 'code' ? 'e.g. LHR' : 'e.g. London'); ?>"
                                                    value="<?php echo e($slices[0]['from_location'] ?? ''); ?>">
                                                <input type="hidden" name="slices[0][from]" class="from_code"
                                                    id="from_code" value="<?php echo e($slices[0]['from'] ?? ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mt-3">
                                                <label><?php echo e(__('frontend.to')); ?></label>
                                                <input type="text" class="form-control to_location"
                                                    name="slices[0][to_location]" id="to_location"
                                                    placeholder="<?php echo e(request('to_type') == 'code' ? 'e.g. JFK' : 'e.g. New York'); ?>"
                                                    value="<?php echo e($slices[0]['to_location'] ?? ''); ?>">
                                                <input type="hidden" name="slices[0][to]" id="to_code"
                                                    class="to_code" value="<?php echo e($slices[0]['to'] ?? ''); ?>">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="mt-3">
                                                <label><?php echo e(__('frontend.travelling_on')); ?></label>
                                                <input type="text" name="slices[0][travelling_date]"
                                                    id="travelling_date" class="form-control travelling_date"
                                                    placeholder="<?php echo e(__('frontend.select_from_date')); ?>"
                                                    value="<?php echo e($slices[0]['travelling_date'] ?? ''); ?>"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="col-auto hidden-button"
                                            <?php if(request('triptype') != 'Multicity'): ?> style="display: none;" <?php endif; ?>>
                                            <div class="mt-3">
                                                <button type="button"
                                                    class="btn btn-outline-danger btn-sm remove-city w-100"
                                                    style="visibility: hidden;" title="Remove this city">
                                                    &times;
                                                </button>
                                            </div>
                                        </div>
                                        <div class="col return-date"
                                            <?php if(request('triptype') != 'twoway'): ?> style="display: none;" <?php endif; ?>>
                                            <div class="mt-3">
                                                <label><?php echo e(__('frontend.return')); ?></label>
                                                <input name="return_date" type="text" id="return_date"
                                                    class="form-control" placeholder="<?php echo e(__('frontend.select_return_date')); ?>"
                                                    value="<?php echo e(request('return_date')); ?>" autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="multiple-city">
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-3 mutiple-button me-auto" <?php if(request('triptype') != 'Multicity'): ?> style="display: none;" <?php endif; ?>>
                                           
                                                <div class="addmoreflight">
                                                    <button type="button" id="add-city" class="btn btn-sec">
                                                        <?php echo e(__('frontend.add_flight')); ?>

                                                    </button>
                                                </div>
                                           
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mt-3">
                                                <label><?php echo e(__('frontend.cabin_class')); ?></label>
                                                <select class="form-control" name="cabin_class">
                                                    <option value=""><?php echo e(__('frontend.any_class')); ?></option>
                                                    <option value="economy"
                                                        <?php echo e(request('cabin_class') == 'economy' ? 'selected' : ''); ?>>
                                                        <?php echo e(__('frontend.economy')); ?></option>
                                                    <option value="premium_economy"
                                                        <?php echo e(request('cabin_class') == 'premium_economy' ? 'selected' : ''); ?>>
                                                        <?php echo e(__('frontend.premium_economy')); ?></option>
                                                    <option value="business"
                                                        <?php echo e(request('cabin_class') == 'business' ? 'selected' : ''); ?>>
                                                        <?php echo e(__('frontend.business')); ?></option>
                                                    <option value="first"
                                                        <?php echo e(request('cabin_class') == 'first' ? 'selected' : ''); ?>>
                                                        <?php echo e(__('frontend.first_class')); ?></option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mt-3">
                                                <label><?php echo e(__('frontend.adults')); ?></label>
                                                <input type="number" class="form-control" name="adults"
                                                    min="1" max="9"
                                                    value="<?php echo e(request('adults', 1)); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="mt-3">
                                                <label><?php echo e(__('frontend.children')); ?></label>
                                                <input type="number" class="form-control" name="children"
                                                    min="0" max="9"
                                                    value="<?php echo e(request('children', 0)); ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-2 ms-auto text-right mt-3"><label>&nbsp;</label> <button
                                                class="btn btn-primary d-block w-100"><?php echo e(__('frontend.search')); ?>

                                            </button></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane fade" id="hotelsearch" role="tabpanel" aria-labelledby="hotel-tab"
                            tabindex="0">
                            <form method="get" action="<?php echo e(url('/hotels')); ?>">
                                <div class="searchintbox">
                                    <div class="row">
                                        <div class="col-lg-7">
                                            <div class="mb-3"><label for=""><?php echo e(__('frontend.destination')); ?></label><input
                                                    type="text" class="form-control" name="keyword"
                                                    placeholder="<?php echo e(__('frontend.destination_placeholder')); ?>"></div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="mb-3"><label for=""><?php echo e(__('frontend.when')); ?></label><input
                                                    type="date" class="form-control" name=""
                                                    placeholder="<?php echo e(__('frontend.when')); ?>"></div>
                                        </div>
                                        <div class="col-lg-2"><label for="">&nbsp;</label><button
                                                class="btn btn-sec w-100" type="submit"
                                                id="button-addon2"><?php echo e(__('frontend.search')); ?></button></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
    <!-- Top Destination Section -->
     <div class="container">
     <div class="fade-text">
                        <h3><?php echo e($widget->getTranslatedExtraField(2)); ?>

                            <a href="" class="typewrite" data-period="2000"
                                data-type='[ "<?php echo e($widget->getTranslatedExtraField(3)); ?>", "<?php echo e($widget->getTranslatedExtraField(4)); ?>", "<?php echo e($widget->getTranslatedExtraField(5)); ?>", "<?php echo e($widget->getTranslatedExtraField(6)); ?>" ]'>
                                <span class="wrap"></span> </a>
                        </h3>
                    </div>
     </div>
    <div class="parallax-section pt-5" id="places">
        <?php $widget = widget(7); ?>
        <div class="container">
            <div class="section-title">
                <h3><?php echo e($widget->getTranslatedExtraField(1)); ?></h3>
                <p><?php echo e($widget->getTranslatedDescription()); ?></p>
            </div>
            <div class="row topdesti">
                <?php if(null !== ($locations = module(19))): ?>
                    <?php $__currentLoopData = $locations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $location): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $num_hotels = App\Models\ModulesData::select('id')->where('extra_field_24', $location->id)->count(); ?>
                        <div class="col-lg-2 col-md-3 col-6">
                            <div class="destibox">
                                <a href="<?php echo e(url('/hotels?destination=' . $location->id)); ?>">
                                    <div class="destimg"><img src="<?php echo e(asset('images/' . $location->image)); ?>"
                                            alt=""></div>
                                    <h4><?php echo e($location->title); ?></h4>
                                    <p><?php echo e($num_hotels); ?> <?php echo e(__('frontend.listings')); ?></p>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php if(null !== ($arilines = moduleF(4))): ?>
        <!-- Popular Flights -->
        <div class="popflights pb-5">
            <div class="container">
                <div class="section-title">
                    <h3><?php echo e(__('frontend.popular_airlines')); ?></h3>
                    <p><?php echo e(__('frontend.popular_airlines_description')); ?></p>
                </div>
                <ul class="row topaircompany">
                    <?php $__currentLoopData = $arilines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $airline): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="col-lg-2 mb-3">
                            <div class="arilinebox">
                            <img src="<?php echo e(asset('images/' . $airline->image)); ?>">
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    <?php endif; ?>
    <!-- Widgets -->
    <div class="container pt-5">
        <div class="row">
            <div class="col-lg-6">
                <?php $widget = widget(5); ?>
                <?php $img = asset('images/' . $widget->extra_image_1); ?>
                <div class="hotelwidget" style="background: url(<?php echo e($img); ?>) no-repeat;">
                    <h2><?php echo e($widget->getTranslatedExtraField(1)); ?></h2>
                    <h3><?php echo e($widget->getTranslatedDescription()); ?></h3>
                    <a href="#" class="btn btn-sec"><?php echo e(__('frontend.book_now')); ?></a>
                </div>
            </div>
            <div class="col-lg-6">
                <?php $widget = widget(6); ?>
                <?php $img = asset('images/' . $widget->extra_image_1); ?>
                <div class="hotelwidget" style="background: url(<?php echo e($img); ?>) no-repeat;">
                    <h2><?php echo e($widget->getTranslatedExtraField(1)); ?></h2>
                    <h3><?php echo e($widget->getTranslatedDescription()); ?></h3>
                    <a href="#" class="btn btn-sec"><?php echo e(__('frontend.book_now')); ?></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Top Hotels Section -->
    <div class="parallax-section" id="places">
        <?php $widget = widget(4); ?>
        <div class="container">
            <div class="section-title">
                <h3><?php echo e($widget->getTranslatedExtraField(1)); ?></h3>
                <p><?php echo e($widget->getTranslatedDescription()); ?></p>
            </div>
            <div class="destinationList">
                <ul class="owl-carousel owl-theme hotelslist">
                    <?php if(null !== ($hotels = module(1))): ?>
                        <?php $__currentLoopData = $hotels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hotel): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="item">
                                <div class="locwrap">
                                    <div class="imgbox"><a href="<?php echo e(route('hotel.detail', $hotel->slug)); ?>"
                                            class="image-popup"><img src="<?php echo e(asset('images/' . $hotel->image)); ?>"
                                                alt=""></a></div>
                                    <h3><?php echo e($hotel->title); ?></h3>
                                    <?php
                                    $averageRating = $hotel->reviews()->avg('rating');
                                    $averageRating = number_format($averageRating, 1);
                                    ?>
                                    <div class="comprating">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <i
                                                class="fas fa-star <?php echo e($i <= $averageRating ? 'text-warning' : 'text-muted'); ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="location"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                        <?php echo e($hotel->extra_field_18); ?></div>
                                    <div class="prices">$<?php echo e($hotel->extra_field_1); ?></div>
                                    <div class="meta">
                                        <span title="Hotel Type"><i class="fa fa-hotel" aria-hidden="true"></i>
                                            <strong><?php echo e(title($hotel->extra_field_2)); ?></strong></span>
                                        <span title="People"><i class="fa fa-users" aria-hidden="true"></i>
                                            <strong><?php echo e($hotel->extra_field_11); ?></strong></span>
                                        <span title="Room Type"><i class="fa fa-star" aria-hidden="true"></i>
                                            <strong><?php echo e(title($hotel->extra_field_23)); ?></strong></span>
                                    </div>
                                    <a href="<?php echo e(route('hotel.detail', $hotel->slug)); ?>" class="btn btn-white"><?php echo e(__('frontend.view_details')); ?></a>
                                </div>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="text-center"><a href="<?php echo e(url('hotels')); ?>" class="btn btn-primary"><?php echo e(__('frontend.view_all_hotels')); ?></a></div>
        </div>
    </div>

    <div class="appwraper text-center">
        <div class="container">
            <img src="images/mobile-app.jpg" alt="Mobile App" class="rounded-4">
        </div>
    </div>

    <!-- Latest Tours Section -->
    <div class="parallax-section" id="latest-tours">
        <div class="container">
            <div class="section-title">
                <h3><?php echo e(__('frontend.latest_tours')); ?></h3>
                <p><?php echo e(__('frontend.discover_amazing_tours')); ?></p>
            </div>
            <div class="row">
                <?php if(null !== ($latestTours = \App\Models\ModulesData::where('module_id', 34)->where('status', 'active')->orderBy('created_at', 'desc')->limit(3)->get())): ?>
                    <?php $__currentLoopData = $latestTours; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                                            <a href="<?php echo e(route('tour.detail', $tour->slug)); ?>" class="btn btn-primary btn-sm">
                                                <?php echo e(__('frontend.view_details')); ?>

                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
            <div class="text-center">
                <a href="<?php echo e(url('tours')); ?>" class="btn btn-primary"><?php echo e(__('frontend.view_all_tours')); ?></a>
            </div>
        </div>
    </div>


   


    <!-- About section -->
    <div id="about">
        <div class="container">
            <div class="about-desc">
                <div class="row">
                    <div class="col-lg-7">
                        <?php $widget = widget(9); ?>
                        <?php $img = asset('images/' . $widget->extra_image_1); ?>
                        <div class="section-title">
                            <div class="subtitle"><?php echo e($widget->getTranslatedExtraField(2)); ?></div>
                            <h3><?php echo e($widget->getTranslatedExtraField(1)); ?></h3>
                        </div>
                        <?php echo $widget->getTranslatedDescription(); ?>

                    </div>
                    <div class="col-lg-5">
                        <div class="postimg"><img src="<?php echo e($img); ?>"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="parallax-section bg-grey">
        <div class="container">
            <ul class="circleList row">
                <li class="col-md-3 col-sm-4">
                    <?php $widget = widget(10); ?>
                    <div class="cricle"><?php echo $widget->getTranslatedExtraField(2); ?></div>
                    <div class="title"><?php echo e($widget->getTranslatedExtraField(1)); ?></div>
                    <p><?php echo $widget->getTranslatedDescription(); ?></p>
                </li>
                <li class="col-md-3 col-sm-4">
                    <?php $widget = widget(11); ?>
                    <div class="cricle"><?php echo $widget->getTranslatedExtraField(2); ?></div>
                    <div class="title"><?php echo e($widget->getTranslatedExtraField(1)); ?></div>
                    <p><?php echo $widget->getTranslatedDescription(); ?></p>
                </li>
                <li class="col-md-3 col-sm-4">
                    <?php $widget = widget(12); ?>
                    <div class="cricle"><?php echo $widget->getTranslatedExtraField(2); ?></div>
                    <div class="title"><?php echo e($widget->getTranslatedExtraField(1)); ?></div>
                    <p><?php echo $widget->getTranslatedDescription(); ?></p>
                </li>
                <li class="col-md-3 col-sm-4">
                    <?php $widget = widget(13); ?>
                    <div class="cricle"><?php echo $widget->getTranslatedExtraField(2); ?></div>
                    <div class="title"><?php echo e($widget->getTranslatedExtraField(1)); ?></div>
                    <p><?php echo $widget->getTranslatedDescription(); ?></p>
                </li>
            </ul>
        </div>
    </div>
    <!-- Search Filter -->
    <div class="searchfilter parallax-section pb-0">
        <div class="container">
            <div class="row">
                <?php if(null !== ($cities = toCities())): ?>
                    <div class="col-lg-6">
                        <h4><?php echo e(__('frontend.flights_to_top_cities')); ?></h4>
                        <ul class="row txtfilter">
                            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="col-lg-4"><a href="<?php echo e(url('/flights?to_location=' . $city)); ?>"><i
                                            class="fas fa-caret-right"></i> <?php echo e($city); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if(null !== ($countries = toCountries())): ?>
                    <div class="col-lg-6">
                        <h4><?php echo e(__('frontend.flights_by_top_countries')); ?></h4>
                        <ul class="row txtfilter">
                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="col-lg-4"><a href="<?php echo e(url('/flights?to_country=' . $key)); ?>"><i
                                            class="fas fa-caret-right"></i> <?php echo e($country); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>


    <div class="searchfilter parallax-section pt-4 pb-5">
        <div class="container">
            <div class="row">
                <?php if(null !== ($cities = toCitiesH())): ?>
                    <div class="col-lg-6">
                        <h4><?php echo e(__('frontend.hotels_to_top_cities')); ?></h4>
                        <ul class="row txtfilter">
                            <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="col-lg-4"><a href="<?php echo e(url('/hotels?searchlocation=' . $city)); ?>"><i
                                            class="fas fa-caret-right"></i> <?php echo e($city); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
                <?php if(null !== ($countries = toCountriesH())): ?>
                    <div class="col-lg-6">
                        <h4><?php echo e(__('frontend.hotels_to_top_countries')); ?></h4>
                        <ul class="row txtfilter">
                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="col-lg-4"><a href="<?php echo e(url('/hotels?location=' . $key)); ?>"><i
                                            class="fas fa-caret-right"></i> <?php echo e($country); ?></a></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Search Filter End -->
    <!-- Counter Section -->
    <div id="counter">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-6 counter-item">
                    <?php $widget = widget(14); ?>
                    <div class="counterbox">
                        <div class="counter-icon"><?php echo $widget->getTranslatedExtraField(2); ?></div>
                        <span class="counter-number" data-from="1" data-to="<?php echo e($widget->getTranslatedExtraField(1)); ?>"
                            data-speed="1000"></span> <span class="counter-text"><?php echo e(__('frontend.happy_client')); ?></span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 counter-item">
                    <?php $widget = widget(15); ?>
                    <div class="counterbox">
                        <div class="counter-icon"><?php echo $widget->getTranslatedExtraField(2); ?></div>
                        <span class="counter-number" data-from="1" data-to="<?php echo e($widget->getTranslatedExtraField(1)); ?>"
                            data-speed="1000"></span> <span class="counter-text"><?php echo e(__('frontend.cars')); ?></span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 counter-item">
                    <?php $widget = widget(16); ?>
                    <div class="counterbox">
                        <div class="counter-icon"><?php echo $widget->getTranslatedExtraField(2); ?></div>
                        <span class="counter-number" data-from="1" data-to="<?php echo e($widget->getTranslatedExtraField(1)); ?>"
                            data-speed="1000"></span> <span class="counter-text"><?php echo e(__('frontend.destinations')); ?></span>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-6 counter-item">
                    <?php $widget = widget(17); ?>
                    <div class="counterbox">
                        <div class="counter-icon"><?php echo $widget->getTranslatedExtraField(2); ?></div>
                        <span class="counter-number" data-from="1" data-to="<?php echo e($widget->getTranslatedExtraField(1)); ?>"
                            data-speed="1000"></span> <span class="counter-text"><?php echo e(__('frontend.awards')); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service 1 -->
    <?php $widget = widget(18); ?>
    <div class="homevideobox">
        <div class="ratio ratio-16x9">
            <iframe
                src="<?php echo e($widget->getTranslatedExtraField(2)); ?>?autoplay=1&loop=1&controls=0&mute=1&rel=0&modestbranding=1&playlist=<?php echo e(basename($widget->getTranslatedExtraField(2))); ?>"
                title="YouTube video" allow="autoplay" allowfullscreen>
            </iframe>
        </div>
        <div class="homevideocontent">
            <div class="container">
                <h3><?php echo e($widget->getTranslatedExtraField(1)); ?></h3>
                <p><?php echo e($widget->getTranslatedDescription()); ?></p>
            </div>
        </div>
    </div>
    <!-- Service Section -->
    <div id="service" class="parallax-section">
        <?php $widget = widget(19); ?>
        <div class="container">
            <div class="section-title">
                <h3><?php echo e($widget->getTranslatedExtraField(1)); ?></h3>
                <p><?php echo e($widget->getTranslatedDescription()); ?></p>
            </div>
            <div class="row">
                <!-- Service 1 -->
                <?php if(null !== ($services = module(28))): ?>
                    <?php $__currentLoopData = $services; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-4 col-sm-6">
                            <div class="service-thumb">
                                <div class="thumb-icon"><?php echo $service->extra_field_1; ?></div>
                                <h4><?php echo $service->title; ?></h4>
                                <p><?php echo Str::limit($service->description, 140); ?></p>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Tagline Section -->
    <div class="taglinewrap">
        <?php $widget = widget(20); ?>
        <div class="container">
            <h4><?php echo e($widget->getTranslatedExtraField(2)); ?></h4>
            <h2><?php echo e($widget->getTranslatedExtraField(1)); ?></h2>
            <p><?php echo e($widget->getTranslatedDescription()); ?> </p>
            <a href="<?php echo e(url('contact-us')); ?>"><?php echo e(__('frontend.contact_us')); ?> <i class="fas fa-long-arrow-right"></i></a>
        </div>
    </div>
    <!-- Team Section -->
    <div id="team" class="parallax-section">
        <?php $widget = widget(21); ?>
        <div class="container">
            <div class="section-title">
                <h3><?php echo e($widget->getTranslatedExtraField(1)); ?></h3>
                <p><?php echo e($widget->getTranslatedDescription()); ?></p>
            </div>
            <div class="row">
                <!-- team 1 -->
                <?php if(null !== ($team = module(30))): ?>
                    <?php $__currentLoopData = $team; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="team-thumb">
                                <div class="thumb-image"><img src="<?php echo e(asset('images/' . $member->image)); ?>"
                                        alt=""></div>
                                <h4><?php echo $member->title; ?></h4>
                                <h5><?php echo $member->extra_field_1; ?></h5>
                                <div class="contct"><i class="fas fa-phone-alt"></i> <?php echo $member->extra_field_2; ?></div>
                                <div class="contct"><i class="fas fa-envelope"></i> <?php echo $member->extra_field_3; ?></div>
                                <ul class="list-inline social">
                                    <li> <a href="<?php echo $member->extra_field_4; ?>" class="bg-twitter"><i
                                                class="fab fa-twitter"></i></a> </li>
                                    <li> <a href="<?php echo $member->extra_field_5; ?>" class="bg-facebook"><i
                                                class="fab fa-facebook-f"></i></a> </li>
                                    <li> <a href="<?php echo $member->extra_field_6; ?>" class="bg-linkedin"><i
                                                class="fab fa-linkedin-in"></i></a> </li>
                                </ul>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <!-- Testimonials Section -->
    <div id="testimonials">
        <div class="container">
            <!-- Section Title -->
            <div class="section-title">
                <h3><?php echo e(__('frontend.testimonials')); ?></h3>
            </div>
            <ul class="owl-carousel owl-theme testimonialsList">
                <!-- Client -->
                <?php if(null !== ($testimonials = module(31))): ?>
                    <?php $__currentLoopData = $testimonials; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li class="item">
                            <div class="testibox">
                                <div class="rating">
                                    <?php for($i = 1; $i <= intval(title($testimonial->extra_field_2)); $i++): ?>
                                        <i class="fa fa-star" aria-hidden="true"></i>
                                    <?php endfor; ?>
                                </div>
                                <p>"<?php echo strip_tags($testimonial->getTranslatedDescription()); ?>"</p>
                                <div class="clientname"><?php echo $testimonial->getTranslatedTitle(); ?></div>
                                <div class="clientinfo"><?php echo $testimonial->getTranslatedExtraField(1); ?></div>
                            </div>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>
    <!-- Blog Section -->
    <div class="hmblog parallax-section">
        <div class="container">
            <!-- SECTION TITLE -->
            <div class="section-title">
                <h3><?php echo e(__('frontend.latest_from_blog')); ?></h3>
                <p><?php echo e(__('frontend.latest_from_blog_description')); ?></p>
            </div>
            <div class="row">
                <?php if(null !== ($blogs = module(23))): ?>
                    <?php $__currentLoopData = $blogs->sortByDesc('created_at')->take(3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $service): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="col-lg-4">
                            <div class="subposts">
                                <div class="postimg">
                                    <img src="<?php echo e(asset('images/' . $service->image)); ?>">
                                </div>
                                <div class="postinfo">
                                    <h3>
                                        <a href="<?php echo e(route('blogs.detail', $service->slug)); ?>" class="pageLnks">
                                            <?php echo e($service->getTranslatedTitle()); ?>

                                        </a>
                                    </h3>
                                </div>
                                <div class="date">
                                    <?php echo e(date('d M Y', strtotime($service->created_at))); ?>

                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <?php $__env->startPush('js'); ?>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

        <script>
            function initDatepickers() {
                $('.travelling_date').each(function() {
                    // Prevent duplicate initialization
                    if (!$(this).hasClass('hasDatepicker')) {
                        $(this).datepicker({
                            dateFormat: 'yy-mm-dd',
                            minDate: 0
                        });
                    }
                });
            }

            function setupAutocomplete(inputSelector, codeSelector, typeSelector) {
                $(inputSelector).each(function() {
                    const $input = $(this);
                    const $code = $input.closest('.city-row, .single-city').find(codeSelector);
                    const $type = $(typeSelector); // or pass static value
                    $input.autocomplete({
                        source: function(request, response) {
                            const type = $type.val() || 'code';
                            $.ajax({
                                url: "<?php echo e(route('flights.search.airports')); ?>",
                                dataType: "json",
                                data: {
                                    query: request.term,
                                    type: type
                                },
                                success: function(data) {
                                    response(data);
                                }
                            });
                        },
                        minLength: 2,
                        select: function(event, ui) {
                            $input.val(ui.item.value);
                            $code.val(ui.item.code);
                            return false;
                        },
                        focus: function(event, ui) {
                            $input.val(ui.item.value);
                            return false;
                        }
                    });
                });
            }

            // --- ADDED LOGIC FOR DATE DEPENDENCIES ---
            function updateReturnMinDate() {
                let tripType = $('input[name="triptype"]:checked').val();
                let firstDate = $('.single-city .travelling_date').first().val();
                if (tripType === 'twoway' && firstDate) {
                    $('#return_date').datepicker('option', 'minDate', firstDate);
                } else {
                    $('#return_date').datepicker('option', 'minDate', 0);
                }
            }

            function updateMultiCityMinDates() {
                $('.multiple-city .single-city').each(function(index) {
                    if (index === 0) return; // skip the first, it's handled by main
                    let prevDate = $(this).prev('.single-city').find('.travelling_date').val();
                    let $currentDate = $(this).find('.travelling_date');
                    if (prevDate) {
                        $currentDate.datepicker('option', 'minDate', prevDate);
                    } else {
                        $currentDate.datepicker('option', 'minDate', 0);
                    }
                });
            }

            $(document).on('change', '.single-city .travelling_date', function() {
                updateReturnMinDate();
                updateMultiCityMinDates();
            });

            // Also call these after adding a new city
            $(document).on('click', '#add-city', function() {
                setTimeout(function() {
                    updateMultiCityMinDates();
                }, 100); // slight delay to ensure DOM is updated
            });

            // Call once on page load
            $(document).ready(function() {
                updateReturnMinDate();
                updateMultiCityMinDates();
            });
            // --- END ADDED LOGIC ---
        </script>

        <script>
            $(document).ready(function() {
                initDatepickers();
                setupAutocomplete('.from_location', '.from_code', '#from_type');
                setupAutocomplete('.to_location', '.to_code', '#to_type');
            });
            $(document).ready(function() {

                $('input[name="triptype"]').change(function() {
                    if ($(this).val() === 'twoway') {
                        $('.multiple-city').empty();
                        $(".mutiple-button,.hidden-button").hide();
                        $('.return-date').show();
                        $('#return_date').prop('required', true);
                    } else if ($(this).val() === 'oneway') {
                        $('.return-date').hide();
                        $(".mutiple-button,.hidden-button").hide();
                        $('.multiple-city').empty();
                        $('#return_date').prop('required', false);
                        $('#return_date').val('');
                    } else {
                        $(".mutiple-button,.hidden-button").show();
                        $('.return-date').hide();
                        $('#return_date').prop('required', false);
                        $('#return_date').val('');
                        if ($('.multiple-city .single-city').length === 0) {
                            addCityRow();
                        }
                    }
                });

                $('#return_date').datepicker({
                    dateFormat: 'yy-mm-dd',
                    minDate: 0
                });

                $('.select-flight-btn').click(function() {
                    const offerId = $(this).data('offer-id');
                    const origin = $(this).data('origin');
                    const destination = $(this).data('destination');
                    // Show loading state
                    $(this).html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <?php echo e(__('frontend.processing')); ?>'
                    );
                    $(this).prop('disabled', true);
                    // Store the location codes in session storage
                    sessionStorage.setItem('origin_code', origin);
                    sessionStorage.setItem('destination_code', destination);
                    // Redirect to booking form
                    window.location.href = "<?php echo e(route('flights.booking.form', '')); ?>/" + offerId;
                });
                // Form submission validation

                $('form').on('submit', function(e) {
                    e.preventDefault();

                    let form = $(this);
                    let hasError = false;


                    form.find('.text-danger.error-msg').remove();


                    form.find('.from_location:visible').each(function() {
                        let $input = $(this);
                        let fromCode = $input.closest('.single-city').find('.from_code').val();
                        if (!$input.val() || !fromCode) {
                            showError($input, '<?php echo e(__('frontend.please_select_valid_origin')); ?>');
                            hasError = true;
                        }
                    });


                    form.find('.to_location:visible').each(function() {
                        let $input = $(this);
                        let toCode = $input.closest('.single-city').find('.to_code').val();
                        if (!$input.val() || !toCode) {
                            showError($input, '<?php echo e(__('frontend.please_select_valid_destination')); ?>');
                            hasError = true;
                        }
                    });

                    let previousDate = null;

                    form.find('.travelling_date:visible').each(function() {
                        let $input = $(this);
                        let dateVal = $input.val();

                        if (!dateVal) {
                            showError($input, '<?php echo e(__('frontend.please_select_departure_date')); ?>');
                            hasError = true;
                            return;
                        }

                        let currentDate = new Date(dateVal);

                        if (previousDate !== null && currentDate < previousDate) {
                            showError($input, '<?php echo e(__('frontend.date_cannot_be_earlier')); ?>');
                            hasError = true;
                        }

                        previousDate = currentDate;
                    });



                    let tripType = $('input[name="triptype"]:checked').val();
                    let returnDateInput = $('#return_date');
                    if (tripType === 'twoway' && returnDateInput.is(':visible') && !returnDateInput.val()) {
                        showError(returnDateInput, '<?php echo e(__('frontend.please_select_return_date')); ?>');
                        hasError = true;
                    }

                    if (hasError) return false;


                    form.find('button[type="submit"]').html(
                        '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <?php echo e(__('frontend.searching')); ?>'
                    ).prop('disabled', true);

                    this.submit();

                    function showError($input, message) {
                        let errorDiv = $('<div class="text-danger mt-1 error-msg">' + message + '</div>');
                        $input.closest('.mt-3').append(errorDiv);
                    }
                });

                $(document).on('click', '#add-city', function() {
                    if ($('.single-city').length < 6) {
                        addCityRow();
                    }
                    checkFlightLimit();
                });

                $(document).on('click', '.remove-city', function() {
                    $(this).closest('.single-city').remove();
                    checkFlightLimit();
                });

                checkFlightLimit();
            });

            function addCityRow() {
                const sliceIndex = $('.multiple-city .single-city').length + 1;
                let new_html = `
            <div class="row single-city align-items-end">
            <div class="col-12"><h4 class="newflighttitle"><?php echo e(__('frontend.add_new_flight_details')); ?></h4></div>
                <div class="col">
                    <div class="mt-3">
                        <label>From</label>
                        <input type="text" class="form-control from_location" name="slices[${sliceIndex}][from_location]"
                            placeholder="e.g. London">
                        <input type="hidden" name="slices[${sliceIndex}][from]" class="from_code" value="">
                    </div>
                </div>
                <div class="col">
                    <div class="mt-3">
                        <label>To</label>
                        <input type="text" class="form-control to_location" name="slices[${sliceIndex}][to_location]"
                            placeholder="e.g. New York">
                        <input type="hidden" name="slices[${sliceIndex}][to]" class="to_code" value="">
                    </div>
                </div>
                <div class="col">
                    <div class="mt-3">
                        <label>Travelling On</label>
                        <input type="text" name="slices[${sliceIndex}][travelling_date]" class="form-control travelling_date"
                            placeholder="Select From Date" autocomplete="off">
                    </div>
                </div>
                <div class="col-auto">
                    <div class="mt-3">
                        <button type="button" class="btn btn-outline-danger btn-sm remove-city w-100" style="visibility: visible;"
                                                                                title="<?php echo e(__('frontend.remove_this_city')); ?>">
                            &times;
                        </button>
                    </div>
                </div>
            </div>`;

                $('.multiple-city').append(new_html);
                // Setup autocomplete for new fields
                initDatepickers();
                setupAutocomplete('.multiple-city .from_location:last', '.from_code:last', '#from_type');
                setupAutocomplete('.multiple-city .to_location:last', '.to_code:last', '#to_type');
            }

            function checkFlightLimit() {
                if ($('.single-city').length >= 6) {
                    $('#add-city').prop('disabled', true);
                } else {
                    $('#add-city').prop('disabled', false);
                }
            }
        </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /home/icherrish.com/public_html/easytrips/resources/views/welcome.blade.php ENDPATH**/ ?>