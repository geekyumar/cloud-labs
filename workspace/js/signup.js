// if(window.location.pathname == '/users/signup'){
//     $('#formSubmit').on('click', ()=>
//     {
//         $('#formSubmit').addClass('disabled')
//         $('#formSubmit').text('Signing up..')

//         var name = $('#formName').val()
//         var username = $('#formUsername').val()
//         var email = $('#formEmail').val()
//         var phone = $('#formPhone').val()
//         var password = $('#formPassword').val()

//         var data = {
//         name: name,
//         username: username,
//         email: email,
//         phone: phone, 
//         password: password
//         }

//         $.ajax({
//         type:'POST',
//         url:'/src/api/signup.api.php',
//         dataType: 'json',
//         data: data,

//         success: function(response)
//         { 
//             if(response.response == 'success')
//             {
//                 setTimeout(()=>{
//                 createToast('Signup Success!')
//                 $('#formSubmit').text('Signed up!')
//                 setTimeout(()=>
//                 {
//                     window.location.href="/users/login"
//                 },1500)
//                 }, 2000)
                
//             }
//             else if(response.response == 'failed')
//             {
//                 setTimeout(()=>{
//                 createToast('Signup Failed! Check your input details and try again.')
//                 $('#formSubmit').removeClass('disabled')
//                 $('#formSubmit').text('Signup')
//                 }, 2000)
//             }
//         },

//         error: function(xhr,status, response)
//         {
//             if(xhr.status == 500)
//             {
//             createToast('There is a problem with the signup. please try again later.')
//             $('#formSubmit').removeClass('disabled')
//             $('#formSubmit').text('Signup')
//             }
//         }

//         })
//     })
// }