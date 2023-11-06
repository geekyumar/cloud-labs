<html>
    <h1>Hello</h1>
</html>

<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>


     // TODO: error handling in API (done)
       
       $(document).ready(()=>
       {
        var username = 'umar'
     
         var data = {
           username: username,
         }
     
         $.ajax({
           type:'POST',
           url:'src/api/authorize.api.php',
           dataType: 'json',
           data: data,
     
           success: function(response)
           {
               if(response.response == 'success')
               {
                   alert('success')
                 }
                 
               else if(response.response == 'failed')
               {
                  window.location.replace('users/login.php')
               }

           },
     
           error: function(xhr,status, response)
           {
             if(xhr.status == 500)
             {
             alert('error')
             }
           }
          })
     
         })

     </script>
