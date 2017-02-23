<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ExameAmostra]].
 *
 * @see ExameAmostra
 */
class ExameAmostraQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ExameAmostra[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ExameAmostra|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
