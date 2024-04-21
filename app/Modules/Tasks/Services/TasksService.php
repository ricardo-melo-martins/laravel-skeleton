<?php
namespace App\Modules\Tasks\Services;

use App\Modules\Authentication\Services\AuthService;
use App\Modules\Tasks\Handlers\Exceptions\TaskNotCreateException;
use App\Modules\Tasks\Handlers\Exceptions\TaskNotDeleteException;
use App\Modules\Tasks\Handlers\Exceptions\TaskNotFoundException;
use App\Modules\Tasks\Handlers\Exceptions\TaskNotUpdatedException;
use App\Modules\Tasks\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Throwable;

class TasksService
{
    private AuthService $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function fetchAll()
    {
        return Cache::remember(Task::CACHE_TOKEN_LIST, now()->addMinutes(TASK::CACHE_TOKEN_LIST_MINUTES), function () {
            return $this->authService->user()->tasks;
        });
    }

    /**
     * @throws TaskNotFoundException
     */
    public function findOneById(int $id)
    {

        $response = $this->authService->user()->tasks()->find($id);

        if (!$response) {
            throw new TaskNotFoundException();
        }

        return $response;

    }

    public function createTask(array $data)
    {
        try {
            $taskCreated = Task::create($data);
            $this->authService->user()->tasks()->attach($taskCreated->id);

            return $taskCreated;
        } catch (Throwable $th) {
            throw new TaskNotCreateException($th->getMessage());
        }
    }

    public function updateTask(Task $task, array $data)
    {
        return $this->updateTaskById($task->id, $data);
    }

    /**
     * @throws TaskNotUpdatedException
     */
    public function updateTaskById(int $id, array $data)
    {
        try {
            $task = $this->findOneById($id);
            return $task->update($data);

        } catch (Throwable $th) {
            throw new TaskNotUpdatedException($th->getMessage());
        }
    }

    /**
     * @throws TaskNotDeleteException
     */
    public function deleteTask(Task $task)
    {

        return $this->deleteTaskById($task->id);
    }

    /**
     * @throws TaskNotDeleteException
     */
    public function deleteTaskById(int $id){

        try {
            $task = $this->findOneById($id);
            return $task->delete();

        } catch (Throwable $th) {
            throw new TaskNotDeleteException($th->getMessage());
        }

    }

    public function finishedTaskById(int $id)
    {
        return $this->updateTaskById($id, ['finished_at'=> Carbon::now()->timestamp]);
    }
}
