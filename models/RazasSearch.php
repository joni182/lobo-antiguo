<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RazasSearch represents the model behind the search form of `app\models\Razas`.
 */
class RazasSearch extends Razas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'especie_id'], 'integer'],
            [['nombre', 'especie.nombre'], 'safe'],
        ];
    }

    public function attributes()
    {
        return array_merge(parent::attributes(), ['especie.nombre']);
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
        $query = Razas::find();

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

        $query->joinWith('especie e');

        $dataProvider->sort->attributes['especie.nombre'] = [
            'asc' => ['e.nombre' => SORT_ASC],
            'desc' => ['e.nombre' => SORT_DESC],
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'especie_id' => $this->especie_id,
        ]);

        $query->andFilterWhere(['ilike', 'nombre', $this->nombre]);
        $query->andFilterWhere(['ilike', 'e.nombre', $this->getAttribute('especie.nombre')]);

        return $dataProvider;
    }
}
