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
        $this->setSourcePath(__DIR__ . '/assets/selectivity');
        $this->setupAssets('js', ['selectivity-jquery']);
        $this->setupAssets('css', ['selectivity-jquery']);
        parent::init();
    }

    /**
     * Sets the source path if empty
     * @param string $path the path to be set
     */
    protected function setSourcePath($path)
    {
        if (empty($this->sourcePath)) {
            $this->sourcePath = $path;
        }
    }
}


