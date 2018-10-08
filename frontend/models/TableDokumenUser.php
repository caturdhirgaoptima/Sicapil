<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "table_dokumen_user".
 *
 * @property int $id
 * @property int $id_urusanlayanan_user
 * @property int $id_dokumen
 * @property string $file_dokumen
 *
 * @property TableDokumen $dokumen
 * @property TableUrusanlayananUser $urusanlayananUser
 */
class TableDokumenUser extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'table_dokumen_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_urusanlayanan_user', 'id_dokumen', 'file_dokumen'], 'required'],
            [['id_urusanlayanan_user', 'id_dokumen'], 'integer'],
            [['file_dokumen'], 'string'],
            [['id_dokumen'], 'exist', 'skipOnError' => true, 'targetClass' => TableDokumen::className(), 'targetAttribute' => ['id_dokumen' => 'id']],
            [['id_urusanlayanan_user'], 'exist', 'skipOnError' => true, 'targetClass' => TableUrusanlayananUser::className(), 'targetAttribute' => ['id_urusanlayanan_user' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_urusanlayanan_user' => 'Id Urusanlayanan User',
            'id_dokumen' => 'Id Dokumen',
            'file_dokumen' => 'File Dokumen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDokumen()
    {
        return $this->hasOne(TableDokumen::className(), ['id' => 'id_dokumen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrusanlayananUser()
    {
        return $this->hasOne(TableUrusanlayananUser::className(), ['id' => 'id_urusanlayanan_user']);
    }
}
