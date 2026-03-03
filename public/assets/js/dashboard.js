var currentPage = 0;
var limit = 5;

// Load tasks from server
function loadTasks() {
    var status = document.getElementById("statusFilter").value;
    var offset = currentPage * limit;
    var url = "../controllers/TaskController.php?action=get&limit=" + limit + "&offset=" + offset;

    if (status) {
        url += "&status=" + status;
    }

    fetch(url)
        .then(function (res) { return res.json(); })
        .then(function (data) {
            var list = document.getElementById("taskList");
            list.innerHTML = "";

            if (!data || data.length === 0) {
                list.innerHTML = '<p class="empty-msg">No tasks found.</p>';
                return;
            }

            for (var i = 0; i < data.length; i++) {
                var task = data[i];
                var statusClass = task.status === "completed" ? "completed" : "";
                var badgeClass = task.status === "completed" ? "status-completed" : "status-pending";

                var card = document.createElement("div");
                card.className = "task-card " + statusClass;

                card.innerHTML =
                    '<div class="task-title">' + task.title + '</div>' +
                    '<div class="task-desc">' + (task.description || '') + '</div>' +
                    '<span class="status-badge ' + badgeClass + '">' + task.status + '</span>' +
                    '<div class="task-actions">' +
                    '<button class="btn-edit" onclick="showEdit(' + task.id + ', \'' + escapeQuote(task.title) + '\', \'' + escapeQuote(task.description || '') + '\', \'' + task.status + '\')">Edit</button> ' +
                    '<button class="btn-delete" onclick="deleteTask(' + task.id + ')">Delete</button>' +
                    '</div>' +
                    '<div id="edit-form-' + task.id + '"></div>';

                list.appendChild(card);
            }
        });
}

// Create a new task
function createTask() {
    var title = document.getElementById("title").value;
    var description = document.getElementById("description").value;

    if (!title) {
        alert("Please enter a title!");
        return;
    }

    var formData = new FormData();
    formData.append("title", title);
    formData.append("description", description);

    fetch("../controllers/TaskController.php?action=create", {
        method: "POST",
        body: formData
    })
        .then(function (res) { return res.json(); })
        .then(function () {
            document.getElementById("title").value = "";
            document.getElementById("description").value = "";
            currentPage = 0;
            loadTasks();
        });
}

// Delete a task
function deleteTask(id) {
    if (!confirm("Delete this task?")) return;

    var formData = new FormData();
    formData.append("id", id);

    fetch("../controllers/TaskController.php?action=delete", {
        method: "POST",
        body: formData
    })
        .then(function (res) { return res.json(); })
        .then(function () {
            loadTasks();
        });
}

// Show edit form inside the task card
function showEdit(id, title, description, status) {
    var container = document.getElementById("edit-form-" + id);

    if (container.innerHTML !== "") {
        container.innerHTML = "";
        return;
    }

    container.innerHTML =
        '<div class="edit-form">' +
        '<input type="text" id="editTitle-' + id + '" value="' + title + '">' +
        '<input type="text" id="editDesc-' + id + '" value="' + description + '">' +
        '<select id="editStatus-' + id + '">' +
        '<option value="pending"' + (status === "pending" ? " selected" : "") + '>Pending</option>' +
        '<option value="completed"' + (status === "completed" ? " selected" : "") + '>Completed</option>' +
        '</select>' +
        '<button class="btn-save" onclick="saveEdit(' + id + ')">Save</button> ' +
        '<button class="btn-cancel" onclick="cancelEdit(' + id + ')">Cancel</button>' +
        '</div>';
}

// Save edited task
function saveEdit(id) {
    var title = document.getElementById("editTitle-" + id).value;
    var description = document.getElementById("editDesc-" + id).value;
    var status = document.getElementById("editStatus-" + id).value;

    if (!title) {
        alert("Title cannot be empty!");
        return;
    }

    var formData = new FormData();
    formData.append("id", id);
    formData.append("title", title);
    formData.append("description", description);
    formData.append("status", status);

    fetch("../controllers/TaskController.php?action=update", {
        method: "POST",
        body: formData
    })
        .then(function (res) { return res.json(); })
        .then(function () {
            loadTasks();
        });
}

// Cancel edit
function cancelEdit(id) {
    document.getElementById("edit-form-" + id).innerHTML = "";
}

// Previous page
function prevPage() {
    if (currentPage > 0) {
        currentPage--;
        loadTasks();
    }
}

// Next page
function nextPage() {
    currentPage++;
    loadTasks();
}

// Escape single quotes
function escapeQuote(str) {
    return str.replace(/'/g, "\\'");
}

// Load tasks when page opens
loadTasks();