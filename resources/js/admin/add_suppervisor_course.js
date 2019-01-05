$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $( "#course_suppervisor" ).change(function() {
        $( "#course_suppervisor option:selected" ).each(function() {
            var course_id = $('#course_suppervisor').val();
            $.ajax({
                url : '/admin/show-suppervisor',
                method : 'post',
                data : {
                    course_id : course_id
                },
                success : function (data){
                    var tr = '';
                    $.each(data, function(key, value){
                       tr = tr + `<tr>`
                                + `<td>` + value.name + `</td>`
                                + `<td>
                                        <a href = "delete-suppervisor/`
                                         +value.id+`/`+value['pivot'].course_id+`
                                        " class = "btn btn-danger delete">
                                        Xóa</a>
                                    </td>`
                            + `</tr>`
                    });
                    $('#suppervisor').html(tr);

                }
            });
        });
    }).trigger( "change" );
});
