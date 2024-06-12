<?php $title = "login"; ?>

<?php include "layouts/header.php"; ?>
<?php include "layouts/nav.php"; ?>

<?php

include "middleware/guest.php";

$users = [
    (object)[
        'id' => 1,
        'name' => 'ahmed',
        "gender" => 'm',
        'image' => '1.jpg',
        'email' => 'ahmed@gmail.com',
        'password' => 123456
    ],
    (object)[
        'id' => 1,
        'name' => 'moahmed',
        "gender" => 'm',
        'image' => '2.jpg',
        'email' => 'mohamed@gmail.com',
        'password' => 123456
    ],
    (object)[
        'id' => 1,
        'name' => 'esraa',
        "gender" => 'f',
        'image' => '3.jpg',
        'email' => 'esraa@gmail.com',
        'password' => 123456
    ],
];


// check if user press on submit or not

if ($_POST) {
    //print_r($_POST);die;

    //create an array to safe massage in it
    $errors = [];

    // check if the email is empty or no and if it empty appear massange
    if (empty($_POST['email'])) {
        $errors['email'] = "<div class='alert alert-danger'> Email is Required </div>";
    }

    // check if the email is empty or no and if it empty appear massange
    if (empty($_POST['password'])) {
        $errors['password'] = "<div class='alert alert-danger'> Password is Required </div>";
    }
    //print_r($errors);die;


    // if there aren't no error in the entered data from user
    if (empty($errors)) {
        // i will loop in the array to check in it if the data or same or not
        foreach ($users as $index => $user) {
            if ($_POST['email'] == $user->email && $_POST['password'] == $user->password) {
                //authenticated user
                //store user data into session

                $_SESSION['user'] = $user;

                //header to home page
                header('location:home.php');
                die;

                //break loop                
            }
        }

        //unauthenticated user and print error message
        $errors['wrong-attempt'] = "<div class='alert alert-danger'> wrong email or password </div>";
    }
}

?>



<div class="contianter mt-5">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="text-dark h1">login</h1>
        </div>
        <div class="offset-4 col-4">
            <form action="" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?php if (isset($_POST['email'])) {
                                                                                                echo $_POST['email'];
                                                                                            } ?>" placeholder="" aria-describedby="helpId">
                    <?php

                    //check first if the array of errors are saving data for email then echo it
                    if (isset($errors['email'])) {
                        echo $errors['email'];
                    }
                    if (isset($errors['wrong-attempt'])) {
                        echo $errors['wrong-attempt'];
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="" aria-describedby="helpId">
                    <?php

                    //check second if the array of errors are saving data for password then echo it
                    if (isset($errors['password'])) {
                        echo $errors['password'];
                    }
                    ?>
                </div>
                <div class="form-group">
                    <button class="btn btn-dark rounded"> Login </button>
                </div>
            </form>
        </div>
    </div>
</div>


<?php include "layouts/footer.php" ?>