<?php

namespace App\Modules\Tasks\Controllers;

use App\Http\Controllers\ControllerAbstract;
use App\Modules\Tasks\Handlers\Exceptions\TaskNotCreateException;
use App\Modules\Tasks\Services\TasksService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Lang;

class TasksController extends ControllerAbstract
{
    private TasksService $taskService;

    public function __construct(TasksService $taskService)
    {
        $this->taskService = $taskService;
    }

    public function index(): JsonResponse
    {
        return $this->responseOk($this->taskService->fetchAll()->toArray());
    }

    /**
     * @throws TaskNotCreateException
     */
    public function store(Request $request): JsonResponse
    {
        $response = $this->taskService->createTask([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'delivery_date' => $request->input('delivery_date'),
            'status' => $request->input('status'),
        ]);

        return $this->responseCreateOk([
            'message' => Lang::get('tasks.created'),
            'task'=> $response
        ]);
    }

    public function show(int $id): JsonResponse
    {
        $response = $this->taskService->findOneById($id);

        return $this->responseOk($response->toArray());
    }

    public function update(Request $request, $id): JsonResponse
    {
        $response = $this->taskService->updateTaskById($id, $request->all());

        return $this->responseUpdateOk([
            'message' => Lang::get('tasks.updated'),
            'debug' => $response
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $this->taskService->deleteTaskById($id);

        return $this->responseDeleteOk([
            'message' => Lang::get('tasks.deleted')
        ]);
    }
}
