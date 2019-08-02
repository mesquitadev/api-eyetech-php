<?php

namespace App\Http\Controllers\Ambiente;

use App\Http\Controllers\ApiMessages;
use App\Http\Requests\MoradorRequest;
use App\Http\Resources\MoradorCollection;
use App\Models\Morador;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MoradoresController extends Controller
{
    private $morador;

    public function __construct(Morador $morador)
    {
        return $this->morador = $morador;
    }
    /**
     * Display a listing of the resource.
     *
     * @return MoradorCollection
     */
    public function index()
    {
        $morador   = $this->morador->all();
        return new MoradorCollection($morador);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MoradorRequest $request)
    {
        $data = $request->all();
        try {
            $morador = $this->morador->create($data);
            return response()->json([
                'data' => 'Morador cadastrado com sucesso!'
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
            $morador = $this->morador->findOrFail($id);
            return response()->json([
                'data' => $morador
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
            $morador = $this->morador->findOrFail($id);
            $morador->update($data);
            return response()->json([
                'data' => 'Morador atualizado com sucesso!'
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
            $morador = $this->morador->findOrFail($id);
            $morador->delete();
            return response()->json([
                'data' => 'Morador removido com sucesso!'
            ], 201);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 400);
        }
    }
}
