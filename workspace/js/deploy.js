if(window.location.pathname == '/labs' && $("#labs-status").text() == 'Offline'){
$("#deployInstance").on('click', ()=>{
    confirmation = confirm("Are you sure to deploy the instance?")
    if(confirmation == true){

    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
    .then(FingerprintJS => FingerprintJS.load());

    fpPromise
    .then(fp => fp.get())
    .then(result => {
    visitorId = result.visitorId
    instance_id = $("#instance_id").val()

    $('#deployInstance').addClass('disabled')
    $('#deployInstance').text('Deploying...')


    var data = {
        fingerprint: visitorId,
        instance_id: instance_id
    }

    $.ajax({
    type:'POST',
    url:'/src/api/labs/deploy.api.php',
    dataType: 'json',
    data: data,

    success: function(response)
    { 
        if(response.response == 'success')
        {
            setTimeout(()=>{
                createToast("Server Instance Deployed!")
                $('#deployInstance').text('Deployed!')
                setTimeout(()=>
                {
                    window.location.href="/labs"
                },1500)
                }, 2000)
        }
        else{
            createToast("Deploying server instance failed!")
            $('#deployInstance').removeClass('disabled')
            $('#deployInstance').text('Deploy')
        }
    },

    error: function(response)
    {
        createToast("Deploying server instance failed due to some error!")
        $('#deployInstance').removeClass('disabled')
        $('#deployInstance').text('Deploy')
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