<?php

namespace App\Repositories;

use App\Http\Controllers\Controller;
use App\Http\Resources\ListPokedexResource;
use App\Http\Resources\PokedexDetailResource;
use App\Models\Pokedex_dataset;

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
            })->paginate($this->response()->limit($request));

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
}
