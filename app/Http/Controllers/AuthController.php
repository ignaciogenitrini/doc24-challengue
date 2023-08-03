<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use App\Utils\ResponseUtil;
use App\Models\Persona;
use App\Models\Credencial;

class AuthController extends Controller
{
    public function updatePerson(Request $request) {
        if (!isset($request->id) || !isset($request->brand) || !isset($request->password)) {
            return response()->json([
                'Error message' => 'Parameters invalids.',
                'Code' => '404',
                'response' => []
            ]);
        }

        try {
            $personaExists = Persona::where('id', $request->id)->first();

            if (!$personaExists) {
                return response()->json([
                    'Error message' => 'Persona not found.',
                    'Code' => '404',
                    'response' => []
                ]);
            }

            $token = Auth::attempt(['email' => $personaExists['email'], 'password' => $request->password]); //

            if (!is_string($token) || is_bool($token)) {
                return response()->json([
                    'Error message' => 'Unauthorized',
                    'Code' => '401',
                    'response' => []
                ]);
            }

            $brandExists = Credencial::where('id', $request->brand)->first();

            if (!$brandExists) {
                return response()->json([
                    'Error message' => 'Brand not found',
                    'Code' => '404',
                    'response' => []
                ]);
            }

            if ($brandExists['brand'] === 'update_user' && is_string($token) && is_null($brandExists['secret_id'])) {
                $brandExists->update([
                    'secret_id' => $token
                ]);
            }

            return response()->json([
                'access_token' => $brandExists['secret_id'],
                'token_type' => 'bearer',
                'expires_in' => config('jwt.ttl')
            ]);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function getPersonData(Request $request) {
        $personaExists = Persona::where('id', $request->id_person)->first();
        $updatePersona = (!is_null($request->update)) ? intval($request->update) : 0;

        if (!$personaExists) {
            return response()->json([
                'Error message' => 'Persona not found.',
                'Code' => '404',
                'response' => []
            ]);
        }

        if (is_int($updatePersona) && $updatePersona === 0) {
            return response()->json([
                'response' => json_encode($personaExists),
                'Code' => '200'
            ]);
        }

        if (is_int($updatePersona) && $updatePersona === 1) {
            $personaExists->update([
                'edad' => rand(1, 100),
            ]);

            return response()->json([
                'Status' => 0,
                'Message' => "Datos actualizados correctamente"
            ]);
        }

        if (is_int($updatePersona) && ($updatePersona < 0 || $updatePersona > 1)) {
            return response()->json([
                'Status' => 0,
                'Message' => "Ha ocurrido un error al procesar la solicitud"
            ]);
        }
    }
}
