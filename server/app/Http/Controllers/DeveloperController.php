<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use Illuminate\Http\Request;
use App\Http\Services\DeveloperService;

class DeveloperController extends Controller
{
    private $developerService;

    public function __construct(DeveloperService $developerService)
    {
        $this->developerService = $developerService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $developers = $this->developerService->getAll();

        return response()->json($developers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $developer = $request->only(
            ['nome', 'idade', 'sexo', 'hobby', 'data_nascimento']
        );

        $isOk = $this->developerService->save($developer);

        if (! $isOk) {
            return response()->json(
                ['error' => 
                    ['message' => 'There was a problem with the provided data. Try again later.']
                ],
                400
            );
        }

        return response()->json([], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $developer = $this->developerService->getById($id);

        if (! $developer) {
            return response()->json(
                ['message' => 'Developer not found'], 
                404
            );
        }

        return response()->json($developer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $developer = $request->only(
            ['nome', 'idade', 'sexo', 'hobby', 'data_nascimento']
        );

        $isOk = $this->developerService->edit($developer, $id);

        if (! $isOk) {
            return response()->json(
                ['error' => 
                    ['message' => 'There was a problem with the provided data. Try again later.']
                ],
                400
            );
        }

        return response()->json([], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
