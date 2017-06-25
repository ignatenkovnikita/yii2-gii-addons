### Yii2 Gii Addons


Configuration, paste code in config
```php
'gii' => [
            'class' => \yii\gii\Module::class,
            'allowedIPs' => ['*'],
            'generators' => [
                'model' => [
                    'class' => \yii\gii\generators\model\Generator::class,
                    'templates' => [
                        'myModel' => '@vendor/ignatenkovnikita/yii2-gii-addons/model/default',
                    ]
                ]
            ],
        ],
```

