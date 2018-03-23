<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VacunasAnimales;

/**
 * VacunasAnimalesSearch represents the model behind the search form of `app\models\VacunasAnimales`.
 */
class VacunasAnimalesSearch extends VacunasAnimales
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['animal_id', 'vacuna_id'], 'integer'],
            [['fecha'], 'safe'],
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = VacunasAnimales::find();

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
            'animal_id' => $this->animal_id,
            'vacuna_id' => $this->vacuna_id,
            'fecha' => $this->fecha,
        ]);

        return $dataProvider;
    }
}
