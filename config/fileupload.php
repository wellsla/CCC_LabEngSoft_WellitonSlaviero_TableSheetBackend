<?php

return [
    /*
    |--------------------------------------------------------------------------
    | File Upload Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains the configuration for file uploads including
    | allowed file types, size limits, and storage paths.
    |
    */

    'avatars' => [
        'max_size' => 2048, // 2MB in KB
        'allowed_mimes' => ['jpeg', 'png', 'jpg'],
        'allowed_extensions' => ['jpeg', 'jpg', 'png'],
        'storage_path' => 'avatars',
        'disk' => 'public',
    ],

    'portraits' => [
        'max_size' => 2048, // 2MB in KB
        'allowed_mimes' => ['jpeg', 'png', 'jpg'],
        'allowed_extensions' => ['jpeg', 'jpg', 'png'],
        'storage_path' => 'portraits',
        'disk' => 'public',
    ],

    'cover_images' => [
        'max_size' => 5120, // 5MB in KB
        'allowed_mimes' => ['jpeg', 'png', 'jpg', 'gif'],
        'allowed_extensions' => ['jpeg', 'jpg', 'png', 'gif'],
        'storage_path' => 'covers',
        'disk' => 'public',
    ],

    'documents' => [
        'max_size' => 10240, // 10MB in KB
        'allowed_mimes' => ['pdf'],
        'allowed_extensions' => ['pdf'],
        'storage_path' => 'documents',
        'disk' => 'public',
    ],

    /*
    |--------------------------------------------------------------------------
    | File Type Signatures
    |--------------------------------------------------------------------------
    |
    | These are the actual file signatures (magic numbers) used to validate
    | real file content, not just the MIME type which can be spoofed.
    |
    */
    'file_signatures' => [
        'jpeg' => [
            'FFD8FFE0', 'FFD8FFE1', 'FFD8FFE2', 'FFD8FFE3', 'FFD8FFE8', 'FFD8FFDB'
        ],
        'jpg' => [
            'FFD8FFE0', 'FFD8FFE1', 'FFD8FFE2', 'FFD8FFE3', 'FFD8FFE8', 'FFD8FFDB'
        ],
        'png' => [
            '89504E47'
        ],
        'gif' => [
            '47494638'
        ],
        'pdf' => [
            '25504446'
        ],
    ],
];
