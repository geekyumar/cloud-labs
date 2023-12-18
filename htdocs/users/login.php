<?php

include $_SERVER['DOCUMENT_ROOT'].'/src/main.php';

if(session::get('session_token'))
{
   header('Location: /');
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login - Cloud Labs</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="/assets/img/favicon3.png" rel="icon">
  <link href="/assets/img/favicon3.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../css/bootstrap.min.css" rel="stylesheet">
  <link href="../css/bootstrap-icons.css" rel="stylesheet">
      <!-- Favicon -->
      <link rel="shortcut icon" href="../images/favicon.ico" />
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="../css/bootstrap.min.css">
      <!-- Typography CSS -->
      <link rel="stylesheet" href="../css/typography.css">
      <!-- Style CSS -->
      <link rel="stylesheet" href="../css/style.css">
      <!-- Responsive CSS -->
      <link rel="stylesheet" href="../css/responsive.css">
      <link href="/css/toast.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="/assets/css/style.css" rel="stylesheet">


</head>

<body>

  <main>
    <div class="container">
    <div class="toast-container" id="toast-container"></div>
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="index.html" class="logo d-flex align-items-center w-auto">
                  
                  <h3 class="text-danger">Cloud<span class="text-primary ml-1">labs</span></h3> 
                </a>
              </div><!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2 mb-2">
                    <h4 class="card-title text-center pb-0 fs-4">Login to continue</h4>
                    <p class="text-center">Enter your details to login</p>
                  </div>

                  <form method="post" class="row g-3 needs-validation" novalidate>

                    <div class="col-12">
                      <label for="yourUsername" class="form-label">Username or email</label>
                      <div class="input-group has-validation">
                        <input type="text" name="username" class="form-control" id="formUsername" required>
                        <div class="invalid-feedback">Please input your username.</div>
                      </div>
                    </div>
                    <br>
                    

                    <div class="col-12">
                      <label for="yourPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="formPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                      <br>
                    </div>
                    
<!-- 
                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div> -->

                    <div class="col-12">
                      <a class="btn btn-primary w-100 text-white" id="formSubmit" >Login</a>
                    </div>
                    <div class="col-12">
                     <br>
                      <p class="small mb-0 text-center">Forgot your password? contact <a href="/contact_admin/">admin</a>.</p>
                    </div>
                  </form>

                </div>
              </div>


              <div class="credits text-center">
               Site Crafted and maintained by <a href="https://umarfarooq.online/">Umar Farooq</a>
              </div>

            </div>
          </div>
        </div>

      </section>

    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="/assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/chart.js/chart.umd.js"></script>
  <script src="/assets/vendor/echarts/echarts.min.js"></script>
  <script src="/assets/vendor/quill/quill.min.js"></script>
  <script src="/assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="/assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="/assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="/assets/js/main.js"></script>
  <script src="/js/toast.js"></script>
  
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

  <script>
     
// TODO: error handling in API (done)
  
  $('#formSubmit').on('click', ()=>
  {
    $('#formSubmit').addClass('disabled')
    $('#formSubmit').text('Logging you in..')

    var username = $('#formUsername').val()
    var password = $('#formPassword').val()

    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
  .then(FingerprintJS => FingerprintJS.load());

    fpPromise
    .then(fp => fp.get())
    .then(result => {
      visitorId = result.visitorId
      var data = {
      username: username,
      password: password,
      fingerprint: visitorId
    }

    $.ajax({
      type:'POST',
      url:'../src/api/login.api.php',
      dataType: 'json',
      data: data,

      success: function(response)
      { 
          if(response.response == 'success')
          {
            setTimeout(()=>{
              createToast('Login Success!')
              $('#formSubmit').text('Logged in, moving to dashboard..')
              setTimeout(()=>
              {
                window.location.href="/"
              },1500)
            }, 2000)
            
          }
          else if(response.response == 'failed')
          {
            setTimeout(()=>{
              createToast('Login Failed! Check your input details and try again.')
              $('#formSubmit').removeClass('disabled')
              $('#formSubmit').text('Login')
            }, 2000)
          }
          else{
            $('#formSubmit').removeClass('disabled')
            $('#formSubmit').text('Login')
            createToast('There is a problem with the login. please try again later.')
          }
      },

      error: function(xhr,status, response)
      {
        if(xhr.status == 500)
        {
          $('#formSubmit').removeClass('disabled')
          $('#formSubmit').text('Login')
          createToast('There is a problem with the server. please try again later.')
        }
      }

    })
      
    })
    .catch(error => {
      $('#formSubmit').removeClass('disabled')
          $('#formSubmit').text('Login')
    createToast('There is a problem with the API, try disabling ad blockers and try again.')
  })


  })
</script>


</body>

</html>