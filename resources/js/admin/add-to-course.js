$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $( "#course_name" ).change(function() {
        $( "#course_name option:selected" ).each(function() {
            var course_id = $('#course_name :selected').val();
            $.ajax({
                url : '/admin/post-trainee',
                type : 'post',
                data : {
                    course_id : course_id,
                },
                success: function(data){
                    var tr = '';
                    $.each(data, function(key, value){
                       tr = tr + `<tr>`
                                + `<td>` + key + `</td>`
                                + `<td>
                                        <a href = "delete-trainee/` +value[0].pivot.user_id+`/`+value[0].pivot.course_id+`" class = "btn btn-danger delete">Xóa</a>
                                    </td>`
                            + `</tr>`
                    });
                    $('#trainee').html(tr);
                }
            });
        });
    }).trigger( "change" );
    $( "#course_id" ).change(function() {
        $( "#course_id option:selected" ).each(function() {
            var course_id = $('#course_id').val();
            $.ajax({
                url : '/admin/show-subject',
                method : 'post',
                data : {
                    course_id : course_id
                },
                success : function (data){
                    var box = '';
                    $.each(data, function (key, value){
                        box = box + `<p>
                                <label>
                                    <input type = "checkbox" checked value="`+value.id+`" name="subject[]">
                                    `+ value.name+
                                `</label>
                            </p>`
                    });
                    $('#box-subject').html(box);
                }
            });
        });
    }).trigger( "change" );
});
