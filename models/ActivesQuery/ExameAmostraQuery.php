<?php

namespace app\models\ActivesQuery;

/**
 * This is the ActiveQuery class for [[\app\models\ExameAmostra]].
 *
 * @see \app\models\ExameAmostra
 */
class ExameAmostraQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\ExameAmostra[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\ExameAmostra|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
