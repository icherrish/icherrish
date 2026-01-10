<nav class="topnav navbar navbar-expand shadow justify-content-between justify-content-sm-start navbar-light bg-white" id="sidenavAccordion">
    <!-- Sidenav Toggle Button-->
    <button class="btn btn-icon btn-transparent-dark order-1 order-lg-0 me-2 ms-lg-2 me-lg-0 d-none" id="sidebarToggle"><i data-feather="menu"></i></button>
    <!-- Navbar Brand-->
    <!-- * * Tip * * You can use text or an image for your navbar brand.-->
    <!-- * * * * * * When using an image, we recommend the SVG format.-->
    <!-- * * * * * * Dimensions: Maximum height: 32px, maximum width: 240px-->
    <a class="navbar-brand pe-3 ps-4 ps-lg-2" href="<?php echo e(route('admin.dashboard')); ?>"><img src="<?php echo e(asset('images/'.widget(1)->extra_image_1)); ?>"></a>
    <!-- Navbar Search Input-->
    <!-- * * Note: * * Visible only on and above the lg breakpoint-->
    <style>
    .truncate{
        font-size: 14px;
        font-weight: 400;
        color: #000;
        text-decoration: none;
        text-underline-offset: unset;
    }
    
    </style>
    <!-- Navbar Items-->
    <ul class="navbar-nav align-items-center ms-auto">
        
        <!-- Navbar Search Dropdown-->
        <!-- * * Note: * * Visible only below the lg breakpoint-->
        <li class="nav-item dropdown no-caret me-3 d-lg-none">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="searchDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="search"></i></a>
            <!-- Dropdown - Search-->
            <div class="dropdown-menu dropdown-menu-end p-3 shadow animated--fade-in-up" aria-labelledby="searchDropdown">
                <form class="form-inline me-auto w-100">
                    <div class="input-group input-group-joined input-group-solid">
                        <input class="form-control pe-0" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                        <div class="input-group-text"><i data-feather="search"></i></div>
                    </div>
                </form>
            </div>
        </li>
       
        <!-- Messages Dropdown-->
        <li class="nav-item dropdown no-caret d-none d-sm-block me-3 dropdown-notifications">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownMessages" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i data-feather="mail"></i></a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownMessages">
                <h6 class="dropdown-header dropdown-notifications-header">
                    <i class="fas fa-envelope me-2"></i>
                    Message Center
                </h6>
                <!-- Example Message 1  -->
               
               
                <!-- Footer Link-->
                <a class="dropdown-item dropdown-notifications-footer" href="<?php echo e(route('admin.contact-us-messages')); ?>">Read All Messages</a>
            </div>
        </li>
        <!-- User Dropdown-->
        
        <li class="nav-item dropdown no-caret dropdown-user me-3 me-lg-4">
            <a class="btn btn-icon btn-transparent-dark dropdown-toggle" id="navbarDropdownUserImage" href="javascript:void(0);" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <!-- __BLOCK__ --><?php if(Laravel\Jetstream\Jetstream::managesProfilePhotos()): ?>

                <img class="img-fluid" src="<?php echo e(Auth::user()->profile_photo_url); ?>" />

                <?php else: ?>

                <?php echo e(Auth::user()->name[0]); ?>


                <?php endif; ?> <!-- __ENDBLOCK__ -->

            </a>
            <div class="dropdown-menu dropdown-menu-end border-0 shadow animated--fade-in-up" aria-labelledby="navbarDropdownUserImage">
                <h6 class="dropdown-header d-flex align-items-center">
                    <!-- __BLOCK__ --><?php if(Laravel\Jetstream\Jetstream::managesProfilePhotos()): ?>

                    <img class="h-8 w-8 rounded-full object-cover" src="<?php echo e(Auth::user()->profile_photo_url); ?>" alt="<?php echo e(Auth::user()->name); ?>" />

                    <?php endif; ?> <!-- __ENDBLOCK__ -->
                    <div class="dropdown-user-details">
                        <div class="dropdown-user-details-name"><?php echo e(Auth::user()->name); ?></div>
                        <div class="dropdown-user-details-email"><?php echo e(Auth::user()->email); ?></div>
                    </div>
                </h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="<?php echo e(route('profile.show')); ?>">
                    <div class="dropdown-item-icon"><i data-feather="settings"></i></div>
                    Account
                </a>
                <a class="dropdown-item" href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <div class="dropdown-item-icon"><i data-feather="log-out"></i></div>
                    Logout
                </a>
                <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                    <?php echo csrf_field(); ?>
                </form>
            </div>
        </li>
    </ul>
</nav><?php /**PATH /home/icherrish.com/public_html/easytrips/resources/views/livewire/admin/common/navbar.blade.php ENDPATH**/ ?>