<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Personal Task Manager</title>

    <link rel="stylesheet"
          href="{{ asset('css/task-manager.css') }}">
</head>

<body>

<div class="app">

    <!-- SIDEBAR -->
    <aside class="sidebar">

        <div class="logo">
            <div class="logo-icon">✓</div>

            <div>
                <h2>TaskFlow</h2>
                <span>Personal Manager</span>
            </div>
        </div>

        <nav class="navigation">

            <a href="{{ route('tasks.index') }}"
               class="nav-item active">
                <span>▦</span>
                <span>My Tasks</span>
            </a>

            <a href="#add-task" class="nav-item">
                <span>＋</span>
                <span>Add Task</span>
            </a>

        </nav>

        <div class="sidebar-footer">
            <p>Stay organized.</p>
            <strong>One task at a time.</strong>
        </div>

    </aside>


    <!-- MAIN CONTENT -->
    <main class="main-content">

        <!-- HEADER -->
        <header class="topbar">

            <div>
                <p class="small-title">PERSONAL TASK MANAGER</p>
                <h1>My Tasks</h1>
                <p class="subtitle">
                    Organize your work and stay productive.
                </p>
            </div>

            <a href="#add-task" class="add-button">
                + Add Task
            </a>

        </header>


        <!-- SUCCESS MESSAGE -->
        @if(session('success'))

            <div class="success-message">
                ✓ {{ session('success') }}
            </div>

        @endif


        <!-- STATISTICS -->
        <section class="stats">

            <div class="stat-card">
                <div class="stat-icon">📋</div>

                <div>
                    <span>Total Tasks</span>
                    <strong>{{ $tasks->count() }}</strong>
                </div>
            </div>


            <div class="stat-card">
                <div class="stat-icon">⏳</div>

                <div>
                    <span>Pending</span>
                    <strong>
                        {{ $tasks->where('status', 'Pending')->count() }}
                    </strong>
                </div>
            </div>


            <div class="stat-card">
                <div class="stat-icon">✓</div>

                <div>
                    <span>Completed</span>
                    <strong>
                        {{ $tasks->where('status', 'Completed')->count() }}
                    </strong>
                </div>
            </div>

        </section>


        <!-- ADD TASK -->
        <section class="panel" id="add-task">

            <div class="panel-header">
                <div>
                    <h2>Add New Task</h2>
                    <p>Create a task and set your deadline.</p>
                </div>
            </div>


            <form action="{{ route('tasks.store') }}"
                  method="POST"
                  class="task-form">

                @csrf

                <div class="form-group">

                    <label for="task_name">
                        Task Name
                    </label>

                    <input
                        type="text"
                        id="task_name"
                        name="task_name"
                        placeholder="Example: Finish Laravel project"
                        required
                    >

                </div>


                <div class="form-group">

                    <label for="description">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Write some details about this task..."
                    ></textarea>

                </div>


                <div class="form-row">

                    <div class="form-group">

                        <label for="due_date">
                            Due Date
                        </label>

                        <input
                            type="date"
                            id="due_date"
                            name="due_date"
                        >

                    </div>

                    <div class="form-group">

                        <label>&nbsp;</label>

                        <button type="submit"
                                class="primary-button">
                            Add Task
                        </button>

                    </div>

                </div>

            </form>

        </section>


        <!-- TASK LIST -->
        <section class="panel">

            <div class="panel-header">

                <div>
                    <h2>My Task List</h2>

                    <p>
                        {{ $tasks->count() }}
                        {{ $tasks->count() == 1 ? 'task' : 'tasks' }}
                        saved
                    </p>
                </div>

            </div>


            @if($tasks->count() > 0)

                <div class="task-list">

                    @foreach($tasks as $task)

                        <article class="task-card
                            {{ $task->status === 'Completed'
                                ? 'completed'
                                : '' }}">

                            <div class="task-check">

                                <form
                                    action="{{ route('tasks.complete', $task->id) }}"
                                    method="POST">

                                    @csrf
                                    @method('PATCH')

                                    <button
                                        type="submit"
                                        class="check-button"
                                        title="Change status">

                                        @if($task->status === 'Completed')
                                            ✓
                                        @else
                                            ○
                                        @endif

                                    </button>

                                </form>

                            </div>


                            <div class="task-info">

                                <h3>{{ $task->task_name }}</h3>

                                @if($task->description)

                                    <p>
                                        {{ $task->description }}
                                    </p>

                                @endif

                                <div class="task-meta">

                                    <span class="status
                                        {{ strtolower($task->status) }}">
                                        {{ $task->status }}
                                    </span>

                                    @if($task->due_date)

                                        <span>
                                            📅
                                            {{ \Carbon\Carbon::parse($task->due_date)->format('M d, Y') }}
                                        </span>

                                    @endif

                                </div>

                            </div>


                            <div class="task-actions">

                                <a
                                    href="{{ route('tasks.edit', $task->id) }}"
                                    class="edit-button">
                                    Edit
                                </a>


                                <form
                                    action="{{ route('tasks.destroy', $task->id) }}"
                                    method="POST"
                                    class="delete-form">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="delete-button"
                                        onclick="return confirmDelete()">
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </article>

                    @endforeach

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        ✓
                    </div>

                    <h3>No tasks yet</h3>

                    <p>
                        Add your first task above to get started.
                    </p>

                </div>

            @endif

        </section>

        <footer>
            Personal Task Manager · Laravel Project
        </footer>

    </main>

</div>

<script src="{{ asset('js/task-manager.js') }}"></script>

</body>
</html>