<?php
include 'config.php';
$sql ="SELECT * FROM progects ORDER BY id DESC";
$result =$conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>portfoliyo Builder </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-marker">
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
<div class="container mt-5">


    <form method="GET" class="mb-2">
<input type="text" name="search" class="form-control" placeholder="Search by Name or Email" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>">

<br>
    <table class="table table-bordered table-striped" text-align="center">
        <thead >
            <tr class="table-dark text-center">

                <th >ID</th>
                <th>Progect Title</th>
                <th>Description</th>
                <th>Teck Stack</th>
                <th>Action</th>
             
            </tr>
        </thead>


        <tbody>
            <?php
            

            $search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM progects WHERE name LIKE '%$search%' OR description LIKE '%$search%' ORDER BY id DESC";
$result = $conn->query($sql);

            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                   
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['stack']}</td>

                    <td class='text-center'>


                    <div class='d-flex justify-content-center gap-2'>
                    <a href='form.php?edit={$row['id']}' class='btn btn-primary btn-sm'>Edit</a> 
                    <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this entry?');\">Delete</a>
                    <a href='https://github.com/' target='_blank' class='btn btn-info btn-sm'>View</a>
                    </div>
                </td>
                    
                 
                           </tr>";


                }
            }
            else{
                    echo "<tr><td colspan='5'>No entries found</td></tr>";
}


?>
</tbody>
</table>
</form>



</div>



        </tbody>
      

</body>

</html>