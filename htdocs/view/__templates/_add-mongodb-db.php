<?$session_username = session::getUsername()?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Add MongoDB Database - Cloud Labs</title>
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
                              <span class="text-danger text-uppercase">Cloud<span class="text-primary ml-1">Labs</span></span>
                           </div>
                        </a>
                     </div>
                  </div>
                  <div class="navbar-breadcrumb">
                     <h4 class="mb-0 text-dark">Add MongoDB Database</h4>
                     <p class="mb-0">You can add upto 5 databases to your MongoDB user.</p>
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

         <div class="toast-container" id="toast-container"></div>
<link href="css/toast.css" rel="stylesheet">
<script src="js/toast.js"></script>
         <!-- TOP Nav Bar END -->
         
         <!-- Page Content  -->
         <div id="content-page" class="content-page">
            <div class="container-fluid">
               <div class="row">
                    <div class="col-sm-12 col-lg-10">
                        <div class="iq-card">
                           <div class="iq-card-header d-flex justify-content-between">
                              <div class="iq-header-title">
                                 <h4 class="card-title">Add MongoDB Database</h4>
                              </div>
                           </div>
                           <div class="iq-card-body">
                              <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p> -->
                              <form>
                                 <div class="form-group">
                                    <label for="email">Username</label>
                                    <select class="form-control" id="mongodbUsername">
                                       <?$conn = database::getConnection();
                                       $mongodb_users = "SELECT * FROM `mongodb_users` WHERE `username` = '$session_username'";

                                       if($conn->query($mongodb_users)->num_rows){
                                         ?><option selected disabled>Select username</option><?
                                          $result = $conn->query($mongodb_users);

                                          for($i = 1; $i <= $result->num_rows; $i++){
                                             $row = $result->fetch_assoc();
                                          ?><option><?echo $row['mongodb_username']?></option><?
                                    }
                                    }else{
                                       ?><option selected disabled>There are no users for this username.</option><?
                                    }?>
                                    </select>
                                 </div>
                                 <div class="form-group">
                                 <label for="email">Database Name</label>
                                    <div class="input-group">
                               
                                    <div class="input-group-prepend">
                                          <span class="input-group-text" id="username-prefix"></span>
                                       </div>
                                    
                                    <input type="text" class="form-control" id="mongodbDbname">
                                 </div>
                                 </div>
                                 <br>
                                 <a class="btn btn-primary text-white" id="addDb">Add database</a>
                                 <a class="btn iq-bg-danger" href="/services">Go back</a>
                              </form>
                           </div>
                           
                        </div>
               <div class="row">
                  <div class="col-lg-12">
                  <h4 class="card-title ml-2">MongoDB Databases</h4>
                  <br>
                    <div class="row" id="mongodbUsers">

                   
                    <div class="row">
                  <div class="col-lg-12">
                    <div class="row">

               <p class="mb-0 ml-4 pl-3">Your MongoDB Databases list will appear here. toggle the username above to view your databases.</p>

                     </div>
                  </div>
               </div>
                        <!-- <div class="col-sm-6">
                           <div class="iq-card  iq-mb-3">
                              <div class="iq-card-body">
                                 <h4 class="card-title">mongodb Server</h4>
                                 <p class="card-text">mongodb is a popular relational database managenent system currently maintained by oracle. </p>
                                 <div id="device-config" class="d-none">
                                 <p class="card-text">Hello World</p>
                                </div>
                                <br>
                                 <button type="submit" href="#" id="show-config" class="btn btn-primary">Click to view config</button>
                                 <button type="submit" href="#" class="btn btn-primary">Manage Users</button>
                              </div>
                           </div>
                        </div> -->
<!-- 
                        <div class="col-sm-6">
                           <div class="iq-card  iq-mb-3">
                              <div class="iq-card-body">
                                 <h4 class="card-title">MongoDB Server</h4>
                                 <p class="card-text">MongoDB is a popular No-SQL database management system.</p>
                                 <a href="#" class="btn btn-primary btn-block disabled">Comming soon..</a>
                              </div>
                           </div>
                        </div> -->
                     </div>
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

      <script src="/js/app.js"></script>
   
   
   </body>
</html>

