if(window.location.pathname == '/add-mongodb-db'){
    $("#addDb").on('click', ()=>
    {
        const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
        .then(FingerprintJS => FingerprintJS.load());
    
        fpPromise
        .then(fp => fp.get())
        .then(result => {
        visitorId = result.visitorId
    
        var mongodb_username = $('#mongodbUsername').val()
        var mongodb_dbname = $('#mongodbDbname').val()
    
        $('#addDb').addClass('disabled')
        $('#addDb').text('Adding database...')
    
        if(mongodb_username == '' || mongodb_dbname == '')
        {
            createToast('Please fill all the fields!')
            $('#addDb').removeClass('disabled')
            $('#addDb').text('Add database')
            return
        }
    
        // const invalidChars = ['-', ';', '"', "'", '`', '\\', '/', '%', '*', '=', '+', '<', '>', '&', '|', ' ', '@', '!', '#', '$', '^', '(', ')', '[', ']', '{', '}', ':', ',', '?'];
    
        // if (invalidChars.some(char => mongodb_username.includes(char) || mongodb_dbname.includes(char) || collation.includes(char))) {
        //     createToast('Invalid characters detected in the input fields!');
        //     $('#addDb').removeClass('disabled');
        //     $('#addDb').text('Add database');
        //     return;
        // }
    
        var data = {
            mongodb_username: mongodb_username,
            mongodb_dbname: mongodb_dbname,
            fingerprint: visitorId
        }
    
        $.ajax({
        type:'POST',
        url:'/api/services/mongodb/addDb',
        dataType: 'json',
        data: data,
    
        success: function(response)
        { 
            if(response.response == 'success')
            {
                setTimeout(()=>{
                    createToast(`Database ${mongodb_dbname} added to user ${mongodb_username}!`)
                    $('#addDb').text('Database added!')
                    setTimeout(()=>
                    {
                        window.location.href="/add-mongodb-db"
                    },1500)
                    }, 2000)
    
                console.log('success')
            }
            else{
                createToast(`Add database ${mongodb_dbname} failed!`)
                $('#addDb').removeClass('disabled')
                $('#addDb').text('Add database')
                console.log(response)
            }
        },
    
        error: function(response)
        {
            createToast(`Add database ${mongodb_dbname} failed due to some error!`)
            $('#addDb').removeClass('disabled')
            $('#addDb').text('Add database')
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
    
    
        })
    
    }