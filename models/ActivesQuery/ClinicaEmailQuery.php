<?php

namespace app\models\ActivesQuery;

/**
 * This is the ActiveQuery class for [[\app\models\ClinicaEmail]].
 *
 * @see \app\models\ClinicaEmail
 */
class ClinicaEmailQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\ClinicaEmail[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\ClinicaEmail|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
