<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[ProprietarioFone]].
 *
 * @see ProprietarioFone
 */
class ProprietarioFoneQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return ProprietarioFone[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return ProprietarioFone|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
