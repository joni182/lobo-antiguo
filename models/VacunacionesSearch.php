<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Vacunaciones;

/**
 * VacunacionesSearch represents the model behind the search form of `app\models\Vacunaciones`.
 */
class VacunacionesSearch extends Vacunaciones
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'animal_id', 'vacuna_id', 'clinica_id'], 'integer'],
            [['fecha_hora'], 'safe'],
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
        $query = Vacunaciones::find();

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
            'animal_id' => $this->animal_id,
            'vacuna_id' => $this->vacuna_id,
            'clinica_id' => $this->clinica_id,
            'fecha_hora' => $this->fecha_hora,
        ]);

        return $dataProvider;
    }
}
