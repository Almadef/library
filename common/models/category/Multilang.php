<?php

namespace common\models\category;

use common\helpers\LanguagesHelper;
use Exception;

/**
 * Trait Multilang
 * @package common\models\category
 */
trait Multilang
{
    /**
     * @return string
     * @throws Exception
     */
    public function getTitle(): string
    {
        $title = LanguagesHelper::getCurrentAttribute('title');
        return $this->$title;
    }
}
