<?php

namespace console\controllers;

use common\helpers\StorageHelper;
use common\models\{
    Author,
    Category,
    Publisher,
    Book,
    Storage
};
use Exception;
use Throwable;
use Yii;
use yii\console\Controller;
use yii\helpers\Console;
use Faker\Factory;
use yii\caching\TagDependency;

/**
 * Seed database
 * @package console\controllers
 */
final class SeedController extends Controller
{
    private const COUNT_AUTHORS = 15;
    private const COUNT_CATEGORIES = 10;
    private const COUNT_PUBLISHERS = 6;
    private const COUNT_BOOKS = 40;

    /**
     * Create authors, categories, publishers, books.
     * @throws Exception
     */
    public function actionLibrary()
    {
        $fakerEn = Factory::create('en_US');
        $fakerRu = Factory::create('ru_RU');

        $db = Yii::$app->db;
        $transaction = $db->beginTransaction();
        try {
            Storage::deleteAll();
            Book::deleteAll();
            Publisher::deleteAll();
            Category::deleteAll();
            Author::deleteAll();

            $authors = [];
            $categories = [];
            $publishers = [];

            for ($i = 0; $i < self::COUNT_AUTHORS; $i++) {
                $author = new Author();
                $author->name_ru = $fakerRu->firstName;
                $author->name_en = $fakerEn->firstName;
                $author->surname_ru = $fakerRu->lastName;
                $author->surname_en = $fakerEn->lastName;
                $author->patronymic_ru = $fakerRu->middleName;
                $author->patronymic_en = $fakerEn->firstName;
                $author->save();
                $authors[] = $author;
            }

            for ($i = 0; $i < self::COUNT_CATEGORIES; $i++) {
                $category = new Category();
                $category->title_ru = $fakerRu->colorName;
                $category->title_en = $fakerEn->colorName;
                $category->save();
                $categories[] = $category;
            }

            for ($i = 0; $i < self::COUNT_PUBLISHERS; $i++) {
                $publisher = new Publisher();
                $publisher->name_ru = $fakerRu->company;
                $publisher->name_en = $fakerEn->company;
                $publisher->save();
                $publishers[] = $publisher;
            }

            for ($i = 0; $i < self::COUNT_BOOKS; $i++) {
                $book = new Book();
                $book->title_ru = $fakerRu->country;
                $book->title_en = $fakerEn->country;
                $book->release = $fakerEn->date();
                $book->isbn = $fakerEn->isbn13;
                $book->pages = $fakerEn->randomDigitNotNull;
                $book->description_ru = $fakerRu->text(700);
                $book->description_en = $fakerEn->text(700);
                $book->link('publisher', $publishers[$this->getRandomNumberForArray(self::COUNT_PUBLISHERS)]);
                $book->save();

                $usedAuthors = [];
                for ($j = 0; $j < rand(1, 3); $j++) {
                    $authorNumber = $this->getNewObjectNumber($usedAuthors, self::COUNT_AUTHORS);
                    $usedAuthors[] = $authorNumber;
                    $book->link('authors', $authors[$authorNumber], ['created_at' => time()]);
                }

                $usedCategories = [];
                for ($j = 0; $j < rand(1, 2); $j++) {
                    $categoryNumber = $this->getNewObjectNumber($usedCategories, self::COUNT_CATEGORIES);
                    $usedCategories[] = $categoryNumber;
                    $book->link('categories', $categories[$categoryNumber], ['created_at' => time()]);
                }

                $bookFile = new Storage();
                $bookFile->model_id = $book->id;
                $bookFile->model_name = Book::class;
                $bookFile->description = StorageHelper::BOOK_BOOK_DESCRIPTION;
                $bookFile->file_name = $fakerEn->word . '.pdf';
                $bookFile->file_type = 'pdf';
                $bookFile->file_size = 133668;
                $bookFile->file_path = '/seed/book.pdf';
                $bookFile->save();

                $coverFile = new Storage();
                $coverFile->model_id = $book->id;
                $coverFile->model_name = Book::class;
                $coverFile->description = StorageHelper::BOOK_COVER_DESCRIPTION;
                $coverFile->file_name = $fakerEn->word . '.png';
                $coverFile->file_type = 'png';
                $coverFile->file_size = 433668;
                $coverFile->file_path = '/seed/book_cover.png';
                $coverFile->save();
            }

            $transaction->commit();
            TagDependency::invalidate(Yii::$app->cache, ['library_index']);
            $this->stdout(
                $this->ansiFormat('Success!' . PHP_EOL, Console::FG_GREEN)
            );
        } catch (Exception $e) {
            $transaction->rollBack();
            throw $e;
        } catch (Throwable $e) {
            $transaction->rollBack();
        }
    }

    /**
     * @param array $numbers
     * @param int $count
     * @return int
     */
    private function getNewObjectNumber(array $numbers, int $count): int
    {
        while (true) {
            $number = $this->getRandomNumberForArray($count);
            if (!in_array($number, $numbers)) {
                return $number;
            }
        }
    }

    /**
     * @param int $count
     * @return int
     */
    private function getRandomNumberForArray(int $count): int
    {
        return rand(0, ($count - 1));
    }
}
