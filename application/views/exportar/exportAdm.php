<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title></title>
</head>
<body>

    <table class="table table-hover table-bordered  table-striped">

    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>

    </tr>
    <?php 
    foreach ($resultado as $user) { ;?>
        <tr>
        <center>
            <td><?php echo $user->idusuario ?> </td>
            <td><?php echo $user->nome ?> </td>
            <td><?php echo $user->email ?> </td>
        </center>
        </tr>
        <?php 
    }
    ;?>

 </table>


</body>
</html> 

