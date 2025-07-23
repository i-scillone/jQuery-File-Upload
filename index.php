<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>JQFU test</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.14.1/jquery-ui.min.js" integrity="sha256-AlTido85uXPlSyyaZNsjJXeCs07eSv3r43kyCVc8ChI=" crossorigin="anonymous"></script>
    <link href="https://code.jquery.com/ui/1.13.3/themes/redmond/jquery-ui.css" rel="stylesheet">
    <script src="js/jquery.fileupload.js"></script>
    <link href="/my_reset.css" rel="stylesheet">
    <style>
        h1 { font-size: 200%; }
        #progress { width: 25%; }
        #feedback { 
            margin-top: 8px;
            color: silver; background: black;
        }
    </style>
    <script>
    $(function(){
        var progress=$('#progress').progressbar({ value: false });
        $('#source').fileupload({
            url: 'server/php/index.php',
            dataType: 'json',
            maxChunkSize: 10000000,
            start: function(e){
                progress.progressbar('option',{ value: 0});
            },
            done: function (e, data) {
                $.each(data.result.files, function (index, file) {
                    console.log(file.error);
                    $('#feedback').append(file.name+": OK\n");
                });
            },
            progressall: function (e, data) {
                progress.progressbar('option',{ value: data.loaded / data.total * 100});
            }
        });
    });
    </script>
</head>
<body>
<h1>JQuery File Upload test</h1>
<p><input id="source" type="file" name="files[]" multiple></p>
<div id="progress"></div>
<pre id="feedback"><?= 'Lunghezze massime ➔ upload: '.ini_get('upload_max_filesize').' post: '.ini_get('post_max_size').' memoria: '.ini_get('memory_limit').PHP_EOL; ?></pre>
</body>
</html>