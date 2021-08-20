<?php

namespace common\fixtures;

use common\models\User;
use yii\test\ActiveFixture;

final class UserFixture extends ActiveFixture
{
    public $modelClass = User::class;
}
