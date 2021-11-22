<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property string|null $name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Departments[] $departments
 * @property Departments[] $departments_form
 * @property EmployeesDepartments[] $employeesDepartments
 */
class Employees extends \yii\db\ActiveRecord
{

    public $departments_form;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
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
            [['name'], 'string', 'max' => 121],
            [['departments_form'], 'each', 'rule' => ['integer']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'departments_form' => 'Departments',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Departments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDepartments()
    {
        return $this->hasMany(Departments::className(), ['id' => 'departments_id'])->viaTable('employees_departments', ['employees_id' => 'id']);
    }

    /**
     * Gets query for [[EmployeesDepartments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEmployeesDepartments()
    {
        return $this->hasMany(EmployeesDepartments::className(), ['employees_id' => 'id']);
    }
}
