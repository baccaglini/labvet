<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Administrador]].
 *
 * @see Administrador
 */
class AdministradorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Administrador[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Administrador|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
