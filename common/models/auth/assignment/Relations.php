<?php

namespace common\models\auth\assignment;

use common\models\auth\Item;
use yii\db\ActiveQuery;

/**
 * Trait Relations
 * @package common\models\auth\assignment
 */
trait Relations
{
    /**
     * @return ActiveQuery
     */
    public function getItemName()
    {
        return $this->hasOne(Item::class, ['name' => 'item_name']);
    }
}
