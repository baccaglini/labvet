<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Cidades]].
 *
 * @see Cidades
 */
class CidadesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Cidades[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Cidades|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
