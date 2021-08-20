<?php

namespace common\models\publisher;

use common\helpers\LanguagesHelper;
use Exception;

/**
 * Trait Multilang
 * @package common\models\publisher
 */
trait Multilang
{
    /**
     * @return string
     * @throws Exception
     */
    public function getName(): string
    {
        $name = LanguagesHelper::getCurrentAttribute('name');
        return $this->$name;
    }
}
