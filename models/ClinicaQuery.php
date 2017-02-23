<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Clinica]].
 *
 * @see Clinica
 */
class ClinicaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Clinica[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Clinica|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
