<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $allTodos = Todo::all();

            return response()->json([
                "success" => true,
                "todos" => $allTodos
            ], 200);

        } catch(Exception $e) {
            Log::error("Error when fetching Todos", [
                "error" => $e->getMessage()
            ]);

            return response()->json([
                "success" => false,
                "message" => "An error occurred. Please try again later"
            ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                "title" => "required|string|min:3|max:255",
                "description" => "nullable|string|max:3000",
                "status" => "required|string|in:completed,pending,in_progress"
            ]);

            $todo = Todo::create([
                "title" => $validated["title"],
                "description" => $validated["description"],
                "status" => $validated["status"]
            ]);

            return response()->json([
                "success" => true,
                "message" => "Todo created successfully"
            ], 201);

        } catch(Exception $e) {
            Log::error("Error when creating a Todo", [
                "error" => $e->getMessage()
            ]);

            return response()->json([
                "success" => false,
                "message" => "An error occurred. Please try again later"
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $todo = Todo::where("id", $id)->first();

            if(!$todo) {
                return response()->json([
                    "success" => false,
                    "message" => "Todo not found"
                ], 404);
            }

            return response()->json([
                "success" => true,
                "todo" => $todo
            ], 200);

        } catch(Exception $e) {
            return response()->json([
                "success" => false,
                "message" => "An error occurred when getting Todo."
            ]);
        }
    }

        /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $todo = Todo::where("id", $id)->first();

            if (!$todo) {
                return response()->json([
                    "success" => false,
                    "message" => "Todo not found"
                ], 404);
            }

            $validated = $request->validate([
                "title" => "sometimes|required|string|min:3|max:255",
                "description" => "nullable|string|max:3000",
                "status" => "sometimes|required|string|in:completed,pending,in_progress"
            ]);

            $todo->update($validated);

            return response()->json([
                "success" => true,
                "message" => "Todo updated successfully",
                "todo" => $todo
            ], 200);

        } catch (Exception $e) {
            Log::error("Error when updating Todo", [
                "error" => $e->getMessage()
            ]);

            return response()->json([
                "success" => false,
                "message" => "An error occurred. Please try again later"
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $todo = Todo::where("id", $id)->first();

            if (!$todo) {
                return response()->json([
                    "success" => false,
                    "message" => "Todo not found"
                ], 404);
            }

            $todo->delete();

            return response()->json([
                "success" => true,
                "message" => "Todo deleted successfully"
            ], 200);

        } catch (Exception $e) {
            Log::error("Error when deleting Todo", [
                "error" => $e->getMessage()
            ]);

            return response()->json([
                "success" => false,
                "message" => "An error occurred. Please try again later"
            ], 500);
        }
    }
}
