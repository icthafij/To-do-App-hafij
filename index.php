<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple To-Do App</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.min.css">
    <style>
        body {
           background-color: #f3bc1f;
           color: #333; !* Darker text color for better readability *!*/
        }

        h1 {
            color: #007acc; /* Bright blue for the title */
        }
        .done {
            text-decoration: line-through;
            color: gray;
        }
        button {
            background-color: #007acc; /* Blue button background */
            color: white; /* White text on buttons */
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #; /* Darker blue for hover effect */
        }
        /*.task-container {*/
        /*    margin-top: 20px;*/
        /*}*/
        /*ul {*/
        /*    list-style-type: none; !* Remove bullet points *!*/
        /*    padding: 0;*/
        /*}*/
        li {
            padding: 10px 0;
            border-bottom: 1px solid #ddd; /* Light border for separation */
        }
        li span {
            cursor: pointer; /* Pointer cursor for clickable tasks */
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Simple To-Do App</h1>

    <!-- Add Task Form -->
    <form action="task.php" method="POST">
        <input type="text" name="task" placeholder="Enter a new task" required>
        <button type="submit" name="action" value="add">Add Task</button>
    </form>

    <div class="task-container">
        <h3>Your Tasks</h3>
        <ul>
            <?php
            // Load tasks from tasks.json
            $tasks = json_decode(file_get_contents('tasks.json'), true);

            foreach ($tasks as $index => $task) {
                $class = $task['done'] ? 'done' : '';
                echo "<li class='$class'>
                            <span onclick='document.getElementById(\"mark$index\").submit();'>{$task['task']}</span>
                            <form id='mark$index' action='task.php' method='POST' style='display: inline;'>
                                <input type='hidden' name='index' value='$index'>
                                <button type='submit' name='action' value='mark'>Mark</button>
                            </form>
                            <form action='task.php' method='POST' style='display: inline;'>
                                <input type='hidden' name='index' value='$index'>
                                <button type='submit' name='action' value='delete'>Delete</button>
                            </form>
                          </li>";
            }
            ?>
        </ul>
    </div>
</div>
</body>
</html>
