if (window.location.pathname == '/domains') {
    let deleteClass = $('.deleteDomain');
    for (let i = 0; i < deleteClass.length; i++) {
        deleteClass[i].addEventListener('click', function () {
            let confirmation = confirm('Do you want to delete the domain?');
            if (confirmation) {
                var domain_name = this.id;
                let button = $(this); // Target the clicked button

                import('https://openfpcdn.io/fingerprintjs/v4')
                    .then(FingerprintJS => FingerprintJS.load())
                    .then(fp => fp.get())
                    .then(result => {
                        let visitorId = result.visitorId;

                        button.addClass('disabled').text('Deleting Domain...'); // Properly disable the button

                        let data = { domain: domain_name };

                        $.ajax({
                            type: 'POST',
                            url: '/api/domains/delete',
                            dataType: 'json',
                            data: data,
                            success: function (response) {
                                if (response.response == 'success') {
                                    setTimeout(() => {
                                        createToast(`Domain ${domain_name} deleted!`);
                                        button.text('Domain deleted!');
                                        setTimeout(() => {
                                            window.location.href = "/domains";
                                        }, 1500);
                                    }, 2000);
                                } else {
                                    createToast(`Delete Domain ${domain_name} failed!`);
                                    button.removeClass('disabled').text('Delete Domain'); // Re-enable the button
                                }
                            },
                            error: function () {
                                createToast(`Delete Domain ${domain_name} failed due to some error!`);
                                button.removeClass('disabled').text('Delete Domain'); // Re-enable the button
                            }
                        });
                    })
                    .catch(() => {
                        $.ajax({
                            type: 'POST',
                            url: '/api/auth/sessionDestroy',
                            dataType: 'json',
                            success: function (response) {
                                if (response.response == 'success') {
                                    window.location.replace('/users/login');
                                } else {
                                    window.location.replace('/users/login');
                                }
                            },
                            error: function () {
                                window.location.replace('/users/login');
                            }
                        });
                    });
            }
        });
    }
}