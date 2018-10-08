<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "table_data_formulir".
 *
 * @property int $id
 * @property string $nama_data
 * @property string $datatype
 * @property int $id_formulir
 *
 * @property TableFormulir $formulir
 * @property TableUserFormulirValue[] $tableUserFormulirValues
 */
class DataFormulirModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'table_data_formulir';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_data', 'datatype', 'id_formulir'], 'required'],
            [['id_formulir'], 'integer'],
            [['nama_data'], 'string', 'max' => 200],
            [['datatype'], 'string', 'max' => 20],
            [['id_formulir'], 'exist', 'skipOnError' => true, 'targetClass' => FormulirModel::className(), 'targetAttribute' => ['id_formulir' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_data' => 'Nama Data',
            'datatype' => 'Datatype',
            'id_formulir' => 'Id Formulir',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormulir()
    {
        return $this->hasOne(FormulirModel::className(), ['id' => 'id_formulir']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFormulirValues()
    {
        return $this->hasMany(UserFormulirValueModel::className(), ['id_dataformulir' => 'id']);
    }
}
