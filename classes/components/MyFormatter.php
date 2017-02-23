<?php
namespace app\classes\components;
use \yii\i18n\Formatter;
class MyFormatter extends Formatter {
    public static function asCpf($string) {
        $string = str_pad($string, 11, '0', STR_PAD_LEFT);
        return substr($string, 0, 3) . '.' .substr($string, 3, 3) . '.' . substr($string, 6, 3) . '-' .substr($string, 9, 2);
    }
}
