<?php
/**
 * User: Denis Porplenko <denis.porplenko@gmail.com>
 * Date: 16.08.14
 * Time: 10:54
 */

namespace denisogr\smartadmin\widgets;
use yii\helpers\Html;

class Dropdown  extends \yii\bootstrap\Dropdown {
    /**
     * Initializes the widget.
     * If you override this method, make sure you call the parent implementation first.
     */
    public function init()
    {
        parent::init();
        Html::removeCssClass($this->options, 'dropdown-menu');
        //Html::removeCssClass($this->_containerOptions, 'dropdown-menu');
    }

} 