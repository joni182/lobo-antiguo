<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * AnimalesSearch represents the model behind the search form of `app\models\Animales`.
 */
class AnimalesSearch extends Animales
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'raza_id', 'especie_id'], 'integer'],
            [['nombre', 'chip', 'sexo', 'observaciones', 'created_at'], 'safe'],
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
     * Creates data provider instance with search query applied.
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Animales::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'raza_id' => $this->raza_id,
            'especie_id' => $this->especie_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'chip', $this->chip])
            ->andFilterWhere(['ilike', 'sexo', $this->sexo])
            ->andFilterWhere(['ilike', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
}
