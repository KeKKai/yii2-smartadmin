<?php
/**
 * Created by PhpStorm.
 * User: ubuntu-denis
 * Date: 9/1/14
 * Time: 9:49 PM
 */

namespace denisogr\smartadmin\widgets;


use yii\base\InvalidConfigException;
use yii\helpers\Html;

/**
 * Jarvis widget.
 * Example:
 * Jarvis::begin(
 *   ['wrapperId' => JarvisWrapper::getIdWrapper()]
 *   );
 *   echo 'foobar';
 *   Jarvis::end();
 *
 * NOTE You maust wrap Jarsiv widget in JarviwWrapper
 * Example:
 * JarvisWrapper::begin();
 * Jarvis::begin(
 *   ['wrapperId' => JarvisWrapper::getIdWrapper()]
 *   );
 *  echo 'foobar';
 * Jarvis::end();
 * JarvisWrapper::end();
 *
 * Class Jarvis
 * @package denisogr\smartadmin\widgets
 * @see http://bootstraphunter.com/themes/preview/jarvisadmin/2.0/widgets.html
 */
class Jarvis  extends \yii\bootstrap\Widget{

    public $wrapperId;

    public $articleOption = [];

    /**
     * <!-- widget options:
    usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

    data-widget-colorbutton="false"
    data-widget-editbutton="false"
    data-widget-togglebutton="false"
    data-widget-deletebutton="false"
    data-widget-fullscreenbutton="false"
    data-widget-custombutton="false"
    data-widget-collapsed="true"
    data-widget-sortable="false"
     * @var array
     *
     */
    public $jarvisOptions = [];

    private $_jarvisOptions = [
        'class'                  => '',
        'data-widget-editbutton' => 'false',
    ];

    public $label = 'Content';

    public $iconOption = [
        'class' => ' fa fa-table'];


    public function initOptions()
    {
        if (empty($this->articleOption)) {
            Html::addCssClass($this->articleOption, 'col-xs-12');
            Html::addCssClass($this->articleOption, 'col-sm-12');
            Html::addCssClass($this->articleOption, 'col-md-12');
            Html::addCssClass($this->articleOption, 'col-lg-12');
        }

        if(empty($this->jarvisOptions)) {
            Html::addCssClass($this->jarvisOptions, 'jarviswidget-color-blueDark');
        }
        Html::addCssClass($this->jarvisOptions, 'jarviswidget');

        if (empty($this->jarvisOptions['id'])) {
            $this->jarvisOptions['id'] = "{$this->getId()}_" . uniqid();
        }
    }
    /**
     *
     */
    public function init()
    {
        if (empty($this->wrapperId)) {
            throw new InvalidConfigException('Wrap your Jarvis in JarvisWrapper and set Jarvis::wrapperId=JarvisWrapper::getIdWrapper()');
        }
        $this->initOptions();
        $this->registerJs();
        echo Html::beginTag('article', $this->articleOption);
        echo Html::beginTag('div', $this->jarvisOptions);
        echo Html::beginTag('header');
        echo Html::beginTag('span', ['class' => 'widget-icon']);
        echo Html::beginTag('i', $this->iconOption);
        echo Html::endTag('i');
        echo Html::endTag('span');
        echo Html::tag('h2', $this->label);

        echo Html::endTag('header');

        echo Html::beginTag('div');
        echo Html::tag('div', '', ['class' => 'jarviswidget-editbox']);
        echo Html::beginTag('div', ['class' => 'widget-body']);


    }

    public function run()
    {
        echo Html::endTag('div');
        echo Html::endTag('div');
        echo Html::endTag('div');
        echo Html::endTag('article');
    }

    public function registerJs()
    {
        $view = $this->getView();

        $js = '$.fn.jarvisWidgets && enableJarvisWidgets && $("#' . $this->wrapperId . '").
                jarvisWidgets({grid: "article", widgets: ".jarviswidget", localStorage: !0,
                    deleteSettingsKey: "#deletesettingskey-options",
                    settingsKeyLabel: "Reset settings?",
                    deletePositionKey: "#deletepositionkey-options",
                    positionKeyLabel: "Reset position?", sortable: !0, buttonsHidden: !1, toggleButton: !0, toggleClass: "fa fa-minus | fa fa-plus", toggleSpeed: 200,
                    onToggle: function () {
            }, deleteButton: !0, deleteClass: "fa fa-times", deleteSpeed: 200, onDelete: function () {
            }, editButton: !0, editPlaceholder: ".jarviswidget-editbox", editClass: "fa fa-cog | fa fa-save", editSpeed: 200, onEdit: function () {
            }, colorButton: !0, fullscreenButton: !0, fullscreenClass: "fa fa-expand | fa fa-compress", fullscreenDiff: 3, onFullscreen: function () {
            }, customButton: !1, customClass: "folder-10 | next-10", customStart: function () {
                alert("Hello you, this is a custom button...")
            }, customEnd: function () {
                alert("bye, till next time...")
            }, buttonOrder: "%refresh% %custom% %edit% %toggle% %fullscreen% %delete%", opacity: 1, dragHandle: "> header", placeholderClass: "jarviswidget-placeholder", indicator: !0, indicatorTime: 600, ajax: !0, timestampPlaceholder: ".jarviswidget-timestamp", timestampFormat: "Last update: %m%/%d%/%y% %h%:%i%:%s%", refreshButton: !0, refreshButtonClass: "fa fa-refresh", labelError: "Sorry but there was a error:", labelUpdated: "Last Update:", labelRefresh: "Refresh", labelDelete: "Delete widget:", afterLoad: function () {
            }, rtl: !1, onChange: function () {
            }, onSave: function () {
            }, ajaxnav: $.navAsAjax})';
        //JARVIS WIDGETS
        \Yii::$app->assetManager->publish(dirname(dirname(__FILE__)) . '/assets/js/smartwidgets/jarvis.widget.min.js');
        $jsFile = \Yii::$app->assetManager->getPublishedUrl(dirname(dirname(__FILE__)) . '/assets/js/smartwidgets/jarvis.widget.min.js');
        $view->registerJsFile($jsFile, ['depends' => 'yii\web\JqueryAsset']);
        $view->registerJs($js);
    }

} 