$(document).ready(function () {
    $("#datatable").DataTable(),
        $("#datatable-buttons")
            .DataTable({
                lengthChange: !1,
                buttons: ["copy", "excel", "pdf", "colvis"],
            })
            .buttons()
            .container()
            .appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");
});
$(document).ready(function () {

    $('.kt-table').DataTable({
        responsive: true,
        paging: true,
        processing: true,
        autoWidth: false,
        order: [], 
        lengthMenu: [10, 25, 50, 100, 150, 200, 500],
        pageLength: 25,
        dom: 'BLlfrtip',
        buttons: [
            'print','excel','colvis'
        ],
        
        columnDefs: [ {
        targets: 'no-sort',
            orderable: false,
            order: []
        },
        {
            targets: 'text-center',
            className: "dt-center"
        },
        {
            targets: 'no-search',
            searchable: false
        },
        {
            targets: 'hidden',
            visible: false
        }]
    });
    
    
    $('.kt-table-result').DataTable({
        responsive: true,
        paging: true,
        processing: true,
        autoWidth: false,
        ordering: false,
        order: [], 
        lengthMenu: [10, 25, 50, 100, 150, 200, 500],
        pageLength: 25,
        dom: 'BLlfrtip',
        buttons: [
            'print','excel'
        ],
        
        columnDefs: [ 
        {
        targets: 'no-sort',
            orderable: false,
            order: []
        },
        {
            targets: 'text-center',
            className: "dt-center"
        },
        {
            targets: 'no-search',
            searchable: false
        },
        {
            targets: 'hidden',
            visible: false
        }],
        aoColumnDefs: [
            { "bSortable": false, "aTargets": [ 0, 1, 2, 3 ] }, 
            { "bSearchable": false, "aTargets": [ 0, 1, 2, 3 ] }
        ]
    });

})