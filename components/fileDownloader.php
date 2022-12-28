<?php // file downloader view 

    function formatBytes($bytes) {
        if ($bytes > 0) {
            $i = floor(log($bytes) / log(1024));
            $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
            return sprintf('%.02F', round($bytes / pow(1024, $i),1)) * 1 . ' ' . @$sizes[$i];
        } else {
            return 0;
        }
    }

    // check if component included
    if (basename(__FILE__) == basename($_SERVER["SCRIPT_FILENAME"])) {
        die(header('Location: /?process=upload'));
    } else {

        // check if gets found
        if (empty($_GET["file"]) or empty($_GET["key"])) {
            die(header('Location: /?process=upload'));
        } else {
                            
            // build file path
            $file = $config["storage-path"].$_GET["key"]."/".$_GET["file"];

            // get file size
            if (file_exists($file)) {

                // get file size
                $size = filesize($file);

            } else {

                // redirect to not found file
                header('Location: /?process=notFound&file='.$_GET["file"]);
            }


            // file security check
            if (str_contains($_GET["file"], '/') or str_contains($_GET["key"], '/')) {
                die('{"jsonrpc" : "2.0", "error" : {"code": 107, "message": "Filed to get download file, but good try :)"}, "id" : "id"}'); 
            } else {
                // print download box
                echo '<div class="downloader-box">';
                    echo '<p class="downloader-name">'.$_GET["file"].' (<span class="file-size">'.formatBytes($size).'</span>)</p>';
                    echo '<a class="downloader-button" href="downloader.php?key='.$_GET["key"].'&file='.$_GET["file"].'">Download</a>';
                echo '</div>';
            }
        }
    } 
?>