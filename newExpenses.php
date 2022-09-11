<?php
include("db.php");
if (isset($_POST['action']) && $_POST['action'] == 'insert') {
    try {

        $sql = "INSERT INTO expenses (category,value,date,whereSpend,notes) VALUES (?, ?, ?, ?, ?)";
        $stm = $pdo->prepare($sql);
        $stm->execute([$_POST['category'], $_POST['value'], $_POST['date'], $_POST['whereSpend'], $_POST['notes']]);
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
    <title>Expenses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>

<body>
    <div class="container mb-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card mt-5 mb-5">
                    <div class="card-header">Insert new expenses</div>
                    <div class="card-body">
                        <?php
                        if (isset($error)) {
                        ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php } ?>
                        <form action="" method="POST">
                            <input type="hidden" name="action" value="insert">
                            <div class="mb-3">
                                <label for="" class="form-label">Category:</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" value="0">
                                    <label class="form-check-label">
                                        Food/Drinks
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" value="1">
                                    <label class="form-check-label">
                                        Taxes
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" value="2">
                                    <label class="form-check-label">
                                        Rent/Loan
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" value="3">
                                    <label class="form-check-label">
                                        Transportation
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" value="4">
                                    <label class="form-check-label">
                                        Family
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" value="5">
                                    <label class="form-check-label">
                                        Health/Sport
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" value="6">
                                    <label class="form-check-label">
                                        Pets
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" value="7">
                                    <label class="form-check-label">
                                        Shopping
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" value="8">
                                    <label class="form-check-label">
                                        Entertainment
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="category" value="4">
                                    <label class="form-check-label">
                                        Home
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Value:</label>
                                <input name="value" type="number" class="form-control" value="value">
                            </div>
                            <?php print_r($expense); ?>

                            <div class="mb-3">
                                <label for="" class="form-label">Date:</label>
                                <input name="date" type="date" class="form-control" value="date">
                            </div>
                            <?php print_r($expense); ?>
                            <div class="mb-3">
                                <label for="" class="form-label">For (optional):</label>
                                <input name="source" type="text" class="form-control" value="whereSpend">
                            </div>
                            <div class="mb-3">
                                <label for="" class="form-label">Notes (optional):</label>
                                <input name="notes" type="text" class="form-control" value="notes">
                            </div>
                            <button class="btn btn-success" type="submit" value="submit">Add new</button>
                            <a href="budget.php" class="btn btn-info float-end">Go back</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

</html>