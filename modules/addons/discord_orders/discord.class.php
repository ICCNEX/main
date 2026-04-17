<?php

class Discord {
    private $webhookUrl;

    public function __construct($url) {
        $this->webhookUrl = $url;
    }

    public function sendMessage($message) {
        $data = [
            'content' => $message
        ];

        $this->postData($data);
    }

    public function sendEmbed($title, $description, $color) {
        $data = [
            'embeds' => [[
                'title' => $title,
                'description' => $description,
                'color' => $color
            ]]
        ];

        $this->postData($data);
    }

    private function postData($data) {
        $options = [
            'http' => [
                'header'  => "Content-Type: application/json\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ]
        ];

        $context  = stream_context_create($options);
        file_get_contents($this->webhookUrl, false, $context);
    }
}

?>