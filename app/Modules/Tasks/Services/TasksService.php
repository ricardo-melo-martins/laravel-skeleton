<?php
namespace App\Modules\Tasks\Services;

use App\Modules\Authentication\Services\AuthService;
use App\Modules\Tasks\Handlers\Exceptions\TaskNotCreateException;
use App\Modules\Tasks\Models\Task;
use Carbon\Carbon;

class TasksService
{
    private $authService;

    public function __construct(AuthService $authService) {
        $this->authService = $authService;
    }

    public function fetchAll()
    {
        $response = $this->authService->user()->tasks;

        return $response;
    }

    public function findOneById(int $id)
    {
        return Task::findOrFail($id);
    }

    public function createTask(array $data)
    {
        try {
            $taskCreated = Task::create($data);

            $this->authService->user()->tasks()->attach($taskCreated->id);

            return $taskCreated;
        } catch (\Throwable $th) {
            throw new TaskNotCreateException($th->getMessage());
        }
    }

    public function updateTask(Task $task, array $data)
    {
        return $this->updateTaskById($task->id, $data);
    }

    public function updateTaskById(int $id, array $data)
    {
        $task = Task::findOrFail($id);
        $taskUpdated = $task->update($data);

        // TODO: $this->authService->user()->syncWithoutDetaching([$task->id]);

        return $taskUpdated;
    }

    public function deleteTask(Task $task)
    {
        return $this->deleteTaskById($task->id);
    }

    public function deleteTaskById($id){

        $task = Task::findOrFail($id);

        $deleteTask = $task->delete();

        // TODO: $this->authService->user()->detach($task->id);

        return $deleteTask;
    }

    public function finishedTaskById(int $id)
    {
        return $this->updateTaskById($id, ['finished_at'=> Carbon::now()->timestamp]);
    }
}
