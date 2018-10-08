<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "table_dokumen".
 *
 * @property int $id
 * @property string $nama_dokumen
 *
 * @property TableDokumenUrusanlayanan[] $tableDokumenUrusanlayanans
 * @property TableDokumenUser[] $tableDokumenUsers
 */
class DokumenModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'table_dokumen';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nama_dokumen'], 'required'],
            [['nama_dokumen'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nama_dokumen' => 'Nama Dokumen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDokumenUrusanlayanans()
    {
        return $this->hasMany(DokumenUrusanlayananModel::className(), ['id_dokumen' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDokumenUsers()
    {
        return $this->hasMany(DokumenUserModel::className(), ['id_dokumen' => 'id']);
    }
}
