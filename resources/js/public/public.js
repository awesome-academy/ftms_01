$(document).ready(function(){
    $('.close-subjet').click(function(){
        var result = confirm('Bạn có muốn kết thúc chủ đề?');
        if (result) {
            return true;
        } else {
            return false;
        }
    });
    $('.progress-bar').css('width', $('#progress_course').val() + '%').attr('aria-valuenow', valeur);
});
