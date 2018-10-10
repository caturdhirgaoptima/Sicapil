<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "table_urusanlayanan_user".
 *
 * @property int $id
 * @property string $id_user
 * @property int $id_urusanlayanan
 * @property string $tanggal
 * @property string $status
 * @property string $komentar
 *
 * @property TableDokumenUser[] $tableDokumenUsers
 * @property AuthUser $user
 * @property TableUrusanlayanan $urusanlayanan
 * @property TableUserFormulirValue[] $tableUserFormulirValues
 */
class UrusanlayananUserModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'table_urusanlayanan_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_user', 'id_urusanlayanan', 'tanggal', 'status', 'komentar'], 'required'],
            [['id_urusanlayanan'], 'integer'],
            [['tanggal'], 'safe'],
            [['id','status', 'komentar'], 'string'],
            [['id_user'], 'string', 'max' => 30],
            [['id'], 'unique'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => UserModel::className(), 'targetAttribute' => ['id_user' => 'user_id']],
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
            'id_user' => 'Nama',
            'id_urusanlayanan' => 'Keperluan',
            'tanggal' => 'Tanggal',
            'status' => 'Status',
            'komentar' => 'Pesan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDokumenUsers()
    {
        return $this->hasMany(DokumenUserModel::className(), ['id_urusanlayanan_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(UserModel::className(), ['user_id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrusanlayanan()
    {
        return $this->hasOne(UrusanlayananModel::className(), ['id' => 'id_urusanlayanan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserFormulirValues()
    {
        return $this->hasMany(UserFormulirValueModel::className(), ['id_urusanlayanan_user' => 'id']);
    }


    public function verifikasi(){
         return "<center><a href='verifikasi/detail/".$this->id."' style='margin:0px 10px'><span class='fa fa-eye'></span></a> </center>";
    }


    public function statusnya(){
        
        if($this->status=="verifikasi")
         return "<center><span class='fa fa-check'></span></center>";
     else if($this->status=="tolak")
        return "<center><span class='fa fa-remove'></span></center>";
    else if($this->status=="pending")
        return "<center><span class='fa fa-minus'></span></center>";
    else if($this->status=="perbaikan")
        return "<center><span class='fa fa-refresh'></span></center>";
    }
}
