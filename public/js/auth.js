/**
 * @author: David Bezalel Laoli (david.laoly@gmail.com)
 * Jan 2017
 */

jQuery(document).ready(function () {
    var is_agree_terms = false;

    $('#login').submit(function (event) {
        $('#success').hide();
        $('#error').hide();
        event.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: '/user/login',
            type: 'POST',
            data: data,
            cache: false,
            processData: false,
            success: function (data) {
                if (!data.status) {
                    $('#error').text(data.message).show();
                } else {
                    location.href = '/dashboard';
                }
            }
        });
    });

});