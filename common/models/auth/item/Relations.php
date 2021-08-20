<?php

namespace common\models\auth\item;

use common\models\auth\Assignment;
use common\models\auth\Item;
use common\models\auth\ItemChild;
use common\models\auth\Rule;
use yii\db\ActiveQuery;

/**
 * Trait Relations
 * @package common\models\auth\item
 */
trait Relations
{
    /**
     * @return ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(Assignment::class, ['item_name' => 'name']);
    }

    /**
     * @return ActiveQuery
     */
    public function getRuleName()
    {
        return $this->hasOne(Rule::class, ['name' => 'rule_name']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthItemChildren()
    {
        return $this->hasMany(ItemChild::class, ['parent' => 'name']);
    }

    /**
     * @return ActiveQuery
     */
    public function getAuthItemChildren0()
    {
        return $this->hasMany(ItemChild::class, ['child' => 'name']);
    }

    /**
     * @return ActiveQuery
     */
    public function getChildren()
    {
        return $this->hasMany(Item::class, ['name' => 'child'])->viaTable(
            '{{%auth_item_child}}',
            ['parent' => 'name']
        );
    }

    /**
     * @return ActiveQuery
     */
    public function getParents()
    {
        return $this->hasMany(Item::class, ['name' => 'parent'])->viaTable(
            '{{%auth_item_child}}',
            ['child' => 'name']
        );
    }
}
