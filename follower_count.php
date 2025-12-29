<?php
    if ($argc != 2) {
        echo "Usage: php follower_count.php <platform>\n";
        exit(1);
    }

    if ($argv[1] != "twitter") {
        echo "Invalid platform. Use twitter.\n";
        exit(1);
    }

    if ($argv[1] == "twitter") {
        require_once __DIR__ . "/followers.php";
        $count = getTwitterFollowers();
        echo $count . "\n";
    }

?>