/**
 * @author: David Bezalel Laoli (david.laoly@gmail.com)
 * Jan 2017
 */

jQuery(document).ready(function () {
    var id = $('#id').val();
    var role = $('#role').val();
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
            {data: 'description'}
        ],
        order: [1, 'DESC'],
    });

    $('#add-role').click(function (e) {
        e.preventDefault();
        $('#add-modal').modal();
    });
});