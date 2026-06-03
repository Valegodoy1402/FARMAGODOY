<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Ventas".
 *
 * @property int $venta_id
 * @property int|null $cliente_id
 * @property int|null $medicamento_id
 * @property string|null $fecha_venta
 * @property int $cantidad
 * @property float $precio_unitario
 * @property float $total_pago
 *
 * @property Clientes $cliente
 * @property Medicamentos $medicamento
 */
class Ventas extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Ventas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cliente_id', 'medicamento_id'], 'default', 'value' => null],
            [['cliente_id', 'medicamento_id', 'cantidad'], 'integer'],
            [['fecha_venta'], 'safe'],
            [['cantidad', 'precio_unitario', 'total_pago'], 'required'],
            [['precio_unitario', 'total_pago'], 'number'],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Clientes::class, 'targetAttribute' => ['cliente_id' => 'cliente_id']],
            [['medicamento_id'], 'exist', 'skipOnError' => true, 'targetClass' => Medicamentos::class, 'targetAttribute' => ['medicamento_id' => 'medicamento_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'venta_id' => 'Venta ID',
            'cliente_id' => 'Cliente ID',
            'medicamento_id' => 'Medicamento ID',
            'fecha_venta' => 'Fecha Venta',
            'cantidad' => 'Cantidad',
            'precio_unitario' => 'Precio Unitario',
            'total_pago' => 'Total Pago',
        ];
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Clientes::class, ['cliente_id' => 'cliente_id']);
    }

    /**
     * Gets query for [[Medicamento]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMedicamento()
    {
        return $this->hasOne(Medicamentos::class, ['medicamento_id' => 'medicamento_id']);
    }

}
