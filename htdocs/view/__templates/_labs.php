<?
$session_username = session::getUsername();

?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Labs - Cloud Labs</title>
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
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
     
      <!-- Wrapper Start -->
      <div class="toast-container" id="toast-container"></div>
      <link href="css/toast.css" rel="stylesheet">
      <script src="js/toast.js"></script>
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
                     <h4 class="mb-0 text-dark">Labs Dashboard</h4>
                     <p class="mb-0"><span class="text-danger">Hi <?echo session::getName()?>!</span> Great to see you again</p>
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
               <div class="row content-body">
                  <div class="col-lg-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height iq-bg-danger ">
                        <div class="d-flex">
                        <div class="iq-card-body box iq-box-relative">
                           <div class="float-left">
                              <img class="rounded img-fluid" style="width:75%; height:75%" src="images/ubuntu/icons8-ubuntu-96.png" alt="profile">
                           </div>
                           <div class="justify-content-between">
                           <h4 class="d-block mb-2 text-black">Ubuntu Server</h4>
                           <p class="d-inline-block welcome-text text-black">A Ubuntu 23.04 lab packed with all the essentials to code, host, build, and develop, with a superuser (root) access.</p>
                        </div>
                    </div>
                     <? if(labs::isCreated()){
                        $labs = new labs(session::getUsername());
                        if($labs->labStatus() == true){
                           ?>
                           <a id="redeployInstance" class="text-white btn btn-primary mr-4 align-self-center">Redeploy</a>
                           <a id="stopInstance" class=" text-white btn btn-primary mr-4 align-self-center">Stop</a>
                          
                           <?
                        }
                        else{
                           ?>
                          <a id="deployInstance" class="btn btn-primary text-white align-self-center">Deploy</a>
                           <?
                        }
                     }
                     else{
                        ?>
                           <a id="createInstance" class="btn btn-primary text-white align-self-center">Create Instance</a>
                        <?
                     }
                     ?>
                        </div>
                        </div>
                     </div>
                  </div>

                  <div class="iq-header-title pl-4 pb-4">
                     <h4 class="mb-0 text-dark">Container Usage</h4>
                     <p class="mb-0">Container status: 
                        <?if(labs::isCreated()){
                        if($labs->labStatus($instance_id, $session_username)){
                           ?>
                           <span id="labs-status" class="text-danger">Online</p>
                           <?
                           }
                           else{
                              ?>
                              <span id="labs-status" class="text-danger">Offline</p>
                              <?
                           }
                        }
                           else{
                              ?>
                              <span id="labs-status" class="text-danger">Not Created</p>
                              <?
                           }
                        ?>
                        
                  </div>

                  <div class="col-lg-12 row m-0 p-0">
                     <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body">
                              <div class="icon iq-icon-box iq-bg-primary rounded" data-wow-delay="0.2s">
                                 <i class="ri-cpu-line"></i>
                              </div>
                              <div class="mt-4">
                                 <h5 class="text-black text-uppercase">CPU Usage</h5>
                                 <h3 class="d-flex text-primary" id="CPUPerc_big"> 0%</h3>
                              </div>
                              <div class="d-flex justift-content-">
                              <p class="mb-0 mt-1">PIDs: </p>
                              <p class="mb-0 mt-1" id="PIDs">0</p>
                        </div>
                              <div class="mt-3">
                                 <div class="d-inline-block mt-1 w-100">
                                    <div class="iq-progress-bar">
                                       <span class="bg-primary" id="CPUPerc" style="transition: width 1s ease 0s;"></span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body">
                              <div class="icon iq-icon-box iq-bg-danger rounded" data-wow-delay="0.2s">
                                 <i class="ri-window-line"></i>
                              </div>
                              <div class="mt-4">
                                 <h5 class="text-black text-uppercase">RAM Usage</h5>
                                 <h3 class="d-flex text-danger" id="MemPerc_big"> 0%</h3>
                              </div>
                              <div class="d-flex justift-content-">
                              <p class="mb-0 mt-1">Memory: </p>
                              <p class="mb-0 mt-1" id="MemUsage">0B /0B</p>
                        </div>
                              <div class="mt-3">
                                 <div class="iq-progress-bar-linear d-inline-block mt-1 w-100">
                                    <div class="iq-progress-bar">
                                       <span class="bg-danger" id="MemPerc" style="transition: width 1s ease 0s;"></span>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body">
                              <div class="icon iq-icon-box iq-bg-primary rounded" data-wow-delay="0.2s">
                                 <i class="ri-u-disk-line"></i>
                              </div>
                              <div class="mt-4">
                                 <h5 class="text-black text-uppercase">Block IO</h5>
                                 <h3 class="d-flex text-primary pt-3" id="BlockIO"> 0B / 0B</h3>
                              </div>
                              <!-- <p class="mb-0 mt-1" id="BlockIOPerc">0%</p> -->
                              <div class="mt-3">
                                 <!--
                                 <div class="iq-progress-bar-linear d-inline-block mt-1 w-100">
                                    <div class="iq-progress-bar">
                                    <span class="bg-danger" id="BlockIOPerc" style="transition: width 1s ease 0s;"></span>
                                    </div>
                                 </div> -->
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6 col-md-6 col-lg-3">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-body">
                              <div class="icon iq-icon-box iq-bg-danger rounded" data-wow-delay="0.2s">
                                 <i class="ri-global-line"></i>
                              </div>
                              <div class="mt-4">
                                 <h5 class="text-black text-uppercase">Net IO</h5>
                                 <h3 class="d-flex text-danger pt-3" id="NetIO"> 0B / 0B</i></h3>
                              </div>
                              <!-- <p class="mb-0 mt-1" id="NetIOPerc">0%</p> -->
                              <div class="mt-3">
                                 <!-- <div class="iq-progress-bar-linear d-inline-block mt-1 w-100">
                                    <div class="iq-progress-bar">
                                    <span class="bg-danger" id="NetIOPerc" style="transition: width 1s ease 0s;"></span>
                                    </div>
                                 </div> -->
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <? /* if(labs::isCreated($session_username)){ 
                   if($labs->labStatus($instance_id, $session_username) == true){
                     session::loadComponent('redeploy-dialoguebox');
                     session::loadComponent('stop-dialoguebox');
                  }else{
                     session::loadComponent('deploy-dialoguebox');
                  }
               }else{
                  session::loadComponent('create-dialoguebox');
               } */
               ?>

                  <div class="col-lg-8">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height rounded">
                        <div class="iq-card-body">
                           <div class="d-flex align-items-center mb-3">
                              <div><img style="width: 50px; height: 50px" src="images/page-img/50.png" alt=""></div>
                              <h5 class="pl-3 text-black">Instance details</h5>
                           </div>
                           <p class="mb-2">SSH Username: 'your username'</p>
                           <p class="mb-2">SSH Password: 'your username'@user</p>
                           <p class="mb-2">Instance IP: <?echo $labs->instance['wg_ip'] ?? 'N/A'?></p>
                           <p class="mb-3">SSH Command: ssh <?echo $session_username?>@<?echo $labs->instance['wg_ip'] ?? 'N/A'?></p>
                        </div>
                     </div>
                  </div>


                  <!-- <div class="col-lg-12 row m-0 p-0">
                     <div class="col-sm-6">
                        <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                           <div class="iq-card-header d-flex justify-content-center">
                              <div class="iq-header-title">
                                 <h4 class="card-title">CPU Daily Usage</h4>
                              </div>
                           </div>
                           <div class="iq-card-body">
                              <div class="text-center">
                                 <h4>50.03%</h4>
                                 <p class="mb-0">CPU usage is<span class="text-primary pl-2">good</span></p>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-sm-6">
                        <div class="iq-card bg-danger">
                           <div class="iq-card-body box iq-box-relative">
                              <div class="d-flex flex-wrap justify-content-between align-items-center">
                                 <div class="col-4 p-0">
                                    <div class="float-left progress-round income-progress mr-2" data-value="80">
                                       <span class="progress-left">
                                       <span class="progress-bar border-white" style="transform: rotate(108deg);"></span>
                                       </span>
                                       <span class="progress-right">
                                       <span class="progress-bar border-white" style="transform: rotate(180deg);"></span>
                                       </span>
                                       <div class="progress-value w-100 h-100 rounded d-flex align-items-center justify-content-center text-center">
                                          <div class="h4 mb-0">12</div>
                                       </div>
                                    </div>
                                 </div>
                                 <div class="col-8 pr-0">
                                    <h5 class="d-block mt-2 mb-3 text-white">Most Recent Alarams</h5>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div> -->
                  <!-- <div class="col-lg-12">
                     <div class="iq-card iq-card-block iq-card-stretch iq-card-height">
                        <div class="iq-card-header d-flex justify-content-between">
                           <div class="iq-header-title">
                              <h4 class="card-title">Active Instances</h4>
                           </div>
                           <div class="iq-card-header-toolbar d-flex align-items-center">
                              <div class="dropdown">
                                 <span class="dropdown-toggle text-primary" id="dropdownMenuButton2" data-toggle="dropdown">
                                 <i class="ri-more-2-fill"></i>
                                 </span>
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton2">
                                    <a class="dropdown-item" href="#"><i class="ri-eye-fill mr-2"></i>View</a>
                                    <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-fill mr-2"></i>Delete</a>
                                    <a class="dropdown-item" href="#"><i class="ri-pencil-fill mr-2"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i class="ri-printer-fill mr-2"></i>Print</a>
                                    <a class="dropdown-item" href="#"><i class="ri-file-download-fill mr-2"></i>Download</a>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="iq-card-body">
                           <div class="table-responsive">
                              <table class="table mb-0 table-borderless tbl-server-info">
                                 <thead>
                                    <tr>
                                       <th scope="col">Servers</th>
                                       <th scope="col"></th>
                                       <th scope="col">IP Address</th>
                                       <th scope="col">Created</th>
                                       <th scope="col">Tag</th>
                                       <th scope="col">Provider</th>
                                       <th scope="col"></th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                    <tr>
                                       <td>
                                          <div class="avatar-40 text-center rounded-circle iq-bg-danger position-relative">
                                             <span class="font-size-20 align-item-center"><i class="fa fa-user" aria-hidden="true"></i><span class="bg-success dots"></span></span>
                                          </div>
                                       </td>
                                       <td>
                                          <h6>Noveruche Admin</h6>
                                          <span class="text-body font-weight-400">8GB/80GB/SF02-Ubuntu Iconic- jfkakf-daksl...</span>
                                       </td>
                                       <td>192.168.130.26</td>
                                       <td>2 Months ago</td>
                                       <td>
                                          <div class="text-danger">Web Server</div>
                                       </td>
                                       <td>Indioserver</td>
                                       <td>
                                          <span class="text-black font-size-24" id="dropdownMenuButton3">
                                          <i class="ri-more-fill"></i>
                                          </span>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="avatar-40 text-center rounded-circle iq-bg-danger position-relative">
                                             <span class="font-size-20 align-item-center"><i class="fa fa-user" aria-hidden="true"></i><span class="bg-success dots"></span></span>
                                          </div>
                                       </td>
                                       <td>
                                          <h6>Developing Hier</h6>
                                          <span class="text-body font-weight-400">8GB/80GB/SF02-Ubuntu Iconic- jfkakf-daksl...</span>
                                       </td>
                                       <td>192.168.130.26</td>
                                       <td>4 Months ago</td>
                                       <td>
                                          <div class="text-primary">Desky</div>
                                       </td>
                                       <td>Jeniorde</td>
                                       <td>
                                          <span class="text-black font-size-24" id="dropdownMenuButton4">
                                          <i class="ri-more-fill"></i>
                                          </span>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="avatar-40 text-center rounded-circle iq-bg-danger position-relative">
                                             <span class="font-size-20 align-item-center"><i class="fa fa-user" aria-hidden="true"></i><span class="bg-success dots"></span></span>
                                          </div>
                                       </td>
                                       <td>
                                          <h6>Nalurel Dilam</h6>
                                          <span class="text-body font-weight-400">8GB/80GB/SF02-Ubuntu Iconic- jfkakf-daksl...</span>
                                       </td>
                                       <td>192.168.130.26</td>
                                       <td>5 Months ago</td>
                                       <td>
                                          <div class="text-success">Software</div>
                                       </td>
                                       <td>Walikarsi</td>
                                       <td>
                                          <span class="text-black font-size-24" id="dropdownMenuButton5">
                                          <i class="ri-more-fill"></i>
                                          </span>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="avatar-40 text-center rounded-circle iq-bg-danger position-relative">
                                             <span class="font-size-20 align-item-center"><i class="fa fa-user" aria-hidden="true"></i><span class="bg-success dots"></span></span>
                                          </div>
                                       </td>
                                       <td>
                                          <h6>Nariokali Borji</h6>
                                          <span class="text-body font-weight-400">8GB/80GB/SF02-Ubuntu Iconic- jfkakf-daksl...</span>
                                       </td>
                                       <td>192.168.130.26</td>
                                       <td>6 Months ago</td>
                                       <td>
                                          <div class="text-primary">Innohouse</div>
                                       </td>
                                       <td>Leoharshan</td>
                                       <td>
                                          <span class="text-black font-size-24" id="dropdownMenuButton6">
                                          <i class="ri-more-fill"></i>
                                          </span>
                                       </td>
                                    </tr>
                                    <tr>
                                       <td>
                                          <div class="avatar-40 text-center rounded-circle iq-bg-danger position-relative">
                                             <span class="font-size-20 align-item-center"><i class="fa fa-user" aria-hidden="true"></i><span class="bg-success dots"></span></span>
                                          </div>
                                       </td>
                                       <td>
                                          <h6>Bulesta Karolin</h6>
                                          <span class="text-body font-weight-400">8GB/80GB/SF02-Ubuntu Iconic- jfkakf-daksl...</span>
                                       </td>
                                       <td>192.168.130.26</td>
                                       <td>6 Months ago</td>
                                       <td>
                                          <div class="text-danger">Rodrigez</div>
                                       </td>
                                       <td>Karilorni</td>
                                       <td>
                                          <span class="text-black font-size-24" id="dropdownMenuButton7">
                                          <i class="ri-more-fill"></i>
                                          </span>
                                       </td>
                                    </tr>
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div> -->
               </div>
            </div>
         </div>
      </div>
      <!-- Wrapper END -->

      <input type="text" id="instance_id" value="<?echo $labs->instance['instance_id'] ?? ''?>" hidden>
      <!-- Footer -->
      <?php session::loadComponent('footer')?>
      <!-- Footer END -->
      <!-- color-customizer -->
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
      <!-- Raphael-min JavaScript -->
      <script src="js/raphael-min.js"></script>
      <!-- Morris JavaScript -->
      <script src="js/morris.js"></script>
      <!-- Morris min JavaScript -->
      <script src="js/morris.min.js"></script>
      <!-- Flatpicker Js -->
      <script src="js/flatpickr.js"></script>
      <!-- Style Customizer -->
      <script src="js/style-customizer.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="js/custom.js"></script>

      <script src="/js/app.js"></script>

   </body>
</html>