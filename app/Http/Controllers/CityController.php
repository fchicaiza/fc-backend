<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class CityController extends Controller
{
    public function __construct()
    {
        // Middleware 'auth:api' for all methods in the controller
        $this->middleware('auth:api');
    }

    public function index()
    {
        $cities = City::all();
        return response()->json($cities);
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

            // Check if the city already exists
            $existingCity = City::where('code', $request->input('code'))->first();

            if ($existingCity) {
                return response()->json(['status'=> false, 'error' => 'La Ciudad con el codigo ingresado ya existe.'], 422);
            }

            // Create the city
            $city = City::create($request->all());

            return response()->json(['status'=> true, 'success' => 'Ciudad creada exitosamente', 'province' => $city], 201);
        } catch (QueryException $e) {
            // Capture database exceptions
            return response()->json(['status'=> false, 'error' => 'Se ha producido un error al crear la provincia.', 'details' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            // Capture other exceptions
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }

    }


    public function show($ciudad)
    {
        try {
            $city = City::findOrFail($ciudad);
            return response()->json($city);
        } catch (\Exception $e) {
            // Verify if got an known exeption code state
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            // Verify if code state is equal 0
            if ($statusCode == 0) {
                return response()->json(['status' => false, 'error' => 'Ciudad no encontrada'], 404);
            }
            // Handle if other code state exists
            if(stripos($e->getMessage(), 'No query results for model') !== false){
                return response()->json(['status'=>false ,'error' => 'Ciudad no encontrada', "message"=>"No se ha encontrado ningún resultado con el codigo ingresado"], $statusCode );
            }else{
                return response()->json(['error' => $e->getMessage()], $statusCode );
            }

        }
    }

    public function edit($ciudad)
    {
        try {
            $city = City::findOrFail($ciudad);
            return response()->json($city);
        } catch (ModelNotFoundException $e) {
            return response()->json(['status' => false, 'error' => 'Provincia no encontrada'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }


    public function update(Request $request, $ciudad)
    {
        try {
            $city = City::findOrFail($ciudad);

            $request->validate([
                'code' => 'required',
                'name' => 'required',
                'province_id' => 'required|exists:provinces,id',
            ]);

            $city->update($request->all());

             return response()->json(['status' => true, 'success' => 'Ciudad actualizada exitosamente', 'city' => $city]);
         } catch (\Exception $e) {
             // Verify if got an known exeption code state
             $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

             // Verify if code state is equal 0
             if ($statusCode == 0) {
                 return response()->json(['status' => false, 'error' => 'Ciudad no encontrada'], 404);
             }
             // Handle if other code state exists
             if(stripos($e->getMessage(), 'No query results for model') !== false){
                 return response()->json(['status'=>false ,'error' => 'Ciudad no encontrada', "message"=>"No se ha encontrado ningún resultado con el codigo ingresado"], $statusCode );
             }else{
                 return response()->json(['error' => $e->getMessage()], $statusCode );
             }

         }
    }

    public function destroy($ciudad)
    {
        try {
            $city = City::findOrFail($ciudad);
            $city->delete();

            return response()->json(['status' => true, 'success' => 'Ciudad eliminada exitosamente']);
        } catch (\Exception $e) {
            // Verify if got an known exeption code state
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            // Verify if code state is equal 0
            if ($statusCode == 0) {
                return response()->json(['status' => false, 'error' => 'Ciudad no encontrada'], 404);
            }
            // Handle if other code state exists
            if(stripos($e->getMessage(), 'No query results for model') !== false){
                return response()->json(['status'=>false ,'error' => 'Ciudad no encontrada', "message"=>"No se ha encontrado ningún resultado con el codigo ingresado"], $statusCode );
            }else{
                return response()->json(['error' => $e->getMessage()], $statusCode );
            }

        }
    }


}
