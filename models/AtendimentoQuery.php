<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Atendimento]].
 *
 * @see Atendimento
 */
class AtendimentoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Atendimento[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Atendimento|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
