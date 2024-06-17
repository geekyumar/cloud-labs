$(document).ready(function() {
    if (window.location.pathname === '/add-mysql-db') {
            $('body').on('click', '.delete-mysql-db', function() {
                event.stopPropagation();
                var mysql_dbname = this.id;

                var confirmation = confirm(`Do you want to delete database '${mysql_dbname}'?`);
                if (confirmation === true) {
                    $('#' + mysql_dbname).addClass("disabled").text("Deleting database..");

                    const fpPromise = import('https://openfpcdn.io/fingerprintjs/v4')
                        .then(FingerprintJS => FingerprintJS.load());

                    fpPromise
                        .then(fp => fp.get())
                        .then(result => {
                            var visitorId = result.visitorId;
                            var data = {
                                fingerprint: visitorId,
                                mysql_dbname: mysql_dbname
                            };

                            $.ajax({
                                type: 'POST',
                                url: '/api/services/mysql/deleteDb',
                                dataType: 'json',
                                data: data,
                                success: function(response) {
                                    if (response.response === 'success') {
                                        setTimeout(() => {
                                            createToast(`Database ${mysql_dbname} has been deleted!`);
                                            $('#' + mysql_dbname).text('Database deleted!');
                                            setTimeout(() => {
                                                window.location.href = "/add-mysql-db";
                                            }, 1500);
                                        }, 2000);
                                    } else {
                                        createToast(`Delete database ${mysql_dbname} failed!`);
                                        $('#' + mysql_dbname).removeClass("disabled").text('Drop database');
                                    }
                                },
                                error: function(response) {
                                    createToast(`Delete database ${mysql_dbname} failed due to some error!`);
                                    $('#' + mysql_dbname).removeClass("disabled").text('Drop database');
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
                                        window.location.replace('/dbs/login');
                                    } else {
                                        window.location.replace('/dbs/login');
                                    }
                                },
                                error: function(response) {
                                    window.location.replace('/dbs/login');
                                }
                            });
                        });
                }
            });
        }
    
});
