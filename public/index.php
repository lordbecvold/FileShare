<?php // main site directory
    require_once("../config.php");

    $appName = $config["app-name"];

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
            <h2><a class="header-link" href="/"><?php echo $appName; ?></a></h2>
        </header>
        <main>
        <?php

            // get process name
            if (!empty($_GET["process"])) {
                $process = $_GET["process"];
            } else {

                // redirect to default process if get empty
                header('Location: /?process=upload');
            }

            // use upload function
            if ($process == "upload") {
                include_once("fileUploader.php");

            // use download function
            } elseif ($process == "download") {
                include_once("fileDownloader.php");

            // use not found page
            } elseif ($process == "notFound") {
                include_once("fileNotFound.php");

            // redirect to default process if process not found
            } else {
                header('Location: /?process=upload');
            }
        ?> 
        </main>
        <footer>
            <h1>Made with ❤️ by <a class="lukas-link" href="http://becvold.xyz/">Lukáš Bečvář</a></h1>
        </footer>
    </body>
</html>
