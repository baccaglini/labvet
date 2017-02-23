<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Especie]].
 *
 * @see Especie
 */
class EspecieQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Especie[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Especie|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
