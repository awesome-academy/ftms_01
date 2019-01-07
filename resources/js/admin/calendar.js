$( document ).ready( function() {
   var counter = 2;
    $('#add-text-calendar').click(function(e){
        e.preventDefault();
        var textNew = $(document.createElement('div')).attr({"id":"box_calendar"+counter});
        textNew.after().html(`<div class="form-group">
                <label>Thứ</label>
                <input required type="number" class="form-control" name="day`+counter+`" placeholder ="Thứ">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Giờ bắt đầu</label>
                        <input required type="time" class="form-control" name="hour_start`+counter+`">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Giờ kết thúc</label>
                        <input required type="time" class="form-control" name="hour_end`+counter+`">
                    </div>
                </div>
            </div>`);
        counter++;
        textNew.appendTo('#box_calendar');
        $('#counter').val(counter-1);
    });
    $('#delete-text-calendar').click(function (e) {
        e.preventDefault();
        if (counter==2) {
            alert("Bạn không thể xóa!");
            return false;
        }
        counter--;
        $("#box_calendar" + counter).remove();

    });
});
