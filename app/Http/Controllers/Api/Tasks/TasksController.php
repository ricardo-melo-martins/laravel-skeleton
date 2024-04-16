<?php

namespace App\Http\Controllers\Api\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    public function index()
    {
        return Task::all();
    }

    public function store(Request $request)
    {
        return Task::create($request->all());
    }

    public function show($id)
    {
        return Task::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $tarefa = Task::findOrFail($id);
        $tarefa->update($request->all());
        return $tarefa;
    }

    public function destroy($id)
    {
        Task::findOrFail($id)->delete();
        return response()->noContent();
    }
}
