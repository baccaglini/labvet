<?php

namespace app\models\ActivesQuery;

/**
 * This is the ActiveQuery class for [[\app\models\VeterinarioClinica]].
 *
 * @see \app\models\VeterinarioClinica
 */
class VeterinarioClinicaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \app\models\VeterinarioClinica[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\models\VeterinarioClinica|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
