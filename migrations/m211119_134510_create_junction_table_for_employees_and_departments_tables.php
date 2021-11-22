<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%employees_departments}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%employees}}`
 * - `{{%departments}}`
 */
class m211119_134510_create_junction_table_for_employees_and_departments_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%employees_departments}}', [
            'employees_id' => $this->integer(),
            'departments_id' => $this->integer(),
            'PRIMARY KEY(employees_id, departments_id)',
        ]);

        // creates index for column `employees_id`
        $this->createIndex(
            '{{%idx-employees_departments-employees_id}}',
            '{{%employees_departments}}',
            'employees_id'
        );

        // add foreign key for table `{{%employees}}`
        $this->addForeignKey(
            '{{%fk-employees_departments-employees_id}}',
            '{{%employees_departments}}',
            'employees_id',
            '{{%employees}}',
            'id',
            'CASCADE'
        );

        // creates index for column `departments_id`
        $this->createIndex(
            '{{%idx-employees_departments-departments_id}}',
            '{{%employees_departments}}',
            'departments_id'
        );

        // add foreign key for table `{{%departments}}`
        $this->addForeignKey(
            '{{%fk-employees_departments-departments_id}}',
            '{{%employees_departments}}',
            'departments_id',
            '{{%departments}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%employees}}`
        $this->dropForeignKey(
            '{{%fk-employees_departments-employees_id}}',
            '{{%employees_departments}}'
        );

        // drops index for column `employees_id`
        $this->dropIndex(
            '{{%idx-employees_departments-employees_id}}',
            '{{%employees_departments}}'
        );

        // drops foreign key for table `{{%departments}}`
        $this->dropForeignKey(
            '{{%fk-employees_departments-departments_id}}',
            '{{%employees_departments}}'
        );

        // drops index for column `departments_id`
        $this->dropIndex(
            '{{%idx-employees_departments-departments_id}}',
            '{{%employees_departments}}'
        );

        $this->dropTable('{{%employees_departments}}');
    }
}
