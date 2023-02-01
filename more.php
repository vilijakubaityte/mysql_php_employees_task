<?php
require_once 'db.php';
$id= $_GET['id'];
$stm=$db->prepare("SELECT * FROM employees WHERE id=?");
$stm->execute([$id]);
$employee=$stm->fetch(PDO::FETCH_ASSOC);

function calculateNPD($employee) {
    $salary = $employee['salary'];
    $mma = 840;
    $npd = 0;

    if ($salary > 2865) {
        $npd = 0;
    } elseif ($salary <= 1926) {
        $npd = 625 - 0.42 * ($salary - $mma);
    } else {
        $npd = 400 - 0.18 * ($salary - 642);
    }
    return $npd;
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
<div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header my-5">
                <h1><?=$employee['name']?>
                    <?=$employee['surname']?></h1>
                <hr>
            </div>
        </div>
    </div>
<div class="row">
    <div class="col-md-6">
        <p>
            <b>Išsilavinimas: </b><br/> <?=$employee['education']?>
        </p>
        <p>
            <b>Mėnesinė alga: </b><br/> <?=$employee['salary']?> EUR
        </p>
    </div>
    <div class="col-md-6">
        <p>
            <b>Telefono nr: </b><br/> <?=$employee['phone']?>
        </p>
    </div>
</div>
</div>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card my-5">
                <div class="card-header bg-secondary text-white py-3">Mokesčiai</div>
            <table class="table table-hover">
            <tr>
                <td>Priskaičiuotas atlyginimas „ant popieriaus“:</td>
                <td><?=$employee['salary']?> EUR</td>
            </tr>
            <tr>
                <td>Pritaikytas NPD</td>
                <td><?=$npd = calculateNPD($employee)?> EUR</td>
            </tr>
            <tr>
                <td>Pajamų mokestis 20 %</td>
                <td><?= round(($employee['salary'] - $npd) *  0.2, 2); ?> EUR</td>
            </tr>
            <tr>
                <td>Sodra. Sveikatos draudimas 6,98 %</td>
                <td><?=round($employee['salary'] *  0.0698, 2)?> EUR</td>
            </tr>
            <tr>
                <td>Sodra. Pensijų ir soc. draudimas 12.52 %</td>
                <td><?=round($employee['salary'] * 0.1252, 2)?> EUR</td>
            </tr>
            <tr class="bg-light">
                <td>Išmokamas atlyginimas „į rankas“:</td>
                <td><b><?= round(($employee['salary'] - $npd) - (($employee['salary'] - $npd) *  0.2) - ($employee['salary'] *  0.0698) - ($employee['salary'] * 0.1252) + $npd, 2); ?> EUR</b></td>
            </tr>
            <tr>
                <td colspan="2"><b>Darbo vietos kaina</b></td>
            </tr>
            <tr>
                <td>Sodra 1.77 %:</td>
                <td><?=round($employee['salary'] *  0.0177, 2)?> EUR</td>
            </tr>
            <tr>
                <td>Įmokos į garantinį fondą 0.2 % :</td>
                <td><?=round($employee['salary'] *  0.002, 2)?> EUR</td>

            </tr>
            <tr class="bg-light">
                <td>Visa darbo vietos kaina :</td>
                <td><b><?=round($employee['salary'] + ($employee['salary'] *  0.0177), 2)?></b></td>
            </tr>
        </table>
    </div>
</div>
</div>
</div>
</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>