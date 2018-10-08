<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "table_dokumen".
 *
 * @property int $id
 * @property string $nama_dokumen
 * @property string $downloadable
 *
 * @property TableDokumenUrusanlayanan[] $tableDokumenUrusanlayanans
 * @property TableDokumenUser[] $tableDokumenUsers
 */
class TableDokumen extends \yii\db\ActiveRecord
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
            [['nama_dokumen', 'downloadable'], 'required'],
            [['nama_dokumen', 'downloadable'], 'string', 'max' => 200],
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
            'downloadable' => 'Downloadable',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTableDokumenUrusanlayanans()
    {
        return $this->hasMany(TableDokumenUrusanlayanan::className(), ['id_dokumen' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTableDokumenUsers()
    {
        return $this->hasMany(TableDokumenUser::className(), ['id_dokumen' => 'id']);
    }
}
