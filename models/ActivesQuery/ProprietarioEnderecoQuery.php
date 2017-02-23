<?php

namespace app\models\ActivesQuery;

/**
 * This is the ActiveQuery class for [[\app\models\ProprietarioEndereco]].
 *
 * @see \app\models\ProprietarioEndereco
 */
class ProprietarioEnderecoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\ProprietarioEndereco[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\ProprietarioEndereco|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
