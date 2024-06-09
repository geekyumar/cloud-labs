if(window.location.pathname == '/labs' && $("#labs-status").text() == 'Online'){
$("#redeployInstance").on('click', ()=>{
    confirmation = confirm("Are you sure to redeploy the instance?")
    if(confirmation == true){

    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
    .then(FingerprintJS => FingerprintJS.load());

    fpPromise
    .then(fp => fp.get())
    .then(result => {
    visitorId = result.visitorId
    instance_id = $("#instance_id").val()

    $('#redeployInstance').addClass('disabled')
    $('#redeployInstance').text('Redeploying...')


    var data = {
        fingerprint: visitorId,
        instance_id: instance_id
    }

    $.ajax({
    type:'POST',
    url:'/src/api/labs/redeploy.api.php',
    dataType: 'json',
    data: data,

    success: function(response)
    { 
        if(response.response == 'success')
        {
            setTimeout(()=>{
                createToast("Server Instance Redeployed!")
                $('#redeployInstance').text('Redeployed!')
                setTimeout(()=>
                {
                    window.location.href="/labs"
                },1500)
                }, 2000)
        }
        else{
            createToast("Redeploying server instance failed!")
            $('#redeployInstance').removeClass('disabled')
            $('#redeployInstance').text('Redeploy')
        }
    },

    error: function(response)
    {
        createToast("Redeploying server instance failed due to some error!")
        $('#redeployInstance').removeClass('disabled')
        $('#redeployInstance').text('Redeploy')
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