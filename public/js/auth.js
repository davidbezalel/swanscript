/**
 * @author: David Bezalel Laoli (david.laoly@gmail.com)
 * Jan 2017
 */

jQuery(document).ready(function () {
    var is_agree_terms = false;

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
                $('#error').hide();
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