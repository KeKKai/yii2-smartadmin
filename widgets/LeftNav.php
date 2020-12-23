<?php
/**
 * User: Denis Porplenko <denis.porplenko@gmail.com>
 * Date: 16.08.14
 * Time: 10:02
 */

namespace denisogr\smartadmin\widgets;

use yii\helpers\Html;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii\bootstrap\Nav;
use denisogr\smartadmin\widgets\Dropdown;

class LeftNav  extends Nav {

    /**
     * Renders widget items.
     */
    public function renderItems()
    {
        return Html::tag('nav', parent::renderItems());
    }
    /**
     * Initializes the widget.
     */
    public function init()
    {
        parent::init();
        Html::removeCssClass($this->options, 'nav');
    }
    /**
     * Renders a widget's item.
     * @param string|array $item the item to render.
     * @return string the rendering result.
     * @throws InvalidConfigException
     */
    public function renderItem($item)
    {
        if (is_string($item)) {
            return $item;
        }
        if (!isset($item['label'])) {
            throw new InvalidConfigException("The 'label' option is required.");
        }
        $encodeLabel = isset($item['encode']) ? $item['encode'] : $this->encodeLabels;
        $icon = ArrayHelper::getValue($item, 'icon', 'fa-envelope-o');

        $label = $encodeLabel ? Html::encode($item['label']) : $item['label'];

        $label = Html::tag('span', $label, ['class' => 'menu-item-parent']);
        $icon = Html::tag('i', '', ['class' => 'fa fa-lg fa-fw ' . $icon]) . ' ';
        $label = $icon . $label;

        $options = ArrayHelper::getValue($item, 'options', []);
        $items = ArrayHelper::getValue($item, 'items');
        $url = ArrayHelper::getValue($item, 'url', '#');
        $linkOptions = ArrayHelper::getValue($item, 'linkOptions', []);

        if (isset($item['active'])) {
            $active = ArrayHelper::remove($item, 'active', false);
        } else {
            $active = $this->isItemActive($item);
        }

        if ($items !== null) {
           // $linkOptions['data-toggle'] = 'dropdown';
            Html::addCssClass($options, 'dropdown');
            Html::addCssClass($linkOptions, 'dropdown-toggle');
            $label .= ' ' . Html::tag('b', Html::tag('em', '', ['class' => 'fa fa-plus-square-o']), ['class' => 'collapse-sign']);
            if (is_array($items)) {
                if ($this->activateItems) {
                    $items = $this->isChildActive($items, $active);
                }
                $items = Dropdown::widget([
                    'items' => $items,
                    'encodeLabels' => $this->encodeLabels,
                    'clientOptions' => false,
                    'view' => $this->getView(),
                ]);
            }
        }

        if ($this->activateItems && $active) {
            Html::addCssClass($options, 'active');
        }

        return Html::tag('li', Html::a($label, $url, $linkOptions) . $items, $options);
    }
} 