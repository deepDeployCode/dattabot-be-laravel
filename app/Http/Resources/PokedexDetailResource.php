<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PokedexDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'pokedex_data' => [
                'pokedex_number' => $this->pokedex_number,
                'name' => $this->name,
                'german_name' => $this->german_name,
                'japanese_name' => $this->japanese_name,
                'generation' => $this->generation,
                'species' => $this->species,
                'type' => [
                    'number' => $this->type_number,
                    'primary' => $this->type_1,
                    'secondary' => $this->type_2,
                ],
                'height_m' => $this->height_m,
                'weight_kg' => $this->weight_kg,
                'abilities' => [
                    'number' => $this->abilities_number,
                    'primary' => $this->ability_1,
                    'secondary' => $this->ability_2,
                    'hidden' => $this->ability_hidden,
                ]
            ],
            'base_state' => [
                'total_points' => $this->total_points,
                'hp' => $this->hp,
                'attack' => $this->attack,
                'defense' => $this->defense,
                'sp' => [
                    'attack' => $this->sp_attack,
                    'defense' => $this->sp_defense,
                    'speed' => $this->speed,
                ],
            ],
            'training' => [
                'catch_rate' => $this->catch_rate,
                'base_friendship' => $this->base_friendship,
                'base_experience' => $this->base_experience,
                'growth_rate' => $this->growth_rate,
            ],
            'breeding' => [
                'egg_type_number' => $this->egg_type_number,
                'egg_type' => [
                    'first' => $this->egg_type_1,
                    'secondary' => $this->egg_type_2,
                ],
                'percentage_male' => $this->percentage_male,
                'egg_cycles' => $this->egg_cycles,
            ],
            'type_defenses' => [
                "against_normal" => $this->against_normal,
                "against_fire" => $this->against_fire,
                "against_water" => $this->against_water,
                "against_electric" => $this->against_electric,
                "against_grass" => $this->against_grass,
                "against_ice" => $this->against_ice,
                "against_fight" => $this->against_fight,
                "against_poison" => $this->against_poison,
                "against_ground" => $this->against_ground,
                "against_flying" => $this->against_flying,
                "against_psychic" => $this->against_psychic,
                "against_bug" => $this->against_bug,
                "against_rock" => $this->against_rock,
                "against_ghost" => $this->against_ghost,
                "against_dragon" => $this->against_dragon,
                "against_dark" => $this->against_dark,
                "against_steel" => $this->against_steel,
                "against_fairy" => $this->against_fairy,
            ],
        ];
    }
}
