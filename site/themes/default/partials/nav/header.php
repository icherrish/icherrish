<link rel="stylesheet" id="theme-styles" type="text/css" href="https://icherrish.com/site/themes/default/assets/css/horizontals.css">

<link rel="stylesheet" id="theme-styles" type="text/css" href="https://icherrish.com/site/themes/default/assets/css/animations.css">

<link rel="stylesheet" id="theme-styles" type="text/css" href="https://icherrish.com/site/themes/default/assets/css/font-awesome.min.css">
<header class="site-navbar navbar-light" id="site-navbar">
  <div class="container">
    <div class="row">
      <div class="col-md-2 col-12 d-flex d-md-block px-md-4"><a class="navbar-brand navbar-logo py-0" href="<?= e_attr(base_uri()); ?>"> <img src="<?= e_attr(sp_logo_uri()); ?>" class="site-logo"></a>
        <div class="flex-1 text-right"> <button class="navbar-toggler d-md-none d-inline-block text-dark" type="button" data-action="offcanvas-open" data-target="#topnavbar" aria-controls="topnavbar" aria-expanded="false"> <span class="navbar-toggler-icon"></span> </button> </div>
      </div>
      <div class="col-md-7 col-12">
        <form method="get" action="<?= e_attr(url_for('site.search')); ?>" id="searchForm" class="home-search-box">
          <div class="input-group"> <input type="text" class="form-control" placeholder="<?= __('search-box-placeholder', _T); ?>" name="q" id="q" autocomplete="off" value="<?= e_attr($t['search_value']); ?>">
            <div class="input-group-append"> <button class="btn btn-primary" type="submit"><?= svg_icon('search', 'svg-md'); ?></button> </div>
          </div>
        </form>
      </div>
      <div class="col-md-3 text-right d-none d-md-block px-1"> <button class="navbar-toggler d-lg-none d-inline-block text-dark" type="button" data-action="offcanvas-open" data-target="#topnavbar" aria-controls="topnavbar" aria-expanded="false"> <span class="navbar-toggler-icon"></span> </button> <?php if (is_logged() && current_user_can('access_dashboard')) : ?> <a href="<?= e_attr(url_for('dashboard')); ?>" target="_blank" class="btn btn-outline-dark"> <?= svg_icon('analytics'); ?> <?= __('Dashboard', _T); ?> </a> <?php endif; ?> </div>
    </div>
     <?php if (!empty($_REQUEST['menu'])) : ?> <!-- New Navigation -->
     <!-- Container Begin --->
            <div id="gp_nav">
                <!-- Navbar Begin -->
                <nav class="navbar navbar-expand-md navbar-dark bg-primary horizontal-menu" id="navbar"
                    role="navigation">
                    <a class="navbar-brand" href="#"><i class="fa fa-home white-clr"></i></a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#defaultmenu"
                        aria-controls="defaultmenu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div id="defaultmenu" class="collapse navbar-collapse">
                        <!-- animated Parent start -->
                        <div class="animatedParent w-100">
                            <ul class="navbar-nav mr-auto">
                                <!-- Navbar Collapse Begin -->
                                <li class="nav-item">
                                    <a href="#" class="nav-link" data-toggle="dropdown"><i
                                            class="fa fa-calendar white"></i> About Us</a>
                                </li>

                                <!-- mega menu -->
                                <!-- List Elements Begin -->
                                <li class="nav-item dropdown horizontal-menu-fw">
                                    <a href="#" class="nav-link dropdown-toggle" id="mmProducts" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-cube white"></i> Our Product
                                    </a>
                                    <ul class="dropdown-menu animated fadeInDownShort go" aria-labelledby="mmProducts">
                                        <li class="grid-demo" id="hover-effect">
                                            <div class="row no-gutters">
                                                <div class="col-md-2 col-sm-4">
                                                    <h3 class="title text-left">Electronic</h3>
                                                    <ul>
                                                        <li><a href="#">Laptop</a></li>
                                                        <li><a href="#">Vaccume Machine</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-2 col-sm-4">
                                                    <h3 class="title text-left">Cloths</h3>
                                                    <ul>
                                                        <li><a href="#">Mens Cloths</a></li>
                                                        <li><a href="#">Woman Cloths</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Elements List End -->

                                <!-- Elements List Begin -->
                                <li class="nav-item dropdown horizontal-menu-fw">
                                    <a href="#" class="nav-link dropdown-toggle" id="mmBrands" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-crosshairs white"></i> Brand Stores
                                    </a>
                                    <ul class="dropdown-menu half animated fadeInDownShort go"
                                        aria-labelledby="mmBrands">
                                        <li class="horizontal-menu-content withoutdesc">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="mar-top-bot d-flex flex-wrap">
                                                            <div class="col-md-3 col-sm-6">
                                                                <!-- card instead of thumbnail -->
                                                                <div class="card">
                                                                    <img class="card-img-top img-fluid"
                                                                        src="http://via.placeholder.com/400x400" alt="">
                                                                    <div class="card-body">
                                                                        <p class="pro-title"><a href="#">Pavilion Core
                                                                                i5 6th Gen Laptop</a></p>
                                                                        <ul class="list-inline" id="product-list">
                                                                            <li class="list-inline-item">$2,580</li>
                                                                            <li class="list-inline-item"><s>$4,699</s>
                                                                            </li>
                                                                            <li class="list-inline-item"><span
                                                                                    class="txt-green">45% Off</span>
                                                                            </li>
                                                                            <a class="btn btn-warning btn-sm brand-btn"
                                                                                href="#">Buy Now</a>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 col-sm-6">
                                                                <div class="card">
                                                                    <img class="card-img-top img-fluid"
                                                                        src="http://via.placeholder.com/400x400" alt="">
                                                                    <div class="card-body">
                                                                        <p class="pro-title"><a href="#">Goldan
                                                                                30460LMGY Black</a></p>
                                                                        <ul class="list-inline" id="product-list">
                                                                            <li class="list-inline-item">$5,670</li>
                                                                            <li class="list-inline-item"><s>$4,349</s>
                                                                            </li>
                                                                            <li class="list-inline-item"><span
                                                                                    class="txt-green">80% Off</span>
                                                                            </li>
                                                                            <a class="btn btn-warning btn-sm brand-btn"
                                                                                href="#">Buy Now</a>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div><!-- /.mar-top-bot -->
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Elements List End -->

                                <!-- Grid Begin -->
                                <li class="nav-item dropdown horizontal-menu-fw">
                                    <a href="#" class="nav-link dropdown-toggle" id="mmItems" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-external-link-square white"></i> Item List
                                    </a>
                                    <ul class="dropdown-menu animated fadeInDownShort go" aria-labelledby="mmItems">
                                        <li class="px-3 py-2">
                                            <div class="col-md-12">
                                                <!-- Tabs -->
                                                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" id="smart-tab" data-toggle="tab"
                                                            href="#smart" role="tab" aria-controls="smart"
                                                            aria-selected="true">Smart Phone</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="dslr-tab" data-toggle="tab" href="#dslr"
                                                            role="tab" aria-controls="dslr" aria-selected="false">DSLR
                                                            Camera</a>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" id="computer-tab" data-toggle="tab"
                                                            href="#computer" role="tab" aria-controls="computer"
                                                            aria-selected="false">Computers</a>
                                                    </li>
                                                </ul>

                                                <div id="myTabContent" class="tab-content">
                                                    <div role="tabpanel" class="tab-pane fade show active" id="smart"
                                                        aria-labelledby="smart-tab">
                                                        <div class="row">
                                                            <div class="col-6 col-md-2 col-sm-4">
                                                                <ul class="tab-pad">
                                                                    <li><a href="#" class="hvr-sweep-to-right">Canon</a>
                                                                    </li>
                                                                    <li><a href="#" class="hvr-sweep-to-right">Sony</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-6 col-md-2 col-sm-4">
                                                                <ul class="tab-pad">
                                                                    <li><a href="#" class="hvr-sweep-to-right">Magic
                                                                            Phone</a></li>
                                                                    <li><a href="#" class="hvr-sweep-to-right">Videocon
                                                                            LCD</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div role="tabpanel" class="tab-pane fade" id="dslr"
                                                        aria-labelledby="dslr-tab">
                                                        <div class="row">
                                                            <div class="col-6 col-md-2 col-sm-4">
                                                                <ul class="tab-pad">
                                                                    <div align="left"><span
                                                                            class="strip">Televisions</span></div>
                                                                    <li><a href="#" class="hvr-sweep-to-right">Canon</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-6 col-md-2 col-sm-4">
                                                                <ul class="tab-pad">
                                                                    <div align="left"><span class="strip">LCD Smart
                                                                            TV</span></div>
                                                                    <li><a href="#" class="hvr-sweep-to-right">Magic
                                                                            Phone</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div role="tabpanel" class="tab-pane fade" id="computer"
                                                        aria-labelledby="computer-tab">
                                                        <div class="row">
                                                            <div class="col-6 col-md-2 col-sm-4">
                                                                <ul class="tab-pad">
                                                                    <div align="left"><span
                                                                            class="strip">Televisions</span></div>
                                                                    <li><a href="#" class="hvr-sweep-to-right">Canon</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-6 col-md-2 col-sm-4">
                                                                <ul class="tab-pad">
                                                                    <div align="left"><span class="strip">LCD Smart
                                                                            TV</span></div>
                                                                    <li><a href="#" class="hvr-sweep-to-right">Magic
                                                                            Phone</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div><!-- /tab-content -->
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <!-- Grid View End -->

                                <!-- Go Quick Begin -->
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" id="mmQuick" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-indent white"></i> Go Quick
                                    </a>
                                    <ul class="dropdown-menu brd-bttom animated fadeInDownShort go" role="menu"
                                        aria-labelledby="mmQuick">
                                        <li><a class="dropdown-item hvr-sweep-to-right" href="#">Tablets</a></li>
                                        <li><a class="dropdown-item hvr-sweep-to-right" href="#">Sports</a></li>
                                        <li><a class="dropdown-item hvr-sweep-to-right" href="#">Cameras</a></li>

                                        <!-- dropdown-submenu (custom) -->
                                        <li class="dropdown-submenu">
                                            <a href="#" class="dropdown-item hvr-sweep-to-right">Air Fryers</a>
                                            <ul class="dropdown-menu">
                                                <li class="dropdown-submenu">
                                                    <a href="#" class="dropdown-item">Headphones</a>
                                                    <ul class="dropdown-menu">
                                                        <li><a href="#"
                                                                class="dropdown-item hvr-sweep-to-right">Laptops</a>
                                                        </li>
                                                        <li><a href="#"
                                                                class="dropdown-item hvr-sweep-to-right">Cameras</a>
                                                        </li>
                                                    </ul>
                                                </li>
                                                <li><a href="#" class="dropdown-item hvr-sweep-to-right">Washing
                                                        Machines</a></li>
                                                <li><a href="#" class="dropdown-item hvr-sweep-to-right">Gourmet
                                                        Foods</a></li>
                                                <li><a href="#" class="dropdown-item hvr-sweep-to-right">Mobiles</a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown horizontal-menu-fw">
                                    <a href="#" class="nav-link dropdown-toggle" id="mmProduct" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-align-right white"></i> Product
                                    </a>
                                    <ul class="dropdown-menu animated fadeInDownShort go" aria-labelledby="mmProduct">
                                        <li class="grid-demo">
                                            <div class="row">
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="card">
                                                        <div id="effect-2" class="effects clearfix">
                                                            <div class="img">
                                                                <img class="card-img-top img-fluid"
                                                                    src="http://via.placeholder.com/400x400" alt="">
                                                                <div class="overlay">
                                                                    <p class="overlay-txt">Best Smart Laptop</p>
                                                                    <p class="overlay-txt">Price: $850</p>
                                                                    <a href="#" class="btn btn-primary btn-sm">Buy
                                                                        Now</a>
                                                                    <ul class="list-inline" id="rating">
                                                                        <li class="list-inline-item"><i
                                                                                class="fa fa-star"></i></li>
                                                                        <li class="list-inline-item"><i
                                                                                class="fa fa-star"></i></li>
                                                                    </ul>
                                                                    <ul class="list-inline" id="social">
                                                                        <li class="list-inline-item"><a href="#"><i
                                                                                    class="fa fa-facebook-square fa-2x"></i></a>
                                                                        </li>
                                                                        <li class="list-inline-item"><a href="#"><i
                                                                                    class="fa fa-twitter-square fa-2x"></i></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div><!-- /.card -->
                                                </div>

                                                <div class="col-md-3 col-sm-6">
                                                    <div class="card">
                                                        <div id="effect-2" class="effects clearfix">
                                                            <div class="img">
                                                                <img class="card-img-top img-fluid"
                                                                    src="http://via.placeholder.com/400x400" alt="">
                                                                <div class="overlay">
                                                                    <p class="overlay-txt">Sports Smart Watch</p>
                                                                    <p class="overlay-txt">Price: $750</p>
                                                                    <a href="#" class="btn btn-primary btn-sm">Buy
                                                                        Now</a>
                                                                    <ul class="list-inline" id="rating">
                                                                        <li class="list-inline-item"><i
                                                                                class="fa fa-star"></i></li>
                                                                        <li class="list-inline-item"><i
                                                                                class="fa fa-star-o"></i></li>
                                                                    </ul>
                                                                    <ul class="list-inline" id="social">
                                                                        <li class="list-inline-item"><a href="#"><i
                                                                                    class="fa fa-facebook-square fa-2x"></i></a>
                                                                        </li>
                                                                        <li class="list-inline-item"><a href="#"><i
                                                                                    class="fa fa-twitter-square fa-2x"></i></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-sm-6">
                                                    <div class="card">
                                                        <div id="effect-2" class="effects clearfix">
                                                            <div class="img">
                                                                <img class="card-img-top img-fluid"
                                                                    src="http://via.placeholder.com/400x400" alt="">
                                                                <div class="overlay">
                                                                    <p class="overlay-txt">Super Headphone Black</p>
                                                                    <p class="overlay-txt">Price: $1050</p>
                                                                    <a href="#" class="btn btn-primary btn-sm">Buy
                                                                        Now</a>
                                                                    <ul class="list-inline" id="rating">
                                                                        <li class="list-inline-item"><i
                                                                                class="fa fa-star"></i></li>
                                                                        <li class="list-inline-item"><i
                                                                                class="fa fa-star"></i></li>
                                                                    </ul>
                                                                    <ul class="list-inline" id="social">
                                                                        <li class="list-inline-item"><a href="#"><i
                                                                                    class="fa fa-facebook-square fa-2x"></i></a>
                                                                        </li>
                                                                        <li class="list-inline-item"><a href="#"><i
                                                                                    class="fa fa-twitter-square fa-2x"></i></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-3 col-sm-6">
                                                    <div class="card">
                                                        <div id="effect-2" class="effects clearfix">
                                                            <div class="img">
                                                                <img class="card-img-top img-fluid"
                                                                    src="http://via.placeholder.com/400x400" alt="">
                                                                <div class="overlay">
                                                                    <p class="overlay-txt">DSLR HD Camera</p>
                                                                    <p class="overlay-txt">Price: $450</p>
                                                                    <a href="#" class="btn btn-primary btn-sm">Buy
                                                                        Now</a>
                                                                    <ul class="list-inline" id="rating">
                                                                        <li class="list-inline-item"><i
                                                                                class="fa fa-star"></i></li>
                                                                        <li class="list-inline-item"><i
                                                                                class="fa fa-star-o"></i></li>
                                                                    </ul>
                                                                    <ul class="list-inline" id="social">
                                                                        <li class="list-inline-item"><a href="#"><i
                                                                                    class="fa fa-facebook-square fa-2x"></i></a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div><!-- /.row -->
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown horizontal-menu-fw">
                                    <a href="#" class="nav-link dropdown-toggle" id="mmOffer" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-gift white"></i> Offer
                                    </a>
                                    <ul class="dropdown-menu animated fadeInDownShort go" aria-labelledby="mmOffer">
                                        <li class="grid-demo" id="hover-effect">
                                            <div class="row no-gutters">
                                                <div class="col-md-2 col-sm-4">
                                                    <h3 class="title text-left">Electronic</h3>
                                                    <ul>
                                                        <li><a href="#">Laptop</a><span class="new-tag"></span></li>
                                                        <li><a href="#">Vaccume Machine</a></li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-2 col-sm-4">
                                                    <h3 class="title text-left">Cloths</h3>
                                                    <ul>
                                                        <li><a href="#">Samsung mobile</a></li>
                                                        <li><a href="#">Nokia Mobile</a><span class="new-tag"></span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>

                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" id="mmSports" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-life-ring white"></i> Sports
                                    </a>
                                    <ul class="dropdown-menu brd-bttom animated fadeInDownShort go" role="menu"
                                        aria-labelledby="mmSports">
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-angle-right"></i> Table
                                                Tennis</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-angle-right"></i>
                                                Tennis</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-angle-right"></i>
                                                Boxing</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="fa fa-angle-right"></i>
                                                Skating</a></li>
                                    </ul>
                                </li>

                                <!-- Search Box -->
                                <li class="nav-item dropdown">
                                    <a href="#" class="nav-link dropdown-toggle" id="mmSearch" data-toggle="dropdown"
                                        aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-search-plus white"></i> Search
                                    </a>
                                    <div class="dropdown-menu left-side animated fadeInDownShort go p-3"
                                        aria-labelledby="mmSearch">
                                        <form id="contact1" action="#" name="contactform" method="post">
                                            <div class="form-group mb-0 position-relative">
                                                <input type="text" name="name" id="name1" class="form-control searchbox"
                                                    placeholder="Search here...">
                                                <span id="search"><a href="#"><i class="fa fa-search"></i></a></span>
                                            </div>
                                        </form>
                                    </div>
                                </li>
                                <!-- Search Box End -->
                            </ul>
 
                        </div>
                    </div>
                </nav>
                <!-- Horizontal Navbar End -->
            </div>
    <?php endif; ?>
    
  </div>
</header> <!-- Mobile Nav -->
<nav class="navbar-light position-absolute" style="top:-9999999rem">
  <div class="navbar-collapse offcanvas-collapse" id="topnavbar"> <button data-action="offcanvas-close" data-target="#topnavbar" class="btn btn-link close d-lg-none">&times;</button>
    <h6 class="dropdown-header font-weight-600 d-lg-none px-0 mb-2"><?= __('site-menu', _T); ?></h6>
    <ul class="nav navbar-categories flex-column">
      <li class="nav-item"> <a class="nav-link <?= e_attr($t["home_active"]); ?>" href="<?= e_attr(url_for('site.home')); ?>"> <?= svg_icon('paper', 'mr-1'); ?> <?= __('category-label-everything', _T); ?> </a> </li> <?php foreach ($t['categories'] as $category) : ?> <li class="nav-item"> <a class="nav-link <?= e_attr($t["{$category['category_id']}_active"]); ?>" href="<?= e_attr(url_for('site.category', ['slug' => $category['category_slug']])); ?>"> <img src="<?= e_attr(category_icon_url($category['category_icon'])); ?>" class="category-icon mr-1"> <?= e(__("category-label-{$category['category_slug']}", _T, ['defaultValue' => $category['category_name']])); ?> </a> </li> <?php endforeach; ?>
    </ul>
  </div>
</nav>