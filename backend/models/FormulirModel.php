<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "table_formulir".
 *
 * @property int $id
 * @property string $nama_formulir
 *
 * @property TableDataFormulir[] $tableDataFormulirs
 * @property TableFormulirUrusanlayanan[] $tableFormulirUrusanlayanans
 */
class FormulirModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'table_formulir';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_formulir'], 'required'],
            [['nama_formulir'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_formulir' => 'Nama Formulir',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataFormulirs()
    {
        return $this->hasMany(DataFormulirModel::className(), ['id_formulir' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormulirUrusanlayanans()
    {
        return $this->hasMany(FormulirUrusanlayananModel::className(), ['id_formulir' => 'id']);
    }


    public function dataform(){
        return "<center><a href='formulir/data-formulir/".$this->id."'><span class='fa fa-file'></span></a></center>";
    }
}
