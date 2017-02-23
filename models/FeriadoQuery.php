<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Feriado]].
 *
 * @see Feriado
 */
class FeriadoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Feriado[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Feriado|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
