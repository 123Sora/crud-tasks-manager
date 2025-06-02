<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    public function index() {
        $tasks = Task::latest()->get();
        return view('tasks.index', compact('tasks'));
    }

    public function store(Request $request){
        $request->validate(['title' => 'required']); 
        Task::create($request->only('title', 'description'));
        return redirect()->route('tasks.index')->with('success', 'Task created successfully.');
    }

    public function edit(Task $task) {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task) {
        $task->title = $request->title;
        $task->description = $request->description;
        $task->completed = $request->has('completed');
        $task->save();
        return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
    }


    public function destroy(Task $task) {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task deleted successfully.');
    }

    public function toggle(Task $task)
{
    $task->completed = !$task->completed;
    $task->save();

    return redirect()->route('tasks.index')->with('success', 'Task updated successfully.');
}

}


