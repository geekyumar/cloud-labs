if(window.location.pathname == '/add-mysql-user'){ 
$("#addUser").on('click', ()=>
{
    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
    .then(FingerprintJS => FingerprintJS.load());

    fpPromise
    .then(fp => fp.get())
    .then(result => {
    visitorId = result.visitorId

    var mysql_username = $('#mysqlUsername').val()
    var mysql_password = $('#mysqlPassword').val()



    var data = {
        mysql_username: mysql_username,
        mysql_password: mysql_password,
        fingerprint: visitorId
    }

    if(mysql_username !== '' && mysql_password !== ''){
        $('#addUser').addClass('disabled')
        $('#addUser').text('Adding user...')
        
    $.ajax({
    type:'POST',
    url:'/api/services/mysql/addUser',
    dataType: 'json',
    data: data,

    success: function(response)
    { 
        if(response.response == 'success')
        {
            setTimeout(()=>{
                createToast(`MySQL user '${mysql_username}' has been created!`)
                $('#addUser').text('User added!')
                setTimeout(()=>
                {
                    window.location.href="/add-mysql-user"
                },1500)
                }, 2000)

            console.log('success')
        }
        else{
            createToast(`Add user '${mysql_username}' failed!`)
            $('#addUser').removeClass('disabled')
            $('#addUser').text('Add user')
            console.log(response)
        }
    },

    error: function(response)
    {
        createToast(`Add user ${mysql_username} failed due to some error!`)
        $('#addUser').removeClass('disabled')
        $('#addUser').text('Add user')
        console.log(response)
    }

    })

}else{
    createToast("Invalid username or password!")
}

    })
    .catch(error => {

    $.ajax({
    type:'POST',
    url:'/api/auth/sessionDestroy',
    dataType: 'json',

    success: function(response)
    { 
        if(response.response == 'success')
        {
            window.location.replace('/users/login')   
        }
        else if(response.response == 'failed')
        {
            window.location.replace('/users/login')
        }
        else{
            window.location.replace('/users/login')
        }
    },

    error: function(response)
    {
            window.location.replace('/users/login')
        }

    })

    })


    })

}