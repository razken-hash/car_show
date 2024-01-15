<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CarShow</title>
    
    <link rel='stylesheet' href='/car_show/admin.css?v=<?php echo time(); ?>' />
    <!-- <link rel='stylesheet' href='/car_show/styles.css?v=<?php echo time(); ?>' /> -->
    <link rel="stylesheet" href="/car_show/flex-styles.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php require_once("./routers/routers.php") ?>
</body>

</html>

<!-- 

<?php
        if (strpos($_SERVER['REQUEST_URI'], '/admin') != false) {
            echo "<link rel='stylesheet' href='/car_show/admin.css?v=<?php echo time(); ?>'";
        } else {
            echo "<link rel='stylesheet' href='./styles.css?v=<?php echo time(); ?>'>";
        }
        ?>
 -->