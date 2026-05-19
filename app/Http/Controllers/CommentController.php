<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Task $task)
    {
        $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        Comment::create([
            'task_id' => $task->id,
            'user_id' => Auth::id(),
            'body'    => $request->body,
        ]);

        return redirect()->route('tasks.show', $task)
                         ->with('success', 'Komentar ditambahkan.');
    }
}