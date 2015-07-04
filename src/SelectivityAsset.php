<?php
/**
 * @link      https://github.com/wbraganca/yii2-selectivity
 * @copyright Copyright (c) 2015 Wanderson Bragança
 * @license   https://github.com/wbraganca/yii2-selectivity/blob/master/LICENSE
 */

namespace wbraganca\selectivity;

/**
 * Asset bundle for selectivity Widget
 *
 * @author Wanderson Bragança <wanderson.wbc@gmail.com>
 */
class SelectivityAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@bower/selectivity/dist';

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
        'yii\widgets\ActiveFormAsset'
    ];

    /**
     * Set up CSS and JS asset arrays based on the base-file names
     * @param string $type whether 'css' or 'js'
     * @param array $files the list of 'css' or 'js' basefile names
     */
    protected function setupAssets($type, $files = [])
    {
        $srcFiles = [];
        $minFiles = [];
        foreach ($files as $file) {
            $srcFiles[] = "{$file}.{$type}";
            $minFiles[] = "{$file}.min.{$type}";
        }
        if (empty($this->$type)) {
            $this->$type = YII_DEBUG ? $srcFiles : $minFiles;
        }
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setupAssets('js', ['selectivity-full']);
        $this->setupAssets('css', ['selectivity-full']);
        parent::init();
    }
}
