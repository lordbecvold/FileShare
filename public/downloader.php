<?php // file download component

// require page config
require_once("../config.php");

// check if file key seted
if (empty($_GET["key"])) {
    die('{"jsonrpc" : "2.0", "error" : {"code": 104, "message": "Filed to get upload key"}, "id" : "id"}'); 
} else {
    
    // get file key
    $key = $_GET["key"];
}

// check if file name seted
if (empty($_GET["file"])) {
    die('{"jsonrpc" : "2.0", "error" : {"code": 106, "message": "Filed to get download file name"}, "id" : "id"}'); 
} else {

    // get file name
    $name = $_GET["file"];
}

// Build file path
$file = $config["storage-path"]."$key/$name";

// check if file exist
if (file_exists($file)) {

    // set downloader headers
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($file) . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    
    // read file
    readfile($file);
} 

// redirect to file not found
else {
    header('Location: /?process=notFound&file='.$name);
}