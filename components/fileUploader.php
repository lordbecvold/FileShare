<div class="file-upload-form">
    <p class="upload-form-title">File upload</p>

    <div class="form-group">
        <input type="file" class="form-control" id="file-upload" title="cc">
    </div>

    <div id="fileList"></div>

    <div class="progress"></div>   

    <div class="form-group">
        <a id="uploadBtn" href="javascript:;" class="btn btn-success">Upload</a>
    </div>
</div>

<script src="assets/js/plupload.full.min.js"></script>
<script>

    // generate random int for create storage key
    var random_int = Math.random().toString(10).slice(2);

    // uploader properties
    var uploader = new plupload.Uploader({
        runtimes : 'html5,flash,silverlight,html4',
        browse_button : 'file-upload', 
        url : 'upload_YZjcoaX443.php?key='+random_int,
        flash_swf_url : 'plupload/js/Moxie.swf',
        silverlight_xap_url : 'plupload/js/Moxie.xap',
        multi_selection: false,
                
        // allow files spcification
        filters : {

            // max file size in mb
            max_file_size : '1024mb',

            // allowed files formates
            mime_types: [
                {title : "Image files", extensions : "jpg,jpeg,gif,png"},
                {title : "Video files", extensions : "mp4,avi,mpeg,mpg,mov,wmv"},
                {title : "Zip files", extensions : "zip,7z,rar,tar.gz,tar"},
                {title : "Document files", extensions : "pdf,docx,xlsx,txt,ppt,pptx"}
            ]
        },

        // main upload functions
        init: {
            PostInit: function() {
                document.getElementById('fileList').innerHTML = '';

                document.getElementById('uploadBtn').onclick = function() {

                    // check if file inputed
                    if (uploader.files.length < 1) {
                                
                        // return false upload
                        return false;
                    } else {

                        // start upload inputed file
                        uploader.start();
                        return false;
                    }
                };
            },

            // print inpited file name
            FilesAdded: function(up, files) {
                plupload.each(files, function(file) {
                    document.getElementById('fileList').innerHTML += '<div class="color-yellow" id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></div>';
                });
            },

            // upload process (update progress)
            UploadProgress: function(up, file) {                        
                // update progress
                document.querySelector(".progress").innerHTML = '<span class="progress-bar-fill" style="width: '+file.percent+'%;"">'+file.percent+'%</span>';

                // update progress title
                document.querySelector("#title").innerHTML = file.percent+'% -> ' + file.name;
            },
                        
            // file uploaded final function
            FileUploaded: function(up, file, result) {
                        
                // redirect to download page
                window.location.replace("?process=download&file="+file.name+"&key="+random_int);
            },

            // file upload error print
            Error: function(up, err) {
                document.getElementById('statusResponse').innerHTML = '<p style="color:#EA4335;">Error #' + err.code + ': ' + err.message + '</p>';
            }
        }
    });

    // Initialize Plupload uploader
    uploader.init();
</script>