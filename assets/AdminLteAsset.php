<?php
namespace app\assets;

use yii\web\AssetBundle;

use yii\base\Exception;

/**
 * AdminLte AssetBundle
 * @since 0.1
 */
class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/dist';
//    public $basePath = '@webroot';
//    public $baseUrl = '@web';

    public $css = [
        'css/AdminLTE.min.css',
//        'css/glyphicons.css', //  !!!! подключал "вручную" в layout/main
//        'css/admin_style.css', // !!!!   подключал "вручную" в layout/main
    ];
    public $js = [
        'js/adminlte.min.js',
//        'js/admin_script.js', // !!!!   подключал "вручную" в layout/main
    ];
    public $depends = [
        'rmrevin\yii\fontawesome\AssetBundle',
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
    ];

    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];

    /**
     * @var string|bool Choose skin color, eg. `'skin-blue'` or set `false` to disable skin loading
     * @see https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html#layout
     */
    public $skin = 'skin-blue';


    public function init()
    {
        // Append skin color file if specified
        if ($this->skin) {
            if (('_all-skins' !== $this->skin) && (strpos($this->skin, 'skin-') !== 0)) {
                throw new Exception('Invalid skin specified');
            }

            $this->css[] = sprintf('css/skins/%s.min.css', $this->skin);
        }

        parent::init();
    }
}
