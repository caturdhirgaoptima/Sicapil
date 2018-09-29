<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "table_user_formulir_value".
 *
 * @property int $id
 * @property int $id_urusanlayanan_user
 * @property int $id_dataformulir
 * @property string $value
 * @property string $related
 *
 * @property TableDataFormulir $dataformulir
 * @property TableUrusanlayananUser $urusanlayananUser
 */
class UserFormulirModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'table_user_formulir_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_urusanlayanan_user', 'id_dataformulir', 'value', 'related'], 'required'],
            [['id_urusanlayanan_user', 'id_dataformulir'], 'integer'],
            [['value'], 'string'],
            [['related'], 'string', 'max' => 50],
            [['id_dataformulir'], 'exist', 'skipOnError' => true, 'targetClass' => TableDataFormulir::className(), 'targetAttribute' => ['id_dataformulir' => 'id']],
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
            'id_dataformulir' => 'Id Dataformulir',
            'value' => 'Value',
            'related' => 'Related',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataformulir()
    {
        return $this->hasOne(TableDataFormulir::className(), ['id' => 'id_dataformulir']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrusanlayananUser()
    {
        return $this->hasOne(TableUrusanlayananUser::className(), ['id' => 'id_urusanlayanan_user']);
    }
}
