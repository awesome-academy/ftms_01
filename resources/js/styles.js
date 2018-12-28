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
});
