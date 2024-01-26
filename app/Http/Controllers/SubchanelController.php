<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subchanel;

class SubchanelController extends Controller
{
    public function __construct()
    {
        // Middleware 'auth:api' for all methods in the controller
        $this->middleware('auth:api');
    }

    public function index()
    {
        $subchanel = Subchanel::all();
        return response()->json($subchanel);
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
                'chanel_id' => 'required|exists:chanels,id',
            ]);

            // Check if the subcanal already exists
            $existingSubchanel = Subchanel::where('code', $request->input('code'))->first();

            if ($existingSubchanel) {
                return response()->json(['status'=> false, 'error' => 'El Subcanal con el codigo ingresado ya existe.'], 422);
            }

            // Create the subcanal
            $subchanel = Subchanel::create($request->all());

            return response()->json(['status'=> true, 'success' => 'Subcanal creado exitosamente', 'subcanal' => $subchanel], 201);
        } catch (QueryException $e) {
            // Capture database exceptions
            return response()->json(['status'=> false, 'error' => 'Se ha producido un error al crear el subcanal.', 'details' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            // Verify if got an known exeption code state
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            // Verify if code state is equal 0
            if ($statusCode == 0) {
                return response()->json(['status' => false, 'error' => 'Subcanal no encontrado'], 404);
            }
            // Handle if other code state exists
            if(stripos($e->getMessage(), 'No query results for model') !== false){
                return response()->json(['status'=>false ,'error' => 'Subcanal no encontrado', "message"=>"No se ha encontrado ningún resultado con el id proporcionado"], $statusCode );
            }else{
                return response()->json(['error' => $e->getMessage()], $statusCode );
            }

        }

    }

    public function show($subcanal)
    {
        try {
            $subchanel = Subchanel::findOrFail($subcanal);
            return response()->json($subchanel);
        } catch (\Exception $e) {
            // Verify if got an known exeption code state
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            // Verify if code state is equal 0
            if ($statusCode == 0) {
                return response()->json(['status' => false, 'error' => 'Subcanal no encontrado'], 404);
            }
            // Handle if other code state exists
            if(stripos($e->getMessage(), 'No query results for model') !== false){
                return response()->json(['status'=>false ,'error' => 'Subcanal no encontrado', "message"=>"No se ha encontrado ningún resultado con el id proporcionado"], $statusCode );
            }else{
                return response()->json(['error' => $e->getMessage()], $statusCode );
            }

        }
    }

    public function update(Request $request, $subcanal)
    {
        try {
            $subchanel = Subchanel::findOrFail($subcanal);

            $request->validate([
                'code' => 'required',
                'name' => 'required',
                // 'canal_id' => 'required|exists:canals,id',
            ]);

            $subchanel->update($request->all());

             return response()->json(['status' => true, 'success' => 'Subcanal actualizado exitosamente', 'subcanal' => $subchanel]);
         } catch (\Exception $e) {
             // Verify if got an known exeption code state
             $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

             // Verify if code state is equal 0
             if ($statusCode == 0) {
                 return response()->json(['status' => false, 'error' => 'Subcanal no encontrado'], 404);
             }
             // Handle if other code state exists
             if(stripos($e->getMessage(), 'No query results for model') !== false){
                 return response()->json(['status'=>false ,'error' => 'Subcanal no encontrado', "message"=>"No se ha encontrado ningún resultado con el id proporcionado"], $statusCode );
             }else{
                 return response()->json(['error' => $e->getMessage()], $statusCode );
             }

         }
    }

    public function destroy($subcanal)
    {
        try {
            $subchanel = Subcanal::findOrFail($subcanal);
            $subchanel->delete();

            return response()->json(['status' => true, 'success' => 'Subcanal eliminado exitosamente']);
        } catch (\Exception $e) {
            // Verify if got an known exeption code state
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            // Verify if code state is equal 0
            if ($statusCode == 0) {
                return response()->json(['status' => false, 'error' => 'Subcanal no encontrado'], 404);
            }
            // Handle if other code state exists
            if(stripos($e->getMessage(), 'No query results for model') !== false){
                return response()->json(['status'=>false ,'error' => 'Subcanal no encontrado', "message"=>"No se ha encontrado ningún resultado con el id proporcionado"], $statusCode );
            }else{
                return response()->json(['error' => $e->getMessage()], $statusCode );
            }

        }
    }


}
