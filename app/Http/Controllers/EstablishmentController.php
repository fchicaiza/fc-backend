<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Establishment;
use App\Models\Province;
use App\Models\City;
use App\Models\Zone;
use App\Models\Chanel;
use App\Models\Subchanel;
use App\Models\Chain;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class EstablishmentController extends Controller
{

    public function __construct()
    {
        // Middleware 'auth:api' for all methods in the controller
        $this->middleware('auth:api');
    }

    public function index()
    {
        $establishments = Establishment::all();
        return response()->json($establishments);
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
                'name'=>'required',
                'block_address' => 'required',
                'main_street_address' => 'required',
                'address_number' => 'required',
                'cross_address' => 'required',
                'reference_address' => 'required',
                'administrator' => 'required',
                'contact_phones' => 'required',
                'contact_email' => 'required|email',
                'location' => 'required',
            ]);

            // Check if the establishment already exists
            $existingEstablishment = Establishment::where('name', $request->input('name'))->first();

            if ($existingEstablishment) {
                return response()->json(['status' => false, 'error' => 'El Establecimiento con el codigo ingresado ya existe.'], 422);
            }

            // Create the establishment
            $establishment = Establishment::create($request->all());

            $establishment->load('province', 'city', 'zone', 'chanel', 'subchanel', 'chain');

            $user = auth()->user();

            // Get Username
            $userName = $user->name . " " . $user->surname;

            $code = $this->generateCode($establishment);

            $formattedResponse = [

                    'nombre' => $establishment->name,
                    'direccion_manzana' => $establishment->block_address,
                    'direccion_calle_principal' => $establishment->main_street_address,
                    'direccion_numero' => $establishment->address_number,
                    'direccion_referencia' => $establishment->reference_address,
                    'administrador' => $establishment->administrator,
                    'telefonos_contacto' => $establishment->contact_phones,
                    'email_contacto' => $establishment->contact_email,
                    'geolocalizacion' => $establishment->location,
                    'uuid_provincia' => $establishment->province_id,
                    'codigo_provincia' => $establishment->province->code,
                    'nombre_provincia' => $establishment->province->name,
                    'uuid_ciudad' => $establishment->city->id,
                    'codigo_ciudad' => $establishment->province->code . '-' . $establishment->city->code,
                    'nombre_ciudad' => $establishment->city->name,
                    'uuid_zona' => $establishment->zone->id,
                    'codigo_zona' => $establishment->province->code . '-' . $establishment->city->code . '-' . $establishment->zone->code,
                    'nombre_zona' => $establishment->zone->name,
                    'uuid_chanel' => $establishment->chanel->id,
                    'codigo_chanel' => $establishment->chanel->code,
                    'nombre_chanel' => $establishment->chanel->name,
                    'uuid_subchanel' => $establishment->subchanel->id,
                    'codigo_subchanel' => $establishment->chanel->code . '-' . $establishment->subchanel->code,
                    'nombre_subchanel' => $establishment->subchanel->name,
                    'uuid_cadena' => $establishment->chain->id,
                    'codigo_cadena' => $establishment->chain->code,
                    'nombre_cadena' => $establishment->chain->name,
                    'codigo' => $code,
                    'creado_por' => $userName,
                    'id' => $establishment->id,
                    'updated_at' => $establishment->updated_at,
                    'created_at' => $establishment->created_at
            ];
            return response()->json(
                [
                    'status' => true,
                    'code' => 200,
                    'message' => "Establecimiento {$establishment->nombre} creado satisfactoriamente",
                    'oEstablecimiento' => $formattedResponse,
                    'errors' => null,
                ], 201
            );
        } catch (\Exception $e) {
            // Capture and handle exceptions
            return $this->handleException($e);
        }
    }

    private function generateCode($establishment)
    {
            return $establishment->province->code . '-' .
            $establishment->city->code . '-' .
            $establishment->zone->code . '-000-000-' .
            $establishment->chanel->code .'-'. $establishment->subchanel->code . '-000-' .
            $establishment->chain->code . '-' .
            str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
    }

    private function handleException($exception)
    {
        // Handle different types of exceptions and return appropriate responses
        $statusCode = method_exists($exception, 'getStatusCode') ? $exception->getStatusCode() : 500;

        if ($statusCode == 0) {
            return response()->json(['status' => false, 'error' => 'Establecimiento no encontrado'], 404);
        }

        if (stripos($exception->getMessage(), 'No query results for model') !== false) {
            return response()->json(['status' => false, 'error' => 'Establecimiento no encontrado', 'message' => 'No se ha encontrado ningún resultado con el id proporcionado'], $statusCode);
        }

        return response()->json(['status' => false, 'error' => $exception->getMessage(), 'message'=> 'No se puede guardar el establecimiento debido a que existen errores en los datos.', 'oEstablecimiento'=>null], $statusCode);
    }

}
