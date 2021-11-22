<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "employees_departments".
 *
 * @property int $employees_id
 * @property int $departments_id
 *
 * @property Departments $departments
 * @property Employees $employees
 */
class EmployeesDepartments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees_departments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['employees_id', 'departments_id'], 'required'],
            [['employees_id', 'departments_id'], 'integer'],
            [['employees_id', 'departments_id'], 'unique', 'targetAttribute' => ['employees_id', 'departments_id']],
            [['departments_id'], 'exist', 'skipOnError' => true, 'targetClass' => Departments::className(), 'targetAttribute' => ['departments_id' => 'id']],
            [['employees_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employees::className(), 'targetAttribute' => ['employees_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'employees_id' => 'Employees ID',
            'departments_id' => 'Departments ID',
        ];
    }

    /**
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasOne(Departments::className(), ['id' => 'departments_id']);
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasOne(Employees::className(), ['id' => 'employees_id']);
    }
}
