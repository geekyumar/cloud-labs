if(window.location.pathname == '/users/login'){
    $('#formSubmit').on('submit', (e)=>
    {
    e.preventDefault()
    $('#submitBtn').addClass('disabled')
    $('#submitBtn').text('Logging you in..')

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
                $('#submitBtn').text('Moving to dashboard..')
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
                $('#submitBtn').removeClass('disabled')
                $('#submitBtn').text('Login')
            }, 2000)
            }
            else{
            $('#submitBtn').removeClass('disabled')
            $('#submitBtn').text('Login')
            createToast('There is a problem with the login. please try again later.')
            }
        },

        error: function(xhr,status, response)
        {
        if(xhr.status == 500)
        {
            $('#submitBtn').removeClass('disabled')
            $('#submitBtn').text('Login')
            createToast('There is a problem with the server. please try again later.')
        }
        }

    })
        
    })
    .catch(error => {
        $('#submitBtn').removeClass('disabled')
        $('#submitBtn').text('Login')
        createToast('It seems like you are using ad-blockers. Try disabling ad blockers and try again.')
    })


})
}