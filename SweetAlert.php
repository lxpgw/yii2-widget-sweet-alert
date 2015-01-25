<?php
namespace Light\widgets;

use yii\base\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\Json;

class SweetAlert extends Widget
{

    /**
     * The title of the modal.
     * It can either be added to the object under the key "title"
     * or passed as the first parameter of the function.
     * @var string
     */
    public $title;

    /**
     * A description for the modal.
     * It can either be added to the object under the key "text"
     * or passed as the second parameter of the function.
     * @var string
     */
    public $text;

    /**
     * The type of the modal.
     * SweetAlert comes with 4 built-in types
     * which will show a corresponding icon animation: "warning", "error", "success" and "info".
     * It can either be put in the array under the key "type" or passed as the third parameter of the function.
     * @var string
     */
    public $type;

    /**
     * Auto close timer of the modal. Set in ms (milliseconds).
     * @var int
     */
    public $timer;

    /**
     * If set to true, the user can dismiss the modal by clicking outside it.
     * @var boolean
     */
    public $allowOutsideClick = false;

    /**
     * Set to false if you want the modal to stay open even if the user presses the "Confirm"-button.
     * This is especially useful if the function attached to the "Confirm"-button is another SweetAlert.
     * @var boolean
     */
    public $closeOnConfirm = true;

    /**
     * Use this to change the text on the "Confirm"-button.
     * If showCancelButton is set as true, the confirm button will automatically show "Confirm" instead of "OK".
     * @var string
     */
    public $confirmButtonText = 'OK';

    /**
     * Use this to change the background color of the "Confirm"-button (must be a HEX value).
     * @var string
     */
    public $confirmButtonColor = '#AEDEF4';

    /**
     * The css class of the confirm button
     * @var string
     */
    public $confirmButtonClass = 'btn-primary';

    /**
     * If set to true, a "Cancel"-button will be shown,
     * which the user can click on to dismiss the modal.
     * @var boolean
     */
    public $showCancelButton = false;

    /**
     * Use this to change the text on the "Cancel"-button.
     * @var string
     */
    public $cancelButtonText = 'Cancel';

    /**
     * Add a customized icon for the modal. Should contain a string with the path to the image.
     * @var string
     */
    public $imageUrl;

    /**
     * If imageUrl is set, you can specify imageSize to describes how big you want the icon to be in px.
     * Pass in a string with two values separated by an "x".
     * The first value is the width, the second is the height.
     * @var string
     */
    public $imageSize = '80x80';

    /**
     * Supported alert types
     * @var array
     */
    protected $allowTypes = [
        'error',
        'warning',
        'info',
        'success',
    ];


    private $settings;

    public function init()
    {
        parent::init();
        if (null == $this->title) {
            throw new InvalidConfigException('The title must be set!');
        }
         $this->initOptions();
    }


    public function run()
    {
        $this->registerAsset();
    }

    protected function initOptions()
    {
        $this->settings['title'] = $this->title;
        if ($this->text) {
            $this->settings['text'] = $this->text;
        }
        if ($this->timer) {
            $this->settings['timer'] = $this->timer;
        }
        if ($this->type && in_array($this->type, $this->allowTypes)) {
            $this->settings['type'] = $this->type;
        }
        if ($this->allowOutsideClick) {
            $this->settings['allowOutsideClick'] = $this->allowOutsideClick;
        }
        if ($this->showCancelButton) {
            $this->settings['showCancelButton'] = $this->showCancelButton;
            $this->settings['cancelButtonText'] = $this->cancelButtonText;
        }
        $this->settings['closeOnConfirm'] = $this->closeOnConfirm;
        $this->settings['confirmButtonText'] = $this->confirmButtonText;
        $this->settings['confirmButtonColor'] = $this->confirmButtonColor;
        $this->settings['confirmButtonClass'] = $this->confirmButtonClass;
        if ($this->imageUrl) {
            $this->settings['imageUrl']  = $this->imageUrl;
            $this->settings['imageSize'] = $this->imageSize;
        }

    }

    /**
     * register client assets
     * @return null
     */
    protected function registerAsset()
    {
        $view = $this->getView();
        SweetAlertAsset::register($view);

        $view->registerJs('sweetAlertInitialize();swal('.Json::encode($this->settings).')');
    }
}
