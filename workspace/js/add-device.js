if(window.location.pathname == '/add-device'){ 
$("#addDeviceSubmit").on('click', ()=>
{
    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
    .then(FingerprintJS => FingerprintJS.load());

    fpPromise
    .then(fp => fp.get())
    .then(result => {
    visitorId = result.visitorId

    var device_name = $('#deviceName').val()
    var device_type = $('#deviceType').val()
    var wg_pubkey = $('#wgPubKey').val()

    $('#addDeviceSubmit').addClass('disabled')
    $('#addDeviceSubmit').text('Adding device...')


    var data = {
        device_name:device_name,
        device_type:device_type,
        wg_pubkey:wg_pubkey,
        fingerprint: visitorId
    }

    $.ajax({
    type:'POST',
    url:'/api/device/add',
    dataType: 'json',
    data: data,

    success: function(response)
    { 
        if(response.response == 'success')
        {
            setTimeout(()=>{
                createToast(`Device ${device_name} added!`)
                $('#addDeviceSubmit').text('Device added!')
                setTimeout(()=>
                {
                    window.location.href="/devices"
                },1500)
                }, 2000)
        }
        else{
            createToast(`Add device ${device_name} failed!`)
            $('#addDeviceSubmit').removeClass('disabled')
            $('#addDeviceSubmit').text('Add device')
        }
    },

    error: function(response)
    {
        if(response.responseJSON.response == 'device_limit_exceeded'){
            createToast(`Device limit exceeded of 5 users!`)
            $('#addDeviceSubmit').removeClass('disabled')
            $('#addDeviceSubmit').text('Add device')
        } else {
        createToast(`Add device ${device_name} failed due to some error!`)
        console.log(response)
        $('#addDeviceSubmit').removeClass('disabled')
        $('#addDeviceSubmit').text('Add device')
    }
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
        } else{
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