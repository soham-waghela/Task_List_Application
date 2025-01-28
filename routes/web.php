<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
// use Illuminate\Http\Response;
use App\Http\Requests\TaskRequest;
use \App\Models\task;




Route::get('/',function(){
    return redirect()->route('tasks.index');
});

Route::get('/tasks', function () {
    return view('index', [
        'tasks' => Task::latest()->paginate(10)
    ]);
})->name('tasks.index');

Route::view('/tasks/create', 'create')
->name('tasks.create');

Route::get('/tasks/{task}/edit', function(task $task) {
    return view('edit',['task'=>$task]);
})->name('tasks.edit');


Route::get('/tasks/{task}', function(task $task) {
    return view('show',['task'=>$task]);
})->name('tasks.show');

Route::put('/tasks/{task}', function (task $task, TaskRequest $request) {
    $task->update($request->validated());

    return redirect()->route('tasks.show', ['task' => $task->id])
        ->with('success', 'Task updated successfully!');
})->name('tasks.update');


Route::post('/tasks', function(taskRequest $request){
    $task=task::create($request->validated());
    return redirect()->route('tasks.show', ['task' => $task->id])
    ->with('success','Task created successfully!');

}) ->name('tasks.store');

Route::delete('/tasks/{task}', function(task $task){
    $task->delete();
    return redirect()->route('tasks.index')->with('success','Task deleted successfully');
})->name('tasks.destory');

Route::put('task/{task}/toggle-complete',function (task $task){
    $task->toggleComplete();

    return redirect()->back()->with('success', 'Task updated successfully!!');  
})->name('tasks.toggle-complete') ;