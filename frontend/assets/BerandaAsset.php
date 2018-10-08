<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class BerandaAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
      "css/bootstrap.min.css",
      "css/master.css",
      "https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css",
      "css/berandacontent.css",
    ];
    public $js = [
      "js/jquery-3.3.1.js",
      "js/bootstrap.min.js",
      "js/popper.min.js",
    ];
}
