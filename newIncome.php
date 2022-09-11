<?php
include("db.php");
if (isset($_POST['action']) && $_POST['action'] == 'insert') {
    try {

        $sql = "INSERT INTO income (category,value,date,source,notes) VALUES (?, ?, ?, ?, ?)";
        $stm = $pdo->prepare($sql);
        $stm->execute([$_POST['category'], $_POST['value'], $_POST['date'], $_POST['source'], $_POST['notes']]);
        header("location:budget.php");
        die();
    } catch (Exception $e) {

        $error = "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Income</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5">
                    <div class="card-header">Insert new income</div>
                    <div class="card-body">
                        <?php
                        if (isset($error)) {
                        ?>
                            <div class="alert alert-danger"><?= $error ?></div>

                        <?php
                        }
                        ?>
                        <form action="" method="POST">
                            <input type="hidden" name="action" value="insert">
                            <div class="mb-3">
                                <label for="" class="form-label">Category:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" value="0">
                                    <label class="form-check-label">
                                        Salary
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" value="1">
                                    <label class="form-check-label">
                                        Gifts
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" value="2">
                                    <label class="form-check-label">
                                        Odd Jobs
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" value="3">
                                    <label class="form-check-label">
                                        Stocks
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" value="4">
                                    <label class="form-check-label">
                                        Other
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Value:</label>
                                <input name="value" type="number" class="form-control" value="value">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Date:</label>
                                <input name="date" type="date" class="form-control" value="date">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">From (optional):</label>
                                <input name="source" type="text" class="form-control" value="source">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Notes (optional):</label>
                                <input name="notes" type="text" class="form-control" value="notes">
                            </div>
                            <button class="btn btn-success" type="submit" value="submit">Insert new</button>
                            <a href="budget.php" class="btn btn-info float-end">Go back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>