<?php

namespace App\Http\Controllers;

use App\Models\Fluxos;
use App\Http\Requests\StoreFluxosRequest;
use App\Http\Requests\UpdateFluxosRequest;

use Illuminate\Http\Request;

class FluxosController extends Controller
{
    private Fluxos $fluxos;

    public function __construct(Fluxos $fluxos){
        $this->fluxos = $fluxos;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fluxos = $this->fluxos->all();
        return response()->json ($fluxos, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->fluxos->rules(), $this->fluxos->feedback());
        $fluxos = $this->fluxos->create($request->all());
        return response()->json ($fluxos, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        /*return $fluxos;*/

        $fluxos = $this->fluxos->find($id);
        if($fluxos === null){
            return response()->json( ['erro' => 'Recurso pesquisado não encontrado!'], 404);
        }
        return response()->json ($fluxos, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $fluxos = $this->fluxos->find($id);
        if($fluxos === null){
            return response()->json( ['erro' => 'Impossível atualizar. Recurso solicitado não existe!'], 404);
        }

        if($request->method() === 'PATCH'){
            $regrasDinamicas = array();

            foreach($fluxos->rules() as $input => $regra){
                if(array_key_exists($input, $request->all())){
                    $regrasDinamicas[$input] = $regra;
                }
            }

            $request->validate($regrasDinamicas, $fluxos->feedback());
        } 
        else{
            $request->validate($fluxos->rules(), $fluxos->feedback());
        }

        $fluxos->update($request->all());
        return response()->json ($fluxos, 200);
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        $fluxos = $this->fluxos->find($id);
        if($fluxos === null){
            return response()->json( ['erro' => 'Impossível deletar. Recurso solicitado não existe!'], 404);
        }
        $fluxos->delete();
        return response()-> json(['msg' => 'Removido com sucesso'], 200);
    }
}
