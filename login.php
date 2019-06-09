<?php
require 'partials/header.php';

/* Se 'submit-button' è settato: */
if ( isset( $_POST['submit-button'])) {

    /* Se i campi del form email e password NON(!) sono vuoti: */
    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        $email = $_POST['email'];
        $password = trim($_POST['password']);


        $sql = "SELECT * FROM utenti where email = '" . $email . "'";
        $result = mysqli_query($conn, $sql);

        /* Se il risultato è uguale a 1, l'utente inserito corrisponde ad un solo utente nel database*/
        if (mysqli_num_rows($result) == 1) {

            /* Per ogni record associo le colonne all'array $row */
            while ($row = mysqli_fetch_assoc($result)) {

                /* Se lo sha1() della password inserita è uguale alla password nel database*/
                if (sha1($password) == $row['password']) {

                    //session_start();
                    // LOGIN: avvio la sessione dell'utente
                    $_SESSION['logged'] = TRUE;
                    /*Setto la variabile di sessione dell'utente */
                    $_SESSION['user_id'] = $row['id'];
                    $_SESSION['email'] = $row['email'];
                    $_SESSION['user_name'] = $row['nome'];

                    if ($row['admin'] == TRUE) {
                        $_SESSION['admin'] = TRUE;
                        header("Location: /innovation/admin.php");

                    } else {
                        /* Reindirizzo a community.php */
                        header("Location: /innovation/index.php");

                    }

                } else {
                    echo "<div class='error-message'>La password inserita non è corretta</div>";
                }
            }
        } else {
            echo "<div class='error-message' >Utente non registrato</div>";
        }

        /* Chiudo in ogni caso la connessione con Mysql */
        mysqli_close($conn);
    }
}
?>

    <div class="content-body">
        <div class="form">
            <form action="login.php" method="POST">
                <div class="imgcontainer">
                    <i class="fas fa-user"></i>
                    <!--<img src="resources/img/user.png" style="width: 100px" alt="Avatar" class="avatar">-->
                </div>

                <div class="form-input">
                    <p><b>ACCEDI</b></p>
                    <input type="email" class="register-field-b" placeholder="E-mail" name="email" required>
                    <input type="password" class="register-field-b" placeholder="Password" name="password" required>

                    <div class="form-container-button">
                        <button class="register-button" type="button"><a href="register.php"><b>Crea un account</b></a></button>
                        <button type="submit" class="login-button" name="submit-button"><b>Avanti</b></button>
                    </div>
                </div>
            </form>
        </div>
    </div>

<?php
require 'partials/footer.php';
?>