<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "table_dokumen_urusanlayanan".
 *
 * @property int $id
 * @property int $id_urusanlayanan
 * @property int $id_dokumen
 *
 * @property TableDokumen $dokumen
 * @property TableUrusanlayanan $urusanlayanan
 */
class DokumenUrusanlayananModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'table_dokumen_urusanlayanan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_urusanlayanan', 'id_dokumen'], 'required'],
            [['id_urusanlayanan', 'id_dokumen'], 'integer'],
            [['id_dokumen'], 'exist', 'skipOnError' => true, 'targetClass' => DokumenModel::className(), 'targetAttribute' => ['id_dokumen' => 'id']],
            [['id_urusanlayanan'], 'exist', 'skipOnError' => true, 'targetClass' => UrusanlayananModel::className(), 'targetAttribute' => ['id_urusanlayanan' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_urusanlayanan' => 'Id Urusanlayanan',
            'id_dokumen' => 'Id Dokumen',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDokumen()
    {
        return $this->hasOne(DokumenModel::className(), ['id' => 'id_dokumen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrusanlayanan()
    {
        return $this->hasOne(UrusanlayananModel::className(), ['id' => 'id_urusanlayanan']);
    }
}
