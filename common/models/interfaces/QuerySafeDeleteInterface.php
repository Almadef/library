<?php

namespace common\models\interfaces;

use yii\db\ActiveQuery;

/**
 * Interface QuerySafeDeleteInterface
 * @package common\models\interfaces
 */
interface QuerySafeDeleteInterface
{
    /**
     * Сondition for output of not deleted records
     * @return ActiveQuery
     */
    public function isNoDeleted();
}
