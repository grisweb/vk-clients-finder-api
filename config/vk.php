<?php

return [
    'api_url' => 'https://api.vk.com/method',
    'oauth_url' => 'https://oauth.vk.com',
    'client_id' => env('VK_CLIENT_ID'),
    'client_secret' => env('VK_CLIENT_SECRET'),
    'redirect_uri' => env('VK_REDIRECT_URI'),
    'users' => [
        'fields' => [
            'is_closed',
            'photo_50',
            'last_seen',
            // 'online',
            // 'about',
            // 'activities',
            // 'books',
            // 'education',
            // // 'university_name',
            // // 'faculty_name',
            // 'games',
            // 'interests',
            // 'movies',
            // 'music',
            // 'nickname',
            // 'personal',
            // 'quotes',
            // 'screen_name',
            // 'site',
            // 'status',
            // 'tv',
        ]
    ]
];
