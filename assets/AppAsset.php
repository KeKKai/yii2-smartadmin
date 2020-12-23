<?php
/**
 * User: Denis Porplenko <denis.porplenko@gmail.com>
 * Date: 15.08.14
 * Time: 16:26
 */

namespace denisogr\smartadmin\assets;
use yii\web\AssetBundle;

class AppAsset extends AssetBundle {

    public $sourcePath;

    public $css = [
        //Basic Styles
      //  'css/bootstrap.min.css',
        'css/font-awesome.min.css',
        //SmartAdmin Styles
        'css/smartadmin-skins.min.css',
        'css/smartadmin-production.min.css',
        //Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp
        'css/demo.min.css'
    ];
    public $js = [
        //Link to Google CDN's jQuery + jQueryUI; fall back to local
        //'//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js',
        //'//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js',
        // IMPORTANT: APP CONFIG
        'js/app.config.js',
        //JS TOUCH : include this plugin for mobile drag / drop touch events
        'js/plugin/jquery-touch/jquery.ui.touch-punch.min.js',
        //BOOTSTRAP JS
        'js/bootstrap/bootstrap.min.js',
        //CUSTOM NOTIFICATION
        'js/notification/SmartNotification.min.js',
        //JARVIS WIDGETS
        //'js/smartwidgets/jarvis.widget.min.js',
        //EASY PIE CHARTS
        'js/plugin/easy-pie-chart/jquery.easy-pie-chart.min.js',
        //SPARKLINES
        'js/plugin/sparkline/jquery.sparkline.min.js',
        //JQUERY VALIDATE
        'js/plugin/jquery-validate/jquery.validate.min.js',
        //JQUERY MASKED INPUT
        'js/plugin/masked-input/jquery.maskedinput.min.js',
        //JQUERY SELECT2 INPUT
        'js/plugin/select2/select2.min.js',
        //JQUERY UI + Bootstrap Slide
        'js/plugin/bootstrap-slider/bootstrap-slider.min.js',
        //browser msie issue fix
        'js/plugin/msie-fix/jquery.mb.browser.min.js',
        //FastClick: For mobile devices: you can disable this in app.js
        'js/plugin/fastclick/fastclick.min.js',
        //Demo purpose only
        'js/demo.min.js',
        // MAIN APP JS FILE
        'js/app.min.js',
        //ENHANCEMENT PLUGINS : NOT A REQUIREMENT
        //Voice command : plugin
        'js/speech/voicecommand.min.js',

    ];

    public $depends = [
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\jui\JuiAsset'
    ];
    public function init()
    {
        parent::init();
        $this->sourcePath = dirname(__FILE__);
    }

    public static function imgSrc($relativePath, $assetImageDir = 'img' ){
        $obj = new self();
        return \Yii::$app->assetManager->getPublishedUrl($obj->sourcePath)
        . "/" . $assetImageDir . "/" . $relativePath;
    }

} 