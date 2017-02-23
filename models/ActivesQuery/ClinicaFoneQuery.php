<?php

namespace app\models\ActivesQuery;

/**
 * This is the ActiveQuery class for [[\app\models\ClinicaFone]].
 *
 * @see \app\models\ClinicaFone
 */
class ClinicaFoneQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\ClinicaFone[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\ClinicaFone|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
