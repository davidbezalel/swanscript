/**
 * @author: David Bezalel Laoli (david.laoly@gmail.com)
 * Jan 2017
 */

jQuery(document).ready(function () {
    var id = $('#id').val();

    function load_user_data(id) {
        $.ajax({
            url: '/api/author/profile/' + id,
            type: 'GET',
            processData: false,
            cache: true,
            success: function (data) {
                var data = data['data'];

                /* data in header */
                $('.user_name').text(data.name);
                $('.user_alias').text(data.alias);
                $('.user_email').text(data.email);
                $('.user_alias_email').text(data.alias + ', ' + data.email);
                if (null == data.photo) {
                    $('.user_photo').attr('src', '/images/user/user_avatar.png');
                    $('.profile-user-img').attr('src', '/images/user/user_avatar.png');
                } else {
                    var time = new Date();
                    $('.profile-user-img').attr('src', '/images/user/' + data.photo + '?' + time.getTime());
                    $('.user_photo').attr('src', '/images/user/' + data.photo + '?' + time.getTime());
                }
                $('.role').text(data.role);

                /* data in aside */
                $('.education').text(data.profile.education);
                $('.location').text(data.profile.location);
                $('.notes').text(data.profile.notes);

                var label = ['label-danger', 'label-success', 'label-info', 'label-warning', 'label-primary'];
                var skills = data.profile.skills;
                $('.skills').text('');
                if (null !== skills && skills.trim() !== '') {
                    if (skills.length > 1) {
                        skills = skills.split(',');
                        for (var i = 0; i < skills.length; i++) {
                            var _span = '<span class="label ' + label[i % 5] + '">' + skills[i] + "</span>";
                            $('.skills').append(_span);
                        }
                    } else if (skills.length == 0) {
                        var _span = '<span class="label label-danger">' + skills[0] + "</span>";
                        $('.skills').append(_span);
                    }
                }
                /* data in profile input form */

                $('#inputEducation').val(data.profile.education);
                $('#inputLocation').val(data.profile.location);
                $('#inputSkills').val(data.profile.skills);
                $('#inputNotes').val(data.profile.notes);
                $('#inputName').val(data.name);
                $('#inputEmail').val(data.email);
                $('#inputAlias').val(data.alias);
            }
        });
    }

    load_user_data(id);

    $('#update_profile').submit(function (event) {
        event.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: '/api/author/profile/update',
            type: 'POST',
            data: data,
            processData: false,
            cache: true,
            success: function (data) {
                if (data.status) {
                    $('#update_profile_success').show().text('Update Profile Success.');
                    load_user_data(id);
                }
            }
        });
    });

    $('#upload-image-container').click(function () {
        $('#user-image').click();
    });

    $('#user-image').change(function () {
        if ($('#user-image')[0].files && $('#user-image')[0].files[0]) {
            var _reader = new FileReader();
            _reader.readAsDataURL($('#user-image')[0].files[0]);

            /* ajax */
            var data = new FormData();
            data.append('photo', $('#user-image')[0].files[0]);
            $.ajax({
                url: '/api/author/profile/update-image',
                type: 'POST',
                data: data,
                contentType: false,
                processData: false,
                cache: false,
                success: function (data) {
                    if (data.status) {
                        load_user_data(id);
                    } else {
                        $('#error-update-image').text(data.message).show();
                    }
                }
            });
        }
    });

    $('#update_setting').submit(function (event) {
        event.preventDefault();
        var data = $(this).serialize();
        $.ajax({
            url: '/api/author/profile/update',
            type: 'POST',
            data: data,
            processData: false,
            cache: false,
            success: function (data) {
                if (data.status) {
                    $('#update_setting_success').text('Update Setting Success.').show();
                    load_user_data(id);
                } else {
                    $('#update_setting_error').text(data.message).show();
                }
            }

        });
    });

});