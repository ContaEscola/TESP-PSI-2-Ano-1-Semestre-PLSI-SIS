<?php


namespace common\components;

use Yii;
use yii\base\Widget;


class CustomAlert extends Widget
{
    public $viewPath = "@common/components/views";

    public $alertTypes = [
        'success' => 'alert-success',
    ];



    public function run()
    {
        $session = Yii::$app->session;

        $flashes = $session->getAllFlashes();

        foreach ($flashes as $type => $flash) {
            if (!isset($this->alertTypes[$type])) {
                continue;
            }
            echo $this->render('customAlert', [
                'body' => $flash, 'type' => $this->alertTypes[$type]
            ]);
            $session->removeFlash($type);
        }
    }
}
