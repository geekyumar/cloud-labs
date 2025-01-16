if(window.location.pathname == '/add-mongodb-user'){ 
    $("#addUser").on('click', ()=>
    {
        const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
        .then(FingerprintJS => FingerprintJS.load());
    
        fpPromise
        .then(fp => fp.get())
        .then(result => {
        visitorId = result.visitorId
    
        var mongodb_username = $('#mongodbUsername').val()
        var mongodb_password = $('#mongodbPassword').val()
    
    
    
        var data = {
            mongodb_username: mongodb_username,
            mongodb_password: mongodb_password,
            fingerprint: visitorId
        }
    
        if(mongodb_username !== '' && mongodb_password !== ''){
            $('#addUser').addClass('disabled')
            $('#addUser').text('Adding user...')
            
        $.ajax({
        type:'POST',
        url:'/api/services/mongodb/addUser',
        dataType: 'json',
        data: data,
    
        success: function(response)
        { 
            if(response.response == 'success')
            {
                setTimeout(()=>{
                    createToast(`mongodb user '${mongodb_username}' has been created!`)
                    $('#addUser').text('User added!')
                    setTimeout(()=>
                    {
                        window.location.href="/add-mongodb-user"
                    },1500)
                    }, 2000)
    
                console.log('success')
            }
            else{
                createToast(`Add user '${mongodb_username}' failed!`)
                $('#addUser').removeClass('disabled')
                $('#addUser').text('Add user')
                console.log(response.response)
            }
        },
    
        error: function(response)
        {
            if(response.responseJSON.response == 'user_limit_exceeded'){
                createToast(`User limit exceeded of 5 users!`)
                $('#addUser').removeClass('disabled')
                $('#addUser').text('Add user')
            } else {
            createToast(`Add user ${mongodb_username} failed due to some error!`)
            $('#addUser').removeClass('disabled')
            $('#addUser').text('Add user')
            console.log(response.responseJSON.response)
        }
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