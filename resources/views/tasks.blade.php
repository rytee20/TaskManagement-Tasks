<!DOCTYPE html>
<html>
<head>
    <title>Задачи</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1>Задачи</h1>

    <div class="mb-4">
        <a href="{{ url('/tasks/create') }}" class="btn btn-success">Добавить новую задачу</a>
    </div>

    <form method="GET" action="{{ url('/tasks') }}">
        <div class="form-group">
            <label for="status">Статус задачи</label>
            <select id="status" name="status" class="form-control">
                <option value="">Все</option>
                <option value="завершено">Завершено</option>
                <option value="в работе">В работе</option>
                <option value="остановлено">Остановлено</option>
                <option value="не начато">Не начато</option>
            </select>
        </div>

        <div class="form-group">
            <label for="team_member_id">ID Исполнителя</label>
            <input type="text" id="team_member_id" name="team_member_id" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Поиск</button>
    </form>

    <hr>

    <!--<h2>Tasks</h2>-->
    <ul id="task-list" class="list-group">
        <!-- Tasks will be displayed here -->
    </ul>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function() {
        // Fetch tasks when the page loads
        fetchTasks();

        // Fetch tasks based on filter
        $('form').on('submit', function(e) {
            e.preventDefault();
            fetchTasks();
        });

        function fetchTasks() {
            let status = $('#status').val();
            let teamMemberId = $('#team_member_id').val();

            $.ajax({
                url: '{{ url('/tasks') }}',
                method: 'GET',
                data: {
                    status: status,
                    team_member_id: teamMemberId
                },
                success: function(tasks) {
                    $('#task-list').empty();
                    tasks.forEach(function(task) {
                        $('#task-list').append('<li class="list-group-item">' + task.task_name + ' - ' + task.status + '</li>');
                    });
                }
            });
        }
    });
</script>
</body>
</html>