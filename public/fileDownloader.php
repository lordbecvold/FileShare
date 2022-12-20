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
        
        <main>
            <?php echo $_GET["file"] . " - " . $_GET["date"]; ?>
        </main>

        <footer>
            <h1>Made with ❤️ by <a class="lukas-link" href="http://becvold.xyz/">Lukáš Bečvář</a></h1>
        </footer>
    </body>
</html>