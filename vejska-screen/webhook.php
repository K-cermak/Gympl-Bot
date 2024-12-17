<?php
    function sendWebhook($status , $day) {
        $embed = [
            'fields' => [
                [
                    'name' => 'Frame:',
                    'value' => $day,
                    'inline' => true
                ],
            ],
            'timestamp' => date('c')
        ];

        if ($status === true) {
            $embed['title'] = '✅ Succesfully posted! ✅';
            $embed['color'] = 0x00FF00;
        } else {
            $embed['title'] = '❌ Error while posting! ❌';
            $embed['color'] = 0xFF0000;
        }

        $data = [
            'embeds' => [$embed]
        ];

        $jsonData = json_encode($data);
        $ch = curl_init(DISCORD_WEBHOOK);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        curl_close($ch);

        if ($httpCode === 204) {
            echo "Webhook sent successfully\n";
        } else {
            echo "ERROR sending webhook: $httpCode\n";
            echo "ERROR Response: $response\n";
        }
    }
?>