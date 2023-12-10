$("#addDb").on('click', ()=>
{
    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
    .then(FingerprintJS => FingerprintJS.load());

    fpPromise
    .then(fp => fp.get())
    .then(result => {
    visitorId = result.visitorId

    var mysql_username = $('#mysqlUsername').val()
    var mysql_dbname = $('#mysqlDbname').val()
    var collation = $('#collation').val()

    // $('#addDeviceSubmit').addClass('disabled')
    // $('#addDeviceSubmit').text('Adding device...')


    var data = {
        mysql_username: mysql_username,
        mysql_dbname: mysql_dbname,
        collation: collation,
        fingerprint: visitorId
    }

    $.ajax({
    type:'POST',
    url:'/src/api/services/mysql/add-db.api.php',
    dataType: 'json',
    data: data,

    success: function(response)
    { 
        if(response.response == 'success')
        {
            // setTimeout(()=>{
            //     createToast(`Device ${device_name} added!`)
            //     $('#addDeviceSubmit').text('Device added!')
            //     setTimeout(()=>
            //     {
            //         window.location.href="/devices"
            //     },1500)
            //     }, 2000)

            console.log('success')
        }
        else{
            // createToast(`Add device ${device_name} failed!`)
            // $('#addDeviceSubmit').removeClass('disabled')
            // $('#addDeviceSubmit').text('Add device')
            console.log(response)
        }
    },

    error: function(response)
    {
        // createToast(`Add device ${device_name} failed due to some error!`)
        // console.log(response)
        // $('#addDeviceSubmit').removeClass('disabled')
        // $('#addDeviceSubmit').text('Add device')
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
            window.location.replace('/users/login.php')   
        }
        else if(response.response == 'failed')
        {
            window.location.replace('/users/login.php')
        }
        else{
            window.location.replace('/users/login.php')
        }
    },

    error: function(response)
    {
            window.location.replace('/users/login.php')
        }

    })

    })


    })

