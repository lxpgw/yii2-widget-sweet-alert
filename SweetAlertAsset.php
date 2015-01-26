<?php
namespace light\widgets;

use yii\web\AssetBundle;

class SweetAlertAsset extends AssetBundle
{
	public $sourcePath = '@vendor/light/yii2-widget-sweet-alert/assets';
    // public $basePath = '@webroot';
    // public $baseUrl = '@web';
    public $css = [
        'css/sweet-alert.css',
    ];
    public $js = [
        'js/sweet-alert.min.js',
    ];
}
