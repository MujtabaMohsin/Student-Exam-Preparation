<!DOCTYPE html>
<html>

<head>
    <title>KFUPM Exam Preperation</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css"
        integrity="sha512-xA6Hp6oezhjd6LiLZynuukm80f8BoZ3OpcEYaqKoCV3HKQDrYjDE1Gu8ocxgxoXmwmSzM4iqPvCsOkQNiu41GA=="
        crossorigin="anonymous" />
    <link rel="stylesheet" href="./assets/signInNUp/styles.css" />
    <?php
        session_start();
        if(isset($_SESSION['signUpMessage'])){
            echo "<script> const signUpMessage = '{$_SESSION['signUpMessage']}';</script>";
        }
        if(isset($_SESSION['signInMessage'])){
            echo "<script> const signInMessage = '{$_SESSION['signInMessage']}';</script>";
        }
    ?>
</head>

<body>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form method="POST" action="signUp.php">
                <h1>Create Account</h1>
                <input type="text" placeholder="Name" name="signUpName" required/>
                <input type="email" placeholder="Email" name="signUpEmail" required/>
                <input type="password" placeholder="Password" name="signUpPassword" required/>
                <button>Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form method="POST" action="signIn.php">
                <h1>Sign in</h1>
                <input type="email" placeholder="Email" name="signInEmail" required />
                <input type="password" placeholder="Password" name="signInPassword" required />
                <a href="#">Forgot your password?</a>
                <button>Sign In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Hello!</h1>
                    <p>To sign up, please fill in your information.<br>or click the button below to sign in.</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Welcome!</h1>
                    <p>Enter your sign in informantion.<br>or click the button below to sign up.</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets/signInNUp/script.js"></script>
</body>

</html>