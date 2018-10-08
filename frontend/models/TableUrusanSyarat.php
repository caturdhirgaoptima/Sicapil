<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "table_urusan_syarat".
 *
 * @property int $id
 * @property int $id_urusan
 * @property string $syarat
 *
 * @property TableUrusan $urusan
 */
class TableUrusanSyarat extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'table_urusan_syarat';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_urusan', 'syarat'], 'required'],
            [['id_urusan'], 'integer'],
            [['syarat'], 'string', 'max' => 200],
            [['id_urusan'], 'exist', 'skipOnError' => true, 'targetClass' => TableUrusan::className(), 'targetAttribute' => ['id_urusan' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_urusan' => 'Id Urusan',
            'syarat' => 'Syarat',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrusan()
    {
        return $this->hasOne(TableUrusan::className(), ['id' => 'id_urusan']);
    }
}
