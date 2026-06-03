<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ventas;

/**
 * VentasSearch represents the model behind the search form of `app\models\Ventas`.
 */
class VentasSearch extends Ventas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['venta_id', 'cliente_id', 'medicamento_id', 'cantidad'], 'integer'],
            [['fecha_venta'], 'safe'],
            [['precio_unitario', 'total_pago'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
    public function search($params, $formName = null)
    {
        $query = Ventas::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'venta_id' => $this->venta_id,
            'cliente_id' => $this->cliente_id,
            'medicamento_id' => $this->medicamento_id,
            'fecha_venta' => $this->fecha_venta,
            'cantidad' => $this->cantidad,
            'precio_unitario' => $this->precio_unitario,
            'total_pago' => $this->total_pago,
        ]);

        return $dataProvider;
    }
}
