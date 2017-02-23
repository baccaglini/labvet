<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[VeterinarioEmail]].
 *
 * @see VeterinarioEmail
 */
class VeterinarioEmailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return VeterinarioEmail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return VeterinarioEmail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
