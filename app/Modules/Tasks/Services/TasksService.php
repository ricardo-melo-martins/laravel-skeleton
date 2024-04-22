<?php
namespace App\Modules\Tasks\Services;

use App\Commons\Util\DatetimeUtil;
use App\Modules\Authentication\Services\AuthService;
use App\Modules\Tasks\Dtos\TaskCreateDto;
use App\Modules\Tasks\Dtos\TaskReadDto;
use App\Modules\Tasks\Handlers\Exceptions\TaskNotCreateException;
use App\Modules\Tasks\Handlers\Exceptions\TaskNotDeleteException;
use App\Modules\Tasks\Handlers\Exceptions\TaskNotFoundException;
use App\Modules\Tasks\Handlers\Exceptions\TaskNotUpdatedException;
use App\Modules\Tasks\Models\Task;
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
    public function findOneById(int $id): TaskReadDto
    {
        $model = $this->authService->user()->tasks()->find($id);

        if (!$model) {
            throw new TaskNotFoundException();
        }

        return TaskReadDto::from($model);
    }

    public function createTask(mixed $data): TaskReadDto
    {
        try {
            $data = TaskCreateDto::from($data);

            $taskCreated = Task::create($data->toArray());

            $this->authService->user()->tasks()->attach($taskCreated->id);

            return TaskReadDto::from($taskCreated);

        } catch (Throwable $th) {
            throw new TaskNotCreateException($th->getMessage());
        }
    }

    /**
     * @throws TaskNotUpdatedException
     */
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

    /**
     * @throws TaskNotUpdatedException
     */
    public function finishedTaskById(int $id)
    {
        return $this->updateTaskById($id, [
            'finished_at'=> DatetimeUtil::nowTimestamp()
        ]);
    }
}
