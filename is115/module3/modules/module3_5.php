<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 3.5</title>
</head>

<script>
    <?php

    $grain_weight = 0.035; // in grams
    $num_rows = 8;
    $num_cols = 8;

    $totalGrains = 0;
    $grainsOnCurrentSquare = 1;

    // Create an array to store the number of grains on each square
    $grainsArray = [];

    // Loop through each square on the chessboard
    for ($row = 1; $row <= $num_rows; $row++) {
        for ($col = 1; $col <= $num_cols; $col++) {
            // Calculate the total grains and update current square's grain count
            $totalGrains += $grainsOnCurrentSquare;
            // Double the grains for the next square
            $grainsOnCurrentSquare *= 2;
        }
    }

    // NOTE: This is not working, most likely because of the size of the number and how number_format() works handles these large numbers.
    $totalGrains = $totalGrains - 1;

    // Convert total grains to weight in grams
    $totalWeightGrams = $totalGrains * $grain_weight;

    // Convert grams to tons
    $totalWeightTons = $totalWeightGrams / 1000000;

    ?>
</script>

<body>

    <h1>Welcome to Module 3.5</h1>
    <p>In this assigment we are using a "for loop" to distribute and double grains of wheat on a chessboard.</p>

    <hr />

    <h2>Grains of Wheat on a Chessboard</h2>
    <p>See the module3_5.php file for the script that provides the results displayed underneath.</p>

    <h2>Results:</h2>
    <p>Total grains of wheat: <?php echo number_format($totalGrains); ?></p>
    <p>Total weight in grams: <?php echo number_format($totalWeightGrams, 2); ?> grams</p>
    <p>Total weight in tons: <?php echo number_format($totalWeightTons, 2); ?> tons</p>

    <hr />

    <p><a href="../">Click here to go back to Module 3 dashboard</a></p>

</body>

</html>