<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 5.5</title>
</head>

<h1>Module 5.5</h1>
<p>In module 5.5, we have created a simple temperature converter that lets the user convert celsius temps to fahrenheit temps.</p>

<hr />

<h1>Celsius to Fahrenheit Converter</h1>

<?php
// Check if the server request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the temperature value from the POST request
    $temperature = $_POST["temperature"];
    // Get the unit of the temperature (Celsius or Fahrenheit) from the POST request
    $unit = $_POST["unit"];

    // If the unit is Celsius
    if ($unit == "celsius") {
        // Convert the temperature from Celsius to Fahrenheit
        $fahrenheit = ($temperature * 9 / 5) + 32;
        // Display the converted temperature
        echo "<p>{$temperature} Celsius is equal to {$fahrenheit} Fahrenheit.</p>";
    }
    // If the unit is Fahrenheit
    elseif ($unit == "fahrenheit") {
        // Convert the temperature from Fahrenheit to Celsius
        $celsius = ($temperature - 32) * 5 / 9;
        // Display the converted temperature
        echo "<p>{$temperature} Fahrenheit is equal to {$celsius} Celsius.</p>";
    }
}
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    <label for="temperature">Temperature:</label>
    <input type="number" id="temperature" name="temperature" min="-40" max="100" required>

    <label for="unit">Unit:</label>
    <select id="unit" name="unit" required>
        <option value="celsius">Celsius</option>
        <option value="fahrenheit">Fahrenheit</option>
    </select>

    <input type="submit" value="Convert">
</form>

<p><i>(The min and max temperature are limited to the most commonly encountered ranges of weather temperature for both fahrenheit and celsius)</i></p>

<hr />

<p><a href="../">Click here to go back to Module 5 dashboard</a></p>

</body>

</html>