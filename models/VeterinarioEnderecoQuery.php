<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[VeterinarioEndereco]].
 *
 * @see VeterinarioEndereco
 */
class VeterinarioEnderecoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return VeterinarioEndereco[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return VeterinarioEndereco|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
