<?php
    require_once("keys.php");
    require_once(__DIR__ . "/../vendor/autoload.php");

    //get last id from last.txt
    $lastId = file_get_contents(__DIR__ . "/last.txt");
    $lastId = trim($lastId);

    if ($lastId > 112100) {
        echo "No new image";
        exit();
    }

    // add trailing zeros 
    $fileName = str_pad($lastId, 6, "0", STR_PAD_LEFT);

    //get image from url
    $context = stream_context_create(["ssl" => [
        "verify_peer"      => false,
        "verify_peer_name" => false]
    ]);
    $fileContent = file_get_contents(URL_START . $fileName . URL_MID . $fileName . URL_END, false, $context);

    $image = imagecreatefromstring($fileContent);

    //scale image
    $scaled_image = imagescale($image, 1920, 1080);

    //save image to /data
    imagepng($scaled_image, __DIR__ . "/data/" . $fileName);

    $text = "Snímek z Vejšky číslo " . number_format($lastId + 1, 0, "", " ") . " ze 112 101.";

    //publish tweet
    $credentials = array(
        'consumer_key' => CONSUMER_KEY,
        'consumer_secret' => CONSUMER_SECRET,
        'token_identifier' => ACCESS_TOKEN,
        'token_secret' => ACCESS_TOKEN_SECRET,
    );

    $twitter = new \Coderjerk\BirdElephant\BirdElephant($credentials);
    $image = $twitter->tweets()->upload(__DIR__ . "/data/" . $fileName);

    $media = (new \Coderjerk\BirdElephant\Compose\Media)->mediaIds(
        [
            $image->media_id_string
        ]
    );

    $tweet = (new \Coderjerk\BirdElephant\Compose\Tweet)->text($text)
        ->media($media);
    $twitter->tweets()->tweet($tweet);


    echo "Tweeted: " . $text . "<br>";

    //save with new id
    file_put_contents(__DIR__ . "/last.txt", $lastId + 1);

    //delete images
    unlink(__DIR__ . "/data/" . $fileName);
    

?>