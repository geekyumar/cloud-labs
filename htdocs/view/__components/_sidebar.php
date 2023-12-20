<div class="iq-sidebar">
            <div class="iq-sidebar-logo d-flex justify-content-between">
               <a href="/" class="header-logo">
                  <div class="logo-title">
                     <span class="text-danger">Cloud<span class="text-primary ml-1">Labs</span></span>
                  </div>
               </a>
               <div class="iq-menu-bt-sidebar">
                  <div class="iq-menu-bt align-self-center">
                     <div class="wrapper-menu">
                        <div class="main-circle"><i class="ri-arrow-left-s-line"></i></div>
                        <div class="hover-circle"><i class="ri-arrow-right-s-line"></i></div>
                     </div>
                  </div>
               </div>
            </div>
            <div id="sidebar-scrollbar">
               <nav class="iq-sidebar-menu">
                  <ul id="iq-sidebar-toggle" class="iq-menu">
                     <li id="dashboard">
                      <a href="/"><i class="las la-house-damage"></i>Dashboard</a>
                    </li>
                    <!--labs active-->
                     <li id="labs">
                        <a href="/labs" class="iq-waves-effect"><i class="las la-cloud iq-arrow-left"></i><span>Labs</span></a>
                     </li>
                     <li id="services">
                        <a href="/services" class="iq-waves-effect"><i class="las la-window-restore iq-arrow-left"></i><span>Services</span></a>
                     </li>
                     <li id="devices-nav">
                        <a href="#userinfo"  class="iq-waves-effect" data-toggle="collapse" aria-expanded="false"><span class="ripple rippleEffect"></span><i class="las la-user-tie iq-arrow-left"></i><span>My Devices</span><i class="ri-arrow-right-s-line iq-arrow-right"></i></a>
                        <ul id="userinfo" class="iq-submenu collapse" data-parent="#iq-sidebar-toggle" style="">
                           <li id="devices"><a href="/devices"><i class="las la-id-card-alt"></i>List Devices</a></li>
                           <li id="add-device"><a href="/add-device"><i class="las la-edit"></i>Add new device</a></li>
                           
                        </ul>
                     </li>
                     <li id="profile">
                        <a href="/profile" class="iq-waves-effect"><i class="las las la-id-card iq-arrow-left"></i><span>My Profile</span></a>
                     </li>
                     <li id="edit-profile">
                        <a href="/edit-profile" class="iq-waves-effect"><i class="las la-edit iq-arrow-left"></i><span>Edit Profile</span></a>
                     </li>
                  </ul>
                  <br>
               </nav>
               <div id="sidebar-bottom" class="p-3 position-relative">
                  <div class="iq-card bg-primary rounded">
                     <div class="iq-card-body">
                        <div class="sidebarbottom-content">
                          
                           <? if(wg::vpnStatus() == true){
                             ?><h5 class="mb-3 text-white">VPN Status: Active</h5>
                             <p class="mb-0 text-light">Now you can access your devices and server instances.</p><?
                           }else{
                              ?><h5 class="mb-3 text-white">VPN Status: Not Active</h5>
                              <p class="mb-0 text-light">The VPN Server is under maintainence.</p><?
                           }?>
                          
                           
                           <a onclick="openInfoDialog()" class="btn btn-white w-100  mt-4 text-primary viwe-more">View More</a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>