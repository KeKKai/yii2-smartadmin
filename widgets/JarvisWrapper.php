<?php
/**
 * Created by PhpStorm.
 * User: ubuntu-denis
 * Date: 9/1/14
 * Time: 9:49 PM
 */

namespace denisogr\smartadmin\widgets;


use yii\helpers\Html;

/**
 * This widget is wrapper to widget Jarvis.
 * You can wrap it  use:
 *  JarvisWrapper::begin();
 *  Jarvis::begin(
 *   ['wrapperId' => JarvisWrapper::getIdWrapper()]
 *   );
 *  echo 'foobar';
 * Jarvis::end();
 * JarvisWrapper::end();
 *
 * NOTE: You need to set property wrapperId in  Jarvis
 * You can do it use follow code:
 * [
 *      ..........
 *      'wrapperId' => JarvisWrapper::getIdWrapper()
 *      .........
 * ]
 * Class Jarvis
 * @package denisogr\smartadmin\widgets
 */
class JarvisWrapper  extends \yii\bootstrap\Widget{

    private  static $idWrapper;

    public function init()
    {
        echo Html::beginTag('section', ['id' => self::$idWrapper = $this->getId() . "_" . uniqid()]);
        echo Html::beginTag('div');
    }

    public function run()
    {
        echo Html::endTag('div');
        echo Html::endTag('section');
    }

    /**
     * @return mixed
     */
    public static function getIdWrapper()
    {
        return self::$idWrapper;
    }


} 