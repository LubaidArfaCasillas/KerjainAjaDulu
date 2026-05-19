<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $totalTasks      = Task::active()->count();
        $doneTasks       = Task::active()->byStatus('done')->count();
        $inProgressTasks = Task::active()->byStatus('in_progress')->count();
        $overdueTasks    = Task::active()
                               ->whereNotNull('due_date')
                               ->where('due_date', '<', Carbon::today())
                               ->whereNotIn('status', ['done'])
                               ->count();

        $recentTasks = Task::active()
                           ->with('assignee')
                           ->latest()
                           ->limit(8)
                           ->get();

        // Progres per anggota tim
        $teamProgress = User::withCount([
            'tasks as total_tasks' => fn($q) => $q->active(),
            'tasks as done_tasks'  => fn($q) => $q->active()->byStatus('done'),
        ])->get()->map(function ($user) {
            $total   = $user->total_tasks;
            $done    = $user->done_tasks;
            $percent = $total > 0 ? round(($done / $total) * 100) : 0;
            return [
                'name'    => $user->name,
                'total'   => $total,
                'done'    => $done,
                'percent' => $percent,
            ];
        })->sortByDesc('done')->values();

        return view('dashboard.index', compact(
            'totalTasks', 'doneTasks', 'inProgressTasks', 'overdueTasks',
            'recentTasks', 'teamProgress'
        ));
    }
}