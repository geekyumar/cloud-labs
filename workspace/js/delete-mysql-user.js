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
url:'/src/api/services/mysql/delete-user.api.php',
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
url:'/src/api/destroysession.api.php',
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