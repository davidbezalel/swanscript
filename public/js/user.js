/**
 * @author: David Bezalel Laoli (david.laoly@gmail.com)
 * Jan 2017
 */

jQuery(document).ready(function () {
    var id = $('#id').val();
    var role = $('#role').val();
    var table = $('#users-table').DataTable({
        bFilter: true,
        ordering: true,
        serverSide: true,
        lengthChange: true,
        ajax: {
            url: '/users',
            type: 'POST'
        },
        columns: [
            {
                data: 'no',
                className: 'no',
                searchable: false,
                orderable: false
            },
            {data: 'name'},
            {data: 'alias'},
            {data: 'email'},
            {
                data: null,
                searchable: false,
                orderable: false,
                defaultContent: '<img class="image-datatable img-responsive">'
            },
            {
                data: null,
                searchable: false,
                orderable: false,
                className: 'right',
                defaultContent: '<a class="look-item action"" ><i class="fa fa-eye" aria-hidden="true"></i></a>' +
                '<a class="update-item action action"><i class="fa fa-pencil" aria-hidden="true"></i></a>' +
                '<a class="delete-item action action-danger" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>'
            }
        ],
        order: [1, 'ASC'],
        aoColumnDefs: [{
            aTargets: [4, 5],
            fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                if (iCol == 4) {
                    if (null != oData.photo) {
                        $(nTd.children[0]).attr('src', '/assets/user/' + oData.photo);
                    } else {
                        $(nTd.children[0]).attr('src', '/assets/user/user_avatar.png');
                    }
                } else if (iCol == 5) {
                    console.log(oData);
                    $(nTd.children[0]).attr('href', '/user/profile/' + oData.id);
                    $(nTd.children[1]).attr('href', '/user/profile/' + oData.id);
                    $(nTd.children[2]).attr('data-id', oData.id);
                    if (oData.is_permitted) {
                        $(nTd.children[0]).hide();
                    } else {
                        $(nTd.children[1]).hide();
                        $(nTd.children[2]).hide();
                    }
                }
            }
        }]

    });

    $('#register-button').click(function (e) {
        e.preventDefault();
        $('#register-modal').modal();
    });

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
                if (!data.status) {
                    $('#error').text(data.message).show();
                } else {
                    $('#register-modal').modal('hide');
                    table.draw();
                }
            }

        });
    });

    $(document).on('click', '.delete-item', function (e) {
        e.preventDefault();
        var _id = $(this).attr('data-id');
        $.ajax({
            url: '/user/delete',
            type: 'POST',
            data: {'id': _id},
            dataType: 'JSON',
            cache: false,
            success: function (data) {
                console.log(data);
                if (data.status) {
                    table.draw();
                }
            }
        });
    });
});