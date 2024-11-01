<?php
require 'vendor/autoload.php'; // Load MongoDB library

// MongoDB connection setup
function getMongoClient() {
    // add your connection string here
    $client = new MongoDB\Client("mongodb+srv://<username>:<password>@<cluster>.mongodb.net/?retryWrites=true&w=majority");
    return $client;
}


function getTasksCollection() {
    $client = getMongoClient();
    return $client->myTodoApp->tasks; // `myTodoApp` is the DB, `tasks` is the collection
}

// Fetch all tasks
function fetchTasks() {
    $tasksCollection = getTasksCollection();
    return $tasksCollection->find();
}

// Add a new task
function addTask($task) {
    $tasksCollection = getTasksCollection();
    $tasksCollection->insertOne([
        'task' => $task,
        'completed' => false
    ]);
}

// Mark a task as completed
function completeTask($id) {
    $tasksCollection = getTasksCollection();
    $tasksCollection->updateOne(
        ['_id' => new MongoDB\BSON\ObjectId($id)],
        ['$set' => ['completed' => true]]
    );
}

// Delete a task
function deleteTask($id) {
    $tasksCollection = getTasksCollection();
    $tasksCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
}
?>
