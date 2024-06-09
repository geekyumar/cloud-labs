if(window.location.pathname == '/labs' && $("#labs-status").text() == 'Online'){
$("#stopInstance").on('click', ()=>{
    confirmation = confirm("Are you sure to stop the instance?")
    if(confirmation == true){

    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
    .then(FingerprintJS => FingerprintJS.load());

    fpPromise
    .then(fp => fp.get())
    .then(result => {
    visitorId = result.visitorId
    instance_id = $("#instance_id").val()

    $('#stopInstance').addClass('disabled')
    $('#stopInstance').text('Stopping...')


    var data = {
        fingerprint: visitorId,
        instance_id: instance_id
    }

    $.ajax({
    type:'POST',
    url:'/api/labs/stop',
    dataType: 'json',
    data: data,

    success: function(response)
    { 
        if(response.response == 'success')
        {
            setTimeout(()=>{
                createToast("Server Instance Stopped!")
                $('#stopInstance').text('Stopped!')
                setTimeout(()=>
                {
                    window.location.href="/labs"
                },1500)
                }, 2000)
        }
        else{
            createToast("Stopping server instance failed!")
            $('#stopInstance').removeClass('disabled')
            $('#stopInstance').text('Stop')
        }
    },

    error: function(response)
    {
        createToast("Stopping server instance failed due to some error!")
        $('#stopInstance').removeClass('disabled')
        $('#stopInstance').text('Stop')
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