<?php

namespace common\models\auth\item_child;

use common\models\auth\Item;
use yii\db\ActiveQuery;

/**
 * Trait Relations
 * @package common\models\auth\item_child
 */
trait Relations
{
    /**
     * @return ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(Item::class, ['name' => 'parent']);
    }

    /**
     * @return ActiveQuery
     */
    public function getChild0()
    {
        return $this->hasOne(Item::class, ['name' => 'child']);
    }
}
