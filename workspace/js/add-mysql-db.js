if(window.location.pathname == '/add-mysql-db'){
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

    $('#addDb').addClass('disabled')
    $('#addDb').text('Adding database...')

    if(mysql_username == '' || mysql_dbname == '' || collation == '')
    {
        createToast('Please fill all the fields!')
        $('#addDb').removeClass('disabled')
        $('#addDb').text('Add database')
        return
    }

    const invalidChars = ['-', ';', '"', "'", '`', '\\', '/', '%', '*', '=', '+', '<', '>', '&', '|', ' ', '@', '!', '#', '$', '^', '(', ')', '[', ']', '{', '}', ':', ',', '?'];

    if (invalidChars.some(char => mysql_username.includes(char) || mysql_dbname.includes(char) || collation.includes(char))) {
        createToast('Invalid characters detected in the input fields!');
        $('#addDb').removeClass('disabled');
        $('#addDb').text('Add database');
        return;
    }

    var data = {
        mysql_username: mysql_username,
        mysql_dbname: mysql_dbname,
        collation: collation,
        fingerprint: visitorId
    }

    $.ajax({
    type:'POST',
    url:'/api/services/mysql/addDb',
    dataType: 'json',
    data: data,

    success: function(response)
    { 
        if(response.response == 'success')
        {
            setTimeout(()=>{
                createToast(`Database ${mysql_dbname} added to user ${mysql_username}!`)
                $('#addDb').text('Database added!')
                setTimeout(()=>
                {
                    window.location.href="/add-mysql-db"
                },1500)
                }, 2000)

            console.log('success')
        }
        else{
            createToast(`Add database ${mysql_dbname} failed!`)
            $('#addDb').removeClass('disabled')
            $('#addDb').text('Add database')
            console.log(response)
        }
    },

    error: function(response)
    {
        createToast(`Add database ${mysql_dbname} failed due to some error!`)
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


    })

}