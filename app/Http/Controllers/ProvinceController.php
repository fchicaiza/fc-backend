<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;

class ProvinceController extends Controller
{
    public function __construct()
    {
        // Middleware 'auth:api' for all methods in the controller
        $this->middleware('auth:api');
    }

    public function index()
    {
        $provinces = Province::all();
        return response()->json($provinces);
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

            // Check if the province already exists
            $existingProvince = Province::where('code', $request->input('code'))->first();

            if ($existingProvince) {
                return response()->json(['status'=> false, 'error' => 'La Provincia con el codigo ingresado ya existe.'], 422);
            }

            // Create the province
            $province = Province::create($request->all());

            return response()->json(['status'=> true, 'success' => 'Provincia creada exitosamente', 'province' => $province], 201);
        } catch (QueryException $e) {
            // Capture database exceptions
            return response()->json(['status'=> false, 'error' => 'Se ha producido un error al crear la provincia.', 'details' => $e->getMessage()], 500);
        } catch (\Exception $e) {
            // Capture other exceptions
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

  public function show($provincia)
    {
        try {
            $province = Province::findOrFail($provincia);
            return response()->json($province);
        } catch (\Exception $e) {
            // Verify if got an known exeption code state
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            // Verify if code state is equal 0
            if ($statusCode == 0) {
                return response()->json(['status' => false, 'error' => 'Provincia no encontrada'], 404);
            }
            // Handle if other code state exists
            if(stripos($e->getMessage(), 'No query results for model') !== false){
                return response()->json(['status'=>false ,'error' => 'Provincia no encontrada', "message"=>"No se ha encontrado ningún resultado con el codigo ingresado"], $statusCode );
            }else{
                return response()->json(['error' => $e->getMessage()], $statusCode );
            }

        }
    }

    public function edit($provincia)
    {
        try {
            $province = Province::findOrFail($provincia);
            return response()->json($province);
        } catch (\Exception $e) {
            // Verify if got an known exeption code state
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            // Verify if code state is equal 0
            if ($statusCode == 0) {
                return response()->json(['status' => false, 'error' => 'Provincia no encontrada'], 404);
            }
            // Handle if other code state exists
            if(stripos($e->getMessage(), 'No query results for model') !== false){
                return response()->json(['status'=>false ,'error' => 'Provincia no encontrada', "message"=>"No se ha encontrado ningún resultado con el codigo ingresado"], $statusCode );
            }else{
                return response()->json(['error' => $e->getMessage()], $statusCode );
            }

        }
    }

    public function update(Request $request, $provincia)
    {
        try {
            $province = Province::findOrFail($provincia);
            // Validate the request
            $request->validate([
                'code' => 'required',
                'name' => 'required',
            ]);

            $province->update($request->all());

            return response()->json(['status'=> true, 'success' => 'Province actualizada exitosamente', 'province' => $province]);
        } catch (\Exception $e) {
            // Verify if got an known exeption code state
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            // Verify if code state is equal 0
            if ($statusCode == 0) {
                return response()->json(['status' => false, 'error' => 'Provincia no encontrada'], 404);
            }
            // Handle if other code state exists
            if(stripos($e->getMessage(), 'No query results for model') !== false){
                return response()->json(['status'=>false ,'error' => 'Provincia no encontrada', "message"=>"No se ha encontrado ningún resultado con el codigo ingresado"], $statusCode );
            }else{
                return response()->json(['error' => $e->getMessage()], $statusCode );
            }
        }
    }

    public function destroy($provincia)
    {
        try {
            $province = Province::findOrFail($provincia);
            $province->delete();

            return response()->json(['status'=> true, 'success' => 'Province eliminada exitosamente']);
        } catch (\Exception $e) {
            // Verify if got an known exeption code state
            $statusCode = method_exists($e, 'getStatusCode') ? $e->getStatusCode() : 500;

            // Verify if code state is equal 0
            if ($statusCode == 0) {
                return response()->json(['status' => false, 'error' => 'Provincia no encontrada'], 404);
            }
            // Handle if other code state exists
            if(stripos($e->getMessage(), 'No query results for model') !== false){
                return response()->json(['status'=>false ,'error' => 'Provincia no encontrada', "message"=>"No se ha encontrado ningún resultado con el codigo ingresado"], $statusCode );
            }else{
                return response()->json(['error' => $e->getMessage()], $statusCode );
            }
        }
    }
}
