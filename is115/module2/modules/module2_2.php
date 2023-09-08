<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 2.2</title>
</head>

<script>
    <?php $l_name = "<strong>Tange</strong><?php ?>ra<em>as</em>" ?>
</script>

<body>

    <h1>Welcome to Module 2.2</h1>

    <p>Below we demonstrate how you can remove HTML- and PHP-code from a predefined String variable using the strip_tags() function.</p>

    <hr />

    <h2>Before formating</h2>
    <p>This is the last name variable before reformating: <?php echo htmlentities($l_name) ?></p>
    <p>At this point in time, you can see that our string value contains the HTML tags for strong and italic, and the PHP initializer &lt;?php ?&gt;.</p>

    <hr />

    <?php $l_name = strip_tags($l_name); ?>

    <h2>After formating</h2>
    <p>This is the last name variable after reformating: <?php echo htmlentities($l_name) ?></p>

    <hr />

    <p><a href="../">Click here to go back to Module 2 dashboard</a></p>

</body>

</html>