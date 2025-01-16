<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Services - Cloud Server</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="css/responsive.css">
   </head>
   <body class="sidebar-main-active right-column-fixed">
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
      <!-- Wrapper Start -->
      <div class="wrapper">
      <? if(wg::vpnStatus() == true){
      session::loadComponent('active-dialoguebox');
      }else{
         session::loadComponent('notactive-dialoguebox');
      } ?>
      
         <!-- Sidebar  -->
         <?php session::loadComponent('sidebar')?>
         <!-- TOP Nav Bar -->
         <div class="iq-top-navbar">
            <div class="iq-navbar-custom">
               <nav class="navbar navbar-expand-lg navbar-light p-0">
                  <div class="iq-menu-bt d-flex align-items-center">
                     <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                        <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                     </div>
                     <div class="iq-navbar-logo d-flex justify-content-between">
                        <a href="index.html" class="header-logo">
                           <img src="images/logo.png" class="img-fluid rounded-normal" alt="">
                           <div class="pt-2 pl-2 logo-title">
                              <span class="text-danger text-uppercase">Server<span class="text-primary ml-1">360</span></span>
                           </div>
                        </a>
                     </div>
                  </div>
                  <div class="navbar-breadcrumb">
                     <h4 class="mb-0 text-dark">Services</h4>
                     <p class="mb-0">Here is the list of the managed services we offer.</p>
                  </div>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
                  <i class="ri-menu-3-line"></i>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  </div>
                  <?session::loadComponent('nav')?>
               </nav>
            </div>
         </div>
         <!-- TOP Nav Bar END -->
         
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-6">
                           <div class="iq-card  iq-mb-3">
                              <div class="iq-card-body">
                                 <h4 class="card-title">MySQL Server</h4>
                                 <p class="card-text">MySQL is a popular relational database managenent system developed, distributed, and supported by Oracle Corporation. </p>
                                 <div id="device-config-mysql" class="d-none">
                                 <p class="mb-0">Copy the hostname and paste it in your ports section of your VS Code to port forward and use MySQL from your computer (do it after you SSH into your instance).</p>
                                 <br>
                                 <p class="mb-0">Hostname: <span class="text-danger">mysql.umarfarooq.cloud:3306</span></p>
                                 <p class="mb-0">Running Port: <span class="text-danger">3306</span></p>
                                </div>
                                <br>
                                 <a href="#" id="show-config-mysql" class="btn btn-primary">Click to view config</a>
                                 <a href="/add-mysql-user" class="btn btn-primary">Manage Users</a>
                                 <a href="/add-mysql-db" class="btn btn-primary">Manage Databases</a>

                              </div>
                           </div>
                        </div>

                        <div class="col-sm-6">
                           <div class="iq-card  iq-mb-3">
                              <div class="iq-card-body">
                                 <div class="d-flex justify-content-between">
                                    <h4 class="card-title">MongoDB Server</h4>
                                 <span class="text-danger">NEW!</span>
                                    </div>
                                 <p class="card-text">MongoDB is a popular No-SQL database management system, developed and maintained by MongoDB Inc.</p>
                                 <div id="device-config-mongodb" class="d-none">
                                 <p class="mb-0">Copy the hostname and paste it in your ports section of your VS Code to port forward and use MySQL from your computer (do it after you SSH into your instance).</p>
                                 <br>
                                 <p class="mb-0">Hostname: <span class="text-danger">mongodb.umarfarooq.cloud:27017</span></p>
                                 <p class="mb-0">Authentication Database: <span class="text-danger">users</span></p>
                                 <p class="mb-0">Running Port: <span class="text-danger">27017</span></p>

                                 <p class="mb-0">Connection String: <span class="text-danger">mongodb://'mongodb_username':'password'@hostname:port/
                                    <br>
                                    'database_name'?authSource=users</span></p>
                                </div>
                                <br>
                                 <a href="#" id="show-config-mongodb" class="btn btn-primary">Click to view config</a>
                                 <a href="/add-mongodb-user" class="btn btn-primary">Manage Users</a>
                                 <a href="/add-mongodb-db" class="btn btn-primary">Manage Databases</a>

                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="iq-card  iq-mb-3">
                              <div class="iq-card-body">
                                 <h4 class="card-title">Adminer</h4>
                                 <p class="card-text">Adminer (formerly phpMinAdmin) is a full-featured database management tool, written in a single PHP file.</p>
                                 <div id="device-config-adminer" class="d-none">
                                 <p class="mb-0">Copy the hostname and paste it in your ports section of your VS Code to port forward and use Adminer from your computer (do it after you SSH into your instance).</p>
                                 <br>
                                 <p class="mb-0">Hostname: <span class="text-danger">adminer.umarfarooq.cloud:8080</span></p>
                                 <p class="mb-0">Running Port: <span class="text-danger">8080</span></p>
                                </div>
                                <br>
                                 <a href="#" id="show-config-adminer" class="btn btn-primary btn-block">Click to view config</a>
                              </div>
                           </div>
                        </div>
                        <div class="col-sm-6">
                           <div class="iq-card  iq-mb-3">
                              <div class="iq-card-body">
                                 <h4 class="card-title">Redis Insight</h4>
                                 <p class="card-text">Redis Insight provides an intuitive Redis Admin GUI and helps optimize and interact your use of Redis in your applications.</p>
                                 <a href="#" class="btn btn-primary btn-block disabled">Comming soon..</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
         $(document).ready(function(){
            $("#show-config-mysql").on('click', ()=>
            {               
                $("#device-config-mysql").toggleClass('d-none')
            
            })

            $("#show-config-adminer").on('click', ()=>
            {               
                $("#device-config-adminer").toggleClass('d-none')
            
            })

            $("#show-config-mongodb").on('click', ()=>
            {               
                $("#device-config-mongodb").toggleClass('d-none')
            
            })
         })
          
      </script>
      <!-- Wrapper END -->
       <!-- Footer -->
       <?php session::loadComponent('footer')?>
      <!-- Footer END -->
       <!-- color-customizer END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="js/jquery.min.js"></script>
      <script src="js/popper.min.js"></script>
      <script src="js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="js/waypoints.min.js"></script>
      <script src="js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="js/apexcharts.js"></script>
      <!-- Slick JavaScript -->
      <script src="js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="js/smooth-scrollbar.js"></script>
      <!-- lottie JavaScript -->
      <script src="js/lottie.js"></script>
      <!-- am core JavaScript -->
      <script src="js/core.js"></script>
      <!-- am charts JavaScript -->
      <script src="js/charts.js"></script>
      <!-- am animated JavaScript -->
      <script src="js/animated.js"></script>
      <!-- am kelly JavaScript -->
      <script src="js/kelly.js"></script>
      <!-- am maps JavaScript -->
      <script src="js/maps.js"></script>
      <!-- am worldLow JavaScript -->
      <script src="js/worldLow.js"></script>
      <!-- Style Customizer -->
      <script src="js/style-customizer.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>

     <script src="/js/app.o.js"></script>
   </body>
</html>