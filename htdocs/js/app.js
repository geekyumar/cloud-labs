/* Concatenated by Cloud Labs */
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
        createToast(`Add device ${device_name} failed due to some error!`)
        console.log(response)
        $('#addDeviceSubmit').removeClass('disabled')
        $('#addDeviceSubmit').text('Add device')
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
if(window.location.pathname == '/add-mysql-user'){ 
$("#addUser").on('click', ()=>
{
    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
    .then(FingerprintJS => FingerprintJS.load());

    fpPromise
    .then(fp => fp.get())
    .then(result => {
    visitorId = result.visitorId

    var mysql_username = $('#mysqlUsername').val()
    var mysql_password = $('#mysqlPassword').val()



    var data = {
        mysql_username: mysql_username,
        mysql_password: mysql_password,
        fingerprint: visitorId
    }

    if(mysql_username !== '' && mysql_password !== ''){
        $('#addUser').addClass('disabled')
        $('#addUser').text('Adding user...')
        
    $.ajax({
    type:'POST',
    url:'/api/services/mysql/addUser',
    dataType: 'json',
    data: data,

    success: function(response)
    { 
        if(response.response == 'success')
        {
            setTimeout(()=>{
                createToast(`MySQL user '${mysql_username}' has been created!`)
                $('#addUser').text('User added!')
                setTimeout(()=>
                {
                    window.location.href="/add-mysql-user"
                },1500)
                }, 2000)

            console.log('success')
        }
        else{
            createToast(`Add user '${mysql_username}' failed!`)
            $('#addUser').removeClass('disabled')
            $('#addUser').text('Add user')
            console.log(response)
        }
    },

    error: function(response)
    {
        createToast(`Add user ${mysql_username} failed due to some error!`)
        $('#addUser').removeClass('disabled')
        $('#addUser').text('Add user')
        console.log(response)
    }

    })

}else{
    createToast("Invalid username or password!")
}

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
    url:'/api/auth/sessionAuth',
    dataType: 'json',
    data: data,

    success: function(response)
    { 
        if(response.response == 'success')
        {
            return true;
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
if(window.location.pathname == '/labs' && $("#labs-status").text() == 'Online'){ 
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
    url:'/api/labs/containerStats',
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
    url:'/api/labs/createInstance',
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


if(window.location.pathname == '/devices'){ 
var devices = $(".devices")
for(var i = 0; i <= devices.length; i++){
devices[i].addEventListener('click', function() {
var deviceId = this.id;

confirmation = confirm("Do you want to delete device?")
if(confirmation == true){
$('#' + deviceId).addClass("disabled")
$('#' + deviceId).text("Deleting device..")

const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
.then(FingerprintJS => FingerprintJS.load());

fpPromise
.then(fp => fp.get())
.then(result => {
visitorId = result.visitorId
var data = {
fingerprint: visitorId,
device_id: deviceId
}

$.ajax({
type:'POST',
url:'/api/device/delete',
dataType: 'json',
data: data,

success: function(response)
{ 
    if(response.response == 'success')
    {
        setTimeout(()=>{
            createToast('Device has been deleted!')
            $('#' + deviceId).text('Device deleted!')
            setTimeout(()=>
            {
                window.location.href="/devices"
            },1500)
            }, 2000)
    }
    else{
        createToast('Delete device failed!')
        $('#' + deviceId).removeClass("disabled")
        $('#' + deviceId).text('Delete Device')
    }
},

error: function(response)
{
    createToast('Delete device failed due to some error!')
    $('#' + deviceId).removeClass("disabled")
    $('#' + deviceId).text('Delete Device')
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
}
if(window.location.pathname == '/add-mysql-db'){
    if($("#mysqlUsers").hasClass('delete-mysql-db')){
var dbs = $(".delete-mysql-db")
for(var i = 0; i <= dbs.length; i++){
dbs[i].addEventListener('click', function() {
var mysql_dbname = this.id;

confirmation = confirm(`Do you want to delete database '${mysql_dbname}?`)
if(confirmation == true){
$('#' + mysql_dbname).addClass("disabled")
$('#' + mysql_dbname).text("Deleting database..")

const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
.then(FingerprintJS => FingerprintJS.load());

fpPromise
.then(fp => fp.get())
.then(result => {
visitorId = result.visitorId
var data = {
fingerprint: visitorId,
mysql_dbname: mysql_dbname
}

$.ajax({
type:'POST',
url:'/api/services/mysql/deleteDb',
dataType: 'json',
data: data,

success: function(response)
{ 
    if(response.response == 'success')
    {
        setTimeout(()=>{
            createToast(`Database ${mysql_dbname} has been deleted!`)
            $('#' + mysql_dbname).text('Database deleted!')
            setTimeout(()=>
            {
                window.location.href="/add-mysql-db"
            },1500)
            }, 2000)
    }
    else{
        createToast(`Delete database ${mysql_dbname} failed!`)
        $('#' + mysql_dbname).removeClass("disabled")
        $('#' + mysql_dbname).text('Drop database')
    }
},

error: function(response)
{
    createToast(`Delete database ${mysql_dbname} failed due to some error!`)
    $('#' + mysql_dbname).removeClass("disabled")
    $('#' + mysql_dbname).text('Drop database')
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
        window.location.replace('/dbs/login')   
    }
    else{
        window.location.replace('/dbs/login')
    }
},

error: function(response)
{
        window.location.replace('/dbs/login')
    }

})

})

}

})
}
}
}
if(window.location.pathname == '/add-mysql-user'){ 
var users = $(".mysqlUsers")
for(var i = 0; i < users.length; i++){
users[i].addEventListener('click', function() {
var mysql_username = this.id;

confirmation = confirm(`Do you want to delete user '${mysql_username}?`)
if(confirmation == true){
$('#' + mysql_username).addClass("disabled")
$('#' + mysql_username).text("Deleting user..")

const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
.then(FingerprintJS => FingerprintJS.load());

fpPromise
.then(fp => fp.get())
.then(result => {
visitorId = result.visitorId
var data = {
fingerprint: visitorId,
mysql_username: mysql_username
}

$.ajax({
type:'POST',
url:'/api/services/mysql/deleteUser',
dataType: 'json',
data: data,

success: function(response)
{ 
    if(response.response == 'success')
    {
        setTimeout(()=>{
            createToast(`User ${mysql_username} has been deleted!`)
            $('#' + mysql_username).text('User deleted!')
            setTimeout(()=>
            {
                window.location.href="/add-mysql-user"
            },1500)
            }, 2000)
    }
    else{
        createToast(`Delete user ${mysql_username} failed!`)
        $('#' + mysql_username).removeClass("disabled")
        $('#' + mysql_username).text('Delete User')
    }
},

error: function(response)
{
    createToast(`Delete device ${mysql_username} failed due to some error!`)
    $('#' + mysql_username).removeClass("disabled")
    $('#' + mysql_username).text('Delete User')
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
}
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
    url:'/api/labs/deploy',
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
function openInfoDialog() {
    document.getElementById('dialogOverlay').classList.add('active');
    document.querySelector('.dialog-box').classList.add('active');
}

function closeInfoDialog() {
    document.querySelector('.dialog-box').classList.add('fadeOut');
    setTimeout(() => {
        document.getElementById('dialogOverlay').classList.remove('active');
        document.querySelector('.dialog-box').classList.remove('active', 'fadeOut');
    }, 500);
}
if(window.location.pathname == '/add-mysql-db'){ 
function fetchMysqlUsers(mysql_username){

 const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
 .then(FingerprintJS => FingerprintJS.load());

 fpPromise
 .then(fp => fp.get())
 .then(result => {
 visitorId = result.visitorId

 var data = {
     mysql_username: mysql_username,
     fingerprint: visitorId
 }

 $("#mysqlUsers").empty();

 $.ajax({
   url: '/api/services/mysql/fetchDb',
   type: 'POST',
   dataType: 'json',

   data: data,

   success: function(response){
      if(response.response == 'success'){
        for (let user of response.databases) {
            $("#mysqlUsers").append('<div class="col-sm-6"><div class="iq-card iq-mb-3"><div class="iq-card-body"><h4 class="card-title">'+user+'</h4><br><a class="btn btn-primary text-white delete-mysql-db" id="'+user+'">Drop database</a></div></div></div>')
          }
      }else{
         console.log(response)
      }
   },

   error: function(response){
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

console.log('vanakam da eleiii')

$("#mysqlUsername").on('change', ()=>{
    $("#username-prefix").text($("#mysqlUsername").val() + "_")
    var user = $("#mysqlUsername").val()
    fetchMysqlUsers(user)
 })
}
if(window.location.pathname == '/users/login'){
    $('#formSubmit').on('click', ()=>
    {
    $('#formSubmit').addClass('disabled')
    $('#formSubmit').text('Logging you in..')

    var username = $('#formUsername').val()
    var password = $('#formPassword').val()

    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
    .then(FingerprintJS => FingerprintJS.load());

    fpPromise
    .then(fp => fp.get())
    .then(result => {
        visitorId = result.visitorId
        var data = {
        username: username,
        password: password,
        fingerprint: visitorId
    }

    $.ajax({
        type:'POST',
        url:'/api/auth/login',
        dataType: 'json',
        data: data,

        success: function(response)
        { 
            if(response.response == 'success')
            {
            setTimeout(()=>{
                createToast('Login Success!')
                $('#formSubmit').text('Logged in, moving to dashboard..')
                setTimeout(()=>
                {
                window.location.href="/"
                },1500)
            }, 2000)
            
            }
            else if(response.response == 'failed')
            {
            setTimeout(()=>{
                createToast('Login Failed! Check your input details and try again.')
                $('#formSubmit').removeClass('disabled')
                $('#formSubmit').text('Login')
            }, 2000)
            }
            else{
            $('#formSubmit').removeClass('disabled')
            $('#formSubmit').text('Login')
            createToast('There is a problem with the login. please try again later.')
            }
        },

        error: function(xhr,status, response)
        {
        if(xhr.status == 500)
        {
            $('#formSubmit').removeClass('disabled')
            $('#formSubmit').text('Login')
            createToast('There is a problem with the server. please try again later.')
        }
        }

    })
        
    })
    .catch(error => {
        $('#formSubmit').removeClass('disabled')
        $('#formSubmit').text('Login')
        createToast('It seems like you are using ad-blockers. Try disabling ad blockers and try again.')
    })


})
}
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
    url:'/api/labs/redeploy',
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
    url:'/sapi/auth/sessionDestroy',
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
var excludedPaths = [
    "/users/signup",
    "/users/login"
    ]

if(!excludedPaths.includes(window.location.pathname)){ 
var url = window.location.pathname.split('/')[1]
var dashboard = window.location.pathname

if(dashboard == '/')
{
    document.getElementById('dashboard').classList.add('active', 'active-menu')
}

var highlight = document.getElementById(url)

if(url == 'devices' || url == 'add-device')
{
    document.getElementById('devices-nav').classList.add('active')
    document.getElementById('userinfo').classList.remove('collapse')
}
}


if(window.location.pathname == '/users/signup'){
    $('#formSubmit').on('click', ()=>
    {
        $('#formSubmit').addClass('disabled')
        $('#formSubmit').text('Signing up..')

        var name = $('#formName').val()
        var username = $('#formUsername').val()
        var email = $('#formEmail').val()
        var phone = $('#formPhone').val()
        var password = $('#formPassword').val()

        var data = {
        name: name,
        username: username,
        email: email,
        phone: phone, 
        password: password
        }

        $.ajax({
        type:'POST',
        url:'/api/auth/signup',
        dataType: 'json',
        data: data,

        success: function(response)
        { 
            if(response.response == 'success')
            {
                setTimeout(()=>{
                createToast('Signup Success!')
                $('#formSubmit').text('Signed up!')
                setTimeout(()=>
                {
                    window.location.href="/users/login"
                },1500)
                }, 2000)
                
            }
            else if(response.response == 'failed')
            {
                setTimeout(()=>{
                createToast('Signup Failed! Check your input details and try again.')
                $('#formSubmit').removeClass('disabled')
                $('#formSubmit').text('Signup')
                }, 2000)
            }
        },

        error: function(xhr,status, response)
        {
            if(xhr.status == 500)
            {
            createToast('There is a problem with the signup. please try again later.')
            $('#formSubmit').removeClass('disabled')
            $('#formSubmit').text('Signup')
            }
        }

        })
    })
}
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
function createToast(message) {
    const toastContainer = document.getElementById("toast-container");

    const toast = document.createElement("div");
    toast.className = "toast";
    toast.textContent = message;

    const closeBtn = document.createElement("span");
    closeBtn.className = "close";
    closeBtn.textContent = "";
    closeBtn.addEventListener("click", function() {
        toast.remove();
    });

    toast.appendChild(closeBtn);
    toastContainer.appendChild(toast);

    // Trigger reflow to apply the transition
    setTimeout(function () {
        toast.classList.add("active");
    }, 10);

    // Remove the toast after a few seconds
    setTimeout(function () {
        toast.classList.remove("active");
        // Remove the toast after the transition duration
        setTimeout(function() {
            toast.remove();
        }, 400);
    }, 3000); // Adjust the duration as needed
}
