<?php

namespace app\models\ActivesQuery;

/**
 * This is the ActiveQuery class for [[\app\models\ProprietarioFone]].
 *
 * @see \app\models\ProprietarioFone
 */
class ProprietarioFoneQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\ProprietarioFone[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\ProprietarioFone|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
