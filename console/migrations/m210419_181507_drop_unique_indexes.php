<?php

use yii\db\Migration;

/**
 * Class m210419_181507_drop_unique_indexes
 */
class m210419_181507_drop_unique_indexes extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->dropIndex('name_en', '{{%author}}');
        $this->dropIndex('surname_en', '{{%author}}');
        $this->dropIndex('patronymic_en', '{{%author}}');

        $this->dropIndex('title_en', '{{%category}}');

        $this->dropIndex('name', '{{%publisher}}');
        $this->dropIndex('name_en', '{{%publisher}}');

        $this->dropIndex('title_en', '{{%book}}');
        $this->dropIndex('description_en', '{{%book}}');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210419_181507_drop_unique_indexes cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210419_181507_drop_unique_indexes cannot be reverted.\n";

        return false;
    }
    */
}
