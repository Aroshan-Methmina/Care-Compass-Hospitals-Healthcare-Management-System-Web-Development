<?php
require '../connection.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Data</title>
</head>
<body>
    <table border="1" cellspacing="0" cellpadding="10">
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Image</td>
        </tr>
        <?php
        $i = 1;
        $result = mysqli_query($database, "SELECT * FROM result ORDER BY resultid DESC");

        while ($row = mysqli_fetch_assoc($result)) :
        ?>
        <tr>
            <td><?php echo $i++; ?></td>
            <td><?php echo htmlspecialchars($row["name"]); ?></td>
            <td>
                <img src="img/<?php echo htmlspecialchars($row["image"]); ?>" width="200" title="<?php echo htmlspecialchars($row['image']); ?>">
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <br>
    <a href="../uploadimagefile">Upload Image File</a>
</body>
</html>
