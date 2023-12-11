<?php

namespace App\Repositories;

use App\Models\Pokedex_dataset;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Resources\ListPokedexResource;
use App\Http\Resources\PokedexDetailResource;

trait PokedexRepositories
{
    public function response()
    {
        return new Controller;
    }

    public function listRepositories($request)
    {
        $data = Pokedex_dataset::orderBy($request->sort ? $request->sort : 'id', $request->typeSort ? $request->typeSort : 'ASC')
            ->when($request->name, function ($query) use ($request) {
                return $query->where('name', 'like', "%{$request->name}%");
            })
            ->when($request->pokedex_number, function ($query) use ($request) {
                return $query->where('pokedex_number', 'like', "%{$request->pokedex_number}%");
            })
            ->when($request->german_name, function ($query) use ($request) {
                return $query->where('german_name', 'like', "%{$request->german_name}%");
            })
            ->when($request->japanese_name, function ($query) use ($request) {
                return $query->where('japanese_name', 'like', "%{$request->japanese_name}%");
            })
            ->when($request->generation, function ($query) use ($request) {
                return $query->where('generation', 'like', "%{$request->generation}%");
            })
            ->when($request->status, function ($query) use ($request) {
                return $query->where('status', 'like', "%{$request->status}%");
            })
            ->when($request->species, function ($query) use ($request) {
                return $query->where('species', 'like', "%{$request->species}%");
            })
            ->paginate($this->response()->limit($request));

        return ListPokedexResource::collection($data);
    }

    public function detailRepositories($id)
    {
        if ($detail = Pokedex_dataset::whereId($id)->first()) {
            $result = $this->response()->ok(new PokedexDetailResource($detail));
        } else {
            $result = $this->response()->error('id pokedex not found');
        }
        return $result;
    }

    private static function labelType1()
    {
        return ['Grass', 'Fire', 'Water', 'Bug', 'Normal', 'Dark', 'Poison', 'Electric', 'Ice', 'Ground', 'Fairy', 'Steel', 'Fighting', 'Psychic', 'Rock', 'Ghost'];
    }

    private static function valueType1()
    {
        return
            [
                DB::table('pokedex_dataset')->where('type_1', 'Grass')->get()->count(),
                DB::table('pokedex_dataset')->where('type_1', 'Fire')->get()->count(),
                DB::table('pokedex_dataset')->where('type_1', 'Water')->get()->count(),
                DB::table('pokedex_dataset')->where('type_1', 'Water')->get()->count(),
                DB::table('pokedex_dataset')->where('type_1', 'Bug')->get()->count(),
                DB::table('pokedex_dataset')->where('type_1', 'Normal')->get()->count(),
                DB::table('pokedex_dataset')->where('type_1', 'Dark')->get()->count(),
                DB::table('pokedex_dataset')->where('type_1', 'Poison')->get()->count(),
                DB::table('pokedex_dataset')->where('type_1', 'Electric')->get()->count(),
                DB::table('pokedex_dataset')->where('type_1', 'Ice')->get()->count(),
                DB::table('pokedex_dataset')->where('type_1', 'Ground')->get()->count(),
                DB::table('pokedex_dataset')->where('type_1', 'Fairy')->get()->count(),
                DB::table('pokedex_dataset')->where('type_1', 'Steel')->get()->count(),
                DB::table('pokedex_dataset')->where('type_1', 'Fighting')->get()->count(),
                DB::table('pokedex_dataset')->where('type_1', 'Psychic')->get()->count(),
                DB::table('pokedex_dataset')->where('type_1', 'Rock')->get()->count(),
                DB::table('pokedex_dataset')->where('type_1', 'Ghost')->get()->count(),
            ];
    }

    private static function highScores()
    {
        return DB::table('pokedex_dataset')->orderByDesc('total_points')->limit(5)->get(['total_points', 'name']);
    }

    public function visualDataPokemonRepositories($request)
    {
        $type_1_label[] = $this->labelType1();
        $valueType1[] = $this->valueType1();
        for ($x = 0; $x <= count($this->labelType1()); $x++) {
            return $this->response()->ok(['label_type_1' => $type_1_label[$x], 'value_type_1' => $valueType1[$x], 'high_scores' => $this->highScores()], 'Successfully Data Visualization Pokemon');
        }
    }
}
