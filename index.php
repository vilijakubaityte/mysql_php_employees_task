<?php
require_once 'db.php';
$result=$db->query('SELECT * FROM employees');
$employees=$result->fetchAll(PDO::FETCH_ASSOC);

$result=$db->query('SELECT * FROM positions');
$positions=$result->fetchAll(PDO::FETCH_ASSOC);


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
        <div class="col-md-12 col-sm-12 mt-5">
            <div class="card">
                <div class="card-header bg-secondary text-white py-3">Darbuotojų sąrašas</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Vardas</th>
                            <th>Pavardė</th>
                            <th>Telefono nr.</th>
                            <th>Išsilavinimas</th>
                            <th>Atlyginimas</th>
                        </tr>
                        </thead>
                        <tbody>
                  <?php foreach ($employees as $employee){?>
                      <tr>
                          <td><?=$employee['id']?></td>
                          <td><?=$employee['name']?></td>
                          <td><?=$employee['surname']?></td>
                          <td><?=$employee['phone']?></td>
                          <td><?=$employee['education']?></td>
                          <td><?=$employee['salary']?></td>
                          <td><a class="btn btn-secondary" href="more.php?id=<?=$employee['id']?>">Plačiau</a> </td>
                      </tr>
                  <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-sm-12 mt-5 my-5">
            <div class="card">
                <div class="card-header bg-secondary text-white py-3">Baziniai darbo užmokesčiai</div>
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                           <th>Pareigos</th>
                            <th>Bazinis darbo užmokestis</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($positions as $position){?>
                            <tr>
                                <td><?=$position['name']?></td>
                                <td><?=$position['base_salary']?></td>
                                <td><a class="btn btn-secondary" href="more.php?id=<?=$position['id']?>">Rodyti darbuotojus</a></td>
                            </tr>
                       <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
