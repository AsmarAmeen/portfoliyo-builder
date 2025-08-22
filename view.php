<?php
include 'config.php';
$sql ="SELECT * FROM Form ORDER BY id DESC";
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
<body>
    <form method="GET" class="mb-3">
<input type="text" name="search" class="form-control" placeholder="Search by Name or Email" value="<?php if(isset($_GET['search'])) echo $_GET['search']; ?>">

<br>
    <table class="table table-bordered table-striped">
        <thead >
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Action</th>
            </tr>
        </thead>


        <tbody>
            <?php
            $search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM Form WHERE name LIKE '%$search%' OR email LIKE '%$search%' ORDER BY id DESC";
$result = $conn->query($sql);

            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                    
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>
                    <a href='form.php?edit={$row['id']}' class='btn btn-primary btn-sm'>Edit</a>
                    <a href='delete.php?id={$row['id']}' class='btn btn-danger btn-sm' onclick=\"return confirm('Are you sure you want to delete this entry?');\">Delete</a>
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