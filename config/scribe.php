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
            ],
            'include' => [
                'api/*',
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
        'enabled' => true,
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
    INTRO,

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
        'Authentication' => 'User authentication and account management',
        'Games' => 'Tabletop RPG games management',
        'Character Sheets' => 'Character sheets management',
        'Races' => 'Game races management',
        'Classes' => 'Game classes management',
        'Books' => 'Game books and documents management',
        'Profile' => 'User profile management',
        'File Upload' => 'File upload operations',
        'Admin' => 'Administrative operations',
        'Health' => 'System health checks',
    ],

    'logo' => false,

    'last_updated' => 'Last updated: {date}',

    'strategies' => [
        'metadata' => [
            \Knuckles\Scribe\Extracting\Strategies\Metadata\GetFromDocBlocks::class,
            \Knuckles\Scribe\Extracting\Strategies\Metadata\GetFromMetadataAttributes::class,
        ],
        'urlParameters' => [
            \Knuckles\Scribe\Extracting\Strategies\UrlParameters\GetFromLaravelAPI::class,
            \Knuckles\Scribe\Extracting\Strategies\UrlParameters\GetFromUrlParamAttribute::class,
            \Knuckles\Scribe\Extracting\Strategies\UrlParameters\GetFromUrlParamTag::class,
        ],
        'queryParameters' => [
            \Knuckles\Scribe\Extracting\Strategies\QueryParameters\GetFromFormRequest::class,
            \Knuckles\Scribe\Extracting\Strategies\QueryParameters\GetFromInlineValidator::class,
            \Knuckles\Scribe\Extracting\Strategies\QueryParameters\GetFromQueryParamAttribute::class,
            \Knuckles\Scribe\Extracting\Strategies\QueryParameters\GetFromQueryParamTag::class,
        ],
        'headers' => [
            \Knuckles\Scribe\Extracting\Strategies\Headers\GetFromHeaderAttribute::class,
            \Knuckles\Scribe\Extracting\Strategies\Headers\GetFromHeaderTag::class,
            [
                \Knuckles\Scribe\Extracting\Strategies\StaticData::class,
                [
                    'only' => [],
                    'except' => [],
                    'data' => [
                        'Content-Type' => 'application/json',
                        'Accept' => 'application/json',
                    ],
                ],
            ],
        ],
        'bodyParameters' => [
            \Knuckles\Scribe\Extracting\Strategies\BodyParameters\GetFromFormRequest::class,
            \Knuckles\Scribe\Extracting\Strategies\BodyParameters\GetFromInlineValidator::class,
            \Knuckles\Scribe\Extracting\Strategies\BodyParameters\GetFromBodyParamAttribute::class,
            \Knuckles\Scribe\Extracting\Strategies\BodyParameters\GetFromBodyParamTag::class,
        ],
        'responses' => [
            \Knuckles\Scribe\Extracting\Strategies\Responses\UseResponseAttributes::class,
            \Knuckles\Scribe\Extracting\Strategies\Responses\UseTransformerTags::class,
            \Knuckles\Scribe\Extracting\Strategies\Responses\UseApiResourceTags::class,
            \Knuckles\Scribe\Extracting\Strategies\Responses\UseResponseTag::class,
            \Knuckles\Scribe\Extracting\Strategies\Responses\UseResponseFileTag::class,
            [
                \Knuckles\Scribe\Extracting\Strategies\Responses\ResponseCalls::class,
                [
                    'only' => ['GET *'],
                    'except' => [
                        'api/users',           // ← EXCLUIR ROTAS ADMIN
                        'api/users/*',
                        '*/suspend',
                    ],
                    'config' => [
                        'app.debug' => false,
                    ],
                    'queryParams' => [],
                    'bodyParams' => [],
                    'fileParams' => [],
                    'cookies' => [],
                ],
            ],
        ],
        'responseFields' => [
            \Knuckles\Scribe\Extracting\Strategies\ResponseFields\GetFromResponseFieldAttribute::class,
            \Knuckles\Scribe\Extracting\Strategies\ResponseFields\GetFromResponseFieldTag::class,
        ],
    ],
];
