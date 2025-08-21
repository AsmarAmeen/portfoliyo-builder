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

            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    echo "<tr>
                    
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['email']}</td>
                    <td>{$row['phone']}</td>
                    <td>{$row['created_at']}</td>
                    
                    </tr>";


                }
            }
            else{
                    echo "<tr><td colspan='5'>No entries found</td></tr>";
}
?>
</tbody>
</table>
</div>



        </tbody>

</body>
</html>