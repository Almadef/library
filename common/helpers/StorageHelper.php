<?php

namespace common\helpers;

final class StorageHelper
{
    const BOOK_COVER_DESCRIPTION = 'cover';
    const BOOK_BOOK_DESCRIPTION = 'book';

    public static function convertDescriptionToLabel(string $description): string
    {
        return static::descriptionLabels()[$description];
    }

    /**
     * @return array
     */
    public static function descriptionLabels()
    {
        return [
            self::BOOK_COVER_DESCRIPTION => 'Обложка',
            self::BOOK_BOOK_DESCRIPTION => 'Книга',
        ];
    }
}
