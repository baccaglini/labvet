<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProprietarioEmail]].
 *
 * @see ProprietarioEmail
 */
class ProprietarioEmailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ProprietarioEmail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProprietarioEmail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
