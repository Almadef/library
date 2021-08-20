<?php

namespace common\models\author;

use common\helpers\LanguagesHelper;
use Exception;

/**
 * Trait Multilang
 * @package common\models\author
 */
trait Multilang
{
    /**
     * @return string
     * @throws Exception
     */
    public function getSurname(): string
    {
        $surname = LanguagesHelper::getCurrentAttribute('surname');
        return $this->$surname;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getName(): string
    {
        $name = LanguagesHelper::getCurrentAttribute('name');
        return $this->$name;
    }


    /**
     * @return string|null
     * @throws Exception
     */
    public function getPatronymic()
    {
        $patronymic = LanguagesHelper::getCurrentAttribute('patronymic');
        return $this->$patronymic;
    }
}
