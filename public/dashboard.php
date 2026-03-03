<?php
require_once "../middleware/auth.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>Task Dashboard</title>
    <link rel="stylesheet" href="assets/css/dashboard.css">
</head>
<body>

<div class="container">

    <h2>Task Dashboard</h2>
    <a href="logout.php">Logout</a>

    <hr>

    <h3>Create Task</h3>

    <input type="text" id="title" placeholder="Task Title">
    <input type="text" id="description" placeholder="Task Description">
    <button onclick="createTask()">Add Task</button>

    <hr>

    <h3>Filter</h3>

    <select id="statusFilter" onchange="loadTasks()">
        <option value="">All</option>
        <option value="pending">Pending</option>
        <option value="completed">Completed</option>
    </select>

    <hr>

    <h3>Task List</h3>

    <div id="taskList"></div>

    <br>

    <button onclick="prevPage()">Previous</button>
    <button onclick="nextPage()">Next</button>

</div>

<script src="assets/js/dashboard.js"></script>
</body>
</html>