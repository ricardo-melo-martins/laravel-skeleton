<?php
namespace App\Http\Controllers\Api\Tasks\Services;

use App\Models\Task;

class TasksService
{
    private $authenticateUser;

    public function __construct() {
        $this->authenticateUser = auth()->user();
    }

    public function fetchAll()
    {
            $response = $this->authenticateUser->tasks;

            return $response;     
        
    }

    public function findOneById(int $id)
    {
        return Task::findOrFail($id);
    }

    public function createTask(array $data)
    {
        $user = auth()->user();
        
        $taskCreated = Task::create($data);
        $user->tasks()->attach($taskCreated->id); // Associa a tarefa ao usuário

        return $taskCreated;    
    }

    public function updateTask(Task $task, array $data)
    {
        return $this->updateTaskById($task->id, $data);
    }

    public function updateTaskById(int $id, array $data)
    {
        $user = auth()->user();
        $task = Task::findOrFail($id);
        $taskUpdated = $task->update($data);
        $user->tasks()->syncWithoutDetaching([$task->id]); // Associa a tarefa ao usuário
    
        return $taskUpdated;
    }    

    public function deleteTask(Task $task)
    {
        return $this->deleteTaskById($task->id);
    }

    public function deleteTaskById($id){
        
        $user = auth()->user();
        
        $task = Task::findOrFail($id);
        
        $deleteTask = $task->delete();

        $user->tasks()->detach($task->id); // Remove a associação da tarefa com o usuário

        return $deleteTask;
    }
}