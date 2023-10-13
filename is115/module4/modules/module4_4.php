<?php

// Below we create three different job adverts. Each job advert is an array with four key-value pairs.

$boring_job = array(
    "job_title" => "Get your boring job now!",
    "job_description" => "This is a boring job. You will be bored.",
    "application_deadline" => "2023-10-10",
    "location" => "Oslo"
);

$regular_job = array(
    "job_title" => "Just a regular job. But it's yours!",
    "job_description" => "Do you like regular jobs? Then this is the job for you!",
    "application_deadline" => "2023-06-10",
    "location" => "Bergen"
);

$super_job = array(
    "job_title" => "Superhero needed!",
    "job_description" => "We are in need of a superhero. You will be saving the world!",
    "application_deadline" => "As soon as possible",
    "location" => "Worldwide"
);

// Below we create an array of all of the job adverts. This array is a multidimensional array, as it contains three arrays.
$job_listings = array(
    $boring_job,
    $regular_job,
    $super_job
);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Module 4.4</title>
</head>

<body>

    <h1>Welcome to Module 4.4</h1>
    <p>In this assignment, we are creating job adverts. The information of each job is stored inside the job adverts array. Alle of the job adverts are stored in a job listings array.</p>

    <hr />

    <h2>Job Listings</h2>
    <p>See the table down below to find your new job today!</p>

    <table border='1'>
        <tr>
            <th>Job Title</th>
            <th>Job Description</th>
            <th>Application Deadline</th>
            <th>Location</th>
        </tr>

        <?php foreach ($job_listings as $job) : ?>
            <tr>
                <td><?php echo $job['job_title']; ?></td>
                <td><?php echo $job['job_description']; ?></td>
                <td><?php echo $job['application_deadline']; ?></td>
                <td><?php echo $job['location']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <hr />

    <p><a href="../">Click here to go back to Module 4 dashboard</a></p>

</body>

</html>