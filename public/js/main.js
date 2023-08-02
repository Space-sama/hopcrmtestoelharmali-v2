$(document).ready(function() {
    $('#form').parsley();
    var table = $('#example').DataTable({
        responsive: true,
        "language": {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/French.json"
    }})
    .columns.adjust()
    .responsive.recalc();

    $(document).on('click', '.editOnModal',function() {
        var id = $(this).val();
        // alert(id);
        $.ajax({
            type: "get",
            url: '{{ URL::to("/edit_data") }}/'+id,
            success: function(res){
                console.log(res);
            },
        });
    });
});

