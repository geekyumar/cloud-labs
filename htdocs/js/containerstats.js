$(document).ready(()=>{

    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
    .then(FingerprintJS => FingerprintJS.load());

    fpPromise
    .then(fp => fp.get())
    .then(result => {
    visitorId = result.visitorId
    instance_id = $('#instance_id').val()

    var data = {
        fingerprint: visitorId,
        instance_id: instance_id
    }
setInterval(()=>{

    $.ajax({
    type:'POST',
    url:'/src/api/labs/containerstats.api.php',
    dataType: 'json',
    data: data,

    success: function(response)
    { 
        if(response.response == 'success')
        {
           stats = response.stats
           $("#CPUPerc_big").text(stats['CPUPerc'])
           $("#CPUPerc").css('width', stats['CPUPerc'])
           $("#PIDs").text(stats['PIDs'])
           
           $("#MemPerc_big").text(stats['MemPerc'])
           $("#MemUsage").text(stats['MemUsage'])
           $("#MemPerc").css('width', stats['MemPerc'])

           $("#BlockIO").text(stats['BlockIO'])
           $("#NetIO").text(stats['NetIO'])
        }
        else{
           console.log("failed")
        }
    },

    error: function(response)
    {
        console.log(response)
    }

    })

}, 3000)

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

