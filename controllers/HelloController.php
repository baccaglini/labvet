<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;
use \yii\web\Controller;

/**
 * Description of HelloController
 *
 * @author rogerio.baccaglini
 */
class HelloController extends Controller {
    public function actionFalaAi($msg = 'oi!!!'){
        return $this->render('fala-ai',[
            'msg' => $msg
        ]);
    }
}
