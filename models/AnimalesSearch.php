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
            [
                [
                    'nombre',
                    'raza.nombre',
                    'especie.nombre',
                    'chip',
                    'sexo',
                    'peso',
                    'ppp',
                    'observaciones',
                    'created_at'
                ],
                
                'safe'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['raza.nombre', 'especie.nombre']);
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
        $query->joinWith(['especie e', 'raza r']);

        $dataProvider->sort->attributes['raza.nombre'] = [
            'asc' => ['r.nombre' => SORT_ASC],
            'desc' => ['r.nombre' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['especie.nombre'] = [
            'asc' => ['e.nombre' => SORT_ASC],
            'desc' => ['e.nombre' => SORT_DESC],
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            'created_at' => $this->created_at,
            'ppp' => $this->ppp,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre])
            ->andFilterWhere(['ilike', 'r.nombre', $this->getAttribute('raza.nombre')])
            ->andFilterWhere(['ilike', 'e.nombre', $this->getAttribute('especie.nombre')])
            ->andFilterWhere(['ilike', 'peso', $this->peso])
            ->andFilterWhere(['ilike', 'chip', $this->chip])
            ->andFilterWhere(['ilike', 'sexo', $this->sexo])
            ->andFilterWhere(['ilike', 'observaciones', $this->observaciones]);

        return $dataProvider;
    }
}
