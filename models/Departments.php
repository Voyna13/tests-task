<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "departments".
 *
 * @property int $id
 * @property string|null $title
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Employees[] $employees
 * @property EmployeesDepartments[] $employeesDepartments
 */
class Departments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'departments';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function() {
                    return date("Y-m-d H:i:s");
                }
            ],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'safe'],
            [['title'], 'string', 'max' => 121],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Employees]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployees()
    {
        return $this->hasMany(Employees::className(), ['id' => 'employees_id'])->viaTable('employees_departments', ['departments_id' => 'id']);
    }

    /**
     * Gets query for [[EmployeesDepartments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeesDepartments()
    {
        return $this->hasMany(EmployeesDepartments::className(), ['departments_id' => 'id']);
    }
}
