$( document ).ready( function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
   $('#logout').click(function(e){
        e.preventDefault();
        $.ajax({
            method : 'post',
            url : '/logout',
            data : {form: $('#logout-form').serialize()},
            success: function() {
                location.reload();
            }
        });
   });
   var counter = 2;
    $('#add-text-subject').click(function(e){
        e.preventDefault();
        var textNew = $(document.createElement('div')).attr({"id":"box_group"+counter});
        textNew.after().html(`<div class="form-group">
                <label>Tên chủ đề</label>
                <input required type="text" class="form-control" name="name`+counter+`" placeholder ="Tên chủ đề">
                <label>Nội dung</label>
                <textarea rows="5" class="form-control" name="content`+counter+`" required></textarea>
            </div>`);
        counter++;
        textNew.appendTo('#box_group');
        $('#counter').val(counter-1);
    });
    $('#delete-text-subject').click(function (e) {
        e.preventDefault();
        if(counter==2){
            alert("Bạn không thể xóa!");
            return false;
                       }
        counter--;
        $("#box_group" + counter).remove();

    });
    $('.delete').click(function(){
        var result = confirm('Bạn có muốn xóa?');
        if(result)
        {
            return true;
        }
        return false;
    });
});
