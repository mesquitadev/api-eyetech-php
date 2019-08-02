<?php

namespace App\Http\Controllers\Ambiente;

use App\Http\Requests\ApartamentoRequest;
use App\Http\Resources\ApartamentoCollection;
use App\Http\Resources\ApartamentoResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Apartamento;

class ApartamentosController extends Controller
{
    private $apartamento;

    public function __construct(Apartamento $apartamento)
    {
        return $this->apartamento = $apartamento;
    }

    /**
     * Display a listing of the resource.
     *
     * @return ApartamentoCollection
     */
    public function index()
    {

        $apartamentos = $this->apartamento->all();
//        return response()->json($apartamentos);
        return new ApartamentoCollection($apartamentos);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ApartamentoResource
     */
    public function show($id)
    {
        try{
            $apartamento = $this->apartamento->findOrFail($id);
            return response()->json([
                'data' => $apartamento
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ApartamentoRequest $request)
    {
        $data = $request->all();
        try {
            $apartamento = $this->apartamento->create($data);
            return response()->json([
                'data' => 'Apartamento cadastrado com sucesso!'
            ], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
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
            $apartamento = $this->apartamento->findOrFail($id);
            $apartamento->update($data);
            return response()->json([
                'data' => 'Apartamento atualizado com sucesso!'
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
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
            $apartamento = $this->apartamento->findOrFail($id);
            $apartamento->delete();
            return response()->json([
                'data' => 'Apartamento removido com sucesso!'
            ], 201);

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 401);
        }
    }
}
