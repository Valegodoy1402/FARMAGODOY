<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Medicamentos;

/**
 * MedicamentosSearch represents the model behind the search form of `app\models\Medicamentos`.
 */
class MedicamentosSearch extends Medicamentos
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['medicamento_id', 'stock'], 'integer'],
            [['nombre_comercial', 'componente_activo', 'laboratorio', 'fecha_vencimiento'], 'safe'],
            [['precio'], 'number'],
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
        $query = Medicamentos::find();

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
            'medicamento_id' => $this->medicamento_id,
            'precio' => $this->precio,
            'stock' => $this->stock,
            'fecha_vencimiento' => $this->fecha_vencimiento,
        ]);

        $query->andFilterWhere(['like', 'nombre_comercial', $this->nombre_comercial])
            ->andFilterWhere(['like', 'componente_activo', $this->componente_activo])
            ->andFilterWhere(['like', 'laboratorio', $this->laboratorio]);

        return $dataProvider;
    }
}
