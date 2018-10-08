<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "table_urusan".
 *
 * @property int $id
 * @property string $nama_urusan
 *
 * @property TableUrusanlayanan[] $tableUrusanlayanans
 */
class UrusanModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'table_urusan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_urusan'], 'required'],
            [['nama_urusan'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_urusan' => 'Nama Urusan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrusanlayanans()
    {
        return $this->hasMany(UrusanlayananModel::className(), ['id_urusan' => 'id']);
    }


    
}
