<?php
/**
 * @link      https://github.com/wbraganca/yii2-selectivity
 * @copyright Copyright (c) 2015 Wanderson Bragança
 * @license   https://github.com/wbraganca/yii2-selectivity/blob/master/LICENSE
 */
namespace wbraganca\selectivity;

use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\View;
use yii\helpers\ArrayHelper;

/**
 * The yii2-selectivity is a Yii 2 wrapper for Selectivity.js.
 * See more: https://arendjr.github.io/selectivity/
 *
 * @author Wanderson Bragança <wanderson.wbc@gmail.com>
 */
class SelectivityWidget extends \yii\widgets\InputWidget
{
    /**
     * The name of the jQuery plugin to use for this widget.
     */
    const PLUGIN_NAME = 'selectivity';
    /**
     * @var array the JQuery plugin options for the Selectivity.js plugin.
     * @see https://arendjr.github.io/selectivity/#api
     */
    public $pluginOptions = [];
    /**
     * @var array the HTML attributes for the input tag.
     * @see \yii\helpers\Html::renderTagAttributes() for details on how attributes are being rendered.
     */
    public $options = [];
    /**
     * @var string the hashed variable to store the pluginOptions
     */
    protected $_hashVar;

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerClientScript();
        $data = ArrayHelper::getValue($this->pluginOptions, 'items', []);

        if ($this->hasModel()) {
            echo Html::activeDropDownList($this->model, $this->attribute, $data, $this->options);
        } else {
            echo Html::dropDownList($this->name, $this->value, $data, $this->options);
        }
    }

    /**
     * Generates a hashed variable to store the plugin `pluginOptions`. Helps in reusing the variable for similar
     * options passed for other widgets on the same page. The following special data attribute will also be
     * setup for the input widget, that can be accessed through javascript:
     *
     * - 'data-plugin-selectivity' will store the hashed variable storing the plugin options.
     *
     * @param View $view the view instance
     */
    protected function hashPluginOptions($view)
    {
        $encOptions = empty($this->pluginOptions) ? '{}' : Json::encode($this->pluginOptions);
        $this->_hashVar = self::PLUGIN_NAME . '_' . hash('crc32', $encOptions);
        $this->options['data-plugin-' . self::PLUGIN_NAME] = $this->_hashVar;
        $view->registerJs("var {$this->_hashVar} = {$encOptions};\n", View::POS_HEAD);
    }

    /**
     * Registers the needed client script and options.
     */
    public function registerClientScript()
    {
        $js = '';
        $view = $this->getView();
        $this->hashPluginOptions($view);
        $id = $this->options['id'];
        $js .= '$("#' . $id . '").' . self::PLUGIN_NAME . "(" . $this->_hashVar . ");\n";
        SelectivityAsset::register($view);
        $view->registerJs($js);
    }
}
