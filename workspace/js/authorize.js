//Fingerprint code snippet is below.

// const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
//   .then(FingerprintJS => FingerprintJS.load());

// fpPromise
//   .then(fp => fp.get())
//   .then(result => {
//     visitorId = result.visitorId;
//     console.log(visitorId)
//   });
       
    $(document).ready(()=>{

        var excludedPaths = [
        "/users/signup",
        "/users/login"
        ]

    if(!excludedPaths.includes(window.location.pathname)){ 
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
            window.location.replace('/users/login')
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
    console.log('auth')
        }

    })