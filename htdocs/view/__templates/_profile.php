<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Profile - Cloud Labs</title>
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
                     <h4 class="mb-0 text-dark">Dashboard</h4>
                     <p class="mb-0"><span class="text-danger">Hi <?echo session::$user->data['name']?>,</span> Great to see you again</p>
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
                  <div class="col-sm-12">
                     <div class="iq-card">
                        <div class="iq-card-body profile-page p-0">
                           <div class="profile-header">
                              <div class="cover-container">
                                 <img src="images/page-img/profile-bg.jpg" alt="profile-bg" class="rounded img-fluid w-100">
                                 <ul class="header-nav d-flex flex-wrap justify-end p-0 m-0">
                                    <li><a href="javascript:void();"><i class="ri-pencil-line"></i></a></li>
                                    <li><a href="javascript:void();"><i class="ri-settings-4-line"></i></a></li>
                                 </ul>
                              </div>
                              <div class="profile-info iq-card-body">
                                 <div class="row align-items-center">
                                    <div class="col-sm-12 col-md-6">
                                       <div class="user-detail">
                                          <div class="d-flex flex-wrap align-items-center">
                                             <div class="profile-img">
                                                <img src="images/user/11.png" alt="profile-img" class="avatar-130 img-fluid" />
                                             </div>
                                             <div class="profile-detail d-flex align-items-center ml-3">
                                                <h3 class="line-height"><?echo session::$user->data['name']?></h3>
                                                <p class="m-0 pl-3"> - <?echo session::$user->data['role']?></p>
                                             </div>
                                          </div>
                                       </div>
                                    </div>

                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-sm-12">
                     <div class="row">

                        <div class="col-lg-12 profile-center">
                           <div class="tab-content">

    

                              <div class="" id="profile-profile" role="tabpanel">
                                 <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between">
                                       <div class="iq-header-title">
                                          <h4 class="card-title">Profile</h4>
                                       </div>
                                    </div>
                                    <div class="iq-card-body">
                                       <div class="user-detail text-center">
                                          <div class="user-profile">
                                             <img src="images/user/11.png" alt="profile-img" class="avatar-130 img-fluid">
                                          </div>
                                          <div class="profile-detail mt-3">
                                             <h3 class="d-inline-block"><?echo session::$user->data['name']?></h3>
                                             <p class="d-inline-block pl-3"> - <?echo session::$user->data['role']?></p>
                                             <p class="mb-0"><?echo session::$user->data['about']?></p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="iq-card">
                                    <div class="iq-card-header d-flex justify-content-between">
                                       <div class="iq-header-title">
                                          <h4 class="card-title">About User</h4>
                                       </div>
                                    </div>
                                    <div class="iq-card-body">
                                      <div class="mt-2">
                                       <h6>Full Name:</h6>
                                       <p><?echo session::$user->data['name']?></p>
                                      </div>
                                      <div class="mt-2">
                                       <h6>Username:</h6>
                                       <p><?echo session::$user->data['username']?></p>
                                      </div>
                                      <div class="mt-2">
                                       <h6>Email:</h6>
                                       <p><a href="mailto:nikjone@gmail.com"> <?echo session::$user->data['email']?></a></p>
                                      </div>
                                      <div class="mt-2">
                                       <h6>Phone:</h6>
                                       <p><?echo session::$user->data['phone']?></p>
                                      </div>
                                      <div class="mt-2">
                                       <h6>Date Joined:</h6>
                                       <p><?echo session::$user->data['date_joined']?></p>
                                      </div>
                                    </div>
                                 </div>
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
      <script src="js/sidebar.js"></script>
      <script src="js/dialoguebox.js"></script>
      <script>
   $(document).ready(()=>
    {

    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
    .then(FingerprintJS => FingerprintJS.load());

    fpPromise
    .then(fp => fp.get())
    .then(result => {
    visitorId = result.visitorId
    var data = {
    fingerprint: visitorId
    }

    $.ajax({
    type:'POST',
    url:'/src/api/authorize.api.php',
    dataType: 'json',
    data: data,

    success: function(response)
    { 
        if(response.response == 'success')
        {
           return true
        }
        else{
            window.location.replace('/users/login.php')
        }
    },

    error: function(response)
    {
      window.location.replace('/users/login.php')
    }

    })

    })
    .catch(error => {

    $.ajax({
    type:'POST',
    url:'/src/api/destroysession.api.php',
    dataType: 'json',

    success: function(response)
    { 
        if(response.response == 'success')
        {
            window.location.replace('/users/login.php')   
        }
        else if(response.response == 'failed')
        {
            window.location.replace('/users/login.php')
        }
        else{
            window.location.replace('/users/login.php')
        }
    },

    error: function(response)
    {
            window.location.replace('/users/login.php')
        }

    })

    })


    })
      </script>
   </body>
</html>