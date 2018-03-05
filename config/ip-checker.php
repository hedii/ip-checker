<?php

return [
    /**
     * The ip addresses to check.
     */
    'ips' => [
        '0.0.0.0',
    ],

    /**
     * The urls used to test the ip address.
     */
    'test_urls' => [
        'https:/example.com',
    ],

    /**
     * A unique identifier for the current server.
     */
    'server_name' => 'test1',

    /**
     * The notification settings.
     */
    'notifications' => [
        'mail' => [
            'from' => 'from@example.com',
            'to' => 'to@example.com'
        ]
    ]
];
