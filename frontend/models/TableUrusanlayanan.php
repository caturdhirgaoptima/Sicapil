<?php

namespace frontend\models;

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
 * @property TableUrusanSyarat[] $tableUrusanSyarats
 * @property TableUrusan $urusan
 * @property TableLayanan $layanan
 */
class TableUrusanlayanan extends \yii\db\ActiveRecord
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
            [['id_urusan'], 'exist', 'skipOnError' => true, 'targetClass' => TableUrusan::className(), 'targetAttribute' => ['id_urusan' => 'id']],
            [['id_layanan'], 'exist', 'skipOnError' => true, 'targetClass' => TableLayanan::className(), 'targetAttribute' => ['id_layanan' => 'id']],
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
    public function getTableDokumenUrusanlayanans()
    {
        return $this->hasMany(TableDokumenUrusanlayanan::className(), ['id_urusanlayanan' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTableFormulirUrusanlayanans()
    {
        return $this->hasMany(TableFormulirUrusanlayanan::className(), ['id_urusanlayanan' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTableUrusanSyarats()
    {
        return $this->hasMany(TableUrusanSyarat::className(), ['id_urusanlayanan' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrusan()
    {
        return $this->hasOne(TableUrusan::className(), ['id' => 'id_urusan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLayanan()
    {
        return $this->hasOne(TableLayanan::className(), ['id' => 'id_layanan']);
    }
}
