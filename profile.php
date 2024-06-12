<?php

$title = "profile";
include "layouts/header.php";
include "middleware/auth.php";
include "layouts/nav.php";

?>

<div class="container mt-5">
    <div class="row">
        <div class="col-6 offset-3">
            <form action="post/profile_post.php" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-12">
                        <?php
                        if (!empty($_SESSION['success'])) {
                            echo $_SESSION['success'];
                        }
                        if (!empty($_SESSION['errors']['image-size'])) {
                            echo $_SESSION['errors']['image-size'];
                        }
                        if (!empty($_SESSION['errors']['image-extention'])) {
                            echo $_SESSION['errors']['image-extention'];
                        }
                        ?>
                    </div>
                    <div class="col-6 offset-3">
                        <img src="images/users/<?= $_SESSION['user']->image; ?>" alt="" class="w-100 rounded-circle">
                        <input type="file" name="image" class="form-control" id="">

                    </div>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" value="<?= $_SESSION['user']->name ?>" id="name" class="form-control" placeholder="" aria-describedby="helpId">
                    <?php
                    if (!empty($_SESSION['errors']['name'])) {
                        echo $_SESSION['errors']['name'];
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" value="<?= $_SESSION['user']->email ?>" id="email" class="form-control" placeholder="" aria-describedby="helpId">
                    <?php
                    if (!empty($_SESSION['errors']['email'])) {
                        echo $_SESSION['errors']['email'];
                    }
                    ?>
                </div>
                <div class="form-group">
                    <label for="gender">Gender</label>
                    <select name="gender" id="id" class="form-control">
                        <option <?php if ($_SESSION['user']->gender == 'm') {
                                    echo "selected";
                                } ?> value="m">Male</option>
                        <option <?= ($_SESSION['user']->gender == 'f') ? 'selected' : ''; ?> value="f">Female</option>
                    </select>
                    <?php
                    if (!empty($_SESSION['errors']['gender'])) {
                        echo $_SESSION['errors']['gender'];
                    }
                    ?>
                </div>
                <div class="form-group">
                    <button class="btn btn-warning rounded"> Update</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
// delete the error after echo
unset($_SESSION['success']);
unset($_SESSION['errors']);
include "layouts/footer.php";
?>