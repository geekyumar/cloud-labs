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