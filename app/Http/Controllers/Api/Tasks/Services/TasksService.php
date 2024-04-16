<?php
namespace App\Http\Controllers\Api\Tasks\Services;

use App\Http\Controllers\Api\Auth\Services\AuthService;
use App\Http\Controllers\Api\Tasks\Exceptions\TaskNotCreateException;
use App\Models\Task;

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

        $this->authService->user()->syncWithoutDetaching([$task->id]);
    
        return $taskUpdated;
    }    

    public function deleteTask(Task $task)
    {
        return $this->deleteTaskById($task->id);
    }

    public function deleteTaskById($id){
        
        $task = Task::findOrFail($id);
        
        $deleteTask = $task->delete();

        $this->authService->user()->detach($task->id);

        return $deleteTask;
    }
}