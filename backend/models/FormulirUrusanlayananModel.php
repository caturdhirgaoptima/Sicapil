<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "table_formulir_urusanlayanan".
 *
 * @property int $id
 * @property int $id_formulir
 * @property int $id_urusanlayanan
 *
 * @property TableFormulir $formulir
 * @property TableUrusanlayanan $urusanlayanan
 */
class FormulirUrusanlayananModel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'table_formulir_urusanlayanan';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_formulir', 'id_urusanlayanan'], 'required'],
            [['id_formulir', 'id_urusanlayanan'], 'integer'],
            [['id_formulir'], 'exist', 'skipOnError' => true, 'targetClass' => FormulirModel::className(), 'targetAttribute' => ['id_formulir' => 'id']],
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
            'id_formulir' => 'Id Formulir',
            'id_urusanlayanan' => 'Id Urusanlayanan',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFormulir()
    {
        return $this->hasOne(FormulirModel::className(), ['id' => 'id_formulir']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUrusanlayanan()
    {
        return $this->hasOne(UrusanlayananModel::className(), ['id' => 'id_urusanlayanan']);
    }
}
