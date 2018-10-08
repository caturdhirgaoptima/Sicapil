<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "table_urusanlayanan_user".
 *
 * @property int $id
 * @property int $id_user
 * @property int $id_urusanlayanan
 * @property string $tanggal
 *
 * @property TableDokumenUser[] $tableDokumenUsers
 * @property AuthUser $user
 * @property TableUserFormulirValue[] $tableUserFormulirValues
 */
class TableUrusanlayananUser extends \yii\db\ActiveRecord
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
            [['id', 'id_user', 'id_urusanlayanan', 'tanggal'], 'required'],
            [['id', 'id_user', 'id_urusanlayanan'], 'integer'],
            [['tanggal'], 'safe'],
            [['id'], 'unique'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => AuthUser::className(), 'targetAttribute' => ['id_user' => 'user_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'id_urusanlayanan' => 'Id Urusanlayanan',
            'tanggal' => 'Tanggal',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTableDokumenUsers()
    {
        return $this->hasMany(TableDokumenUser::className(), ['id_urusanlayanan_user' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(AuthUser::className(), ['user_id' => 'id_user']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTableUserFormulirValues()
    {
        return $this->hasMany(TableUserFormulirValue::className(), ['id_urusanlayanan_user' => 'id']);
    }
}
