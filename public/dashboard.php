<?php
require_once "../middleware/auth.php";
?>


<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>

<h2>Task Dashboard</h2>
<a href="logout.php">Logout</a>

<hr>

<h3>Create Task</h3>

<input type="text" id="title" placeholder="Title">
<input type="text" id="description" placeholder="Description">
<button onclick="createTask()">Add</button>

<hr>

<h3>Tasks</h3>

<ul id="taskList"></ul>

<script>

function loadTasks() {
    fetch("../controllers/TaskController.php?action=get")
        .then(res => res.json())
        .then(data => {
            const list = document.getElementById("taskList");
            list.innerHTML = "";
            data.forEach(task => {
                const li = document.createElement("li");
                li.innerHTML = `
                    ${task.title} (${task.status})
                    <button onclick="deleteTask(${task.id})">Delete</button>
                `;
                list.appendChild(li);
            });
        });
}

function createTask() {
    const formData = new FormData();
    formData.append("title", document.getElementById("title").value);
    formData.append("description", document.getElementById("description").value);

    fetch("../controllers/TaskController.php?action=create", {
        method: "POST",
        body: formData
    })
    .then(res => res.json())
    .then(() => loadTasks());
}

function deleteTask(id) {
    const formData = new FormData();
    formData.append("id", id);

    fetch("../controllers/TaskController.php?action=delete", {
        method: "POST",
        body: formData
    })
    .then(() => loadTasks());
}

loadTasks();

</script>

</body>
</html>