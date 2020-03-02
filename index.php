<?php include('views/_partials/head.php');?>


<!--Select user query-->
<?php
//$user = $query_builder->selectUser(1);
//echo $user->name;
?>


<!--Update user query-->
<?php
//$user = $query_builder->updateUser('sss', '2011-03-01', 1);
//echo $user;
?>

<!--Create user query-->
<?php

//$user = $query_builder->createUser('srdaajan', '1990-03-01');
//echo "This is " . $user->name . ", born in " . $user->year_of_birth;

?>



<?php

if (isset($_GET['userId']) && isset($_POST['name'])) {
    $updated = date('Y-m-d');

    $user = $query_builder->updateUser($_GET['name'], $updated, $_GET['userId']);
    echo $user;

} else if (isset($_POST['name'])) {

    $user = $query_builder->createUser($_POST['name'], $_POST['yearOfBirth']);
    echo "This is " . $user->name . ", born in " . $user->year_of_birth;

} else if (isset($_GET['userId'])) {

    $user = $query_builder->selectUser($_GET['userId']);
    echo $user->name;

}


?>






<?php include('views/_partials/footer.php');?>