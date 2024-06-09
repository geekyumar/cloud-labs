if(window.location.pathname == '/users/login'){
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
        url:'/api/auth/login',
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
        createToast('It seems like you are using ad-blockers. Try disabling ad blockers and try again.')
    })


})
}