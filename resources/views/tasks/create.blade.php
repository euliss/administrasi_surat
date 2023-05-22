<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Agenda</title>
</head>
<body>
    <form action="{{ route('tasks.store') }}" method="post">
        {{ csrf_field() }}
        Task name:
        <br />
        <input type="text" name="name" />
        <br /><br />
        Task description:
        <br />
        <textarea name="description"></textarea>
        <br /><br />
        Start time:
        <br />
        <input type="text" name="task_date" class="date" />
        <br /><br />
        <input type="submit" value="Save" />
    </form>
    <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="https://code.jquery.com/ui/1.11.3/jquery-ui.min.js"></script>
    <script>
        $('.date').datepicker({
            autoclose: true,
            dateFormat: "yy-mm-dd"
        });
    </script>
</body>
</html>