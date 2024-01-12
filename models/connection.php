<?php
// require_once '../config.php';

define('DB_HOST', 'localhost');
define('DB_USER','root');
define('DB_PASS','');
define('DB_NAME','car_show_db');
define('DB_PORT',3306);
define('DB_DSN',"mysql:host=".DB_HOST.";dbname=".DB_NAME.";port=".DB_PORT.";charset=utf8");
define('DB_OPTIONS',[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ]);

class Connection
{
   protected function connect()
    {
        try {
            $connection = new PDO(DB_DSN,DB_USER,DB_PASS,DB_OPTIONS);
            return $connection;
        } catch (PDOException $e) {
            exit;
        }
    }

    protected function request($connection, $query)
    {
        return $connection->query($query);

    }

    protected function disconnect($connection)
    {
        $connection = null;
    }

    // protected function uploadImage($file, $targetDirectory = "")
    // {
    //     $uniqueFilename = uniqid() . '_' . time();

    //     $fileExtension = pathinfo($file["name"], PATHINFO_EXTENSION);

    //     $targetDirectoryPath = __DIR__ . "/../uploads" . $targetDirectory;
    //     if (!file_exists($targetDirectoryPath)) {
    //         mkdir($targetDirectoryPath, 0777, true);
    //     }

    //     $targetFile = $targetDirectoryPath . "/" . $uniqueFilename . "." . $fileExtension;

    //     $imageInfo = getimagesize($file["tmp_name"]);
    //     if ($imageInfo === false) {
    //         throw new ErrorException('Invalid image file.');
    //     }

    //     $allowedImageTypes = array(IMAGETYPE_JPEG, IMAGETYPE_PNG, IMAGETYPE_GIF);
    //     if (!in_array($imageInfo[2], $allowedImageTypes)) {
    //         throw new ErrorException('Unsupported image type. Only JPEG, PNG, and GIF are allowed.');
    //     }

    //     if (move_uploaded_file($file["tmp_name"], $targetFile)) {
    //         return "/uploads" . $targetDirectory . "/" . $uniqueFilename . "." . $fileExtension;
    //     } else {
    //         throw new ErrorException('Error uploading file.');
    //     }
    // }

}
?>