<?php

namespace App\Http\Controllers\Ambiente;

use App\Http\Controllers\ApiMessages;
use App\Http\Requests\VisitanteRequest;
use App\Http\Resources\VisitanteCollection;
use App\Models\Visitante;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VisitanteController extends Controller
{
    private $visitante;
    public function __construct(Visitante $visitante)
    {
        $this->visitante = $visitante;
    }

    /**
     * Display a listing of the resource.
     *
     * @return VisitanteCollection
     */
    public function index()
    {
        $visitante = $this->visitante->all();
        return new VisitanteCollection($visitante);
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VisitanteRequest $request)
    {
        $data = $request->all();
        try {
            $visitante = $this->visitante->create($data);
            return response()->json([
                'data' => 'Visitante cadastrado com sucesso!'
            ], 201);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try{
            $visitante = $this->visitante->findOrFail($id);
            return response()->json([
                'data' => $visitante
            ], 201);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 400);
        }
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
        $data = $request->all();
        try{
            $visitante = $this->visitante->findOrFail($id);
            $visitante->update($data);
            return response()->json([
                'data' => 'Visitante atualizado com sucesso!'
            ], 201);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $visitante = $this->visitante->findOrFail($id);
            $visitante->delete();
            return response()->json([
                'data' => 'Visitante removido com sucesso!'
            ], 201);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 400);
        }
    }
}
