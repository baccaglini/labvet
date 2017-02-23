<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Raca]].
 *
 * @see Raca
 */
class RacaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Raca[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Raca|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
