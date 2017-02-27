/**
 * @author: David Bezalel Laoli (david.laoly@gmail.com)
 * Jan 2017
 */

jQuery(document).ready(function () {
    var id = $('#user_id').val();

    function load_user_data(id) {
        $.ajax({
            url: '/api/user/profile/' + id,
            type: 'GET',
            processData: false,
            cache: false,
            success: function (data) {
                var data = data['data'];
                $('.user_name_dashboard').text(data.name);
                $('.user_alias_dashboard').text(data.alias);
                if (null == data.photo) {
                    $('.user_photo_dashboard').attr('src', '/assets/user/user_avatar.png');
                } else {
                    $('.user_photo_dashboard').attr('src', '/assets/user/' + data.photo);
                }
                $('.role_dashboard').text(data.role_name.name);
            }
        });
    }

    load_user_data(id);
});