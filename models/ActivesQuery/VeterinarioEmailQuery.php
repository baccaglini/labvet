<?php

namespace app\models\ActivesQuery;

/**
 * This is the ActiveQuery class for [[\app\models\VeterinarioEmail]].
 *
 * @see \app\models\VeterinarioEmail
 */
class VeterinarioEmailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\VeterinarioEmail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\VeterinarioEmail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
