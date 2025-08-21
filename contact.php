<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Me</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
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
<section class="py-5 bg-light" id="contact">
  <div class="container">
    <div class="row justify-content-center">
      
      <!-- Title -->
      <div class="col-lg-8 text-center mb-5">
        <h2 class="fw-bold">Contact Me</h2>
        <p class="text-muted">Feel free to get in touch using the form below.</p>
      </div>
      
      <!-- Contact Form -->
      <div class="col-lg-6">
        <?php
        include 'config.php';

        $alertMsg = $alertClass = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $name    = trim($_POST['name']);
            $email   = trim($_POST['email']);
            $message = trim($_POST['message']);

            // Server-side validation
            if(empty($name) || empty($email) || empty($message)) {
                $alertMsg = "All fields are required!";
                $alertClass = "alert-danger";
            } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $alertMsg = "Invalid email format!";
                $alertClass = "alert-danger";
            } else {
                // Insert into database
                $stmt = $conn->prepare("INSERT INTO builder (name, email, message) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $name, $email, $message);

                if($stmt->execute()) {
                    $alertMsg = "Your message has been sent successfully!";
                    $alertClass = "alert-success";
                } else {
                    $alertMsg = "Error: " . $stmt->error;
                    $alertClass = "alert-danger";
                }
                $stmt->close();
            }
            $conn->close();

            // Show alert
            if($alertMsg != ""){
                echo "<div class='alert $alertClass alert-dismissible fade show' role='alert'>
                        $alertMsg
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                      </div>";
            }
        }
        ?>

        <form method="POST" action="" onsubmit="return validateForm()">
          <div class="mb-3">
            <label for="name" class="form-label">Your Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
          </div>
          
          <div class="mb-3">
            <label for="email" class="form-label">Your Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
          </div>
          
          <div class="mb-3">
            <label for="message" class="form-label">Message</label>
            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Write your message here..."></textarea>
          </div>
          
          <button type="submit" class="btn btn-primary w-100">Send Message</button>
        </form>

      </div>

    </div>
  </div>
</section>

<script>
function validateForm() {
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let message = document.getElementById("message").value.trim();

    if(name === "" || email === "" || message === "") {
        alert("All fields are required!");
        return false;
    }
    if(!email.includes("@")) {
        alert("Invalid email!");
        return false;
    }
    return true;
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
