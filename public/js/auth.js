/**
 * @author: David Bezalel Laoli (david.laoly@gmail.com)
 * Jan 2017
 */

jQuery(document).ready(function () {
    var is_agree_terms = false;
    $('#register').submit(function (event) {
        event.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: '/user/register',
            type: 'POST',
            data: data,
            processData: false,
            cache: false,
            success: function (data) {
                console.log(data);
                if (!data.status) {
                    $('#success').hide();
                    $('#error').text(data.message).show();
                } else {
                    location.href = '/user/login';
                }
            }

        });
    });

    $('#login').submit(function (event) {
        event.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: '/user/login',
            type: 'POST',
            data: data,
            cache: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if (!data.status) {
                    $('#success').hide();
                    $('#error').text(data.message).show();
                } else {
                    location.href = '/dashboard';
                }
            }
        });
    });

});