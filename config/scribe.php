<?php

return [
    'theme' => 'default',

    'title' => 'TableSheet API Documentation',

    'description' => 'API documentation for the TableSheet backend - a web system to manage tabletop RPG games and character sheets.',

    'base_url' => null,

    'routes' => [
        [
            'match' => [
                'domains' => ['*'],
                'prefixes' => ['api/*'],
                'versions' => ['v1'],
            ],
            'include' => [
                // Include all API routes
            ],
            'exclude' => [
                // Exclude sensitive routes if needed
            ],
        ],
    ],

    'type' => 'laravel',

    'static' => [
        'output_path' => 'public/docs',
    ],

    'laravel' => [
        'add_routes' => true,
        'docs_url' => '/docs',
    ],

    'try_it_out' => [
        'enabled' => true,
        'base_url' => null,
    ],

    'auth' => [
        'enabled' => false,
        'default' => false,
        'in' => 'bearer',
        'name' => 'Authorization',
        'use_value' => env('SCRIBE_AUTH_KEY'),
        'placeholder' => '{YOUR_AUTH_KEY}',
        'extra_info' => 'You can retrieve your token by making a POST request to <code>/login</code> endpoint.',
    ],

    'intro_text' => <<<INTRO
This documentation aims to provide all the information you need to work with our API.

<aside>Base URL: <code>{base_url}</code></aside>
INTRO
    ,

    'example_languages' => [
        'bash',
        'javascript',
    ],

    'postman' => [
        'enabled' => true,
        'overrides' => [
            'info.name' => 'TableSheet API',
        ],
    ],

    'openapi' => [
        'enabled' => true,
        'overrides' => [
            'info.title' => 'TableSheet API',
            'info.description' => 'API for managing tabletop RPG games and character sheets',
            'info.version' => '1.0.0',
        ],
    ],

    'groups' => [
        'default' => 'Endpoints',
    ],

    'logo' => false,

    'last_updated' => 'Last updated: {date}',

];
