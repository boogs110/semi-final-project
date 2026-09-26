<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Edit Task - TaskFlow</title>

    <link rel="stylesheet"
          href="{{ asset('css/task-manager.css') }}">

</head>

<body>

<div class="app">

    <aside class="sidebar">

        <div class="logo">

            <div class="logo-icon">
                ✓
            </div>

            <div>
                <h2>TaskFlow</h2>
                <span>Personal Manager</span>
            </div>

        </div>


        <nav class="navigation">

            <a href="{{ route('tasks.index') }}"
               class="nav-item">
                <span>▦</span>
                <span>My Tasks</span>
            </a>

        </nav>


        <div class="sidebar-footer">
            <p>Stay organized.</p>
            <strong>One task at a time.</strong>
        </div>

    </aside>


    <main class="main-content">

        <header class="topbar">

            <div>

                <p class="small-title">
                    TASK MANAGEMENT
                </p>

                <h1>Edit Task</h1>

                <p class="subtitle">
                    Update your task information.
                </p>

            </div>

        </header>


        <section class="panel">

            <div class="panel-header">

                <h2>Edit "{{ $task->task_name }}"</h2>

                <p>
                    Change the details and status of this task.
                </p>

            </div>


            <form
                action="{{ route('tasks.update', $task->id) }}"
                method="POST"
                class="task-form">

                @csrf

                @method('PUT')


                <div class="form-group">

                    <label for="task_name">
                        Task Name
                    </label>

                    <input
                        type="text"
                        id="task_name"
                        name="task_name"
                        value="{{ $task->task_name }}"
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
                        rows="5"
                    >{{ $task->description }}</textarea>

                </div>


                <div class="form-row">

                    <div class="form-group">

                        <label for="status">
                            Status
                        </label>

                        <select
                            name="status"
                            id="status">

                            <option
                                value="Pending"
                                {{ $task->status === 'Pending'
                                    ? 'selected'
                                    : '' }}>
                                Pending
                            </option>

                            <option
                                value="Completed"
                                {{ $task->status === 'Completed'
                                    ? 'selected'
                                    : '' }}>
                                Completed
                            </option>

                        </select>

                    </div>


                    <div class="form-group">

                        <label for="due_date">
                            Due Date
                        </label>

                        <input
                            type="date"
                            name="due_date"
                            id="due_date"
                            value="{{ $task->due_date }}"
                        >

                    </div>

                </div>


                <div class="task-actions">

                    <a
                        href="{{ route('tasks.index') }}"
                        class="edit-button">
                        Cancel
                    </a>

                    <button
                        type="submit"
                        class="primary-button">
                        Save Changes
                    </button>

                </div>

            </form>

        </section>

    </main>

</div>


<script src="{{ asset('js/task-manager.js') }}"></script>

</body>

</html>