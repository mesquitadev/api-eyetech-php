<?php

namespace App\Http\Controllers\Ambiente;

use App\Http\Controllers\ApiMessages;
use App\Http\Requests\VeiculoRequest;
use App\Http\Resources\VeiculoCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Veiculo;

class VeiculosController extends Controller
{
    private $veiculo;
    public function __construct(Veiculo $veiculo)
    {
        $this->veiculo = $veiculo;
    }

    /**
     * Display a listing of the resource.
     *
     * @return VeiculoCollection
     */
    public function index()
    {
        $veiculo = $this->veiculo->all();
        return new VeiculoCollection($veiculo);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VeiculoRequest $request)
    {
        $data = $request->all();
        try {
            $veiculo = $this->veiculo->create($data);
            return response()->json([
                'data' => 'Veiculo cadastrado com sucesso!'
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
            $veiculo = $this->veiculo->findOrFail($id);
            return response()->json([
                'data' => $veiculo
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
            $veiculo = $this->veiculo->findOrFail($id);
            $veiculo->update($data);
            return response()->json([
                'data' => 'Veículo atualizado com sucesso!'
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
            $veiculo = $this->veiculo->findOrFail($id);
            $veiculo->delete();
            return response()->json([
                'data' => 'Veiculo removido com sucesso!'
            ], 201);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 400);
        }
    }
}
