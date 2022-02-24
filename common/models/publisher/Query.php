<?php

namespace common\models\publisher;

use common\models\interfaces\QuerySafeDeleteInterface;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\common\models\publisher\ActiveRecord]].
 *
 * @see \common\models\Publisher
 */
final class Query extends ActiveQuery implements QuerySafeDeleteInterface
{
    /**
     * {@inheritdoc}
     * @return ActiveRecord[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ActiveRecord|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * {@inheritdoc}
     */
    public function isNoDeleted()
    {
        return $this->andWhere(['{{%publisher}}.is_deleted' => false]);
    }

    /**
     * @param $id
     * @return Query
     */
    public function byId($id)
    {
        return $this->andWhere(['{{%publisher}}.id' => $id]);
    }
}
