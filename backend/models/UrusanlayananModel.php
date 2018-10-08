<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "table_urusanlayanan".
 *
 * @property int $id
 * @property int $id_urusan
 * @property int $id_layanan
 *
 * @property TableDokumenUrusanlayanan[] $tableDokumenUrusanlayanans
 * @property TableFormulirUrusanlayanan[] $tableFormulirUrusanlayanans
 * @property TableUrusan $urusan
 * @property TableLayanan $layanan
 * @property TableUrusanlayananUser[] $tableUrusanlayananUsers
 */
class UrusanlayananModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'table_urusanlayanan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_urusan', 'id_layanan'], 'required'],
            [['id_urusan', 'id_layanan'], 'integer'],
            [['id_urusan'], 'exist', 'skipOnError' => true, 'targetClass' => UrusanModel::className(), 'targetAttribute' => ['id_urusan' => 'id']],
            [['id_layanan'], 'exist', 'skipOnError' => true, 'targetClass' => LayananModel::className(), 'targetAttribute' => ['id_layanan' => 'id']],
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
            'id_layanan' => 'Id Layanan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDokumenUrusanlayanans()
    {
        return $this->hasMany(DokumenUrusanlayananModel::className(), ['id_urusanlayanan' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormulirUrusanlayanans()
    {
        return $this->hasMany(FormulirUrusanlayananModel::className(), ['id_urusanlayanan' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrusan()
    {
        return $this->hasOne(UrusanModel::className(), ['id' => 'id_urusan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLayanan()
    {
        return $this->hasOne(LayananModel::className(), ['id' => 'id_layanan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrusanlayananUsers()
    {
        return $this->hasMany(UrusanlayananUserModel::className(), ['id_urusanlayanan' => 'id']);
    }
}
