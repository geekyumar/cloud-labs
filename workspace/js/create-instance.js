if(window.location.pathname == '/labs' && $("#labs-status").text() == 'Not Created'){
$("#createInstance").on('click', ()=>{
    confirmation = confirm("Are you sure to create an instance?")
    if(confirmation == true){

    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
    .then(FingerprintJS => FingerprintJS.load());

    fpPromise
    .then(fp => fp.get())
    .then(result => {
    visitorId = result.visitorId

    $('#createInstance').addClass('disabled')
    $('#createInstance').text('Creating a server instance...')


    var data = {
        fingerprint: visitorId
    }

    $.ajax({
    type:'POST',
    url:'/src/api/labs/create-instance.api.php',
    dataType: 'json',
    data: data,

    success: function(response)
    { 
        if(response.response == 'success')
        {
            setTimeout(()=>{
                createToast("Server Instance Created!")
                $('#createInstance').text('Instance Created!')
                setTimeout(()=>
                {
                    window.location.href="/labs"
                },1500)
                }, 2000)
        }
        else{
            createToast("Create server instance failed!")
            $('#createInstance').removeClass('disabled')
            $('#createInstance').text('Create Instance')
        }
    },

    error: function(response)
    {
        createToast("Create server instance failed due to some error!")
        $('#createInstance').removeClass('disabled')
        $('#createInstance').text('Create Instance')
        console.log(response)
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

}


    })

}

