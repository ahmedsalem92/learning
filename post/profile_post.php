<?php
session_start();
//print_r($_POST);
//print_r($_FILES);

//if the request is get not post
if (empty($_POST)) {
    header('location:../errors/404.php');
    die;
}

//start of validation
$errors = [];

if (empty($_POST['name'])) {
    $errors['name'] = "<div class='alert alert-danger'>Name is Required</div>";
}

if (empty($_POST['email'])) {
    $errors['email'] = "<div class='alert alert-danger'>Email is Required</div>";
}

if (empty($_POST['gender'])) {
    $errors['gender'] = "<div class='alert alert-danger'>Gender is Required</div>";
}

if (empty($errors)) {
    //check if photo is exists
    if ($_FILES['image']['error'] == 0) {
        //validation

        //1. define varaible carry the max size allowed
        $maxuploadsize = 1000000;

        //2. check if the image size greather than the allowed size
        // if it greather then error echoed
        if ($_FILES['image']['size'] > $maxuploadsize) {
            // error saved in the array
            $errors['image-size'] = "<div class='alert alert-danger'>You Must upload image than $maxuploadsize </div>";
        }


        // 1. define varaible by extentions allowed
        $allowedextensions = ["png", "jpg", "jpeg"];

        // 2. define varaible by the photo extention by build in function called passinfo have 2 pramerters
        $photoextention = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        // 3. check if the extention not are like the allowed with 2 function (1> array search this not reqired 2> in array)
        if (!in_array($photoextention, $allowedextensions)) {
            //echo error massage if extention not equal the allowed
            //implode is a build in function change the array to string
            $errors['image-extention'] = "<div class='alert alert-danger'>You Must upload with " . implode(",", $allowedextensions) . "extentions </div>";
        }

        //if there no error in the image
        if (empty($errors)) {

            //chooce the folder that the photo will be uploaded
            $photodirectory = "../images/users/";
            // choose a unik name for a photo will be uploaded
            $photoname = time() . '-' . $_SESSION['user']->id . '.' . $photoextention;
            // make a path for the image source
            $photopath = $photodirectory . $photoname;

            //move the image by method move uploaded file
            move_uploaded_file($_FILES['image']['tmp_name'], $photopath);

            // edit on the session
            $_SESSION['user']->image = $photoname;
        }
    }
    // update on session
    $_SESSION['user']->name = $_POST['name'];
    $_SESSION['user']->email = $_POST['email'];
    $_SESSION['user']->gender = $_POST['gender'];

}
if (empty($errors)) {
    $_SESSION['success'] = "<div class='alert alert-success'>Data Uploaded successfuly</div>";
}

$_SESSION['errors'] = $errors;

header('location:../profile.php');
