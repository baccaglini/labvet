<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[VeterinarioFone]].
 *
 * @see VeterinarioFone
 */
class VeterinarioFoneQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return VeterinarioFone[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return VeterinarioFone|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
