<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title>Login - Cloud Labs</title>
      <!-- Favicon -->
      <link rel="shortcut icon" href="/images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="/css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="/css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="/css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="/css/responsive.css">
      <!-- Toast Messages -->
      <link rel="stylesheet" href="/css/toast.css">
    <div class="toast-container" id="toast-container"></div>
   </head>
   <body>
      <!-- loader Start -->
      <div id="loading">
         <div id="loading-center">
         </div>
      </div>
      <!-- loader END -->
        <!-- Sign in Start -->
        <section class="sign-in-page">
          <div class="container p-0" id="sign-in-page-box">
                <div class="bg-white form-container sign-in-container">
                    <div class="sign-in-page-data">
                      <div class="sign-in-from w-100 m-auto">
                          <h1 class="mb-3 text-center">Sign in</h1>
                          <p class="text-center text-dark">Enter your email address and password to access admin panel.</p>
                          <form class="mt-4" method="post">
                              <div class="form-group">
                                  <label for="exampleInputEmail2">Email address or username</label>
                                  <input type="text" class="form-control mb-0" id="exampleInputEmail2" placeholder="Enter email">
                              </div>
                              <div class="form-group">
                                  <label for="exampleInputPassword2">Password</label>
                                  <a href="#" class="float-right">Forgot password?</a>
                                  <input type="password" class="form-control mb-0" id="exampleInputPassword2" placeholder="Password">
                              </div>
                              <div class="sign-info">
                                  <button id="signin-btn"  class="btn btn-primary mb-2">Sign in</button>
                                  <span class="text-dark dark-color d-block line-height-2">Don't have an account? <a href="#">Sign up</a></span>
                              </div>
                          </form>
                      </div>
                  </div>
                </div>
                <div class="overlay-container">
                    <div class="overlay">
    
                        <div class="overlay-panel overlay-right">
                            <h1 class="text-white">Cloud Labs</span></h1>
                            <br>
                            <p>Didn't have an account? Register here.</p>
                            
                            <a href="/users/signup.php" class="btn iq-border-primary mt-2">Sign Up</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Sign in END -->

        <script>
            $("#signup-btn").on('click', () => 
            {
                console.log('signup')
            })
            $("#signin-btn").on('click', () => 
            {
                console.log('signin')
            })
            </script>
         <!-- color-customizer -->

       <!-- color-customizer END -->
      <!-- Optional JavaScript -->
      <!-- jQuery first, then Popper.js, then Bootstrap JS -->
      <script src="/js/jquery.min.js"></script>
      <script src="/js/popper.min.js"></script>
      <script src="/js/bootstrap.min.js"></script>
      <!-- Appear JavaScript -->
      <script src="/js/jquery.appear.js"></script>
      <!-- Countdown JavaScript -->
      <script src="/js/countdown.min.js"></script>
      <!-- Counterup JavaScript -->
      <script src="/js/waypoints.min.js"></script>
      <script src="/js/jquery.counterup.min.js"></script>
      <!-- Wow JavaScript -->
      <script src="/js/wow.min.js"></script>
      <!-- Apexcharts JavaScript -->
      <script src="/js/apexcharts.js"></script>
      <!-- lottie JavaScript -->
      <script src="/js/lottie.js"></script>
      <!-- Slick JavaScript --> 
      <script src="/js/slick.min.js"></script>
      <!-- Select2 JavaScript -->
      <script src="/js/select2.min.js"></script>
      <!-- Owl Carousel JavaScript -->
      <script src="/js/owl.carousel.min.js"></script>
      <!-- Magnific Popup JavaScript -->
      <script src="/js/jquery.magnific-popup.min.js"></script>
      <!-- Smooth Scrollbar JavaScript -->
      <script src="/js/smooth-scrollbar.js"></script>
      <!-- Style Customizer -->
      <script src="/js/style-customizer.js"></script>
      <!-- Chart Custom JavaScript -->
      <script src="/js/chart-custom.js"></script>
      <!-- Custom JavaScript -->
      <script src="/js/custom.js"></script>
      <script src="/js/toast.js"></script>
   </body>
</html>
