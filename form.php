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
<li class="nav-item"><a class="nav-link" href="Education.php">Education</a></li>
<li class="nav-item"><a class="nav-link" href="progects.php">progects</a></li>
<li class="nav-item"><a class="nav-link" href="form.php">Form</a></li>
<li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
</ul>
</div>
</div>
</nav>
<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 col-sm-10">
      
      <h2 class="mb-4 text-center">My Progects</h2>

      <?php
      include 'config.php';

      $alertMsg = $alertClass = "";

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $name  = trim($_POST['name']);
          $email = trim($_POST['email']);
          $phone = trim($_POST['phone']);

          if (empty($name) || empty($email) || empty($phone)) {
              $alertMsg = "All fields are required!";
              $alertClass = "alert-danger";
          } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $alertMsg = "Invalid email format!";
              $alertClass = "alert-danger";
          } elseif (!is_numeric($phone) || strlen($phone) != 10) {
              $alertMsg = "Phone must be 10 digits!";
              $alertClass = "alert-danger";
          } else {
              $sql = "INSERT INTO Form (name, email, phone) VALUES ('$name','$email','$phone')";
              if ($conn->query($sql) === TRUE) {
                  $alertMsg = "Entry added successfully!";
                  $alertClass = "alert-success";
              } else {
                  $alertMsg = "Error: " . $sql . "<br>" . $conn->error;
                  $alertClass = "alert-danger";
              }
          }
          $conn->close();

          if ($alertMsg != "") {
              echo "<div class='alert $alertClass alert-dismissible fade show' role='alert'>
                      $alertMsg
                      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>";
          }
      }
      ?>

      <form method="POST" action="" onsubmit="return validateForm()">
        <div class="mb-3">
          <label class="form-label">Name</label>
          <input type="text" id="name" class="form-control" name="name" placeholder="Enter Name">
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" id="email" class="form-control" name="email" placeholder="Enter Email">
        </div>

        <div class="mb-3">
          <label class="form-label">Phone</label>
          <input type="text" id="phone" class="form-control" name="phone" placeholder="Enter Phone">
        </div>

        <div class="d-grid gap-2">
          <button type="submit" class="btn btn-success">Submit</button>
          <button type="reset" class="btn btn-secondary">Clear Form</button>
        </div>
      </form>

    </div>
  </div>
</div>

<script>
function validateForm() {
    let name  = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let phone = document.getElementById("phone").value.trim();

    if (name === "" || email === "" || phone === "") { 
        showAlert("All fields required!", "danger");
        return false; 
    }
    if (!email.includes("@")) { 
        showAlert("Invalid email!", "danger");
        return false; 
    }
    if (phone.length !== 10 || isNaN(phone)) { 
        showAlert("Phone must be 10 digits!", "danger");
        return false; 
    }
    return true;
}

function showAlert(message, type) {
    const container = document.querySelector('.container .col-lg-6');
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.role = "alert";
    alertDiv.innerHTML = `${message} <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>`;
    container.insertBefore(alertDiv, container.firstChild);
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
