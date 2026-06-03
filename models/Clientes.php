<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Clientes".
 *
 * @property int $cliente_id
 * @property string $nombre
 * @property string $apellido
 * @property string $dni_cedula
 * @property string|null $telefono
 * @property string|null $email
 *
 * @property Ventas[] $ventas
 */
class Clientes extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Clientes';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['telefono', 'email'], 'default', 'value' => null],
            [['nombre', 'apellido', 'dni_cedula'], 'required'],
            [['nombre', 'apellido', 'email'], 'string', 'max' => 100],
            [['dni_cedula', 'telefono'], 'string', 'max' => 20],
            [['dni_cedula'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'cliente_id' => 'Cliente ID',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'dni_cedula' => 'Dni Cedula',
            'telefono' => 'Telefono',
            'email' => 'Email',
        ];
    }

    /**
     * Gets query for [[Ventas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVentas()
    {
        return $this->hasMany(Ventas::class, ['cliente_id' => 'cliente_id']);
    }

}
