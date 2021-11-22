<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%departments}}`.
 */
class m211119_134323_employees_create extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $departments = \app\models\Departments::find()->all();
        $employees = ['Валентин', 'Григорий', 'Альберт', 'Вениамин', 'Ярослав', 'Галя', 'Вася', 'Виктор', 'Димка', 'Анастасия Петровна', 'Мари', 'John', 'Тим', 'Барсик'];

        foreach ($employees as $employee){
            $model = new \app\models\Employees();
            $model->name = $employee;
            $model->save();
            foreach ($departments as $department){
                $model->link('departments', $department);
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $employees_name = ['Валентин', 'Григорий', 'Альберт', 'Вениамин', 'Ярослав', 'Галя', 'Вася', 'Виктор', 'Димка', 'Анастасия Петровна', 'Мари', 'John', 'Тим', 'Барсик'];
        $employees = \app\models\Employees::find()->where(['name' =>$employees_name ])->all();
        foreach ($employees as $employee){
            $employee->delete();
        }
    }
}