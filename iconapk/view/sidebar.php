<?php
require_once("../configuration/connection.php");

$active = "";
$active_submenu = "";
if (isset($_GET['page'])) {
    $action = $_GET['page'];
    $url = explode("_", $action);
    
    if (count($url) == 1) {
        $active = $url[0];
        $active_submenu = $url[0] . "_list";
    } else {
        $active = $url[0];
        $active_submenu = $url[0] . "_" . $url[1];
    }
} else {
    $active = "";
}

    $query = "SELECT * FROM `app_settings` WHERE `key` = 'appconfiguration'";
    
    $result = mysqli_query($mysqli,$query) or die(mysqli_error($mysqli));
    
    if(mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_array($result);
        $value = json_decode($row['value']);
    }else{
        $value = null;
    }

?>

<div class="mm-sidebar  sidebar-default ">
    <div class="mm-sidebar-logo d-flex align-items-center justify-content-between">
        <a href="./index.php" class="header-logo">
            <img src="../assets/images/logo.png" class="img-fluid rounded-normal light-logo" alt="logo">
            <img src="../assets/images/dark-logo.png" class="img-fluid mode dark-img rounded-normal darkmode-logo" alt="dark-logo">
        </a>
        <div class="side-menu-bt-sidebar">
            <i class="las la-bars wrapper-menu"></i>
        </div>
    </div>
    <div class="data-scrollbar" data-scroll="1">
        <nav class="mm-sidebar-menu">
            <ul id="mm-sidebar-toggle" class="side-menu">
                <li class="<?= $active === '' ? 'active' : '' ?>">
                    <a href="../view/index.php" class="svg-icon">
                        <i class="">
                        <svg class="svg-icon" id="mm-dash" width="20" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                            </svg>
                        </i><span class="">Dashboard</span>
                    </a>
                </li>
                <li class="<?= $active === 'appconfiguration' ? 'active' : '' ?>">
                    <a href="../view/index.php?page=appconfiguration" class="svg-icon">
                        <i class="">
                            <svg class="svg-icon" id="mm-app-1" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                        </i><span class="">App Configuration</span>
                    </a>
                </li>
                <li class="<?= $active === 'admob' ? 'active' : '' ?>">
                    <a href="../view/index.php?page=admob" class="svg-icon">
                        <i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" id="mm-addmob" class="svg-icon" viewBox="0 0 24 24" stroke-width="2" 
                                stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <rect x="3" y="5" width="18" height="14" rx="2" />
                                <path d="M7 15v-4a2 2 0 0 1 4 0v4" />
                                <line x1="7" y1="13" x2="11" y2="13" />
                                <path d="M17 9v6h-1.5a1.5 1.5 0 1 1 1.5 -1.5" />
                            </svg>
                        </i><span class="">Ads Configuration</span>
                    </a>
                </li>
                <li class="<?= $active === 'progressbar' ? 'active' : '' ?>">
                    <a href="../view/index.php?page=progressbar" class="svg-icon">
                        <i class="">
                            <svg class="svg-icon" id="mm-ui-1-19" xmlns="http://www.w3.org/2000/svg" width="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-hard-drive">
                                <line x1="22" y1="12" x2="2" y2="12"></line>
                                <path
                                    d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">
                                </path>
                                <line x1="6" y1="16" x2="6.01" y2="16"></line>
                                <line x1="10" y1="16" x2="10.01" y2="16"></line>
                            </svg>
                        </i><span class="">ProgressBar Style</span>
                    </a>
                </li>
                <li class="<?= $active === 'theme' ? 'active' : '' ?>">
                    <a href="../view/index.php?page=theme" class="svg-icon">
                        <i class="">
                            <svg class="svg-icon" id="mm-ui-1-7" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                            </svg>
                        </i><span class="">Theme Style</span>
                    </a>
                </li>

                <li class="<?= $active === 'about' ? 'active' : '' ?>">
                    <a href="../view/index.php?page=about" class="svg-icon">
                        <i class="">
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" id="mm-about" 
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="12" cy="12" r="9" />
                            <line x1="12" y1="8" x2="12.01" y2="8" />
                            <polyline points="11 12 12 12 12 16 13 16" />
                        </svg>
                        </i><span class="">About App Configuration</span>
                    </a>
                </li>
                <?php if(isset($value) && $value->isSplashScreen == 'true') { ?>
                    <li class="<?= $active === 'splash' ? 'active' : '' ?>">
                        <a href="../view/index.php?page=splash_configuration" class="svg-icon">
                            <i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" id="mm-splash" 
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <circle cx="12" cy="12" r="9" />
                                <line x1="12" y1="8" x2="12.01" y2="8" />
                                <polyline points="11 12 12 12 12 16 13 16" />
                            </svg>
                            </i><span class="">Splash Configuration</span>
                        </a>
                    </li>
                <?php }?>
                <?php if(isset($value) && isset($value->navigationStyle) && in_array($value->navigationStyle,['sidedrawer','bottom_navigation', 'sidedrawer_tabs'])) { ?>
                <li class="<?= $active === 'menu' ? 'active' : '' ?>">
                    <a href="#app" class="collapsed svg-icon" data-toggle="collapse" aria-expanded="false">
                        <i>
                            <?php if(isset($value) && isset($value->navigationStyle) && $value->navigationStyle == 'bottom_navigation' ) {?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" id="mm-menu-1" width="20" height="20" 
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <rect x="4" y="4" width="16" height="16" rx="2" />
                                    <line x1="4" y1="15" x2="20" y2="15" />
                                </svg>
                            <?php } else {?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" id="mm-menu-1" viewBox="0 0 24 24"
                                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <rect x="4" y="4" width="16" height="16" rx="2" />
                                    <line x1="9" y1="4" x2="9" y2="20" />
                                </svg>
                            <?php }?>
                        </i>
                        <span class="ml-2"><?= (isset($value) && isset($value->navigationStyle)) ? ucfirst(str_replace('_',' ',$value->navigationStyle)) : 'Style' ?> Style</span>
                        <i class="las la-angle-right mm-arrow-right arrow-active"></i>
                        <i class="las la-angle-down mm-arrow-right arrow-hover"></i>
                    </a>

                    <ul id="app" class="submenu collapse" data-parent="#mm-sidebar-toggle">
                        <li class="<?= $active_submenu === 'menu_list' ? 'active' : '' ?>">
                            <a href="../view/index.php?page=menu" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="mm-list" class="svg-icon" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <rect x="5" y="3" width="14" height="18" rx="2" />
                                        <line x1="9" y1="7" x2="15" y2="7" />
                                        <line x1="9" y1="11" x2="15" y2="11" />
                                        <line x1="9" y1="15" x2="13" y2="15" />
                                    </svg>
                                </i><span class="">List</span>
                            </a>
                        </li>

                        <li class="<?= $active_submenu === 'menu_create' ? 'active' : '' ?>">
                            <a href="../view/index.php?page=menu_create" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg"  id="mm-add" class="svg-icon" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <rect x="4" y="4" width="16" height="16" rx="2" />
                                            <line x1="9" y1="12" x2="15" y2="12" />
                                            <line x1="12" y1="9" x2="12" y2="15" />
                                    </svg>
                                </i><span class="">Add</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                <?php if(isset($value) && isset($value->navigationStyle) && in_array($value->navigationStyle,['sidedrawer_bottom_navigation'])) { ?>
                <li class="<?= $active === 'menu' ? 'active' : '' ?>">
                    <a href="#app" class="collapsed svg-icon" data-toggle="collapse" aria-expanded="false">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" id="mm-menu-1" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <rect x="5" y="3" width="14" height="18" rx="2" />
                                <line x1="9" y1="4" x2="9" y2="15" />
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>                                
                                <line x1="7" y1="15" x2="17" y2="15" />
                            </svg>
                        </i>
                        <span class="ml-2 text-wrap"><?= (isset($value) && isset($value->navigationStyle)) ? 'Sidebar & Bottom' : 'Style' ?> Style</span>
                        <i class="las la-angle-right mm-arrow-right arrow-active"></i>
                        <i class="las la-angle-down mm-arrow-right arrow-hover"></i>
                    </a>

                    <ul id="app" class="submenu collapse" data-parent="#mm-sidebar-toggle">
                        <li class="<?= $active_submenu === 'menu_list' ? 'active' : '' ?>">
                            <a href="../view/index.php?page=menu" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="mm-list" class="svg-icon" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <rect x="5" y="3" width="14" height="18" rx="2" />
                                        <line x1="9" y1="7" x2="15" y2="7" />
                                        <line x1="9" y1="11" x2="15" y2="11" />
                                        <line x1="9" y1="15" x2="13" y2="15" />
                                    </svg>
                                </i><span class="">List</span>
                            </a>
                        </li>

                        <li class="<?= $active_submenu === 'menu_create' ? 'active' : '' ?>">
                            <a href="../view/index.php?page=menu_create" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg"  id="mm-add" class="svg-icon" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <rect x="4" y="4" width="16" height="16" rx="2" />
                                            <line x1="9" y1="12" x2="15" y2="12" />
                                            <line x1="12" y1="9" x2="12" y2="15" />
                                    </svg>
                                </i><span class="">Add</span>
                            </a>
                        </li>
                    </ul>

                </li>
                <?php } ?>
                <li class="<?= $active === 'navigationicon' ? 'active' : '' ?>">
                    <a href="#navigationicon" class="collapsed svg-icon" data-toggle="collapse" aria-expanded="false">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" id="mm-navigationicon-1"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <rect x="4" y="4" width="16" height="16" rx="2" />
                                <line x1="4" y1="9" x2="20" y2="9" />
                            </svg>
                        </i>
                        <span class="ml-2">Header Navigation</span>
                        <i class="las la-angle-right mm-arrow-right arrow-active"></i>
                        <i class="las la-angle-down mm-arrow-right arrow-hover"></i>
                    </a>
                    <ul id="navigationicon" class="submenu collapse" data-parent="#mm-sidebar-toggle">
                        <li class="<?= $active_submenu === 'navigationicon_left' ? 'active' : '' ?>">
                            <a href="../view/index.php?page=navigationicon_left" class="svg-icon">
                                <i class="">
                                <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" id="mm-left" viewBox="0 0 24 24" 
                                    stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                    <rect width="6" height="6" x="4" y="5" rx="1" />
                                    <line x1="14" y1="7" x2="20" y2="7" />
                                    <line x1="14" y1="11" x2="20" y2="11" />
                                    <line x1="4" y1="15" x2="20" y2="15" />
                                    <line x1="4" y1="19" x2="20" y2="19" />
                                </svg>
                                </i><span class="">Left Icon</span>
                            </a>
                        </li>
                        
                        <li class="<?= $active_submenu === 'navigationicon_right' ? 'active' : '' ?>">
                            <a href="../view/index.php?page=navigationicon_right" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="mm-right" class="svg-icon" 
                                        viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <rect width="6" height="6" x="14" y="5" rx="1" />
                                        <line x1="4" y1="7" x2="10" y2="7" />
                                        <line x1="4" y1="11" x2="10" y2="11" />
                                        <line x1="4" y1="15" x2="20" y2="15" />
                                        <line x1="4" y1="19" x2="20" y2="19" />
                                    </svg>
                                </i><span class="">Right Icon</span>
                            </a>
                        </li>
                    </ul>
                </li>

            <?php if(isset($value) && isset($value->is_walkthrough) && $value->is_walkthrough == true ) { ?>
                <li class="<?= $active === 'walkthrough' ? 'active' : '' ?>">
                    <a href="#walkthrough" class="collapsed svg-icon" data-toggle="collapse" aria-expanded="false">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" id="mm-walkthrough-1" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="4" y1="6" x2="20" y2="6" />
                                <line x1="4" y1="12" x2="20" y2="12" />
                                <line x1="4" y1="18" x2="20" y2="18" />
                            </svg>
                        </i>
                        <span class="ml-2"> WalkThrough</span>
                        <i class="las la-angle-right mm-arrow-right arrow-active"></i>
                        <i class="las la-angle-down mm-arrow-right arrow-hover"></i>
                    </a>

                    <ul id="walkthrough" class="submenu collapse" data-parent="#mm-sidebar-toggle">
                        <li class="<?= $active_submenu === 'walkthrough_list' ? 'active' : '' ?>">
                            <a href="../view/index.php?page=walkthrough" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="mm-walkthrough-list" class="svg-icon" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <rect x="5" y="3" width="14" height="18" rx="2" />
                                        <line x1="9" y1="7" x2="15" y2="7" />
                                        <line x1="9" y1="11" x2="15" y2="11" />
                                        <line x1="9" y1="15" x2="13" y2="15" />
                                    </svg>
                                </i><span class="">List</span>
                            </a>
                        </li>
                        <li class="<?= $active_submenu === 'walkthrough_create' ? 'active' : '' ?>">
                            <a href="../view/index.php?page=walkthrough_create" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg"  id="mm-walkthrough-add" class="svg-icon" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <rect x="4" y="4" width="16" height="16" rx="2" />
                                            <line x1="9" y1="12" x2="15" y2="12" />
                                            <line x1="12" y1="9" x2="12" y2="15" />
                                    </svg>
                                </i><span class="">Add</span>
                            </a>
                        </li>
                    </ul>

                </li>
            <?php } ?>

            <?php if(isset($value) && isset($value->is_floating_button) && $value->is_floating_button === "true" ) { ?>
                <li class="<?= $active === 'floatingbutton' ? 'active' : '' ?>">
                    <a href="#floatingbutton" class="collapsed svg-icon" data-toggle="collapse" aria-expanded="false">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" id="mm-floatingbutton-1" viewBox="0 0 24 24"
                                stroke-width="2" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                        </i>
                        <span class="ml-2"> Floating Button</span>
                        <i class="las la-angle-right mm-arrow-right arrow-active"></i>
                        <i class="las la-angle-down mm-arrow-right arrow-hover"></i>
                    </a>

                    <ul id="floatingbutton" class="submenu collapse" data-parent="#mm-sidebar-toggle">
                        <li class="<?= $active_submenu === 'floatingbutton_list' ? 'active' : '' ?>">
                            <a href="../view/index.php?page=floatingbutton" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="mm-floatingbutton-list" class="svg-icon" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <rect x="5" y="3" width="14" height="18" rx="2" />
                                        <line x1="9" y1="7" x2="15" y2="7" />
                                        <line x1="9" y1="11" x2="15" y2="11" />
                                        <line x1="9" y1="15" x2="13" y2="15" />
                                    </svg>
                                </i><span class="">List</span>
                            </a>
                        </li>
                        
                        <li class="<?= $active_submenu === 'floatingbutton_create' ? 'active' : '' ?>">
                            <a href="../view/index.php?page=floatingbutton_create" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg"  id="mm-floatingbutton-add" class="svg-icon" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <rect x="4" y="4" width="16" height="16" rx="2" />
                                            <line x1="9" y1="12" x2="15" y2="12" />
                                            <line x1="12" y1="9" x2="12" y2="15" />
                                    </svg>
                                </i><span class="">Add</span>
                            </a>
                        </li>
                        
                    </ul>

                </li>
            <?php } ?>

                <li class="<?= $active === 'pages' ? 'active' : '' ?>">
                    <a href="#pages" class="collapsed svg-icon" data-toggle="collapse" aria-expanded="false">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" id="mm-pages-1" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                <path d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                <path d="M11 14h1v4h1" />
                                <path d="M12 11h.01" />
                            </svg>
                        </i>
                        <span class="ml-2"> Pages</span>
                        <i class="las la-angle-right mm-arrow-right arrow-active"></i>
                        <i class="las la-angle-down mm-arrow-right arrow-hover"></i>
                    </a>

                    <ul id="pages" class="submenu collapse" data-parent="#mm-sidebar-toggle">
                        <li class="<?= $active_submenu === 'pages_list' ? 'active' : '' ?>">
                            <a href="../view/index.php?page=pages" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="mm-pages-list" class="svg-icon" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <rect x="5" y="3" width="14" height="18" rx="2" />
                                        <line x1="9" y1="7" x2="15" y2="7" />
                                        <line x1="9" y1="11" x2="15" y2="11" />
                                        <line x1="9" y1="15" x2="13" y2="15" />
                                    </svg>
                                </i><span class="">List</span>
                            </a>
                        </li>
                        <li class="<?= $active_submenu === 'pages_create' ? 'active' : '' ?>">
                            <a href="../view/index.php?page=pages_create" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg"  id="mm-pages-add" class="svg-icon" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <rect x="4" y="4" width="16" height="16" rx="2" />
                                            <line x1="9" y1="12" x2="15" y2="12" />
                                            <line x1="12" y1="9" x2="12" y2="15" />
                                    </svg>
                                </i><span class="">Add</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="<?= $active === 'useragent' ? 'active' : '' ?>">
                    <a href="#useragent" class="collapsed svg-icon" data-toggle="collapse" aria-expanded="false">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" id="mm-useragent-1" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <line x1="4" y1="6" x2="20" y2="6" />
                                <line x1="4" y1="12" x2="20" y2="12" />
                                <line x1="4" y1="18" x2="20" y2="18" />
                            </svg>
                        </i>
                        <span class="ml-2"> User Agent</span>
                        <i class="las la-angle-right mm-arrow-right arrow-active"></i>
                        <i class="las la-angle-down mm-arrow-right arrow-hover"></i>
                    </a>

                    <ul id="useragent" class="submenu collapse" data-parent="#mm-sidebar-toggle">
                        <li class="<?= $active_submenu === 'useragent_list' ? 'active' : '' ?>">
                            <a href="../view/index.php?page=useragent" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="mm-useragent-list" class="svg-icon" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <rect x="5" y="3" width="14" height="18" rx="2" />
                                        <line x1="9" y1="7" x2="15" y2="7" />
                                        <line x1="9" y1="11" x2="15" y2="11" />
                                        <line x1="9" y1="15" x2="13" y2="15" />
                                    </svg>
                                </i><span class="">List</span>
                            </a>
                        </li>
                        <li class="<?= $active_submenu === 'useragent_create' ? 'active' : '' ?>">
                            <a href="../view/index.php?page=useragent_create" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg"  id="mm-useragent-add" class="svg-icon" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <rect x="4" y="4" width="16" height="16" rx="2" />
                                            <line x1="9" y1="12" x2="15" y2="12" />
                                            <line x1="12" y1="9" x2="12" y2="15" />
                                    </svg>
                                </i><span class="">Add</span>
                            </a>
                        </li>
                    </ul>

                </li>
                <?php if(isset($value) && isset($value->navigationStyle) && in_array($value->navigationStyle,['tabs','sidedrawer_tabs'])) { ?>
                <li class="<?= $active === 'tabs' ? 'active' : '' ?>">
                    <a href="#tabs" class="collapsed svg-icon" data-toggle="collapse" aria-expanded="false">
                        <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" id="mm-tabs-1" viewBox="0 0 24 24"
                                stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <ellipse cx="12" cy="6" rx="8" ry="3"></ellipse>
                                <path d="M4 6v6a8 3 0 0 0 16 0v-6" />
                                <path d="M4 12v6a8 3 0 0 0 16 0v-6" />
                            </svg>
                        </i>
                        <span class="ml-2"> Tabs</span>
                        <i class="las la-angle-right mm-arrow-right arrow-active"></i>
                        <i class="las la-angle-down mm-arrow-right arrow-hover"></i>
                    </a>

                    <ul id="tabs" class="submenu collapse" data-parent="#mm-sidebar-toggle">
                        <li class="<?= $active_submenu === 'tabs_list' ? 'active' : '' ?>">
                            <a href="../view/index.php?page=tabs" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" id="mm-tabs-list" class="svg-icon" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <rect x="5" y="3" width="14" height="18" rx="2" />
                                        <line x1="9" y1="7" x2="15" y2="7" />
                                        <line x1="9" y1="11" x2="15" y2="11" />
                                        <line x1="9" y1="15" x2="13" y2="15" />
                                    </svg>
                                </i><span class="">List</span>
                            </a>
                        </li>
                        <!--                         
                        <li class="<?= $active_submenu === 'tabs_create' ? 'active' : '' ?>">
                            <a href="../view/index.php?page=tabs_create" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg"  id="mm-tabs-add" class="svg-icon" viewBox="0 0 24 24" stroke-width="2"
                                        stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                            <rect x="4" y="4" width="16" height="16" rx="2" />
                                            <line x1="9" y1="12" x2="15" y2="12" />
                                            <line x1="12" y1="9" x2="12" y2="15" />
                                    </svg>
                                </i><span class="">Add</span>
                            </a>
                        </li>
                        -->
                    </ul>

                </li>
                <?php } ?>

                <li class="<?= $active === 'onesignal' ? 'active' : '' ?>">
                    <a href="#onesignal" class="collapsed svg-icon" data-toggle="collapse" aria-expanded="false">
                        <i>
                            <svg class="svg-icon" id="mm-ui-1-16" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                        </i>
                        <span class="ml-2">OneSignal Notification </span>
                        <i class="las la-angle-right mm-arrow-right arrow-active"></i>
                        <i class="las la-angle-down mm-arrow-right arrow-hover"></i>
                    </a>
                    <ul id="onesignal" class="submenu collapse" data-parent="#mm-sidebar-toggle">
                        
                        <li class="<?= $active_submenu === 'onesignal_configuration' ? 'active' : '' ?>">
                            <a href="../view/index.php?page=onesignal_configuration" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" id="mm-config" viewBox="0 0 24 24" 
                                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                        <path d="M10 9v6l5 -3z" />
                                    </svg>
                                </i><span class="">Configuration</span>
                            </a>
                        </li>
                        
                        <li class="<?= $active_submenu === 'onesignal_send' ? 'active' : '' ?>">
                            <a href="../view/index.php?page=onesignal_send" class="svg-icon">
                                <i class="">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon"  id="mm-send" viewBox="0 0 24 24"
                                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                        <path d="M12 18h-7a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v7.5" />
                                        <path d="M3 6l9 6l9 -6" />
                                        <path d="M15 18h6" />
                                        <path d="M18 15l3 3l-3 3" />
                                    </svg>
                                </i><span class="">Send</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php if(isset($value) && isset($value->isExitPopupScreen) && $value->isExitPopupScreen == 'true') { ?>
                    <li class="<?= $active === 'exitpopup' ? 'active' : '' ?>">
                        <a href="../view/index.php?page=exitpopup_configuration" class="svg-icon">
                            <i class="">
                            <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" id="mm-exitpopup"
                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <rect x="4" y="4" width="16" height="16" rx="2" />
                                <path d="M10 10l4 4m0 -4l-4 4" />
                            </svg>
                            </i><span class="">Exit Popup Configuration</span>
                        </a>
                    </li>
                <?php }?>

                <li class="<?= $active === 'share_content' ? 'active' : '' ?>">
                    <a href="../view/index.php?page=share_content" class="svg-icon">
                        <i class="">
                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" id="mm-share-content" 
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                            <circle cx="6" cy="12" r="3" />
                            <circle cx="18" cy="6" r="3" />
                            <circle cx="18" cy="18" r="3" />
                            <line x1="8.7" y1="10.7" x2="15.3" y2="7.3" />
                            <line x1="8.7" y1="13.3" x2="15.3" y2="16.7" />
                        </svg>
                        </i><span class="">Share Content</span>
                    </a>
                </li>
                <li>
                    <a href="../logout.php" class="svg-icon">
                        <i class="">
                            <svg class="svg-icon mr-0 text-primary" id="h-05-p" width="20"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                        </i><span class="">Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div class="pt-5 pb-2"></div>
    </div>
</div>