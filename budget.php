<?php

session_start();
if (!(isset($_SESSION['login']) && $_SESSION['login'] == 1)) {
    header("location:login.php");
    die();
}
include("db.php");


if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $sql = "DELETE FROM income WHERE id=?";
    $pstm = $pdo->prepare($sql);
    $pstm->execute([$_GET['id']]);
}


$sql = "SELECT id,category,value,date,source,notes FROM income ORDER BY date ASC";
$pstm = $pdo->prepare($sql);
$pstm->execute([]);
$income = $pstm->fetchAll(PDO::FETCH_ASSOC);

$sql2 = "SELECT id,category,value,date,whereSpend,notes FROM expenses ORDER BY date ASC";
$pstm2 = $pdo->prepare($sql2);
$pstm2->execute([]);
$expenses = $pstm2->fetchAll(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My budget</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <div class="container mb-5">
        <a href="login.php?logout=1">Log out</a>
        <?php include "password.php"; ?>
        <div class="row">
            <div class="col-sm-6">
                <div class="card mt-5">

                    <div class="card-header">Income</div>
                    <div class="card-body">

                        <a href="newIncome.php" class="btn btn-success mb-3 ">Add income</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Value</th>
                                    <th>Date</th>
                                    <th>From (optional)</th>
                                    <th>Notes (optional)</th>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($income as $profit) { ?>
                                    <tr>
                                        <td><?php
                                            switch ($profit['category']) {
                                                case 0:
                                                    echo "Salary";
                                                    break;
                                                case 1:
                                                    echo "Gifts";
                                                    break;
                                                case 2:
                                                    echo "Odd jobs";
                                                    break;
                                                case 3:
                                                    echo "Stocks";
                                                    break;
                                                case 4:
                                                    echo "Other";
                                                    break;
                                            } ?></td>
                                        <td><?= $profit['value'] ?> EUR</td>
                                        <td><?= $profit['date'] ?></td>
                                        <td><?= $profit['source'] ?></td>
                                        <td><?= $profit['notes'] ?></td>
                                        <td>

                                            <a href="edit_income.php?id=<?= $profit['id'] ?>" class="link-warning">Edit</a>
                                            <a href="budget.php?action=delete&id=<?= $profit['id'] ?>" class="link-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td>Total income: </td>
                                    <td>
                                        <?php
                                        $sql4 = "SELECT SUM(value) FROM income";
                                        $pstm4 = $pdo->prepare($sql4);
                                        $pstm4->execute([]);
                                        $income = $pstm4->fetchAll(PDO::FETCH_ASSOC);
                                        $incomeArr = array_pop($income);
                                        $totalIncome = array_pop($incomeArr);
                                        print_r($totalIncome / 100 . " EUR");
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="card mt-5">
                    <div class="card-header">Expenses</div>
                    <div class="card-body">
                        <a href="newExpenses.php" class="btn btn-success mb-3 ">Add expenses</a>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Value</th>
                                    <th>Date</th>
                                    <th>To (optional)</th>
                                    <th>Notes (optional)</th>
                                    <td></td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($expenses as $expense) { ?>
                                    <tr>
                                        <td><?php
                                            switch ($expense['category']) {
                                                case 0:
                                                    echo "Food/Drinks";
                                                    break;
                                                case 1:
                                                    echo "Taxes";
                                                    break;
                                                case 2:
                                                    echo "Rent/Loan";
                                                    break;
                                                case 3:
                                                    echo "Transportation";
                                                    break;
                                                case 4:
                                                    echo "Family";
                                                    break;
                                                case 5:
                                                    echo "Health/Sport";
                                                    break;
                                                case 6:
                                                    echo "Pets";
                                                    break;
                                                case 7:
                                                    echo "Shopping";
                                                    break;
                                                case 8:
                                                    echo "Entertainment";
                                                    break;
                                                case 9:
                                                    echo "Home";
                                            } ?></td>
                                        <td><?= $expense['value'] / 100 ?> EUR</td>
                                        <td><?= $expense['date'] ?></td>
                                        <td><?= $expense['whereSpend'] ?></td>
                                        <td><?= $expense['notes'] ?></td>
                                        <td>
                                            <a href="edit_expenses.php?id=<?= $expense['id'] ?>" class="link-warning">Edit</a>
                                            <a href="budget.php?action=delete&id=<?= $expense['id'] ?>" class="link-danger">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td>Total expenses: </td>
                                    <td>
                                        <?php
                                        $sql3 = "SELECT SUM(value)  FROM expenses";
                                        $pstm3 = $pdo->prepare($sql3);
                                        $pstm3->execute([]);
                                        $expenses = $pstm3->fetchAll(PDO::FETCH_ASSOC);
                                        $expensesArr = array_pop($expenses);
                                        $totalExpenses = array_pop($expensesArr);
                                        print_r($totalExpenses / 100 . " EUR");
                                        ?>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>