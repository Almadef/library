<?php

use yii\db\Migration;

/**
 * Class m210419_182050_change_book_table_description_en_column
 */
class m210419_182050_change_book_table_description_en_column extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%book}}', 'description_en', $this->text()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%book}}', 'description_en', $this->string()->notNull());
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210419_182050_change_book_table_description_en_column cannot be reverted.\n";

        return false;
    }
    */
}
