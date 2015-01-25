<?php
namespace Light\widgets;

use yii\web\AssetBundle;

class SweetAlertAsset extends AssetBundle
{
	public $sourcePath = '/assets';
    // public $basePath = '@webroot';
    // public $baseUrl = '@web';
    public $css = [
        'css/sweet-alert.css',
    ];
    public $js = [
        'js/sweet-alert.min.js',
    ];
}
