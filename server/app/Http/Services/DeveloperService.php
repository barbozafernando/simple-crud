<?php

namespace App\Http\Services;

use App\Models\Developer;
use Illuminate\Pagination\LengthAwarePaginator;

class DeveloperService
{
    public function getAll(string $rowsPerPage): LengthAwarePaginator
    {
        return Developer::paginate($rowsPerPage);
    }

    public function getById(string $id): Developer
    {
        return Developer::find($id);
    }

    public function save(array $newDeveloper): bool
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

    public function edit(array $editDeveloper, string $id): bool
    {
        try {
            $developer = Developer::find($id);

            $developer->nome = $editDeveloper['nome'];
            $developer->idade = $editDeveloper['idade'];
            $developer->sexo = $editDeveloper['sexo'];
            $developer->hobby = $editDeveloper['hobby'];
            $developer->data_nascimento = $editDeveloper['data_nascimento'];

            $developer->save();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }

    public function delete(string $id): bool
    {
        try {
            $developer = Developer::find($id);
            $developer->delete();

            return true;
        } catch (\Throwable $th) {
            return false;
        }
    }
}