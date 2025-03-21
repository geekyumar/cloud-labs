<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Add a domain - Cloud Labs</title>
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
      <link rel="stylesheet" href="css/toast.css">
      <div class="toast-container" id="toast-container"></div>
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
                              <span class="text-danger text-uppercase">Cloud<span class="text-primary ml-1">Labs</span></span>
                           </div>
                        </a>
                     </div>
                  </div>
                  <div class="navbar-breadcrumb">
                     <h4 class="mb-0 text-dark">Add Domains</h4>
                     <p class="mb-0">You can add a subdomains from the list of available domains, or create your own subdomain.</p>
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
                    <div class="col-sm-12 col-lg-12">
                        <div class="iq-card">
                           <div class="iq-card-header d-flex justify-content-between">
                              <div class="iq-header-title">
                                 <h4 class="card-title">Add a domain</h4>
                              </div>
                           </div>
                           <div class="iq-card-body">
                              <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p> -->
                              <form method="post">
                                 <!-- <div class="form-group">
                                    <label for="email">Device Name:</label>
                                    <input type="text" id="deviceName" class="form-control" id="email1">
                                 </div> -->
                                 <div class="form-group">
                                    <label >Choose your domain</label>
                                    <select class="form-control" id="domainType">
                                       <option selected="" disabled="">Choose your domain..</option>
                                       <option value="cloudlabs.space">*.cloudlabs.space</option>
                                       <option value="custom">Custom Domain</option>
                                    </select>
                                 </div>
                                 <div id="domainInput" class="form-group d-none">
                                    <label for="tect">Enter your Subdomain</label>
                                    <input type="text" id="domainName" class="form-control">
                                 </div>
                                 <div id="customDomainInput" class="form-group d-none">
                                    <label for="tect">Enter your Custom Domain</label>
                                    <input type="text" id="customDomain" class="form-control">
                                    <br>
                                 <p>Please make sure that you configure your DNS provider to point your domain '<span class="text-danger" id="customDomainName"></span>' to our server's IP address (<?echo getPublicIp()?>) to create this domain. Don't worry. we'll take care of SSL certificates.</p>
                                 </div>
                                 <br>
                                 <a id="addDomainSubmit" class="btn btn-primary text-white">Add domain</a>
                                 <a href="/domains" class="btn iq-bg-danger">Cancel</a>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- Wrapper END -->
       <!-- Footer -->
       <?php session::loadComponent('footer')?>
      <!-- Footer END -->
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
    
      <script src="/js/app.js"></script>
   </body>
</html>


