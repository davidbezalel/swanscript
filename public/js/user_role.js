/**
 * @author: David Bezalel Laoli (david.laoly@gmail.com)
 * Jan 2017
 */

jQuery(document).ready(function () {
    var id = $('#id').val();
    var _is_permitted = $('#is_permitted').val();
    var array_delete = [];

    if (_is_permitted) {
        var table = $('#table').DataTable({
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
                    data: null,
                    className: 'no',
                    searchable: false,
                    orderable: false,
                    defaultContent: '<input class="choose-item" type="checkbox">'
                },
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
                    className: 'no',
                    searchable: false,
                    orderable: false,
                    defaultContent: '<input class="role-item" type="checkbox">'
                },
                {
                    data: null,
                    className: 'no',
                    searchable: false,
                    orderable: false,
                    defaultContent: '<input class="role-item" type="checkbox">'
                },
                {
                    data: null,
                    searchable: false,
                    orderable: false,
                    className: 'right',
                    defaultContent: '<a href="" class="update action action"><i class="fa fa-pencil" aria-hidden="true"></i></a>' +
                    '<a class="delete action action-danger" href=""><i class="fa fa-trash" aria-hidden="true"></i></a>'
                }
            ],
            order: [2, 'ASC'],
            aoColumnDefs: [{
                aTargets: [0, 4, 5, 6],
                fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                    if (iCol == 6) {
                        $(nTd.children[0]).attr('data-data', JSON.stringify(oData));
                        $(nTd.children[1]).attr('data-id', oData.id);
                    } else if (iCol == 0) {
                        if (jQuery.inArray(oData.id.toString(), array_delete) !== -1) {
                            $(nTd.children[0]).attr('checked', 'checked');
                        }
                        $(nTd.children[0]).attr('data-id', oData.id);
                    } else if (iCol == 4) {
                        if (oData.profile == '1') {
                            console.log(oData);
                            console.log(nTd.children[0]);
                            $(nTd.children[0]).attr('checked', 'checked');
                        }
                        $(nTd.children[0]).attr('data-id', oData.id);
                        $(nTd.children[0]).attr('data-flag', 'profile');
                    } else if (iCol == 5) {
                        if (oData.role == '1') {
                            console.log(oData);
                            console.log(nTd.children[0]);
                            $(nTd.children[0]).attr('checked', 'checked');
                        }
                        $(nTd.children[0]).attr('data-id', oData.id);
                        $(nTd.children[0]).attr('data-flag', 'role');
                    }
                }
            }]
        });
    } else {
        var table = $('#table').DataTable({
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
            order: [2, 'ASC'],
        });
    }

    $('#table').on('change', '.choose-item', function (event) {
        var id = $(this).attr('data-id');
        if (jQuery.inArray(id, array_delete) === -1) {
            array_delete.push(id);
        } else {
            var index = array_delete.indexOf(id);
            if (index > -1) {
                array_delete.splice(index, 1);
            }
        }
        if (array_delete.length > 0) {
            $('#multiple-delete').show();
        } else {
            $('#multiple-delete').hide();
        }
    });

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

    $(document).on('click', '.delete', function (e) {
        e.preventDefault();
        if (confirm("Are you sure want to delete this item?") == true) {
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
        }
    });

    $(document).on('click', '.update', function (event) {
        event.preventDefault();
        var _data = JSON.parse($(this).attr('data-data'));
        $('#update-modal #id').val(_data.id);
        $('#update-modal #name').val(_data.name);
        $('#update-modal #description').val(_data.description);
        $('#update-modal').modal();
    });

    $('#update-form').submit(function (event) {
        event.preventDefault();
        var _data = $(this).serialize();
        $.ajax({
            url: '/user/role/update',
            type: 'POST',
            data: _data,
            cache: false,
            success: function (data) {
                if (data.status) {
                    $('#update-modal').modal('hide');
                    table.draw();
                }
            }
        });
    });

    $(document).on('click', '#multiple-delete', function (event) {
        event.preventDefault();
        $.ajax({
            url: '/user/role/multipledelete',
            type: 'POST',
            data: JSON.stringify({'items': array_delete}),
            contentType: 'application/json',
            success: function (data) {
                console.log(data);
                if (data.status) {
                    $('#multiple-delete').hide();
                    array_delete = [];
                    table.draw();
                }
            }
        });
    });

    $(document).on('click', '.role-item', function (event) {
        var _id = $(this).attr('data-id');
        var _flag = $(this).attr('data-flag');
        $.ajax({
            url: '/user/role/update/item',
            type: 'POST',
            data: JSON.stringify({'id': _id, 'flag': _flag}),
            contentType: 'application/json',
            success: function (data) {
                console.log(data);
                if (data.status) {
                    table.draw();
                }
            }
        });
    })
});