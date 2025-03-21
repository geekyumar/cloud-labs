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
                     <li id="domains">
                        <a href="/domains" class="iq-waves-effect"><i class="la la-globe iq-arrow-left"></i><span>My Domains</span></a>
                     </li>
                     <li id="profile">
                        <a href="/profile" class="iq-waves-effect"><i class="las las la-id-card iq-arrow-left"></i><span>My Profile</span></a>
                     </li>
                     <!-- <li id="edit-profile">
                        <a href="/edit-profile" class="iq-waves-effect"><i class="las la-edit iq-arrow-left"></i><span>Edit Profile</span></a>
                     </li> -->
                  </ul>
                  <br>
               </nav>
               <div id="" class="p-3 position-relative">
                  <div class="bg-primary rounded">
                     <div class="iq-card-body">
                        <div class="sidebarbottom-content">
                          
                           <? if(wg::vpnStatus() == true){
                             ?><h5 class=" text-white">VPN Status: Active</h5>
                           <?
                           }else{
                              ?><h5 class=" text-white">VPN Status: Not Active</h5>
                             <?
                           }?>
                          
                           <a onclick="openInfoDialog()" class="btn btn-white w-100  mt-4 text-primary viwe-more">View More</a>
                        </div>
                     </div>
                  </div>
               </div>

               <div style="margin-bottom: 100px" class="p-3">
                  <div class="iq-card rounded">
                     <div class="iq-card-body">
                        <div class="sidebarbottom-content">
                          
                           <h5 class="mb-3 text-black">Server Stats</h5>
                           <div class="mt-4">
                                 <h6 class="text-black">CPU Usage: <span id="cpuPercent" class="text-primary"> Loading.. </span></h6>
                                 <div class="mt-3">
                                    <div class="iq-progress-bar">
                                       <span class="bg-primary" id="cpu-bar" style="transition: width 1s ease 0s;"></span>
                                 </div>
                              </div>
                              </div>

                              <div class="mt-4">
                                 <h6 class="text-black">Memory Usage: <span id="memPercent" class="text-primary">Loading.. </span></h6>
                                
                                 <div class="mt-3">
                                    <div class="iq-progress-bar">
                                       <span class="bg-primary" id="mem-bar" style="transition: width 1s ease 0s;"></span>
                                 </div>
                                 <p class="mb-0 pt-1 mt-1">Memory: <span id="memUsage" class="text-primary"></p>
                              </div>
                              </div>

                              <div class="mt-4">
                                 <h6 class="text-black">Load Avg: <span id="loadAvg" class="text-primary">  Loading.. </span></h6>
                              </div>

                          
                           

                        </div>
                     </div>
                  </div>
               </div>

            </div>
         </div>


         <script>

<? if($_SERVER['HTTPS'] == 'on'){ ?>
const ws = new WebSocket('wss://<?echo $_SERVER['SERVER_NAME']?>:3000');
<? } else {?>
   const ws = new WebSocket('ws://localhost:4000');
<? } ?>

        ws.onopen = () => {
            console.log('Connected to WebSocket server');
        };

        ws.onmessage = (event) => {
            const data = JSON.parse(event.data);
            


            document.getElementById('cpuPercent').textContent = data.cpu;
            document.getElementById('memPercent').textContent = data.memoryUsage;
            document.getElementById('memUsage').textContent = data.usedMemory + ' / ' + data.totalMemory;
            document.getElementById('loadAvg').textContent = data.loadAvg.join(', ');

            document.getElementById("mem-bar").style.width = data.memoryUsage;
            document.getElementById("cpu-bar").style.width = data.cpu;

        };

        ws.onclose = () => {
            console.log('Disconnected from WebSocket server');
        };

        ws.onerror = (error) => {
            console.error('WebSocket error:', error);
        };

            </script>