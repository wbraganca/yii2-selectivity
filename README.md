# yii2-selectivity

[![Latest Version](https://img.shields.io/github/release/wbraganca/yii2-selectivity.svg?style=flat-square)](https://github.com/wbraganca/yii2-selectivity/releases)
[![Software License](http://img.shields.io/badge/license-BSD3-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Total Downloads](https://img.shields.io/packagist/dt/wbraganca/yii2-selectivity.svg?style=flat-square)](https://packagist.org/packages/wbraganca/yii2-selectivity)


## Install

Via Composer

```bash
$ composer require wbraganca/yii2-selectivity
```

or add

```
"wbraganca/yii2-selectivity": "~2.0.0-beta.1"
```

to the require section of your `composer.json` file.


## Usage

On your view file.

```php

<?php
use wbraganca\selectivity\SelectivityWidget;
?>

<?= $form->field($model, 'city')->widget(SelectivityWidget::classname(), [
    'options' => [
        'prompt' => ''
    ],
    'pluginOptions' => [
        'allowClear' => true,
        'data' => ['Rio de Janeiro', 'São Paulo'],
        'placeholder' => 'No city selected'
    ]
]) ?>

```


Displaying the data with appeneded addon
```php
<?= $form->field($model, 'city')->widget(SelectivityWidget::classname(), [
    'options' => [
        'prompt' => ''
    ],
    'pluginOptions' => [
        'allowClear' => true,
        'data' => ['Rio de Janeiro', 'São Paulo'],
    ],
    'template' => '<div class="input-group">' .
        '{input}' .
        '<div class="input-group-append">' .
        '<span class="input-group-btn">' .
        '<button class="btn btn-success" type="button">' .
        '<i class="fa fa-plus"></i>' .
        '</button>' .
        '</div>' .
        '</span>' .
        '</div>'
]) ?>
```

For more options, visit: https://arendjr.github.io/selectivity/#api
