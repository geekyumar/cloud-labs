if(window.location.pathname == '/add-domain'){
    $('#domainType').on('change', function(){
        if($('#domainType').val() !== 'custom'){
            $('#customDomainInput').addClass('d-none')
            $('#domainInput').removeClass('d-none')
        } else {
            $('#domainInput').addClass('d-none')
            $('#customDomainInput').removeClass('d-none')
        }
    })

    $('#customDomain').on('input', function() {
        $('#customDomainName').text($(this).val())
    });

    function isValidDomain(domain) {
        const domainRegex = /^(?!:\/\/)([a-zA-Z0-9-]{1,63}\.)+[a-zA-Z]{2,}$/;
        return domainRegex.test(domain);
    }    

    $("#addDomainSubmit").on('click', ()=>
        {
            const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
            .then(FingerprintJS => FingerprintJS.load());
        
            fpPromise
            .then(fp => fp.get())
            .then(result => {
            visitorId = result.visitorId
        
            var domain_name = $('#domainName').val()
            var domain_type = $('#domainType').val()

            if(domain_type == 'custom'){
                custom_domain_name = $('#customDomain').val()
            }

            $('#addDomainSubmit').addClass('disabled')
            $('#addDomainSubmit').text('Adding Domain...')

            // if(isValidDomain(domain_name) == false){
            //     createToast(`Invalid domain name!`)
            //     $('#addDomainSubmit').removeClass('disabled')
            //     $('#addDomainSubmit').text('Add domain')
            //     return
            // }

            var data = {
                domain:domain_name,
                domain_type:domain_type,
            }
        
            $.ajax({
            type:'POST',
            url:'/api/domains/add',
            dataType: 'json',
            data: data,
        
            success: function(response)
            { 
                if(response.response == 'success')
                {
                    setTimeout(()=>{
                        createToast(`Domain ${domain_name} added!`)
                        $('#addDomainSubmit').text('Domain added!')
                        setTimeout(()=>
                        {
                            window.location.href="/domains"
                        },1500)
                        }, 2000)
                }
                else{
                    createToast(`Add Domain ${domain_name} failed!`)
                    $('#addDomainSubmit').removeClass('disabled')
                    $('#addDomainSubmit').text('Add Domain')
                }
            },
        
            error: function(response) {
                if(response.responseJSON.response == 'no_lab_instance_created'){
                    createToast(`You have no lab instance created. create your lab instance and try again.`)
                    $('#addDomainSubmit').removeClass('disabled')
                    $('#addDomainSubmit').text('Add Domain')
                } else {
                    createToast(`Add Domain ${domain_name} failed due to some error!`)
                    console.log(response.responseJSON.response)
                    $('#addDomainSubmit').removeClass('disabled')
                    $('#addDomainSubmit').text('Add Domain')
                }
               
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