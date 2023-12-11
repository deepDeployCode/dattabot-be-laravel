<?php

namespace App\Interface;

use Illuminate\Http\Request;

interface PokedexInterface
{
    public function list(Request $request); //list pokedex
    public function detail($id); // detail pokedex
}
