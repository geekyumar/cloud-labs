$(document).ready(function() {
    if (window.location.pathname === '/add-mongodb-db') {
            $('body').on('click', '.delete-mongodb-db', function() {
                event.stopPropagation();
                var mongodb_dbname = this.id;

                var confirmation = confirm(`Do you want to delete database '${mongodb_dbname}'?`);
                if (confirmation === true) {
                    $('#' + mongodb_dbname).addClass("disabled").text("Deleting database..");

                    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
                        .then(FingerprintJS => FingerprintJS.load());

                    fpPromise
                        .then(fp => fp.get())
                        .then(result => {
                            var visitorId = result.visitorId;
                            var data = {
                                fingerprint: visitorId,
                                mongodb_dbname: mongodb_dbname
                            };

                            $.ajax({
                                type: 'POST',
                                url: '/api/services/mongodb/deleteDb',
                                dataType: 'json',
                                data: data,
                                success: function(response) {
                                    if (response.response === 'success') {
                                        setTimeout(() => {
                                            createToast(`Database ${mongodb_dbname} has been deleted!`);
                                            $('#' + mongodb_dbname).text('Database deleted!');
                                            setTimeout(() => {
                                                window.location.href = "/add-mongodb-db";
                                            }, 1500);
                                        }, 2000);
                                    } else {
                                        createToast(`Delete database ${mongodb_dbname} failed!`);
                                        $('#' + mongodb_dbname).removeClass("disabled").text('Drop database');
                                    }
                                },
                                error: function(response) {
                                    createToast(`Delete database ${mongodb_dbname} failed due to some error!`);
                                    $('#' + mongodb_dbname).removeClass("disabled").text('Drop database');
                                    console.log(response);
                                }
                            });
                        })
                        .catch(error => {
                            $.ajax({
                                type: 'POST',
                                url: '/api/auth/sessionDestroy',
                                dataType: 'json',
                                success: function(response) {
                                    if (response.response === 'success') {
                                        window.location.replace('/users/login');
                                    } else {
                                        window.location.replace('/users/login');
                                    }
                                },
                                error: function(response) {
                                    window.location.replace('/users/login');
                                }
                            });
                        });
                }
            });
        }
    
});
