<?php
require 'mongodb.php'; // Include the MongoDB connection and functions

// Handle adding task
if (isset($_POST['new_task'])) {
    $task = $_POST['new_task'];
    if (!empty($task)) {
        addTask($task);
    }
}

// Handle completing task
if (isset($_POST['complete_task_id'])) {
    $taskId = $_POST['complete_task_id'];
    completeTask($taskId);
}

// Handle deleting task
if (isset($_POST['delete_task_id'])) {
    $taskId = $_POST['delete_task_id'];
    deleteTask($taskId);
}

// Handle updating task
if (isset($_POST['update_task_id'])) {
    $taskId = $_POST['update_task_id'];
    $updatedTask = $_POST['updated_task'];
    if (!empty($updatedTask)) {
        updateTask($taskId, $updatedTask);
    }
}

// Fetch tasks for displaying
$tasks = fetchTasks(); 

// Function to update a task
function updateTask($id, $updatedTask) {
    $tasksCollection = getTasksCollection();
    $tasksCollection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => ['task' => $updatedTask]]
    );
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <!-- To-Do List Container -->
    <div class="bg-white shadow-lg rounded-lg w-full max-w-md p-6">
        <!-- Title -->
        <h2 class="text-2xl font-bold text-gray-800 mb-4">My To-Do List</h2>

        <!-- Add Task Form -->
        <form method="POST" class="mb-4">
            <div class="flex items-center">
                <input type="text" name="new_task" placeholder="Add a new task..." class="w-full p-2 rounded-md border border-gray-300 focus:ring focus:ring-blue-200 outline-none">
                <button type="submit" class="ml-2 bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md shadow-md">Add</button>
            </div>
        </form>

        <!-- Task List -->
        <ul class="divide-y divide-gray-200">
            <?php foreach ($tasks as $task): ?>
                <li class="flex justify-between items-center p-2">
                    <span class="<?= $task['completed'] ? 'text-gray-400 line-through' : 'text-gray-700' ?>">
                        <?= htmlspecialchars($task['task']) ?>
                    </span>
                    <div class="flex space-x-2">
                        <!-- Complete Task -->
                        <?php if (!$task['completed']): ?>
                            <form method="POST">
                                <input type="hidden" name="complete_task_id" value="<?= $task['_id'] ?>">
                                <button type="submit" class="text-green-500 hover:text-green-600">Complete</button>
                            </form>
                        <?php endif; ?>

                        <!-- Edit Task -->
                        <button type="button" class="text-yellow-500 hover:text-yellow-600" onclick="showEditForm('<?= $task['_id'] ?>', '<?= htmlspecialchars($task['task']) ?>')">Edit</button>

                        <!-- Delete Task -->
                        <form method="POST">
                            <input type="hidden" name="delete_task_id" value="<?= $task['_id'] ?>">
                            <button type="submit" class="text-red-500 hover:text-red-600">Delete</button>
                        </form>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <!-- Edit Task Modal -->
    <div id="editModal" class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50 hidden">
        <div class="bg-white rounded-lg p-6 w-80">
            <h3 class="text-lg font-bold mb-4">Edit Task</h3>
            <form id="editForm" method="POST">
                <input type="hidden" name="update_task_id" id="update_task_id">
                <input type="text" name="updated_task" id="updated_task" class="w-full p-2 rounded-md border border-gray-300 focus:ring focus:ring-blue-200 outline-none" required>
                <button type="submit" class="mt-2 bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-md shadow-md">Update</button>
                <button type="button" class="mt-2 text-red-500 hover:text-red-600" onclick="closeEditForm()">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        function showEditForm(taskId, taskContent) {
            document.getElementById('update_task_id').value = taskId;
            document.getElementById('updated_task').value = taskContent;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function closeEditForm() {
            document.getElementById('editModal').classList.add('hidden');
        }
    </script>

</body>
</html>
