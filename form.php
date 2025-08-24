<?php include("config.php"); 


// Handle update form submission
if ($_SERVER["REQUEST_METHOD"] == "POST")  {
    $id = $_POST['id'];
    $name = $_POST['name'];
     $description = $_POST['description'];
    $stack = $_POST['stack'];

        if (isset($_POST['id']) && !empty($_POST['id'])) {
          // Update
          $id = $_POST['id'];
    $sql = "UPDATE progects SET name=?, description=?, stack=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $name, $description, $stack, $id);
    $stmt->execute();

    header("Location: view.php");
    exit;

     } else {
        // Insert
        $sql = "INSERT INTO progects (name, description, stack) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $name, $description, $stack);
        $stmt->execute();
    }
  }

// If edit button clicked, get task data
$editTask = null;
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $result = $conn->query("SELECT * From progects WHERE id = $id");
    $editTask = $result->fetch_assoc();
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Responsive Form</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
<a class="navbar-brand" href="#">Portfolio Builder</a>
<div>
<ul class="navbar-nav">
<li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
<li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
<li class="nav-item"><a class="nav-link" href="form.php">Form</a></li>
<li class="nav-item"><a class="nav-link" href="view.php">Progects</a></li>
<li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>

</ul>
</div>
</div>
</nav>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-sm-10">
      
      <h2 class="mb-4 text-center">My Progects</h2>


      <form method="POST" action="" onsubmit="return validateForm()">
       <input type="hidden" name="id" value="<?php echo $editTask['id'] ?? ''; ?>">

          <div class="mb-3">
            <label class="form-label">Progect Title</label>
            <input type="text" id="name" name="name" class="form-control" oninput="this.value = this.value.toUpperCase()" placeholder="Enter Name"
           
                  value="<?php echo $editTask['name'] ?? ''; ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Progect Description</label>
            <input type="description" id="description" class="form-control" name="description" placeholder="Enter Description"
                  value="<?php echo $editTask['description'] ?? ''; ?>">
          </div>

          <div class="mb-3">
            <label class="form-label">Teck stack</label>
            <input type="text" id="stack" class="form-control" name="stack" placeholder="Enter stack"
                  value="<?php echo $editTask['stack'] ?? ''; ?>">
          </div>

          <div class="d-grid gap-2">
            <button type="submit" class="btn btn-success">
              <?php echo isset($editTask) ? "Update" : "Submit"; ?>
            </button>
            <button type="reset" class="btn btn-secondary">Clear Form</button>
          </div>
      </form>

    </div>
  </div>
</div>

<script>
function validateForm() {
    let name  = document.getElementById("name").value.trim();
    let description = document.getElementById("description").value.trim();
    let stack = document.getElementById("stack").value.trim();

    if (name === "" || description === "" || stack === "") { 
        showAlert("All fields required!", "danger");
        return false; 
    }

    showAlert("Form submitted successfully!", "success");
   
    return true;
  
}

function showAlert(message, type) {
    const container = document.querySelector('.container .col-lg-6');
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.role = "alert";
    alertDiv.innerHTML = `${message} <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>`;
    container.insertBefore(alertDiv, container.firstChild);
   setTimeout(() => {
        const bsAlert = bootstrap.Alert.getOrCreateInstance(alertDiv);
        bsAlert.close();
    }, 5000);
  
}



document.getElementById("name").addEventListener("input", function() {
    let name = this.value;
    if(name.length < 3){
    this.style.borderColor = "red";
    } else {
    this.style.borderColor = "green";
    }
});


</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
