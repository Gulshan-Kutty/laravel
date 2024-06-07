
function fileUpload(){
    $file = $('#file').val();
    if ($file == '') {
        $('#fileError').text("Please upload file");
        return false;
    }
    else{
        $('#fileError').text("");
        return true;

    }

}