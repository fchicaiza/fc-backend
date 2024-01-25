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

  public function show(Province $province)
    {
        try {
            return response()->json($province);
        } catch (ModelNotFoundException $e) {
            return response()->json(['status'=> false, 'error' => 'Provincia no encontrada'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function edit(Province $province)
    {
        try {
            return response()->json($province);
        } catch (ModelNotFoundException $e) {
            return response()->json(['status'=> false, 'error' => 'Provincia no encontrada'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function update(Request $request, Province $province)
    {
        try {
            // Validate the request
            $request->validate([
                'code' => 'required',
                'name' => 'required',
            ]);

            $province->update($request->all());

            return response()->json(['status'=> true, 'success' => 'Province actualizada exitosamente', 'province' => $province]);
        } catch (\Exception $e) {
            // Capture exceptions
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function destroy(Province $province)
    {
        try {
            $province->delete();

            return response()->json(['status'=> true, 'success' => 'Province eliminada exitosamente']);
        } catch (\Exception $e) {
            // Capture exceptions
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }
}
