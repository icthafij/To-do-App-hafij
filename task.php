<?php
// Load tasks from JSON file
$tasks = json_decode(file_get_contents('tasks.json'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];

    if ($action === 'add') {
        $task = htmlspecialchars(trim($_POST['task'])); // Prevent XSS
        if (!empty($task)) {
            $tasks[] = ['task' => $task, 'done' => false];
        }
    } elseif ($action === 'mark') {
        $index = intval($_POST['index']);
        if (isset($tasks[$index])) {
            $tasks[$index]['done'] = !$tasks[$index]['done'];
        }
    } elseif ($action === 'delete') {
        $index = intval($_POST['index']);
        if (isset($tasks[$index])) {
            unset($tasks[$index]);
        }
        $tasks = array_values($tasks); // Reindex array
    }

    // Save updated tasks to JSON file
    file_put_contents('tasks.json', json_encode($tasks, JSON_PRETTY_PRINT));

    // Redirect to the main page
    header('Location: index.php');
    exit();
}
?>
