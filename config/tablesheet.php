<?php

return [

    /*
    |--------------------------------------------------------------------------
    | TableSheet Application Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains configuration options specific to the TableSheet
    | tabletop RPG character sheet management application.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Character Attributes Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for character attributes and their limits.
    |
    */
    'character' => [
        'attributes' => [
            'min_value' => 1,
            'max_value' => 30,
        ],
        'level' => [
            'min' => 1,
            'max' => 20,
        ],
        'hit_points' => [
            'min' => 0,
            'max' => 9999,
        ],
        'armor_class' => [
            'min' => 1,
            'max' => 30,
        ],
        'speed' => [
            'min' => 0,
            'max' => 999,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | File Upload Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for file uploads including allowed types and sizes.
    |
    */
    'uploads' => [
        'portraits' => [
            'max_size' => 2048, // KB
            'allowed_types' => ['jpg', 'jpeg', 'png', 'gif'],
            'path' => 'uploads/portraits',
        ],
        'cover_images' => [
            'max_size' => 5120, // KB
            'allowed_types' => ['jpg', 'jpeg', 'png'],
            'path' => 'uploads/covers',
        ],
        'documents' => [
            'max_size' => 10240, // KB
            'allowed_types' => ['pdf'],
            'path' => 'uploads/documents',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Pagination Configuration
    |--------------------------------------------------------------------------
    |
    | Default pagination settings for the application.
    |
    */
    'pagination' => [
        'default_per_page' => 15,
        'max_per_page' => 100,
    ],

    /*
    |--------------------------------------------------------------------------
    | Game System Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for supported game systems and their features.
    |
    */
    'game_systems' => [
        'default_version' => '1.0',
        'supported_features' => [
            'races',
            'classes',
            'character_sheets',
            'books',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | User Permissions Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for user roles and permissions.
    |
    */
    'permissions' => [
        'admin' => [
            'manage_games',
            'manage_users',
            'manage_races',
            'manage_classes',
            'manage_books',
            'view_all_sheets',
        ],
        'user' => [
            'create_sheets',
            'edit_own_sheets',
            'view_public_content',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | API Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration for API behavior and responses.
    |
    */
    'api' => [
        'rate_limit' => [
            'requests_per_minute' => 60,
        ],
        'response_format' => [
            'include_timestamps' => true,
            'include_meta' => true,
        ],
    ],

];
