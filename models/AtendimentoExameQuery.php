<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[AtendimentoExame]].
 *
 * @see AtendimentoExame
 */
class AtendimentoExameQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return AtendimentoExame[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return AtendimentoExame|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
