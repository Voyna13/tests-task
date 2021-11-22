<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%departments}}`.
 */
class m211119_134323_create_departments extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $departments_title = ['Отдел кибербуллинга', 'Отдел антистрессовых мягких шариков',  'Отдел розовых единорогов', 'Отдел обратно идущего времени'];

        foreach ($departments_title as $department){
            $dep = new \app\models\Departments();
            $dep->title = $department;
            $dep->save();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $departments_title = ['Отдел кибербуллинга', 'Отдел антистрессовых мягких шариков',  'Отдел розовых единорогов', 'Отдел обратно идущего времени'];
        $departments = \app\models\Departments::find()->where(['title' =>$departments_title ])->all();
        foreach ($departments as $department){
            $department->delete();
        }
    }
}
