<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Amostra]].
 *
 * @see Amostra
 */
class AmostraQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Amostra[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Amostra|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
