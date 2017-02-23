<?php

namespace app\models\ActivesQuery;

/**
 * This is the ActiveQuery class for [[\app\models\TipoFeriado]].
 *
 * @see \app\models\TipoFeriado
 */
class TipoFeriadoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\TipoFeriado[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\TipoFeriado|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
