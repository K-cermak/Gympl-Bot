<?php
    require_once("keys.php");
    require_once("webhook.php");
    require_once(__DIR__ . "/../vendor/autoload.php");
    register_shutdown_function("shutdown_check");

    $lastId = file_get_contents(__DIR__ . "/last.txt");
    $lastId = trim($lastId);

    if ($lastId > 112100) {
        echo "ERORR: No new image";
        exit();
    }

    // add trailing zeros
    $fileName = str_pad($lastId, 6, "0", STR_PAD_LEFT);

    $context = stream_context_create(["ssl" => [
        "verify_peer"      => false,
        "verify_peer_name" => false]
    ]);
    $fileContent = file_get_contents(URL_START . $fileName . URL_END, false, $context);

    $image = imagecreatefromstring($fileContent);
    $scaled_image = imagescale($image, 1920, 1080);
    imagepng($scaled_image, __DIR__ . "/data/" . $fileName);

    $text = "Snímek z Vejšky číslo " . number_format($lastId + 1, 0, "", " ") . " ze 112 101.";
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

    $tweet = (new \Coderjerk\BirdElephant\Compose\Tweet)->text($text)->media($media);
    
    $response = $twitter->tweets()->tweet($tweet);
    if (isset($response->data->id)) {
        echo "Tweeted: " . $text . "\n";
        file_put_contents(__DIR__ . "/last.txt", $lastId + 1);
        sendWebhook(true, $lastId + 1);
    } else {
        echo "ERROR: Tweet failed\n";
        sendWebhook(false, $lastId + 1);
    }

    unlink(__DIR__ . "/data/" . $fileName);
?>