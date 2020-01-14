<?php
return [
    'id' => 'app-frontend-tests',
    'components' => [
        'assetManager' => [
            'basePath' => __DIR__ . '/../web/assets',
        ],
        'urlManager' => [
            'enablePrettyUrl'	 => true,
            'showScriptName'	 => true,
            'rules'				 => [
                [
                    'class' => 'yii\rest\UrlRule',
                    'controller' => 'api/post'
                ]
            ]
        ],
        'request' => [
            'cookieValidationKey' => 'test',
        ],
    ],
];
