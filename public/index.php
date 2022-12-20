<?php 
    // require config
    require_once("../config.php");

    // get app name
    $appName = $config["app-name"]
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta content="<?php echo $config["description"]; ?>" name="description">
        <meta content="<?php $config["keywords"]; ?>" name="keywords">
        <link rel="icon" type="image/x-icon" href="assets/img/icon.png">
        <link href="assets/css/main.css" rel="stylesheet">
        <title id="title"><?php echo $appName; ?></title>
    </head>
    <body>
        <header>
            <h2><?php echo $appName; ?></h2>
        </header>
        
        <main class="file-upload-form">

            <p class="upload-form-title">File upload</p>

            <div class="form-group">
                <input type="file" class="form-control" id="fileInput" title="cc">
            </div>

            <div id="fileList"></div>

            <div class="progress"></div>   

            <div class="form-group">
                <a id="uploadBtn" href="javascript:;" class="btn btn-success">Upload</a>
            </div>
        </main>

        <footer>
            <h1>Made with ❤️ by <a class="lukas-link" href="http://becvold.xyz/">Lukáš Bečvář</a></h1>
        </footer>

        <script src="assets/js/plupload.full.min.js"></script>
        <script>

            var uploader = new plupload.Uploader({
                runtimes : 'html5,flash,silverlight,html4',
                browse_button : 'fileInput', 
                url : 'fileUploader.php',
                flash_swf_url : 'plupload/js/Moxie.swf',
                silverlight_xap_url : 'plupload/js/Moxie.xap',
                multi_selection: false,
                
                filters : {
                    max_file_size : '1024mb',
                    mime_types: [
                        {title : "Image files", extensions : "jpg,jpeg,gif,png"},
                        {title : "Video files", extensions : "mp4,avi,mpeg,mpg,mov,wmv"},
                        {title : "Zip files", extensions : "zip,7z,rar,tar.gz,tar"},
                        {title : "Document files", extensions : "pdf,docx,xlsx,txt,ppt,pptx"}
                    ]
                },

                init: {
                    PostInit: function() {
                        document.getElementById('fileList').innerHTML = '';

                        document.getElementById('uploadBtn').onclick = function() {
                            if (uploader.files.length < 1) {
                                document.getElementById('statusResponse').innerHTML = '<p style="color:#EA4335;">Please select a file to upload.</p>';
                                return false;
                            }else{
                                uploader.start();
                                return false;
                            }
                        };
                    },

                    FilesAdded: function(up, files) {
                        plupload.each(files, function(file) {
                            document.getElementById('fileList').innerHTML += '<div id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                        });
                    },

                    UploadProgress: function(up, file) {                        
                        // update progress
                        document.querySelector(".progress").innerHTML = '<span class="progress-bar-fill" style="width: '+file.percent+'%;"">'+file.percent+'%</span>';

                        // update progress title
                        document.querySelector("#title").innerHTML = file.percent+'% -> ' + file.name;
                    },
                    
                    // file upload progress
                    FileUploaded: function(up, file, result) {
                    
                        var today = new Date();
                        var dd = String(today.getDate()).padStart(2, '0');
                        var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
                        var yyyy = today.getFullYear();

                        today = dd + '_' + mm + '_' + yyyy;


                        // redirect to download page
                        window.location.replace("fileDownloader.php?file="+file.name+"&date="+today);
                    },

                    // file upload error
                    Error: function(up, err) {
                        document.getElementById('statusResponse').innerHTML = '<p style="color:#EA4335;">Error #' + err.code + ': ' + err.message + '</p>';
                    }
                }
            });

            // Initialize Plupload uploader
            uploader.init();
        </script>
    </body>
</html>