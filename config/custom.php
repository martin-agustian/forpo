<?php
$root = $_SERVER['HTTP_HOST'];

if ($root == 'production.com') {
    return [
        'api_url' => '',
        'api_key' => '',
        'mobile_url' => '',
        'web_url' => '',
    ];
}
else {
    return [
        'api_url' => '',
        'api_key' => '',
        'mobile_url' => '',    
        'web_url' => '',        
    ];
}
