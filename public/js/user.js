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
                defaultContent: '<a class="update-item action" data-toggle="tooltip" ><i class="fa fa-pencil-square" aria-hidden="true"></i></a>' +
                '<a class="look-item action" data-toggle="tooltip" ><i class="fa fa-eye" aria-hidden="true"></i></a>' +
                '<a class="delete-item action" data-toggle="tooltip" ><i class="fa fa-trash" aria-hidden="true"></i></a>'
            }
        ],
        order: [1, 'ASC'],
        aoColumnDefs: [{
            aTargets: [4, 5],
            fnCreatedCell: function (nTd, sData, oData, iRow, iCol) {
                if (iCol == 4) {
                    if (null != oData.photo) {
                        $(nTd.children[0]).attr('src', '/images/user/' + oData.photo);
                    } else {
                        $(nTd.children[0]).attr('src', '/images/user/user_avatar.png');
                    }
                } else if (iCol == 5) {
                    if (id != oData.id) {
                        $(nTd.children[0]).attr('style', 'display: none');
                        $(nTd.children[1]).attr('href', '/author/profile/' + oData.id + '/0');
                        if (role == "CEO") {
                        } else {
                            $(nTd.children[2]).attr('style', 'display: none');
                        }
                    } else {
                        $(nTd.children[0]).attr('href', '/author/profile/' + oData.id + '/1');
                        $(nTd.children[1]).attr('style', 'display: none');
                    }
                }
            }
        }]

    });
});