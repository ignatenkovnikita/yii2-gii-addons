### Yii2 Gii Addons


[![Latest Stable Version](https://poser.pugx.org/ignatenkovnikita/yii2-gii-addons/v/stable)](https://packagist.org/packages/ignatenkovnikita/yii2-gii-addons)
[![Total Downloads](https://poser.pugx.org/ignatenkovnikita/yii2-gii-addons/downloads)](https://packagist.org/packages/ignatenkovnikita/yii2-gii-addons) 
[![Latest Unstable Version](https://poser.pugx.org/ignatenkovnikita/yii2-gii-addons/v/unstable)](https://packagist.org/packages/ignatenkovnikita/yii2-gii-addons) 
[![License](https://poser.pugx.org/ignatenkovnikita/yii2-gii-addons/license)](https://packagist.org/packages/ignatenkovnikita/yii2-gii-addons)


## Install
```bash
composer require ignatenkovnikita/yii2-gii-addons:dev-master
```


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

