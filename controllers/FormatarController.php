<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;
use Yii;
use \yii\web\Controller;
/**
 * Description of FormatarController
 *
 * @author rogerio.baccaglini
 */
class FormatarController extends Controller {
    
    public function actionIndex() {
        
        $formatter = Yii::$app->formatter;
        
        echo "TEste: {$formatter->asDate('2019-08-21')}";
    }
}
