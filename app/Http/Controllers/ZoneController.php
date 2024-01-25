<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Zone;

class ZoneController extends Controller
{
    public function __construct()
    {
        // Middleware 'auth:api' for all methods in the controller
        $this->middleware('auth:api');
    }

    public function index()
    {
        try {
            $zones = Zone::all();
            return response()->json($zones);
        } catch (Exception $e) {
            return response()->json(['error' => 'Something went wrong.'], 500);
        }
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
                'name' => 'required',
                'code'=> 'required',
                'city_id' => 'required|exists:cities,id',
            ]);

             // Check if the zone already exists
            $existingZone = Zone::where('code', $request->input('code'))->first();

            if ($existingZone) {
                return response()->json(['status'=> false, 'error' => 'La Zona con el codigo ingresado ya existe.'], 422);
            }
            // Create the zone
            $zone = Zone::create($request->all());

            return response()->json(['status'=> true, 'success' => 'Zona creada exitosamente', 'Zone' => $zone], 201);
        } catch (QueryException $e) {
            // Capture database exceptions
            return response()->json(['status'=> false, 'error' => 'Se ha producido un error al crear la zona.', 'details' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            // Verify if got an known exeption code state
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            // Verify if code state is equal 0
            if ($statusCode == 0) {
                return response()->json(['status' => false, 'error' => 'Zona no encontrada'], 404);
            }
            // Handle if other code state exists
            if(stripos($e->getMessage(), 'No query results for model') !== false){
                return response()->json(['status'=>false ,'error' => 'Zona no encontrada', "message"=>"No se ha encontrado ningún resultado con el id proporcionado"], $statusCode );
            }else{
                return response()->json(['status' => false, 'error' => $e->getMessage()], $statusCode );
            }

        }
    }

    public function show($zona)
    {
        try {
            $zone = Zone::findOrFail($zona);
            return response()->json($zone);
        } catch (\Exception $e) {
            // Verify if got an known exeption code state
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            // Verify if code state is equal 0
            if ($statusCode == 0) {
                return response()->json(['status' => false, 'error' => 'Zona no encontrada'], 404);
            }
            // Handle if other code state exists
            if(stripos($e->getMessage(), 'No query results for model') !== false){
                return response()->json(['status'=>false ,'error' => 'Zona no encontrada', "message"=>"No se ha encontrado ningún resultado con el id proporcionado"], $statusCode );
            }else{
                return response()->json(['error' => $e->getMessage()], $statusCode );
            }

        }
    }

    public function update(Request $request, $zona)
    {
        try {
            $zone = Zone::findOrFail($zona);

            $request->validate([
                'code' => 'required',
                'name' => 'required',
                // 'city_id' => 'required|exists:cities,id',
            ]);

            $zone->update($request->all());

             return response()->json(['status' => true, 'success' => 'Zona actualizada exitosamente', 'zone' => $zone]);
         } catch (\Exception $e) {
             // Verify if got an known exeption code state
             $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

             // Verify if code state is equal 0
             if ($statusCode == 0) {
                 return response()->json(['status' => false, 'error' => 'Zona no encontrada'], 404);
             }
             // Handle if other code state exists
             if(stripos($e->getMessage(), 'No query results for model') !== false){
                 return response()->json(['status'=>false ,'error' => 'Zona no encontrada', "message"=>"No se ha encontrado ningún resultado con el id proporcionado"], $statusCode );
             }else{
                 return response()->json(['error' => $e->getMessage()], $statusCode );
             }

         }
    }

    public function destroy($zona)
    {
        try {
            $zone = Zone::findOrFail($zona);
            $zone->delete();

            return response()->json(['status' => true, 'success' => 'Zona eliminada exitosamente']);
        } catch (\Exception $e) {
            // Verify if got an known exeption code state
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            // Verify if code state is equal 0
            if ($statusCode == 0) {
                return response()->json(['status' => false, 'error' => 'Zona no encontrada'], 404);
            }
            // Handle if other code state exists
            if(stripos($e->getMessage(), 'No query results for model') !== false){
                return response()->json(['status'=>false ,'error' => 'Zona no encontrada', "message"=>"No se ha encontrado ningún resultado con el id proporcionado"], $statusCode );
            }else{
                return response()->json(['error' => $e->getMessage()], $statusCode );
            }

        }
    }

}
