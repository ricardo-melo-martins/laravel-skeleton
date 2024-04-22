<?php

namespace App\Modules\Tasks\Controllers;

use App\Http\Controllers\ControllerAbstract;
use App\Modules\Tasks\Handlers\Exceptions\TaskNotCreateException;
use App\Modules\Tasks\Handlers\Exceptions\TaskNotDeleteException;
use App\Modules\Tasks\Handlers\Exceptions\TaskNotFoundException;
use App\Modules\Tasks\Handlers\Exceptions\TaskNotUpdatedException;
use App\Modules\Tasks\Handlers\Requests\TaskCreateRequest;
use App\Modules\Tasks\Handlers\Requests\TaskSearchRequest;
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

    /**
     * @OA\Get(
     *     path="/api/tasks",
     *     summary="Get a list of tasks",
     *     tags={"Tasks"},
     *     operationId="SearchTask",
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     */
    public function index(TaskSearchRequest $request): JsonResponse
    {
        // dd($request);
        return $this->responseOk($this->taskService->fetchAll()->toArray());
    }

    /**
      @OA\Post (
     *     path="/api/tasks",
     *     summary="Create one task",
     *     tags={"Tasks"},
     *     operationId="CreateTask",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="description",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="status",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"Titulo de minha tarefa aqui",
     *                     "description":"Uma descrição para minha tarefa",
     *                     "password":"pendente"
     *                }
     *             )
     *         )
     *      ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     *
     * @throws TaskNotCreateException
     */
    public function store(TaskCreateRequest $request): JsonResponse
    {
        $response = $this->taskService->createTask($request->all());

        return $this->responseCreateOk([
            'message' => Lang::get('tasks.created'),
            'task'=> $response
        ]);
    }

    /**
     *
     * @OA\Get(
     *     path="/api/tasks/{taskId}",
     *     summary="Get a one task",
     *     tags={"Tasks"},
     *     operationId="GetTaskDetails",
     *     @OA\Parameter(
     *        description="Task ID",
     *        in="path",
     *        name="taskId",
     *        required=true,
     *        example="1",
     *        @OA\Schema(
     *           type="integer",
     *           format="int64"
     *        )
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     *
     * @throws TaskNotFoundException
     */
    public function show(int $id): JsonResponse
    {
        $model = $this->taskService->findOneById($id);

        return $this->responseOk($model->toArray());
    }

    /**
    * @OA\Put (
     *     path="/api/tasks/{taskId}",
     *     summary="Update one task",
     *     tags={"Tasks"},
     *     operationId="UpdateTaskDetails",
     *     @OA\Parameter(
     *          description="Task ID",
     *          in="path",
     *          name="taskId",
     *          required=true,
     *          example="1",
     *          @OA\Schema(
     *             type="integer",
     *             format="int64"
     *          )
     *       ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="description",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="status",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"Novo Titulo de minha tarefa aqui",
     *                     "description":"Uma descrição para minha tarefa",
     *                     "password":"indefinido"
     *                }
     *             )
     *         )
     *      ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     *
     * @throws TaskNotUpdatedException
     */
    public function update(Request $request, $id): JsonResponse
    {
        $response = $this->taskService->updateTaskById($id, $request->all());

        return $this->responseUpdateOk([
            'message' => Lang::get('tasks.updated'),
            'debug' => $response
        ]);
    }

    /**
     *
     * @OA\Delete(
     *     path="/api/tasks/{taskId}",
     *     summary="Delete a one task",
     *     tags={"Tasks"},
     *     operationId="DeleteTaskDetails",
     *     @OA\Parameter(
     *        description="Task ID",
     *        in="path",
     *        name="taskId",
     *        required=true,
     *        example="1",
     *        @OA\Schema(
     *           type="integer",
     *           format="int64"
     *        )
     *     ),
     *     @OA\Response(response=200, description="Successful operation"),
     *     @OA\Response(response=400, description="Invalid request")
     * )
     *
     * @throws TaskNotDeleteException
     */
    public function destroy(int $id): JsonResponse
    {
        $this->taskService->deleteTaskById($id);

        return $this->responseDeleteOk([
            'message' => Lang::get('tasks.deleted')
        ]);
    }
}
