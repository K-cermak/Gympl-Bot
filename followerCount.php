<?php
    if ($argc != 2) {
        echo "[ERROR] Usage: php followerCount.php <platform>\n";
        exit(1);
    }

    if ($argv[1] != "twitter") {
        echo "[ERROR] Invalid platform. Use twitter.\n";
        exit(1);
    }

    if ($argv[1] == "twitter") {
        require_once __DIR__ . "/twitter/followers.php";
        $count = getTwitterFollowers();
        echo $count . "\n";
    }

?>