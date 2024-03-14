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
url:'/src/api/device/delete-device.api.php',
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