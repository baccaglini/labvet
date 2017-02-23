<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ClinicaFone]].
 *
 * @see ClinicaFone
 */
class ClinicaFoneQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ClinicaFone[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ClinicaFone|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
