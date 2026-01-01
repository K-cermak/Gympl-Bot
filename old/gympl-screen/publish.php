<?php
    require_once(__DIR__ . "/keys.php");
    require_once(__DIR__ . "/../vendor/autoload.php");
    $directory = "data";

    //get last id from last.txt
    $last_id = file_get_contents("last.txt");

    //save with new id
    file_put_contents("last.txt", $last_id + 1);

    $fileName = "Gympl_" . ($last_id + 1000000) . ".png";

    //get image from folder
    $image = imagecreatefrompng($directory . "/" . $fileName);

    //scale image
    $scaled_image = imagescale($image, 1200, 630);

    //save image to /new
    imagepng($scaled_image, $directory . "/new/" . $fileName);

    $text = "Snímek z Gymplu číslo " . ($last_id + 1) . " z 164 176.";

    //publish tweet
    $credentials = array(
        'consumer_key' => CONSUMER_KEY,
        'consumer_secret' => CONSUMER_SECRET,
        'token_identifier' => ACCESS_TOKEN,
        'token_secret' => ACCESS_TOKEN_SECRET,
    );

    $twitter = new \Coderjerk\BirdElephant\BirdElephant($credentials);
    $image = $twitter->tweets()->upload($directory . "/new/" . $fileName);

    $media = (new \Coderjerk\BirdElephant\Compose\Media)->mediaIds(
        [
            $image->media_id_string
        ]
    );

    $tweet = (new \Coderjerk\BirdElephant\Compose\Tweet)->text($text)
        ->media($media);
    $twitter->tweets()->tweet($tweet);


    echo "Tweeted: " . $text . "<br>";

    //delete both images
    unlink($directory . "/" . $fileName);
    unlink($directory . "/new/" . $fileName);

?>