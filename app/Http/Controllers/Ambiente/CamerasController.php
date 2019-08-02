<?php

namespace App\Http\Controllers\Ambiente;

use App\Http\Controllers\ApiMessages;
use App\Http\Requests\CameraRequest;
use App\Http\Resources\CameraCollection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Camera;
use Psy\Util\Json;

class CamerasController extends Controller
{
    private $camera;

    public function __construct(Camera $camera)
    {
        return $this->camera = $camera;
    }

    /**
     * Display a listing of the resource.
     *
     * @return CameraCollection
     */
    public function index()
    {
        $cameras = $this->camera->all();
//        return response()->json($apartamentos);
        return new CameraCollection($cameras);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Json Camera
     */
    public function show($id)
    {
        try{
            $camera = $this->camera->findOrFail($id);
            return response()->json([
                'data' => $camera
            ], 201);
        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CameraRequest $request)
    {
        $data = $request->all();
        try {
            $camera = $this->camera->create($data);
            return response()->json([
                'data' => 'Camera cadastrada com sucesso!'
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
            $camera = $this->camera->findOrFail($id);
            $camera->update($data);
            return response()->json([
                'data' => 'Câmera atualizada com sucesso!'
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
            $camera = $this->camera->findOrFail($id);
            $camera->delete();
            return response()->json([
                'data' => 'Camera removida com sucesso!'
            ], 201);

        } catch (\Exception $e) {
            $message = new ApiMessages($e->getMessage());
            return response()->json($message->getMessage(), 400);
        }
    }
}
