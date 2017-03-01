/**
 * @author: David Bezalel Laoli (david.laoly@gmail.com)
 * Jan 2017
 */

jQuery(document).ready(function () {
    var id = $('#id').val();
    var _is_permitted = $('#is_permitted').val();

    if (_is_permitted) {
        var table = $('#roles-table').DataTable({
            bFilter: true,
            ordering: true,
            serverSide: true,
            lengthChange: true,
            ajax: {
                url: '/user/roles',
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
                {data: 'description'},
                {
                    data: null,
                    searchable: false,
                    orderable: false,
                    className: 'right',
                    defaultContent: '<a href="" class="update-item action action"><i class="fa fa-pencil" aria-hidden="true"></i></a>' +
                    '<a class="delete-item action action-danger" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>'
                }
            ],
            order: [1, 'ASC'],
            aoColumnDefs: [{
                aTargets: [3],
                fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                    if (iCol == 3) {
                        $(nTd.children[0]).attr('data-id', oData.id);
                        $(nTd.children[1]).attr('data-id', oData.id);
                    }
                }
            }]
        });
    } else {
        var table = $('#roles-table').DataTable({
            bFilter: true,
            ordering: true,
            serverSide: true,
            lengthChange: true,
            ajax: {
                url: '/user/roles',
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
                {data: 'description'},
            ],
            order: [1, 'ASC'],
        });
    }



    $('#add').click(function (e) {
        e.preventDefault();
        $('#error').hide();
        $('#add-modal').modal();
    });

    $('#add-form').submit(function (e) {
        e.preventDefault();
        console.log('submit');
        var data = $(this).serialize();
        var _form = $(this)[0];
        $.ajax({
            url: '/user/role/add',
            type: 'POST',
            data: data,
            cache: false,
            processData: false,
            success: function (data) {
                console.log(data);
                if (data.status) {
                    $('#add-modal').modal('hide');
                    _form.reset();
                    table.draw();
                } else {
                    $('#error').show().text(data.message);
                }
            }
        });
    });

    $(document).on('click', '.delete-item', function (e) {
        e.preventDefault();
        var _id = $(this).attr('data-id');
        $.ajax({
            url: '/user/role/delete',
            type: 'POST',
            data: {'id': _id},
            dataType: 'JSON',
            cache: false,
            success: function (data) {
                if (data.status) {
                    table.draw();
                }
            }
        });
    });
});