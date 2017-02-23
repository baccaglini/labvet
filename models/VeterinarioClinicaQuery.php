<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[VeterinarioClinica]].
 *
 * @see VeterinarioClinica
 */
class VeterinarioClinicaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return VeterinarioClinica[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return VeterinarioClinica|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
