<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chanel;

class ChanelController extends Controller
{
    public function __construct()
    {
        // Middleware 'auth:api' for all methods in the controller
        $this->middleware('auth:api');
    }

    public function index()
    {
        $chanels = Chanel::all();
        return response()->json($chanels);
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
            $existingChanel = Chanel::where('id', $request->input('id'))->first();

            if ($existingChanel) {
                return response()->json(['status'=> false, 'error' => 'El canal con el id proporcionado ya existe.'], 422);
            }

            // Create the canal
            $chanel = Chanel::create($request->all());

                  return response()->json(['status'=> true, 'success' => 'Canal creado exitosamente', 'canal' => $chanel], 201);
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

    public function show($canal)
    {
        try {
            $chanel = Chanel::findOrFail($canal);
            return response()->json($chanel);
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

    public function update(Request $request, $canal)
    {
        try {
            $chanel = Canal::findOrFail($canal);
            // Validate the request
            $request->validate([
                'code' => 'required',
                'name' => 'required',
            ]);

            $chanel->update($request->all());

            return response()->json(['status'=> true, 'success' => 'Canal actualizado exitosamente', 'canal' => $chanel]);
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

    public function destroy($canal)
    {
        try {
            $chanel = Canal::findOrFail($canal);
            $chanel->delete();

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
