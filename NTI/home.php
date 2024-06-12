<?php
    $title = "home";
    include "layouts/header.php";
    include "middleware/auth.php";
    include "layouts/nav.php";
    //print_r($_SESSION);die;

    //checkink if user are login in or not

?>


<h1 class="text-center mt-5">Welcome <?= $_SESSION['user']->name ?> </h1>

<?php
include "layouts/footer.php";
?>