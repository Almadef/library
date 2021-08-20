<?php

namespace backend\controllers\traits;

use Yii;
use yii\caching\TagDependency;

trait CacheManagementTraits
{
    public function clearCache()
    {
        TagDependency::invalidate(Yii::$app->cache, ['library_index']);
    }
}
