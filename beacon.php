<?php
    function sendWebhook($status, $day) {
        $data = [
            'key' => BEACON_API_KEY,
            'type' => $status ? 'success' : 'error',
            'title' => $status ? 'Succesfully posted' : 'Error while posting ❌',
            'message' => "Frame: $day",
            'ping' => $status ? false : true
        ];

        $ch = curl_init(BEACON_URL);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        if ($httpCode >= 200 && $httpCode < 300) {
            echo "[INFO] Webhook for $day sent successfully.\n";
        } else {
            echo "[ERROR] Failed to send webhook for $day. HTTP Code: $httpCode\n";
            echo "[ERROR] Response: $response\n";
        }
    }
?>
