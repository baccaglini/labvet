<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Acesso]].
 *
 * @see Acesso
 */
class AcessoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Acesso[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Acesso|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
