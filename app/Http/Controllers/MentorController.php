<?php

namespace App\Http\Controllers;

use App\Models\Mentor;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class MentorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mentors = Mentor::all();
        return $mentors;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                [
                    'name' => 'required|string',
                    'email' => 'required|email|unique:users,email',
                    'cpf' => 'required|cpf|unique:users,cpf',
                ],
                [
                    'required' => 'O campo :attribute é obrigatório',
                    'string' => 'O campo :attribute precisa ser uma string',
                    'email' => 'O campo :attribute precisa ser um email válido',
                    'cpf' => 'O campo :attribute precisa ser um cpf válido',
                    'unique' => 'O campo :attribute já está em uso'
                ]
                ]);

                $mentor = Mentor::create($request->all());

                return response()->json([
                    'success' => true,
                    'message' => 'Mentor cadastrado com sucesso',
                    'data' => $mentor
                ], Response::HTTP_CREATED);

        } catch (ValidationException $th) {
            return response()->json([
                'success' => false,
                'message' => $th->getMessage(),
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
        } catch (\Throwable $th) {
            return response()->json([
                'success' => false,
                'message' => 'Erro interno, tente novamente',
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Mentor $mentor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mentor $mentor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mentor $mentor)
    {
        //
    }
}
