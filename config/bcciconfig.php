<?php
$environment = strtoupper(env('APP_ENV'));

$config = [];

if ($environment == 'PRODUCTION') {
    $config['CURD_API_URL'] = 'http://52.66.77.143/api/';
    $config['ASSET_URL'] = env('APP_URL');
} else if ($environment == 'DEV') {
    $config['CURD_API_URL'] = 'http://52.66.77.143/api/';
    $config['ASSET_URL'] = env('APP_URL');
} else if ($environment == 'LOCAL') {
    $config['CURD_API_URL'] = 'http://52.66.77.143/api/';
    $config['ASSET_URL'] = env('APP_URL');
}

$config['SPECIALITY'] = ['Batsman', 'Bowler', 'Wicket Keeper', 'All-Rounder'];
$config['LANGUAGES'] = ['English', 'Hindi', 'Marathi'];
$config['CONTENT_STATUS'] = ['Published', 'In Draft', 'In Review', 'Unpublished','Rejected'];
$config['CONTENT_SORTBY'] = ['Last updated', 'Status', 'Publication date'];
$config['CONTENT_MAX_ITEM'] = [24,36,48,60];
$config['CONTENT_FROM'] = ['All time', 'The last year', 'Last 2 years', 'Last 3 years'];

return $config;
