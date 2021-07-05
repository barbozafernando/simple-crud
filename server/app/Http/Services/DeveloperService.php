<?php

namespace App\Http\Services;

use App\Models\Developer;

class DeveloperService
{
    public function getAll()
    {
        return Developer::paginate(5);
    }

    public function getById($id)
    {
        return Developer::find($id);
    }

    public function save($newDeveloper)
    {
        try {
            $developer = new Developer();

            $developer->nome = $newDeveloper['nome'];
            $developer->idade = $newDeveloper['idade'];
            $developer->sexo = $newDeveloper['sexo'];
            $developer->hobby = $newDeveloper['hobby'];
            $developer->data_nascimento = $newDeveloper['data_nascimento'];

            $developer->save();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}