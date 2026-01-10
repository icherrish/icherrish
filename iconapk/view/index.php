<?php
    session_start();
    
    if (empty($_SESSION['user'])) {
        header('Location:  ../login.php ');
        die;
    }
    /*
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    */
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>MightyWeb</title>
        
        <!-- Favicon -->
        <link rel="shortcut icon" href="../assets/images/favicon.ico" />
        <link rel="stylesheet" href="../assets/css/backend-plugin.min.css">
        <link rel="stylesheet" href="../assets/css/backend.css?v=1.0.0">
        <!-- <link rel="stylesheet" href="../assets/vendor/@fortawesome/fontawesome-free/css/all.min.css"> -->
        <link rel="stylesheet" href="../assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css">
        <link rel="stylesheet" href="../assets/vendor/remixicon/fonts/remixicon.css">
        <link rel="stylesheet" href="../assets/css/custom.css">
        <!-- <link rel="stylesheet" href="../assets/vendor/@icon/dripicons/dripicons.css"> -->
        
      
    </head>
    <body class="">
        <!-- loader Start -->
        <div id="loading">
            <div id="loading-center">
            </div>
        </div>

        <!-- Wrapper Start -->
        <div class="wrapper">
            <?php require "sidebar.php"; ?>
            <?php require "header.php"; ?>
                <div class="content-page">
                <?php
                    if (isset($_GET['page']))
                    {
                        $action = $_GET['page'];
                        $url = explode("_", $action);
                        $page_link = "";
                        
                        foreach ($url as &$value) {
                            $page_link .= $value . '/';
                        }
                        $page_link = rtrim($page_link, "/");

                        if (count($url) == 1) {
                            $page_link .= '/index.php';
                        } else {
                            $page_link .= '.php';
                        }

                        try {
                            if (!file_exists($page_link)){
                                require_once("./404.php");
                            } else{
                                require_once($page_link);
                            }
                        } catch (Exception $e) {
                            require_once("./404.php");
                        }
                    } else {
                ?>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 mb-3">
                            <div class="d-flex align-items-center justify-content-between welcome-content">
                                <div class="navbar-breadcrumb">
                                    <h4 class="mb-0 font-weight-700">Welcome To Dashboard</h4>
                                </div>
                                <div class="">
                                    <form method="post" action="./savejson.php">
                                        
                                        <button type="submit" class="btn btn-primary btn-sm " >Update JSON</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="card card-block card-stretch card-height">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="mm-cart-image text-danger">
                                                    <svg class="svg-icon"  width="50" height="52" id="h-01" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-hard-drive">
                                                        <line x1="22" y1="12" x2="2" y2="12"></line>
                                                        <path
                                                            d="M5.45 5.11L2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z">
                                                        </path>
                                                        <line x1="6" y1="16" x2="6.01" y2="16"></line>
                                                        <line x1="10" y1="16" x2="10.01" y2="16"></line>
                                                    </svg>
                                                </div>

                                                <div class="mm-cart-text">
                                                    <h2 class="font-weight-700">12</h2>
                                                    <p class="mb-0 text-danger">Progress Style</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card card-block card-stretch card-height">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="mm-cart-image text-success">
                                                    <svg class="svg-icon svg-success mr-4" width="50" height="52" id="h-02"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                                                    </svg>
                                                </div>
                                                <div class="mm-cart-text">
                                                    <h2 class="font-weight-700">16</h2>
                                                    <p class="mb-0 text-success">Theme Style</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card card-block card-stretch card-height">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="mm-cart-image text-primary">                                                    
                                                    <svg  class="svg-icon svg-success mr-4" width="50" height="52" id="h-03" 
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" 
                                                        stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <rect width="6" height="6" x="4" y="5" rx="1" />
                                                        <line x1="14" y1="7" x2="20" y2="7" />
                                                        <line x1="14" y1="11" x2="20" y2="11" />
                                                        <line x1="4" y1="15" x2="20" y2="15" />
                                                        <line x1="4" y1="19" x2="20" y2="19" />
                                                    </svg>
                                                </div>
                                                <div class="mm-cart-text">
                                                    <h2 class="font-weight-700">7</h2>
                                                    <p class="mb-0 text-primary">Left Icon</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="card card-block card-stretch card-height">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div class="mm-cart-image text-warning">
                                                    <svg class="svg-icon svg-warning mr-4" width="50" height="52"  id="h-04" 
                                                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                                        <rect width="6" height="6" x="14" y="5" rx="1" />
                                                        <line x1="4" y1="7" x2="10" y2="7" />
                                                        <line x1="4" y1="11" x2="10" y2="11" />
                                                        <line x1="4" y1="15" x2="20" y2="15" />
                                                        <line x1="4" y1="19" x2="20" y2="19" />
                                                    </svg>
                                                </div>
                                                <div class="mm-cart-text">
                                                    <h2 class="font-weight-700">15</h2>
                                                    <p class="mb-0 text-warning">Right Icon</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <!-- Wrapper End -->
        <?php require "footer.php"; ?>

    <?php
        if (isset($_SESSION['success'])) {
            // echo $_SESSION['success'];
    ?>
        <script>
            Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            }).fire({
                type: 'success',
                html: '<?= $_SESSION['success'] ?>'
            });
        </script>
        <?php
            unset($_SESSION['success']);
        }
      ?>

      <?php
        if (isset($_SESSION['error'])) {
      ?>
        <script>
            Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            }).fire({
                type: 'error',
                title: '<?= $_SESSION['error'] ?>'
            });
        </script>
      <?php
      }
        unset($_SESSION['error']);
      ?>
    </body>

</html>