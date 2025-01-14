if(window.location.pathname == '/add-mongodb-user'){ 
    var users = $(".mongodbUsers")
    for(var i = 0; i < users.length; i++){
    users[i].addEventListener('click', function() {
    var mongodb_username = this.id;
    
    confirmation = confirm(`Do you want to delete user '${mongodb_username}?`)
    if(confirmation == true){
    $('#' + mongodb_username).addClass("disabled")
    $('#' + mongodb_username).text("Deleting user..")
    
    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
    .then(FingerprintJS => FingerprintJS.load());
    
    fpPromise
    .then(fp => fp.get())
    .then(result => {
    visitorId = result.visitorId
    var data = {
    fingerprint: visitorId,
    mongodb_username: mongodb_username
    }
    
    $.ajax({
    type:'POST',
    url:'/api/services/mongodb/deleteUser',
    dataType: 'json',
    data: data,
    
    success: function(response)
    { 
        if(response.response == 'success')
        {
            setTimeout(()=>{
                createToast(`User ${mongodb_username} has been deleted!`)
                $('#' + mongodb_username).text('User deleted!')
                setTimeout(()=>
                {
                    window.location.href="/add-mongodb-user"
                },1500)
                }, 2000)
        }
        else{
            createToast(`Delete user ${mongodb_username} failed!`)
            $('#' + mongodb_username).removeClass("disabled")
            $('#' + mongodb_username).text('Delete User')
        }
    },
    
    error: function(response)
    {
        createToast(`Delete device ${mongodb_username} failed due to some error!`)
        $('#' + mongodb_username).removeClass("disabled")
        $('#' + mongodb_username).text('Delete User')
        console.log(response)
    }
    
    })
    
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
    
    }
    
    })
    }
    }