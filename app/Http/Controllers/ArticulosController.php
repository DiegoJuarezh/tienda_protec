<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\articulos;
use App\Models\articulos_precios;
use App\Models\articulos_cantidades;

use Carbon\Carbon;


class ArticulosController extends Controller
{
    private $USUARIO_ID = 1;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [];
        $data['usuario_id'] = $this->USUARIO_ID;

        return view('articulos', $data);
    }


    /**
     * Display the specified resource.
     */
    public function showArticulos(){
        $response = ['exito' => true, 'data' => []];

        $response['data']['articulos'] = articulos::
        select('*')
        ->get();

        return response()->json($response);
    }
    public function showArticulo(int $id){
        $response = ['exito' => true, 'data' => []];

        $response['data']['articulo'] = articulos::
        select('*')
        ->where('id', $id)
        ->first();

        return response()->json($response);
    }



    public function nuevoArticulo(Request $request){
        $response = ['exito' => true, 'data' => []];
        $today = Carbon::now();

        $model = new articulos;

        $articulo_id = $model->insertGetId([
            'cantidad' => $request->input('cantidad'),
            'nombre' => $request->input('nombre'),
            'precio' => $request->input('precio'),
            'created_at' => $today,
        ]);
        $response['data']['last_id'] = $articulo_id;


        $model_ap = new articulos_precios;
        $response['data']['last_id'] = $model_ap->insertGetId([
            'articulo_id' => $articulo_id,
            'nombre' => $request->input('nombre'),
            'precio' => $request->input('precio'),
            'usuario_id' => $this->USUARIO_ID,
            'created_at' => $today,
        ]);
        $model_ac = new articulos_cantidades;
        $response['data']['last_id'] = $model_ac->insertGetId([
            'articulo_id' => $articulo_id,
            'cantidad' => $request->input('cantidad'),
            'usuario_id' => $this->USUARIO_ID,
            'created_at' => $today,
        ]);

        return response()->json($response);
    }
    public function bajaArticulo(Request $request){
        $response = ['exito' => true, 'data' => []];
        // $today = Carbon::now();

        $articulo_id = $request->input('articulo_id');
        $model = articulos::find($articulo_id);
        $response['data']['articulo'] = $model->delete();

        return response()->json($response);
    }

    public function edicionArticulo(Request $request){
        $response = ['exito' => true, 'data' => []];
        $today = Carbon::now();

        $articulo_id = $request->input('articulo_id');
        $nuevo_nombre = $request->input('nuevo_nombre');
        $nuevo_precio = $request->input('nuevo_precio');

        articulos_precios::where('articulo_id', $articulo_id)->delete();

        $model = new articulos_precios;
        $response['data']['last_id'] = $model->insertGetId([
            'articulo_id' => $articulo_id,
            'nombre' => $nuevo_nombre,
            'precio' => $nuevo_precio,
            'usuario_id' => $this->USUARIO_ID,
            'created_at' => $today,
        ]);

        
        $articulo = articulos::find($articulo_id);
        $articulo->update(['precio' => $nuevo_precio]);

        return response()->json($response);
    }
    public function actualizacionArticulo(Request $request){
        $response = ['exito' => true, 'data' => []];
        $today = Carbon::now();

        $articulo_id = $request->input('articulo_id');
        $nueva_cantidad = $request->input('nueva_cantidad');

        articulos_cantidades::where('articulo_id', $articulo_id)->delete();

        $model = new articulos_cantidades;
        $response['data']['last_id'] = $model->insertGetId([
            'articulo_id' => $articulo_id,
            'cantidad' => $nueva_cantidad,
            'usuario_id' => $this->USUARIO_ID,
            'created_at' => $today,
        ]);


        $articulo = articulos::find($articulo_id);
        $articulo->update(['cantidad' => $nueva_cantidad]);

        return response()->json($response);
    }
}
