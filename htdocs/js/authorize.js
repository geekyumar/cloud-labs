//Fingerprint code snippet is below.

// const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
//   .then(FingerprintJS => FingerprintJS.load());

// fpPromise
//   .then(fp => fp.get())
//   .then(result => {
//     visitorId = result.visitorId;
//     console.log(visitorId)
//   });
       
    $(document).ready(()=>
    {

    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
    .then(FingerprintJS => FingerprintJS.load());

    fpPromise
    .then(fp => fp.get())
    .then(result => {
    visitorId = result.visitorId
    var data = {
    fingerprint: visitorId
    }

    $.ajax({
    type:'POST',
    url:'/src/api/authorize.api.php',
    dataType: 'json',
    data: data,

    success: function(response)
    { 
        if(response.response == 'success')
        {
           alert('success')
        }
        else{
            window.location.replace('/users/login.php')
        }
    },

    error: function(response)
    {
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