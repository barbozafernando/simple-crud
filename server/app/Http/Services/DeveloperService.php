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
}