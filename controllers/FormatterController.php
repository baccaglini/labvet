<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;
use yii\web\Controller;
use Yii;
/**
 * Description of FormatterController
 *
 * @author roger
 */
class FormatterController extends Controller {
    //put your code here
    public function actionIndex() {
        /** @var MyFormatter $formatter */
        $appLang = Yii::$app->language;
        $formatter = Yii::$app->formatter;
        echo "<h2>{$appLang}</h2>";
        
        echo "
            <p>
            Percentual: {$formatter->asPercent(0.126773, 2)} <br />
                Data: {$formatter->asDate('2016-08-30', 'dd/MM/YYYY')}<br />
                    CPF: {$formatter->asCpf('504811833')}
            </p>
        ";
        
    }
}
