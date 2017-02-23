<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ClinicaEmail]].
 *
 * @see ClinicaEmail
 */
class ClinicaEmailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ClinicaEmail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ClinicaEmail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
