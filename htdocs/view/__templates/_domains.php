<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>My Domains - Cloud Labs</title>
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

   <div class="toast-container" id="toast-container"></div>
<link href="css/toast.css" rel="stylesheet">
<script src="js/toast.js"></script>


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
                     <h4 class="mb-0 text-dark">My Domains</h4>
                     <p class="mb-0">Your Domains will be listed here. User will be allowed to create unlimited subdomains from avalilable domains or point your own custom domain to us.</p>
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

         <?php
         $sess_username = session::getUsername();
         $conn = database::getConnection();
         $device_query = "SELECT * FROM `devices` WHERE `username` = '$sess_username'";
         $labs_query = "SELECT * FROM `labs` WHERE `username` = '$sess_username'";

         $device_result = $conn->query($device_query);
         $labs_result = $conn->query($labs_query);

         ?>

         <? $domains = domains::listDomains() ?>

         <div id="content-page" class="content-page">
            <div class="mb-0 pl-3">
               <p >Total domains: <span class="text-danger"><?php echo count($domains)?></span></p>
               <?if($device_result->num_rows + $labs_result->num_rows == 0){?>
                  <p ><span class="text-danger">You do not have any domains added. Click on Add domains button below to add one.</span></p>
                  <?}?>
                  <a href="/add-domain" class="btn btn-primary">Add a domain</a>
           </div>
           <br>
            <div class="container-fluid">
               <div class="row">
                  <div class="col-lg-12">
                    <div class="row">


                    <?php

                     for($i = 0; $i < count($domains); $i++)
                     {
                        ?>
                        <div class="col-sm-6">
                           <div class="iq-card  iq-mb-3">
                              <div class="iq-card-body">
                              <div class="d-flex justify-content-between">
                                 <h4 class="card-title"><a target="_blank" href="https://<?echo $domains[$i]['domain']?>"><?echo $domains[$i]['domain']?></a></h4>
                                 <? if($domains[$i]['status'] == 'active') { ?>
                                     <h7 class="card-text">Status: <span style="color: green">Active</span></h7>
                                 <? } else { ?>
                                    <h7 class="card-text">Status: <span style="color: red">Inactive</span></h7>
                                 <? } ?>
                                 
                                 </div>
                                 <p class="card-text"><span class="text-danger">Domain type: </span><?php echo $domains[$i]['domain_type']?></p>
                                 <p class="card-text"><span class="text-danger">Date added: </span><?echo $domains[$i]['added_on']?></p>
                                 <p class="card-text"><span class="text-danger">Last updated: </span><?echo $domains[$i]['last_updated']?></p>
                               
                                 <a id="delete_domain" href="#" class="s btn btn-primary">Delete Domain</a>
                                

                              </div>
                           </div>
                        </div>
                        <? }
                    ?>
   
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
        <script>
         $(document).ready(function(){
            <?php 
            if($device_result->num_rows)
            {
               for($i = 1; $i <= $conn->query($device_query)->num_rows; $i++){
                  ?>

            $("#show-config<?php echo $i?>").on('click', ()=>
            {               
                $("#device-config<?php echo $i?>").toggleClass('d-none')
            })
            <?php
            }
          }
          ?>
         

         <?php 
            if($labs_result->num_rows)
            {
               for($i = 1; $i <= $conn->query($device_query)->num_rows; $i++){
                  ?>

            $("#show-config-labs<?php echo $i?>").on('click', ()=>
            {               
                $("#device-config-labs<?php echo $i?>").toggleClass('d-none')
            })
            <?php
            }
          }
          ?>
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