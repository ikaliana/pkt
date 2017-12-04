<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>File upload using PHP, jQuery and AJAX</title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function (e) {
                $('#upload').on('click', function () {
                    var form_data = new FormData();
                    var ins = document.getElementById('multiSHP').files.length;
                    for (var x = 0; x < ins; x++) {
                        form_data.append("shp[]", document.getElementById('multiSHP').files[x]);
                    }
                    $.ajax({
                        url: 'uploads.php', // point to server-side PHP script 
                        dataType: 'text', // what to expect back from the PHP script
                        cache: false,
                        contentType: false,
                        processData: false,
                        data: form_data,
                        type: 'post',
                        success: function (response) {
                            $('#msg').html(response); // display success response from the PHP script
                        },
                        error: function (response) {
                            $('#msg').html(response); // display error response from the PHP script
                        }
                    });
                });
            });
        </script>
    </head>
    <body>
        <p id="msg"></p>
        <input type="file" id="multiSHP" name="shp[]" multiple="multiple"/>
        <button id="upload">Upload</button>
    </body>
</html>