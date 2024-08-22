<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $todos = Todo::all();
        return response()->json($todos,Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string|max:255',
            'completed' => 'sometimes|boolean',
        ]);

        $validated['completed'] = $validated['completed'] ?? false;

        $todo = Todo::create($validated);
        return response()->json($todo, Response::HTTP_CREATED);
    }

    /**
     *  Display the specified resource.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        try {
            $todo = Todo::findOrFail($id); 
            return response()->json($todo, Response::HTTP_OK);
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Todo not found'], Response::HTTP_NOT_FOUND); // Handle not found case
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'description' => 'sometimes|string|max:255',
            'completed' => 'sometimes|boolean',
        ]);

        $todo = Todo::findOrFail($id);
        $todo->update($validated);
        return response()->json($todo, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id
     * @return \Illuminate\Http\JsonResponse
     */
    //destroy(string $id) or destroy(Todo $todo)
    public function destroy(string $id) 
    {
        try {
            $todo = Todo::findOrFail($id);
            $todo->delete(); 
            return response()->json(null, Response::HTTP_NO_CONTENT); 
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Todo not found'], Response::HTTP_NOT_FOUND); 
        }
    }
}
