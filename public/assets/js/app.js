var learnersTable;
$(document).ready(function () {

    $("#department-list").slimScroll({
        height: "400px",
        position: "right",
        size: "4px",
        color: "#dcdcdc",
        alwaysVisible: true
    });

    learnersTable = $('#learners-table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                text: 'Add New Learner',
                className : 'learner-check',
                action: function ( e, dt, node, config ) {

                }
            },
            {
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
                }
            }
            // 'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    learnersTable.on('click', '.remove-learner', function() {

        var that = $(this);
        swal({
            title: 'Remove Learner?',
            text: "You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, remove learner!'
        }).then((result) => {
            if (result.value) {
                that.parent().submit();
            }
        });
    });

    learnersTable.on('click', '.archive-learner', function() {

        var that = $(this);
        swal({
            title: 'Archive Learner ?',
            text: "You may add this learner back to your organization later",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, archive learner!'
        }).then((result) => {
            if (result.value) {
                that.parent().submit();
            }
        });
    });

    $('#department-list li:last').detach().prependTo('#department-list');
    $('#department-list .department').click(function () {
        var name = $(this).attr('data-name');
        learnersTable.columns(3).search(name).draw();
        $('#department-list li').removeClass('box-label');
        $(this).parent('li').addClass('box-label');
    });

    $('.department .edit').click(function () {
        $('#department-name').val($(this).attr('data-name'));
        $('#department-id').val($(this).attr('data-id'));
        var action = $('#edit-department').find('form').attr('action');
        $('#edit-department').find('form').attr('action',action + '/' + $(this).attr('data-id'));
        $('#edit-department').modal('show');
    })

    $('#learners-table').on('click', '.archive-learner', function() {

        var that = $(this);
        swal({
            title: 'Archive Learner?',
            text: "You can revert this later.",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, archive'
        }).then((result) => {
            if (result.value) {
            that.parent().submit();
        }
    });
    });

    $('#learners-table').on('click', '.restore-learner', function() {

        var that = $(this);
        swal({
            title: 'Restore Learner?',
            text: "Are you sure?",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, restore'
        }).then((result) => {
            if (result.value) {
            that.parent().submit();
        }
    });
    });

    $('.scroll-top').click(function(){
        $("html, body").animate({ scrollTop: 0 }, "fast");
        return false;
    });
    $('.firework').click(function(){
        $(this).stop(0).fadeOut('fast').fireworks('destroy');
    });
});
$(window).scroll(function(){
    var scroll = $(window).scrollTop();
    if(scroll > 700){
        $('.scroll-top').stop(0).fadeIn('fast');
    }
    else{
        $('.scroll-top').stop(0).fadeOut('fast');
    }
})

function showToast(title,message,type) {
    $.toast({
        heading: title,
        text: message,
        position: 'top-right',
        loaderBg:'#f75b36',
        icon: type,
        hideAfter: 7000,
        stack: 6
    });
}
function firework(){
    $('.firework').stop(0).fadeIn('fast').fireworks();
    setTimeout(function () {
        $('.firework').stop(0).fadeOut('fast').fireworks('destroy');
    }, 10000);
}