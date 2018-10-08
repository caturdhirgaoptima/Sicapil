<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "auth_user".
 *
 * @property int $user_id
 * @property string $user_username
 * @property string $user_password
 * @property string $user_name
 * @property string $user_level
 * @property string $user_authKey
 * @property int $id_layanan
 *
 * @property TableLayanan $layanan
 * @property TableUrusanlayananUser[] $tableUrusanlayananUsers
 */
class AuthUser extends \yii\db\ActiveRecord
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
            [['user_id', 'user_username', 'user_password', 'user_name', 'user_level', 'user_authKey', 'id_layanan'], 'required'],
            [['user_id', 'id_layanan'], 'integer'],
            [['user_level'], 'string'],
            [['user_username'], 'string', 'max' => 35],
            [['user_password'], 'string', 'max' => 25],
            [['user_name'], 'string', 'max' => 50],
            [['user_authKey'], 'string', 'max' => 250],
            [['user_id'], 'unique'],
            [['id_layanan'], 'exist', 'skipOnError' => true, 'targetClass' => TableLayanan::className(), 'targetAttribute' => ['id_layanan' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'user_username' => 'User Username',
            'user_password' => 'User Password',
            'user_name' => 'User Name',
            'user_level' => 'User Level',
            'user_authKey' => 'User Auth Key',
            'id_layanan' => 'Id Layanan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLayanan()
    {
        return $this->hasOne(TableLayanan::className(), ['id' => 'id_layanan']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTableUrusanlayananUsers()
    {
        return $this->hasMany(TableUrusanlayananUser::className(), ['id_user' => 'user_id']);
    }
}
