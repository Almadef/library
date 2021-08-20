<?php

namespace common\models\auth\rule;

use common\models\auth\Item;
use yii\db\ActiveQuery;

/**
 * Trait Relations
 * @package common\models\auth\rule
 */
trait Relations
{
    /**
     * @return ActiveQuery
     */
    public function getAuthItems()
    {
        return $this->hasMany(Item::class, ['rule_name' => 'name']);
    }
}
