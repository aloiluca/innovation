<?php
require 'partials/header.php';

/* Se submit button è settato: */
if (isset($_POST['submit-button'])) {

    /* Se nome, cognome, email e password sono setta: */
    if (!empty($_POST['nome']) && !empty($_POST['cognome']) && !empty($_POST['email'])
        && !empty($_POST['password']) && !empty($_POST['password_verify'])) {

        $nome = trim($_POST['nome']);
        $cognome = trim($_POST['cognome']);
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $pwd_verify = trim($_POST['password_verify']);


        $sql = "SELECT * FROM utenti where email = '" . $email . "';";
        $result = mysqli_query($conn, $sql);

        /* Se $result è = 0 l'utente non è registato*/
        if (mysqli_num_rows($result) == 0) {

            /* Se le 2 password combaciano: altrimenti errore. */

            /* Assegnazione di variabile in modo condizionale: $var = (condtion) ? true : false */
            $hash = ($password == $pwd_verify) ? sha1($password) : '';

            if ($hash != '') {

                $sql = "SELECT * FROM utenti where email = '" . $email . "';";
                $result = mysqli_query($conn, $sql);


                /* Preparo ed eseguo la query: */
                $sql = "INSERT INTO `utenti`( `nome`, `cognome`, `email`, `password`,`admin`)
                        VALUES ('" . $nome . "','" . $cognome . "','" . $email . "','" . $hash . "',FALSE);";

                $result = mysqli_query($conn, $sql);


                /* Se $result è stata eseguita correttamente: altrimenti stampo messaggio di errore */
                /* var_dump((bool) 1);    OUTPUT:  bool(true) */
                if ($result == 1) {

                    /* L'utente è stato registrato: reindirizzo a login */
                    header("Location: /innovation/login.php");

                } else {
                    echo '<div class="error-message">Ci sono stati problemi durante durante la registrazione riprova.</div>';
                    header("refresh: 1'; Location: /innovation/register.php");
                }
            } else {
                echo '<div class="error-message">Le 2 password non combaciano</div>';
            }
        }
        else {
            echo '<div class="error-message">Utente gia registrato.</div>';
        }
    }
    mysqli_close($conn);
}

?>
<div class="content-body">
    <div class="form">
        <form action="register.php" method="POST">
            <div class="imgcontainer">
                <i class="fas fa-user"></i>
                <!--                    <img src="resources/img/user.png" style="width: 100px" alt="Avatar" class="avatar">-->
            </div>

            <div class="form-input">
                <p><b>SIGN-UP</b></p>
                <input type="email" class="register-field-b" placeholder="Inserisci E-mail" name="email" required>
                <input type="text" class="register-field-a" placeholder="Inserisci Nome" name="nome" required>
                <input type="text" class="register-field-a" placeholder="Inserisci Cognome" name="cognome" required>
                <input type="password" class="register-field-a" placeholder="Inserisci Password" name="password" required>
                <input type="password" class="register-field-a" placeholder="Conferma Password" name="password_verify" required>

                <button type="submit" class="submit-button" name="submit-button"><b>Registrati</b></button>
            </div>
        </form>
    </div>
</div>


<?php
require 'partials/footer.php';
?>