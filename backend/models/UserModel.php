<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "auth_user".
 *
 * @property int $user_id
 * @property string $user_username
 * @property string $user_password
 * @property string $user_name
 * @property string $user_email
 * @property string $user_level
 * @property string $user_authKey
 * @property int $id_layanan
 *
 * @property TableLayanan $layanan
 * @property TableUrusanlayananUser[] $tableUrusanlayananUsers
 */
class UserModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'auth_user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_username', 'user_password', 'user_name', 'user_email', 'user_level', 'user_authKey', 'id_layanan'], 'required'],
            [['user_level'], 'string'],
            [['user_username'], 'string', 'max' => 35],
            [['user_password'], 'string', 'max' => 255],
            [['user_name', 'user_email'], 'string', 'max' => 50],
            [['user_authKey'], 'string', 'max' => 250],
            [['id_layanan'], 'exist', 'skipOnError' => true, 'targetClass' => LayananModel::className(), 'targetAttribute' => ['id_layanan' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'ID',
            'user_username' => 'Username',
            'user_password' => 'Password',
            'user_name' => 'Nama',
            'user_email' => 'Email',
            'user_level' => 'Level',
            'user_authKey' => 'Auth Key',
            'id_layanan' => 'Layanan',
        ];
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
    public function getTableUrusanlayananUsers()
    {
        return $this->hasMany(UrusanlayananUserModel::className(), ['id_user' => 'user_id']);
    }


      public function hak_akses(){
        return "<center><a href='auth-assignment?id=".$this->user_id."'><span class='fa fa-lock'></span></a></center>";
    }
}
