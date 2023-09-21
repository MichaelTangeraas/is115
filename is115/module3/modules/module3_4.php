<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 3.4</title>
</head>

<script>
    <?php

    $county = "Unknown";

    if (isset($_REQUEST['municipality'])) {
        switch ($_REQUEST['municipality']) {
            case 'Kristiansand':
            case 'Lillesand':
            case 'Birkenes':
                $county = "Agder";
                break;
            case 'Harstad':
            case 'Kvæfjord':
            case 'Tromsø':
            case 'Alta':
                $county = "Troms";
                break;
            case 'Bergen':
                $county = "Vestland";
                break;
            case 'Trondheim':
                $county = "Trøndelag";
                break;
            case 'Bodø':
                $county = "Nordland";
                break;
        }
    }

    $municipality = isset($_REQUEST['municipality']) ? $_REQUEST['municipality'] : '';
    ?>
</script>

<body>

    <h1>Welcome to Module 3.4</h1>
    <p>In this assigment we are using the switch statement to display a custom message based on the selected municipality.</p>

    <hr />

    <form method="post">
        <label for="municipality">Select a municipality:</label>
        <select name="municipality" id="municipality">
            <option value="">Select a municipality</option>
            <option value="Kristiansand">Kristiansand</option>
            <option value="Lillesand">Lillesand</option>
            <option value="Birkenes">Birkenes</option>
            <option value="Harstad">Harstad</option>
            <option value="Kvæfjord">Kvæfjord</option>
            <option value="Tromsø">Tromsø</option>
            <option value="Alta">Alta</option>
            <option value="Bergen">Bergen</option>
            <option value="Trondheim">Trondheim</option>
            <option value="Bodø">Bodø</option>
        </select>
        <button type="submit">Submit</button>
    </form>

    <?php if (!empty($municipality)) { ?>
        <p><?php echo $municipality; ?> is located in <?php echo $county; ?> county.</p>
    <?php } ?>

    <hr />

    <p><a href="../">Click here to go back to Module 3 dashboard</a></p>

</body>

</html>