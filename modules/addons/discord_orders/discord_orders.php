<?php
// Discord Orders WHMCS Addon Module

function discord_order_notification($order) {
    $webhook_url = 'YOUR_DISCORD_WEBHOOK_URL'; // Replace with your Discord webhook URL

    // Prepare the message to send
    $message = array(
        'content' => "New order received!\nOrder ID: {$order['id']}\nClient: {$order['client_id']}\nTotal: {$order['total']}"
    );

    // Send the message to Discord
    $options = array(
        'http' => array(
            'header' => "Content-Type: application/json\r\n",
            'method' => 'POST',
            'content' => json_encode($message),
        ),
    );

    $context = stream_context_create($options);
    $result = file_get_contents($webhook_url, false, $context);

    if ($result === FALSE) {
        // Handle any errors here
    }
}

// Hook into the order creation process
add_hook('OrderCreated', 1, 'discord_order_notification');
?>
