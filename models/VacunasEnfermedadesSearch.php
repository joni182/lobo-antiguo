<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\VacunasEnfermedades;

/**
 * VacunasEnfermedadesSearch represents the model behind the search form of `app\models\VacunasEnfermedades`.
 */
class VacunasEnfermedadesSearch extends VacunasEnfermedades
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['vacuna_id', 'enfermedad_id'], 'integer'],
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
        $query = VacunasEnfermedades::find();

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
            'vacuna_id' => $this->vacuna_id,
            'enfermedad_id' => $this->enfermedad_id,
        ]);

        return $dataProvider;
    }
}
