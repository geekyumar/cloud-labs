if(window.location.pathname == '/users/signup'){
    $('#formSubmit').on('submit', (e)=>
    {
        e.preventDefault();

        $('#submitBtn').addClass('disabled')
        $('#submitBtn').text('Signing up..')

        var name = $('#formName').val()
        var username = $('#formUsername').val()
        var email = $('#formEmail').val()
        var phone = $('#formPhone').val()
        var password = $('#formPassword').val()

        var data = {
        name: name,
        username: username,
        email: email,
        phone: phone, 
        password: password
        }

        $.ajax({
        type:'POST',
        url:'/api/auth/signup',
        dataType: 'json',
        data: data,

        success: function(response)
        { 
            if(response.response == 'success')
            {
                setTimeout(()=>{
                createToast('Signup Success!')
                $('#submitBtn').text('Signed up!')
                setTimeout(()=>
                {
                    window.location.href="/users/login"
                },1500)
                }, 2000)
                
            }
            else if(response.response == 'failed')
            {
                setTimeout(()=>{
                createToast('Signup Failed! Check your input details and try again.')
                $('#submitBtn').removeClass('disabled')
                $('#submitBtn').text('Signup')
                }, 2000)
            }
        },

        error: function(xhr,status, response)
        {
            if(xhr.status == 500)
            {
            createToast('There is a problem with the signup. please try again later.')
            $('#submitBtn').removeClass('disabled')
            $('#submitBtn').text('Signup')
            }
        }

        })
    })
}