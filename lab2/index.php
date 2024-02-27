<?php
session_start();
require_once 'autoload.php';

$counter = new Counter(COUNTER_FILE);
if(!Visitor::isCounted()){
    $counter ->incrementVisitsCount();
}

$visitsCount = $counter->getVisitCount();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visits Counter</title>
</head>
<body>
   <h1> Counted Unique Visitors :<br><br> <?php echo $visitsCount ?> </h1>
</body>
</html>