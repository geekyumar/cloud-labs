<?$session_username = session::getUsername()?>
<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Add MySQL Database - Cloud Labs</title>
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
                     <h4 class="mb-0 text-dark">Add MySQL Database</h4>
                     <p class="mb-0">You can add upto 5 databases to your MySQL user.</p>
                  </div>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"  aria-label="Toggle navigation">
                  <i class="ri-menu-3-line"></i>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                     <ul class="navbar-nav ml-auto navbar-list">
                        <li class="nav-item nav-icon">
                           <div class="iq-search-bar">
                              <form action="#" class="searchbox">
                                 <input type="text" class="text search-input" placeholder="Type here to search...">
                                 <a class="search-link" href="#"><i class="ri-search-line"></i></a>
                              </form>
                           </div>
                        </li>
                        <li class="nav-item nav-icon">
                           <a href="#" class="search-toggle iq-waves-effect text-primary rounded">
                           <i class="ri-notification-line block"></i>
                           <span class="bg-danger dots"></span>
                           </a>
                           <div class="iq-sub-dropdown">
                              <div class="iq-card shadow-none m-0">
                                 <div class="iq-card-body p-0">
                                    <div class="bg-primary p-3">
                                       <h5 class="mb-0 text-white">All Notifications<small class="badge  badge-light float-right pt-1">4</small></h5>
                                    </div>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="images/user/01.jpg" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Emma Watson Barry</h6>
                                             <small class="float-right">Just Now</small>
                                             <p class="mb-0">95 MB</p>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="images/user/02.jpg" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">New customer is join</h6>
                                             <small class="float-right">5 days ago</small>
                                             <p class="mb-0">Cyst Barry</p>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="images/user/03.jpg" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">Two customer is left</h6>
                                             <small class="float-right">2 days ago</small>
                                             <p class="mb-0">Cyst Barry</p>
                                          </div>
                                       </div>
                                    </a>
                                    <a href="#" class="iq-sub-card" >
                                       <div class="media align-items-center">
                                          <div class="">
                                             <img class="avatar-40 rounded" src="images/user/04.jpg" alt="">
                                          </div>
                                          <div class="media-body ml-3">
                                             <h6 class="mb-0 ">New Mail from Fenny</h6>
                                             <small class="float-right">3 days ago</small>
                                             <p class="mb-0">Cyst Barry</p>
                                          </div>
                                       </div>
                                    </a>
                                 </div>
                              </div>
                           </div>
                        </li>
                     </ul>
                  </div>
                  <ul class="navbar-list">
                     <li class="line-height">
                        <a href="#" class="search-toggle iq-waves-effect d-flex align-items-center">
                        <img src="images/user/user.png" class="img-fluid rounded-circle" alt="user">
                        </a>
                        <div class="iq-sub-dropdown iq-user-dropdown">
                           <div class="iq-card shadow-none m-0">
                              <div class="iq-card-body p-0 ">
                                 <div class="bg-primary p-3">
                                    <h5 class="mb-0 text-white line-height">Hello Barry Tech</h5>
                                    <span class="text-white font-size-12">Available</span>
                                 </div>
                                 <a href="profile.html" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-primary">
                                          <i class="ri-file-user-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">My Profile</h6>
                                          <p class="mb-0 font-size-12">View personal profile details.</p>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="profile-edit.html" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-primary">
                                          <i class="ri-profile-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Edit Profile</h6>
                                          <p class="mb-0 font-size-12">Modify your personal details.</p>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="account-setting.html" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-primary">
                                          <i class="ri-account-box-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Account settings</h6>
                                          <p class="mb-0 font-size-12">Manage your account parameters.</p>
                                       </div>
                                    </div>
                                 </a>
                                 <a href="privacy-setting.html" class="iq-sub-card iq-bg-primary-hover">
                                    <div class="media align-items-center">
                                       <div class="rounded iq-card-icon iq-bg-primary">
                                          <i class="ri-lock-line"></i>
                                       </div>
                                       <div class="media-body ml-3">
                                          <h6 class="mb-0 ">Privacy Settings</h6>
                                          <p class="mb-0 font-size-12">Control your privacy parameters.</p>
                                       </div>
                                    </div>
                                 </a>
                                 <div class="d-inline-block w-100 text-center p-3">
                                    <a class="bg-primary iq-sign-btn" href="sign-in.html" role="button">Sign out<i class="ri-login-box-line ml-2"></i></a>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </li>
                  </ul>
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
                                 <h4 class="card-title">Add MySQL Database</h4>
                              </div>
                           </div>
                           <div class="iq-card-body">
                              <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vulputate, ex ac venenatis mollis, diam nibh finibus leo</p> -->
                              <form>
                                 <div class="form-group">
                                    <label for="email">Username</label>
                                    <select class="form-control" id="mysqlUsername">
                                       <?$conn = database::getConnection();
                                       $mysql_users = "SELECT * FROM `mysql_users` WHERE `username` = '$session_username'";

                                       if($conn->query($mysql_users)->num_rows){
                                         ?><option selected disabled>Select username</option><?
                                          $result = $conn->query($mysql_users);

                                          for($i = 1; $i <= $result->num_rows; $i++){
                                             $row = $result->fetch_assoc();
                                          ?><option><?echo $row['mysql_username']?></option><?
                                    }
                                    }else{
                                       ?><option selected disabled>There are no users for this username.</option><?
                                    }?>
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label for="email">Database Name</label>
                                    <input type="text" class="form-control" id="mysqlDbname">
                                 </div>
                                 <div class="form-group">
                                    <label for="email">Collation</label>
                                    <select class="form-control col-lg-8" id="collation">
                                       <option value="">(collation)</option>
                                       <optgroup label="armscii8">
                                          <option>armscii8_bin</option>
                                          <option>armscii8_general_ci</option>
                                       </optgroup>
                                       <optgroup label="ascii">
                                          <option>ascii_bin</option>
                                          <option>ascii_general_ci</option>
                                       </optgroup>
                                       <optgroup label="big5">
                                          <option>big5_bin</option>
                                          <option>big5_chinese_ci</option>
                                       </optgroup>
                                       <optgroup label="binary">
                                          <option>binary</option>
                                       </optgroup>
                                       <optgroup label="cp1250">
                                          <option>cp1250_bin</option>
                                          <option>cp1250_croatian_ci</option>
                                          <option>cp1250_czech_cs</option>
                                          <option>cp1250_general_ci</option>
                                          <option>cp1250_polish_ci</option>
                                       </optgroup>
                                       <optgroup label="cp1251">
                                          <option>cp1251_bin</option>
                                          <option>cp1251_bulgarian_ci</option>
                                          <option>cp1251_general_ci</option>
                                          <option>cp1251_general_cs</option>
                                          <option>cp1251_ukrainian_ci</option>
                                       </optgroup>
                                       <optgroup label="cp1256">
                                          <option>cp1256_bin</option>
                                          <option>cp1256_general_ci</option>
                                       </optgroup>
                                       <optgroup label="cp1257">
                                          <option>cp1257_bin</option>
                                          <option>cp1257_general_ci</option>
                                          <option>cp1257_lithuanian_ci</option>
                                       </optgroup>
                                       <optgroup label="cp850">
                                          <option>cp850_bin</option>
                                          <option>cp850_general_ci</option>
                                       </optgroup>
                                       <optgroup label="cp852">
                                          <option>cp852_bin</option>
                                          <option>cp852_general_ci</option>
                                       </optgroup>
                                       <optgroup label="cp866">
                                          <option>cp866_bin</option>
                                          <option>cp866_general_ci</option>
                                       </optgroup>
                                       <optgroup label="cp932">
                                          <option>cp932_bin</option>
                                          <option>cp932_japanese_ci</option>
                                       </optgroup>
                                       <optgroup label="dec8">
                                          <option>dec8_bin</option>
                                          <option>dec8_swedish_ci</option>
                                       </optgroup>
                                       <optgroup label="eucjpms">
                                          <option>eucjpms_bin</option>
                                          <option>eucjpms_japanese_ci</option>
                                       </optgroup>
                                       <optgroup label="euckr">
                                          <option>euckr_bin</option>
                                          <option>euckr_korean_ci</option>
                                       </optgroup>
                                       <optgroup label="gb18030">
                                          <option>gb18030_bin</option>
                                          <option>gb18030_chinese_ci</option>
                                          <option>gb18030_unicode_520_ci</option>
                                       </optgroup>
                                       <optgroup label="gb2312">
                                          <option>gb2312_bin</option>
                                          <option>gb2312_chinese_ci</option>
                                       </optgroup>
                                       <optgroup label="gbk">
                                          <option>gbk_bin</option>
                                          <option>gbk_chinese_ci</option>
                                       </optgroup>
                                       <optgroup label="geostd8">
                                          <option>geostd8_bin</option>
                                          <option>geostd8_general_ci</option>
                                       </optgroup>
                                       <optgroup label="greek">
                                          <option>greek_bin</option>
                                          <option>greek_general_ci</option>
                                       </optgroup>
                                       <optgroup label="hebrew">
                                          <option>hebrew_bin</option>
                                          <option>hebrew_general_ci</option>
                                       </optgroup>
                                       <optgroup label="hp8">
                                          <option>hp8_bin</option>
                                          <option>hp8_english_ci</option>
                                       </optgroup>
                                       <optgroup label="keybcs2">
                                          <option>keybcs2_bin</option>
                                          <option>keybcs2_general_ci</option>
                                       </optgroup>
                                       <optgroup label="koi8r">
                                          <option>koi8r_bin</option>
                                          <option>koi8r_general_ci</option>
                                       </optgroup>
                                       <optgroup label="koi8u">
                                          <option>koi8u_bin</option>
                                          <option>koi8u_general_ci</option>
                                       </optgroup>
                                       <optgroup label="latin1">
                                          <option>latin1_bin</option>
                                          <option>latin1_danish_ci</option>
                                          <option>latin1_general_ci</option>
                                          <option>latin1_general_cs</option>
                                          <option>latin1_german1_ci</option>
                                          <option>latin1_german2_ci</option>
                                          <option>latin1_spanish_ci</option>
                                          <option>latin1_swedish_ci</option>
                                       </optgroup>
                                       <optgroup label="latin2">
                                          <option>latin2_bin</option>
                                          <option>latin2_croatian_ci</option>
                                          <option>latin2_czech_cs</option>
                                          <option>latin2_general_ci</option>
                                          <option>latin2_hungarian_ci</option>
                                       </optgroup>
                                       <optgroup label="latin5">
                                          <option>latin5_bin</option>
                                          <option>latin5_turkish_ci</option>
                                       </optgroup>
                                       <optgroup label="latin7">
                                          <option>latin7_bin</option>
                                          <option>latin7_estonian_cs</option>
                                          <option>latin7_general_ci</option>
                                          <option>latin7_general_cs</option>
                                       </optgroup>
                                       <optgroup label="macce">
                                          <option>macce_bin</option>
                                          <option>macce_general_ci</option>
                                       </optgroup>
                                       <optgroup label="macroman">
                                          <option>macroman_bin</option>
                                          <option>macroman_general_ci</option>
                                       </optgroup>
                                       <optgroup label="sjis">
                                          <option>sjis_bin</option>
                                          <option>sjis_japanese_ci</option>
                                       </optgroup>
                                       <optgroup label="swe7">
                                          <option>swe7_bin</option>
                                          <option>swe7_swedish_ci</option>
                                       </optgroup>
                                       <optgroup label="tis620">
                                          <option>tis620_bin</option>
                                          <option>tis620_thai_ci</option>
                                       </optgroup>
                                       <optgroup label="ucs2">
                                          <option>ucs2_bin</option>
                                          <option>ucs2_croatian_ci</option>
                                          <option>ucs2_czech_ci</option>
                                          <option>ucs2_danish_ci</option>
                                          <option>ucs2_esperanto_ci</option>
                                          <option>ucs2_estonian_ci</option>
                                          <option>ucs2_general_ci</option>
                                          <option>ucs2_general_mysql500_ci</option>
                                          <option>ucs2_german2_ci</option>
                                          <option>ucs2_hungarian_ci</option>
                                          <option>ucs2_icelandic_ci</option>
                                          <option>ucs2_latvian_ci</option>
                                          <option>ucs2_lithuanian_ci</option>
                                          <option>ucs2_persian_ci</option>
                                          <option>ucs2_polish_ci</option>
                                          <option>ucs2_roman_ci</option>
                                          <option>ucs2_romanian_ci</option>
                                          <option>ucs2_sinhala_ci</option>
                                          <option>ucs2_slovak_ci</option>
                                          <option>ucs2_slovenian_ci</option>
                                          <option>ucs2_spanish2_ci</option>
                                          <option>ucs2_spanish_ci</option>
                                          <option>ucs2_swedish_ci</option>
                                          <option>ucs2_turkish_ci</option>
                                          <option>ucs2_unicode_520_ci</option>
                                          <option>ucs2_unicode_ci</option>
                                          <option>ucs2_vietnamese_ci</option>
                                       </optgroup>
                                       <optgroup label="ujis">
                                          <option>ujis_bin</option>
                                          <option>ujis_japanese_ci</option>
                                       </optgroup>
                                       <optgroup label="utf16">
                                          <option>utf16_bin</option>
                                          <option>utf16_croatian_ci</option>
                                          <option>utf16_czech_ci</option>
                                          <option>utf16_danish_ci</option>
                                          <option>utf16_esperanto_ci</option>
                                          <option>utf16_estonian_ci</option>
                                          <option>utf16_general_ci</option>
                                          <option>utf16_german2_ci</option>
                                          <option>utf16_hungarian_ci</option>
                                          <option>utf16_icelandic_ci</option>
                                          <option>utf16_latvian_ci</option>
                                          <option>utf16_lithuanian_ci</option>
                                          <option>utf16_persian_ci</option>
                                          <option>utf16_polish_ci</option>
                                          <option>utf16_roman_ci</option>
                                          <option>utf16_romanian_ci</option>
                                          <option>utf16_sinhala_ci</option>
                                          <option>utf16_slovak_ci</option>
                                          <option>utf16_slovenian_ci</option>
                                          <option>utf16_spanish2_ci</option>
                                          <option>utf16_spanish_ci</option>
                                          <option>utf16_swedish_ci</option>
                                          <option>utf16_turkish_ci</option>
                                          <option>utf16_unicode_520_ci</option>
                                          <option>utf16_unicode_ci</option>
                                          <option>utf16_vietnamese_ci</option>
                                       </optgroup>
                                       <optgroup label="utf16le">
                                          <option>utf16le_bin</option>
                                          <option>utf16le_general_ci</option>
                                       </optgroup>
                                       <optgroup label="utf32">
                                          <option>utf32_bin</option>
                                          <option>utf32_croatian_ci</option>
                                          <option>utf32_czech_ci</option>
                                          <option>utf32_danish_ci</option>
                                          <option>utf32_esperanto_ci</option>
                                          <option>utf32_estonian_ci</option>
                                          <option>utf32_general_ci</option>
                                          <option>utf32_german2_ci</option>
                                          <option>utf32_hungarian_ci</option>
                                          <option>utf32_icelandic_ci</option>
                                          <option>utf32_latvian_ci</option>
                                          <option>utf32_lithuanian_ci</option>
                                          <option>utf32_persian_ci</option>
                                          <option>utf32_polish_ci</option>
                                          <option>utf32_roman_ci</option>
                                          <option>utf32_romanian_ci</option>
                                          <option>utf32_sinhala_ci</option>
                                          <option>utf32_slovak_ci</option>
                                          <option>utf32_slovenian_ci</option>
                                          <option>utf32_spanish2_ci</option>
                                          <option>utf32_spanish_ci</option>
                                          <option>utf32_swedish_ci</option>
                                          <option>utf32_turkish_ci</option>
                                          <option>utf32_unicode_520_ci</option>
                                          <option>utf32_unicode_ci</option>
                                          <option>utf32_vietnamese_ci</option>
                                       </optgroup>
                                       <optgroup label="utf8mb3">
                                          <option>utf8mb3_bin</option>
                                          <option>utf8mb3_croatian_ci</option>
                                          <option>utf8mb3_czech_ci</option>
                                          <option>utf8mb3_danish_ci</option>
                                          <option>utf8mb3_esperanto_ci</option>
                                          <option>utf8mb3_estonian_ci</option>
                                          <option>utf8mb3_general_ci</option>
                                          <option>utf8mb3_general_mysql500_ci</option>
                                          <option>utf8mb3_german2_ci</option>
                                          <option>utf8mb3_hungarian_ci</option>
                                          <option>utf8mb3_icelandic_ci</option>
                                          <option>utf8mb3_latvian_ci</option>
                                          <option>utf8mb3_lithuanian_ci</option>
                                          <option>utf8mb3_persian_ci</option>
                                          <option>utf8mb3_polish_ci</option>
                                          <option>utf8mb3_roman_ci</option>
                                          <option>utf8mb3_romanian_ci</option>
                                          <option>utf8mb3_sinhala_ci</option>
                                          <option>utf8mb3_slovak_ci</option>
                                          <option>utf8mb3_slovenian_ci</option>
                                          <option>utf8mb3_spanish2_ci</option>
                                          <option>utf8mb3_spanish_ci</option>
                                          <option>utf8mb3_swedish_ci</option>
                                          <option>utf8mb3_tolower_ci</option>
                                          <option>utf8mb3_turkish_ci</option>
                                          <option>utf8mb3_unicode_520_ci</option>
                                          <option>utf8mb3_unicode_ci</option>
                                          <option>utf8mb3_vietnamese_ci</option>
                                       </optgroup>
                                       <optgroup label="utf8mb4">
                                          <option selected="">utf8mb4_0900_ai_ci</option>
                                          <option>utf8mb4_0900_as_ci</option>
                                          <option>utf8mb4_0900_as_cs</option>
                                          <option>utf8mb4_0900_bin</option>
                                          <option>utf8mb4_bg_0900_ai_ci</option>
                                          <option>utf8mb4_bg_0900_as_cs</option>
                                          <option>utf8mb4_bin</option>
                                          <option>utf8mb4_bs_0900_ai_ci</option>
                                          <option>utf8mb4_bs_0900_as_cs</option>
                                          <option>utf8mb4_croatian_ci</option>
                                          <option>utf8mb4_cs_0900_ai_ci</option>
                                          <option>utf8mb4_cs_0900_as_cs</option>
                                          <option>utf8mb4_czech_ci</option>
                                          <option>utf8mb4_da_0900_ai_ci</option>
                                          <option>utf8mb4_da_0900_as_cs</option>
                                          <option>utf8mb4_danish_ci</option>
                                          <option>utf8mb4_de_pb_0900_ai_ci</option>
                                          <option>utf8mb4_de_pb_0900_as_cs</option>
                                          <option>utf8mb4_eo_0900_ai_ci</option>
                                          <option>utf8mb4_eo_0900_as_cs</option>
                                          <option>utf8mb4_es_0900_ai_ci</option>
                                          <option>utf8mb4_es_0900_as_cs</option>
                                          <option>utf8mb4_es_trad_0900_ai_ci</option>
                                          <option>utf8mb4_es_trad_0900_as_cs</option>
                                          <option>utf8mb4_esperanto_ci</option>
                                          <option>utf8mb4_estonian_ci</option>
                                          <option>utf8mb4_et_0900_ai_ci</option>
                                          <option>utf8mb4_et_0900_as_cs</option>
                                          <option>utf8mb4_general_ci</option>
                                          <option>utf8mb4_german2_ci</option>
                                          <option>utf8mb4_gl_0900_ai_ci</option>
                                          <option>utf8mb4_gl_0900_as_cs</option>
                                          <option>utf8mb4_hr_0900_ai_ci</option>
                                          <option>utf8mb4_hr_0900_as_cs</option>
                                          <option>utf8mb4_hu_0900_ai_ci</option>
                                          <option>utf8mb4_hu_0900_as_cs</option>
                                          <option>utf8mb4_hungarian_ci</option>
                                          <option>utf8mb4_icelandic_ci</option>
                                          <option>utf8mb4_is_0900_ai_ci</option>
                                          <option>utf8mb4_is_0900_as_cs</option>
                                          <option>utf8mb4_ja_0900_as_cs</option>
                                          <option>utf8mb4_ja_0900_as_cs_ks</option>
                                          <option>utf8mb4_la_0900_ai_ci</option>
                                          <option>utf8mb4_la_0900_as_cs</option>
                                          <option>utf8mb4_latvian_ci</option>
                                          <option>utf8mb4_lithuanian_ci</option>
                                          <option>utf8mb4_lt_0900_ai_ci</option>
                                          <option>utf8mb4_lt_0900_as_cs</option>
                                          <option>utf8mb4_lv_0900_ai_ci</option>
                                          <option>utf8mb4_lv_0900_as_cs</option>
                                          <option>utf8mb4_mn_cyrl_0900_ai_ci</option>
                                          <option>utf8mb4_mn_cyrl_0900_as_cs</option>
                                          <option>utf8mb4_nb_0900_ai_ci</option>
                                          <option>utf8mb4_nb_0900_as_cs</option>
                                          <option>utf8mb4_nn_0900_ai_ci</option>
                                          <option>utf8mb4_nn_0900_as_cs</option>
                                          <option>utf8mb4_persian_ci</option>
                                          <option>utf8mb4_pl_0900_ai_ci</option>
                                          <option>utf8mb4_pl_0900_as_cs</option>
                                          <option>utf8mb4_polish_ci</option>
                                          <option>utf8mb4_ro_0900_ai_ci</option>
                                          <option>utf8mb4_ro_0900_as_cs</option>
                                          <option>utf8mb4_roman_ci</option>
                                          <option>utf8mb4_romanian_ci</option>
                                          <option>utf8mb4_ru_0900_ai_ci</option>
                                          <option>utf8mb4_ru_0900_as_cs</option>
                                          <option>utf8mb4_sinhala_ci</option>
                                          <option>utf8mb4_sk_0900_ai_ci</option>
                                          <option>utf8mb4_sk_0900_as_cs</option>
                                          <option>utf8mb4_sl_0900_ai_ci</option>
                                          <option>utf8mb4_sl_0900_as_cs</option>
                                          <option>utf8mb4_slovak_ci</option>
                                          <option>utf8mb4_slovenian_ci</option>
                                          <option>utf8mb4_spanish2_ci</option>
                                          <option>utf8mb4_spanish_ci</option>
                                          <option>utf8mb4_sr_latn_0900_ai_ci</option>
                                          <option>utf8mb4_sr_latn_0900_as_cs</option>
                                          <option>utf8mb4_sv_0900_ai_ci</option>
                                          <option>utf8mb4_sv_0900_as_cs</option>
                                          <option>utf8mb4_swedish_ci</option>
                                          <option>utf8mb4_tr_0900_ai_ci</option>
                                          <option>utf8mb4_tr_0900_as_cs</option>
                                          <option>utf8mb4_turkish_ci</option>
                                          <option>utf8mb4_unicode_520_ci</option>
                                          <option>utf8mb4_unicode_ci</option>
                                          <option>utf8mb4_vi_0900_ai_ci</option>
                                          <option>utf8mb4_vi_0900_as_cs</option>
                                          <option>utf8mb4_vietnamese_ci</option>
                                          <option>utf8mb4_zh_0900_as_cs</option>
                                       </optgroup>
                                    </select>
                                 </div>
                                 <br>
                                 <a class="btn btn-primary text-white" id="addDb">Add database</a>
                                 <a class="btn iq-bg-danger" href="/services">Go back</a>
                              </form>
                           </div>
                           
                        </div>
               <div class="row">
                  <div class="col-lg-12">
                  <h4 class="card-title ml-2">MySQL Databases</h4>
                  <br>
                    <div class="row" id="mysqlUsers">

                   
                    <div class="row">
                  <div class="col-lg-12">
                    <div class="row">

               <p class="mb-0 ml-4 pl-3">Your MySQL Databases list will appear here. toggle the username above to view your databases.</p>

                     </div>
                  </div>
               </div>
                        <!-- <div class="col-sm-6">
                           <div class="iq-card  iq-mb-3">
                              <div class="iq-card-body">
                                 <h4 class="card-title">MySQL Server</h4>
                                 <p class="card-text">MySQL is a popular relational database managenent system currently maintained by oracle. </p>
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
      <script src="js/sidebar.js"></script>
      <script src="js/add-mysql-db.js"></script>
      <script src="js/fetch-mysql-db.js"></script>
   
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

