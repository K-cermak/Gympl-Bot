<?php
    require_once(__DIR__ . "/../keys.php");
    require_once(__DIR__ . "/../vendor/autoload.php");

    function getTwitterFollowers() {
        $credentials = [
            'consumer_key' => CONSUMER_KEY,
            'consumer_secret' => CONSUMER_SECRET,
            'token_identifier' => ACCESS_TOKEN,
            'token_secret' => ACCESS_TOKEN_SECRET,
            'bearer_token' => BEARER_TOKEN,
        ];

        try {
            $twitter = new \Coderjerk\BirdElephant\BirdElephant($credentials);

            $user = $twitter->users()->lookup(['GymplFilm'], [
                'user.fields' => 'public_metrics'
            ]);

            $count = $user->data[0]->public_metrics->followers_count;
            return $count;

        } catch (\Exception $e) {
            return "error";
        }
    }
?>
