<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Cidade]].
 *
 * @see Cidade
 */
class CidadeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Cidade[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Cidade|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
