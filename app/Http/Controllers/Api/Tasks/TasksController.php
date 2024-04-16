<?php

namespace App\Http\Controllers\Api\Tasks;

use Illuminate\Http\Request;

use App\Http\Controllers\Api\Tasks\Services\TasksService;
use App\Http\Controllers\Controller;

class TasksController extends Controller
{
    private $taskService;

    public function __construct(TasksService $taskService)
    {
        $this->taskService = $taskService;
    }
    
    public function index()
    {
        return $this->taskService->fetchAll();
    }

    public function store(Request $request)
    {
        $response = $this->taskService->createTask([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'delivery_date' => $request->input('delivery_date'),
        ]);

        return response()->json([
            'message' => config('i18n.messages.TASK_CREATE_SUCCESS'),
            'task'=> $response
        ]);
    }

    public function show($id)
    {
        return $this->taskService->findOneById($id);
    }

    public function update(Request $request, $id)
    {
        $response = $this->taskService->updateTaskById($id, $request->all());
        
        return response()->json([
            'message' => config('i18n.messages.TASK_UPDATE_SUCCESS'),
            'task'=> $response
        ]);
    }

    public function destroy($id)
    {
        $this->taskService->deleteTaskById($id);
        
        return response()->json([
            'message' => config('i18n.messages.TASK_DELETE_SUCCESS')
        ]);
        //return response()->noContent();
    }
}
