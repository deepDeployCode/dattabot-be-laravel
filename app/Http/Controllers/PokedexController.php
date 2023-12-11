<?php

namespace App\Http\Controllers;

use App\Interface\PokedexInterface;
use Illuminate\Http\Request;
use App\Repositories\PokedexRepositories;

class PokedexController extends Controller implements PokedexInterface
{
    use PokedexRepositories;

    public function list(Request $request)
    {
        return $this->listRepositories($request);
    }

    public function detail($id)
    {
        return $this->detailRepositories($id);
    }

    public function visualDataPokemon(Request $request)
    {
        return $this->visualDataPokemonRepositories($request);
    }
}
