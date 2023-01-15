<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::paginate();

        return response()->json($todos);
    }

    public function show($id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json(['error' => 'Todo não existe']);
        }

        return response()->json($todo);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'min:3',
            'done' => 'boolean',
        ]);

        if ($validator->fails()) {
            $response['error'] = $validator->messages();
            return response()->json($response);
        }

        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json(['error' => 'Todo não existe']);
        }

        $todo->update($request->all());

        return response()->json($todo);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            $response['error'] = $validator->messages();
            return $response;
        }

        $todo = Todo::create([
            'title' => $request->input('title')
        ]);

        return response()->json($todo);
    }

    public function destroy($id)
    {
        $todo = Todo::find($id);

        if (!$todo) {
            return response()->json(['error' => 'Todo não existe']);
        }

        $todo->delete();

        return response()->json(['message' => 'Todo deletado com sucesso!']);
    }
}
