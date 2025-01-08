<?php
// cloudinary_config.php

require 'vendor/autoload.php';  // Loads Composer dependencies

use Cloudinary\Cloudinary;
use Cloudinary\Configuration\Configuration;

// Configure Cloudinary with your credentials
Configuration::instance([
    'cloud' => [
        'cloud_name' => 'dsyt4e4fp',  // Replace with your Cloudinary Cloud name
        'api_key'    => '399586786843443',     // Replace with your Cloudinary API key
        'api_secret' => 'HH4mh7xMDej9XRNY06BPrgAEn6M',  // Replace with your Cloudinary API secret
    ],
    'url' => [
        'secure' => true
    ]
]);
