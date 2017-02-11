/**
 * @author: David Bezalel Laoli (david.laoly@gmail.com)
 * Jan 2017
 */

jQuery(document).ready(function () {
    var id = $('#user_id').val();

    function load_user_data(id) {
        $.ajax({
            url: '/api/author/profile/' + id,
            type: 'GET',
            processData: false,
            cache: false,
            success: function (data) {
                var data = data['data'];
                $('.user_name').text(data.name);
                $('.user_alias').text(data.alias);
                $('.user_email').text( data.email);
                $('.user_alias_email').text(data.alias + ', ' + data.email);
                if (null == data.photo) {
                    $('.user_photo').attr('src', '/images/user/user_avatar.png');
                } else {
                    $('.user_photo').attr('src', '/images/user/' + data.photo);
                }
                $('.user_created_at').text('Member since ');
            }
        });
    }

    load_user_data(id);
});