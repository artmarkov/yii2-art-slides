<?php

namespace artsoft\slides\models\query;

/**
 * This is the ActiveQuery class for [[\artsoft\slides\models\Slides]].
 *
 * @see \artsoft\slides\models\Slides
 */
class SlidesQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \artsoft\slides\models\Slides[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \artsoft\slides\models\Slides|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
