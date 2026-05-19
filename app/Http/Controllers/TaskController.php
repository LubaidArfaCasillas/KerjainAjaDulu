<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Project Board
    public function index()
    {
        $todoTasks       = Task::active()->byStatus('todo')->with('assignee')->latest()->get();
        $inProgressTasks = Task::active()->byStatus('in_progress')->with('assignee')->latest()->get();
        $reviewTasks     = Task::active()->byStatus('review')->with('assignee')->latest()->get();
        $doneTasks       = Task::active()->byStatus('done')->with('assignee')->latest()->get();

        return view('tasks.index', compact(
            'todoTasks', 'inProgressTasks', 'reviewTasks', 'doneTasks'
        ));
    }

    // Form tambah task
    public function create()
    {
        $users = User::orderBy('name')->get();
        return view('tasks.create', compact('users'));
    }

    // Simpan task baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:todo,in_progress,review,done',
            'priority'    => 'required|in:high,medium,low',
            'assignee_id' => 'nullable|exists:users,id',
            'due_date'    => 'nullable|date',
            'category'    => 'nullable|string|max:100',
        ]);

        $data['creator_id'] = Auth::id();

        $task = Task::create($data);

        return redirect()->route('tasks.show', $task)
                         ->with('success', 'Task berhasil dibuat!');
    }

    // Detail task
    public function show(Task $task)
    {
        $task->load(['assignee', 'creator', 'comments.user']);
        return view('tasks.show', compact('task'));
    }

    // Form edit task
    public function edit(Task $task)
    {
        $users = User::orderBy('name')->get();
        return view('tasks.edit', compact('task', 'users'));
    }

    // Update task
    public function update(Request $request, Task $task)
    {
        $data = $request->validate([
            'title'       => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'status'      => 'required|in:todo,in_progress,review,done',
            'priority'    => 'sometimes|required|in:high,medium,low',
            'assignee_id' => 'nullable|exists:users,id',
            'due_date'    => 'nullable|date',
            'category'    => 'nullable|string|max:100',
        ]);

        $task->update($data);

        return redirect()->route('tasks.show', $task)
                         ->with('success', 'Task berhasil diupdate!');
    }

    // Hapus task
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')
                         ->with('success', 'Task berhasil dihapus.');
    }

    // Arsipkan task
    public function archiveTask(Task $task)
    {
        $task->update(['is_archived' => true]);
        return redirect()->route('tasks.index')
                         ->with('success', 'Task dipindahkan ke arsip.');
    }

    // Halaman archive
    public function archive()
    {
        $tasks = Task::archived()->with('assignee')->latest()->get();
        return view('tasks.archive', compact('tasks'));
    }

    // Restore dari archive
    public function restore(Task $task)
    {
        $task->update(['is_archived' => false]);
        return redirect()->route('tasks.archive')
                         ->with('success', 'Task berhasil direstore.');
    }

    // Search & filter
    public function search(Request $request)
    {
        $query = Task::active()->with('assignee');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($q2) use ($q) {
                $q2->where('title', 'like', "%{$q}%")
                   ->orWhere('description', 'like', "%{$q}%")
                   ->orWhere('category', 'like', "%{$q}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        $tasks = $query->latest()->paginate(15)->withQueryString();

        return view('tasks.search', compact('tasks'));
    }
}