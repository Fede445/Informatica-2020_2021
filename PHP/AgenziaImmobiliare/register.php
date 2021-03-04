<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$email = $password = $confirm_password = "";
$email_err = $password_err = $confirm_password_err = "";
$temp = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Per favore, inserire una email.";
    } elseif (!filter_var(trim($_POST["email"]), FILTER_VALIDATE_EMAIL)) {
        $email_err = "Per favore, inserire una email valida.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // store result
                $stmt->store_result();
                
                if ($stmt->num_rows == 1) {
                    $email_err = "Questa email è stata già usata.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Qualcosa è andato storto, riprovi.";
            }

            // Close statement
            $stmt->close();
        }
    }

    $uppercase = preg_match('@[A-Z]@', trim($_POST["password"]));
    $lowercase = preg_match('@[a-z]@', trim($_POST["password"]));
    $number    = preg_match('@[0-9]@', trim($_POST["password"]));
    $specialChars = preg_match('@[^\w]@', trim($_POST["password"]));
    
    // Validate password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Per favore, inserire una password.";
    } elseif (!$uppercase || !$lowercase || !$number || !$specialChars || strlen(trim($_POST["password"])) < 8) {
        $password_err = "La password deve avere almeno 8 caratteri, avere almeno una lettera maiuscola, un numero e un carattere speciale.";
    } else {
        $password = trim($_POST["password"]);
    }
    
    // Validate confirm password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Confermare la password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "La password non corrisponde.";
        }
    }
    
    // Check input errors before inserting in database
    if (empty($email_err) && empty($password_err) && empty($confirm_password_err)) {
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
         
        if ($stmt = $mysqli->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ss", $param_email, $param_password);
            
            // Set parameters
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page
                header("location: signin.php");
            } else {
                echo "Qualcosa è andato storto. Riprova più tardi.";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home Property | Registrazione</title>

  <!-- Favicon -->
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">


  <!-- Font awesome -->
  <link href="css/font-awesome.css" rel="stylesheet">
  <!-- Bootstrap -->
  <link href="css/bootstrap.css" rel="stylesheet">
  <!-- slick slider -->
  <link rel="stylesheet" type="text/css" href="css/slick.css">
  <!-- price picker slider -->
  <link rel="stylesheet" type="text/css" href="css/nouislider.css">
  <!-- Fancybox slider -->
  <link rel="stylesheet" href="css/jquery.fancybox.css" type="text/css" media="screen" />
  <!-- Theme color -->
  <link id="switcher" href="css/theme-color/default-theme.css" rel="stylesheet">

  <!-- Main style sheet -->
  <link href="css/style.css" rel="stylesheet">


  <!-- Google Font -->
  <link href='https://fonts.googleapis.com/css?family=Vollkorn' rel='stylesheet' type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>


  <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>
  <section id="aa-signin">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="aa-signin-area">
            <div class="aa-signin-form">
              <div class="aa-signin-form-title">
                <a class="aa-property-home" href="index.php">Property Home</a>
                <h4>Crea il tuo account per iniziare a vendere</h4>
              </div>
              <form action="" method="post">
                <form class="contactform">
                  <div class="aa-single-field">
                    <label for="email">Email <span class="required">*</span></label>
                    <input type="email" required="required" aria-required="true" class="form-control"
                      value="<?php echo $email; ?>" name="email">
                    <span class="help-block"><?php echo $email_err; ?></span>
                  </div>
                  <div class="aa-single-field">
                    <label for="password">Password <span class="required">*</span></label>
                    <input type="password" name="password" class="form-control" value="">
                    <span class="help-block"><?php echo $password_err; ?></span>
                  </div>
                  <div class="aa-single-field">
                    <label for="confirm_password">Conferma Password <span class="required">*</span></label>
                    <input type="password" name="confirm_password" class="form-control" value="">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                  </div>
                  <div class="aa-single-submit">
                    <input type="submit" value="Crea un account" name="submit">
                  </div>
                </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- jQuery library -->
  <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> -->
  <script src="js/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.js"></script>
  <!-- slick slider -->
  <script type="text/javascript" src="js/slick.js"></script>
  <!-- Price picker slider -->
  <script type="text/javascript" src="js/nouislider.js"></script>
  <!-- mixit slider -->
  <script type="text/javascript" src="js/jquery.mixitup.js"></script>
  <!-- Add fancyBox -->
  <script type="text/javascript" src="js/jquery.fancybox.pack.js"></script>
  <!-- Custom js -->
  <script src="js/custom.js"></script>

</body>

</html>