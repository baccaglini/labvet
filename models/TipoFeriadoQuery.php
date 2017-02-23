<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[TipoFeriado]].
 *
 * @see TipoFeriado
 */
class TipoFeriadoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TipoFeriado[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TipoFeriado|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
