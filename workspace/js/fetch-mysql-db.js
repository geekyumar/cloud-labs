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
    $("#mysqlUsers").append('<p class="mb-0 ml-4 pl-3">No Databases found for user ' + mysql_username + '.</p>')
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

$("#mysqlUsername").on('change', ()=>{
    $("#username-prefix").text($("#mysqlUsername").val() + "_")
    var user = $("#mysqlUsername").val()
    fetchMysqlUsers(user)
 })
}