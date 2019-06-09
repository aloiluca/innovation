<?php
require 'partials/header.php';

/* Change Rule*/

if ( isset( $_POST['change_rule'])) {

    $id_utente = $_POST['id'];
    $admin = $_POST['admin'];
    $new_admin = ( $admin == 'TRUE' ) ? 'FALSE' : 'TRUE';
    $sql = "UPDATE `utenti` SET `admin`= " .$new_admin." WHERE id = ". $id_utente . ";";
    $result = mysqli_query( $conn, $sql);
    header( "Refresh: 2; Location: /innovation/admin.php");
    echo '<div class="messaggio-avviso">Valore Admin cambiato correttamente';
}

/* Delete utente */
if ( isset( $_POST['delete_utente'])) {

    $id_utente = $_POST['id'];

    if ( $_SESSION['user_id'] != $id_utente ) {

        $sql = 'DELETE FROM `utenti` WHERE id = '. $id_utente .';';
        $result = mysqli_query( $conn, $sql);
        header("Refresh:5; Location: /innovation/admin.php");
        echo '<div class="messaggio-avviso">Utente cancellato correttamente';

    }
    else {
        echo '<div class="error-message">Non puoi eliminare la tua utenza </div>';
    }
}


?>
    <div class="content-body">
        <div class="title">
            <h4>Tabella degli Utenti</h4>
        </div>

        <!-- Apertura table -->
        <table class="table">
            <tr>
                <th>ID Utente</th>
                <th>E-mail</th>
                <th>Nome</th>
                <th>Cognome</th>
                <th>Admin</th>
                <th>Modifica</th>
                <th>Elimina</th>
            </tr>


<?php
/* Stampo tutti gli utenti registrati */

$sql = 'SELECT * FROM utenti';
$result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {

        $id = $row["id"];
        $email = $row["email"];
        $nome = $row["nome"];
        $cognome = $row["cognome"];
        $admin = ($row["admin"] == TRUE ? 'TRUE' : 'FALSE');

        echo '
                 
              <tr>
                  <td>' . $id . '</td>
                  <td>' . $email . '</td>
                  <td>' . $nome . '</td>
                  <td>' . $cognome . '</td>
                  <td>' . $admin . '</td>
                  <td>
                      <form action="admin.php" method="POST">
                           <input style="display:none" type="hidden" name="id" value="' . $id . '"></p>
                           <input style="display:none" type="hidden" name="admin" value="' . $admin . '"></p>
                           <button type="submit" name="change_rule">
                               <span style="font-size: 2em; color: #191aff;">
                                    <i class="far fa-edit"></i>
                               </span>
                           </button>
                      </form>
                                   
                  </td>                           
                  <td>
                      <form action="admin.php" method="POST">
                            <input style="display:none" type="hidden" name="id" value="' . $id . '"></p>
                            <button type="submit" name="delete_utente">
                                <span style="font-size: 2em; color: Tomato;">
                                    <i class="far fa-trash-alt"></i>
                                </span>
                            </button>
                      </form>
                  </td>
                            
              </tr>
                            
                    ';
            }

        ?>
        </table>
    </div>
<?php
require 'partials/footer.php';
?>
