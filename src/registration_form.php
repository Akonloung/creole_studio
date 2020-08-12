<?php
/* Database connection include */
include __DIR__ . '/../db/db.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <style>
            .help-block{
                color: red !important;
            }
        </style>
        <title>Registration</title>

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

        <!-- jQuery library -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- Bootstrap JS -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    </head>
    <body>
        <div class='container'>
            <div class='row'>
                <div class='col-md-6' >
                    <em id="signInMsg"></em>
                    <form method='post' action='' id="registrationForm" onSubmit="return false;">
                        <h1>Registration Form</h1>
                        <?php
                        if (!empty($error_message)) {
                            ?>
                            <div class="alert alert-danger">
                                <strong>Error!</strong> <?= $error_message ?>
                            </div>
                            <?php
                        }
                        ?>
                        <?php
                        if (!empty($success_message)) {
                            ?>
                            <div class="alert alert-success">
                                <strong>Success!</strong> <?= $success_message ?>
                            </div>
                            <?php
                        }
                        ?>
                        <div class="form-group">
                            <label for="fname">First Name:</label>
                            <input type="text" class="form-control" name="fname" id="fname" maxlength="80">
                            <p class="help-block help-block-error fname-error"></p>

                        </div>
                        <div class="form-group">
                            <label for="lname">Last Name:</label>
                            <input type="text" class="form-control" name="lname" id="lname" maxlength="80">
                            <p class="help-block help-block-error lname-error"></p>

                        </div>
                        <div class="form-group">
                            <label for="email">Email address:</label>
                            <input type="email" class="form-control" name="email" id="email" maxlength="80">
                            <p class="help-block help-block-error email-error"></p>

                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" class="form-control" name="password" id="password" maxlength="80">
                            <p class="help-block help-block-error password-error"></p>

                        </div>
                        <div class="form-group">
                            <label for="pwd">Confirm Password:</label>
                            <input type="password" class="form-control" name="confirmpassword" id="confirmpassword" onkeyup=''  maxlength="80">
                            <p class="help-block help-block-error cpassword-error"></p>

                        </div>
                        <label for="hobbies">Gender:</label>
                        <div class="form-group">
                            <label class="radio-inline"><input type="radio" name="gender" checked value="1">Male</label>
                            <label class="radio-inline"><input type="radio" name="gender" value="2">Female</label>
                        </div>
                        <label for="hobbies">Hobby:</label>
                        <div class="form-group" id="checkbox_section">
                            <label class="checkbox-inline hobbies"><input type="checkbox" name="hobbies[]" value="1">Social Activity</label>
                            <label class="checkbox-inline hobbies"><input type="checkbox" name="hobbies[]" value="2">Music</label>
                            <label class="checkbox-inline hobbies"><input type="checkbox" name="hobbies[]" value="3">Dance</label>
                            <label class="checkbox-inline hobbies"><input type="checkbox" name="hobbies[]" value="4">Sports</label>
                            <label class="checkbox-inline hobbies"><input type="checkbox" name="hobbies[]" value="5">Traveling</label>
                        </div>
                        <p class="help-block help-block-error hobby-error"></p>
                        <button type="submit" name="btnsignup" id="registrationSubmit" class="btn btn-default" onClick="return formValidate('#registrationForm', '#signInMsg');">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
<script>
    function formValidate(formId, formMsg) {
        /*Form Fields Validation */
        var fname = $('#fname').val();
        if (fname == '') {
            $('.fname-error').text('First Name cannot ne blank.');
            return false;
        }
        var lname = $('#lname').val();
        if (lname == '') {
            $('.lname-error').text('Last Name cannot ne blank.');
            return false;
        }
        var email = $('#email').val();
        if (email == '') {
            $('.email-error').text('Email cannot ne blank.');
            return false;
        }
        var password = $('#password').val();
        if (password == '') {
            $('.password-error').text('Password cannot ne blank.');
            return false;
        }

        var confirmpassword = $('#confirmpassword').val();
        if (confirmpassword == '') {
            $('.cpassword-error').text('Confirm Password cannot ne blank.');
            return false;
        }
        /*Checbox Jquery */
        var checkbox = document.getElementsByName('hobbies[]');
        var ln = 0;
        for (var i = 0; i < checkbox.length; i++) {
            if (checkbox[i].checked)
                ln++
        }
        if (ln == 0) {
            $('.hobby-error').text('Please select atleast one hobby');
            return false;
        } else if (ln > 3) {
            $('.hobby-error').text('You can select max 3 hobbies.');
            return false;
        }
        /* Password - confirm password validation*/
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirmpassword").value;
        if (password != confirmPassword) {
            $('.cpassword-error').text('Confirm Password must be equal to Password');
            return false;

        }
        /* Form Submit - Ajax*/
        $.ajax({
            type: 'POST',
            url: 'actions/form-action.php',
            data: $(formId).serialize(),
            success: function (data) {
                console.log(data);
                window.location = 'success.php';
            }
        });

    }
</script>