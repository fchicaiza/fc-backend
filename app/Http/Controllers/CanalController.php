<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Canal;

class CanalController extends Controller
{
    public function __construct()
    {
        // Middleware 'auth:api' for all methods in the controller
        $this->middleware('auth:api');
    }

    public function index()
    {
        $canals = Canal::all();
        return response()->json($canals);
    }

    public function store(Request $request)
    {
        try {
            // Verify the existence of a token
            if (!$request->bearerToken()) {
                return response()->json(['error' => 'Unauthorized. Token not provided.'], 401);
            }

            // Validate the request
            $request->validate([
                'code' => 'required',
                'name' => 'required',
            ]);

            // Check if the canal already exists
            $existingCanal = Canal::where('id', $request->input('id'))->first();

            if ($existingCanal) {
                return response()->json(['status'=> false, 'error' => 'El canal con el id proporcionado ya existe.'], 422);
            }

            // Create the canal
            $canal = Canal::create($request->all());

                  return response()->json(['status'=> true, 'success' => 'Canal creado exitosamente', 'canal' => $canal], 201);
              } catch (QueryException $e) {
                  // Capture database exceptions
                  return response()->json(['status'=> false, 'error' => 'Se ha producido un error al crear el canal.', 'details' => $e->getMessage()], 500);
              } catch (\Exception $e) {
                  // Verify if got an known exeption code state
                  $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

                  // Verify if code state is equal 0
                  if ($statusCode == 0) {
                      return response()->json(['status' => false, 'error' => 'Canal no encontrada'], 404);
                  }
                  // Handle if other code state exists
                  if(stripos($e->getMessage(), 'No query results for model') !== false){
                      return response()->json(['status'=>false ,'error' => 'Canal no encontrado', "message"=>"No se ha encontrado ningún resultado con el id proporcionado"], $statusCode );
                  }else{
                      return response()->json(['error' => $e->getMessage()], $statusCode );
                  }

              }
    }

    public function show($canale)
    {
        try {
            $canal = Canal::findOrFail($canale);
            return response()->json($canal);
        } catch (\Exception $e) {
            // Verify if got an known exeption code state
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            // Verify if code state is equal 0
            if ($statusCode == 0) {
                return response()->json(['status' => false, 'error' => 'Canal no encontrada'], 404);
            }
            // Handle if other code state exists
            if(stripos($e->getMessage(), 'No query results for model') !== false){
                return response()->json(['status'=>false ,'error' => 'Canal no encontrado', "message"=>"No se ha encontrado ningún resultado con el id proporcionado"], $statusCode );
            }else{
                return response()->json(['error' => $e->getMessage()], $statusCode );
            }

        }
    }

    public function update(Request $request, $canale)
    {
        try {
            $canal = Canal::findOrFail($canale);
            // Validate the request
            $request->validate([
                'code' => 'required',
                'name' => 'required',
            ]);

            $canal->update($request->all());

            return response()->json(['status'=> true, 'success' => 'Canal actualizado exitosamente', 'canal' => $canal]);
        } catch (\Exception $e) {
            // Verify if got an known exeption code state
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            // Verify if code state is equal 0
            if ($statusCode == 0) {
                return response()->json(['status' => false, 'error' => 'Canal no encontrado'], 404);
            }
            // Handle if other code state exists
            if(stripos($e->getMessage(), 'No query results for model') !== false){
                return response()->json(['status'=>false ,'error' => 'Canal no encontrado', "message"=>"No se ha encontrado ningún resultado con el id proporcionado"], $statusCode );
            }else{
                return response()->json(['error' => $e->getMessage()], $statusCode );
            }
        }


    }

    public function destroy($canale)
    {
        try {
            $canal = Canal::findOrFail($canale);
            $canal->delete();

            return response()->json(['status'=> true, 'success' => 'Canal eliminado exitosamente']);
        } catch (\Exception $e) {
            // Verify if got an known exeption code state
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            // Verify if code state is equal 0
            if ($statusCode == 0) {
                return response()->json(['status' => false, 'error' => 'Canal no encontrado'], 404);
            }
            // Handle if other code state exists
            if(stripos($e->getMessage(), 'No query results for model') !== false){
                return response()->json(['status'=>false ,'error' => 'Canal no encontrado', "message"=>"No se ha encontrado ningún resultado con el id proporcionado"], $statusCode );
            }else{
                return response()->json(['error' => $e->getMessage()], $statusCode );
            }
        }
    }

}
