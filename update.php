<?php

require_once 'db.php';
$id= $_GET['id'];
$stm=$db->prepare("SELECT * FROM employees WHERE id=?");
$stm->execute([$id]);
$employee=$stm->fetch(PDO::FETCH_ASSOC);

if(isset($_POST['update'])) {
    $stm = $db->prepare("UPDATE `employees` SET name=?, surname=?, phone=?, education=?, salary=? WHERE id=?");
    $stm->execute([$_POST['name'], $_POST['surname'], $_POST['phone'], $_POST['education'], $_POST['salary'], $id]);
    header('location: index.php');
    die();
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-md-6 mt-5">
            <div class="card">
                <div class="card-header">Pridėti darbuotoją: </div>
                <div class="card-body">
                    <form method="post" action="update.php?id=<?=$employee['id']?>">
                        <div class="mb-3">
                            <label class="form-label">Vardas</label>
                            <input type="text" class="form-control" name="name" value="<?=$employee['name']?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pavardė</label>
                            <input type="text" class="form-control" name="surname" value="<?=$employee['surname']?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telefono nr.</label>
                            <input type="text" class="form-control" name="phone" value="<?=$employee['phone']?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Išsilavinimas</label>
                            <input type="text" class="form-control" name="education" value="<?=$employee['education']?>">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Atlyginimas</label>
                            <input type="text" class="form-control" name="salary" value="<?=$employee['salary']?>">
                        </div>
                        <button class="btn btn-success" name="update" value="1">Redagavimas baigtas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
