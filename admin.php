<?php
require 'config/database.php';
require 'partials/header.php';
?>
    <div class="content-body">
        <h2>Tabella degli Utenti</h2>

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

$sql = 'SELECT * FROM utenti';
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {

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
                      <form action="/im-ict/core/admin/change-rule.php" method="POST">
                           <input style="display:none" type="hidden" name="id" value="' . $id . '"></p>
                           <input style="display:none" type="hidden" name="admin" value="' . $admin . '"></p>
                           <button type="submit" name="edit-admin">
                               <span style="font-size: 2em; color: #191aff;">
                                    <i class="far fa-edit"></i>
                               </span>
                           </button>
                      </form>
                                   
                  </td>                           
                  <td>
                      <form action="/im-ict/core/admin/delete-user.php" method="POST">
                            <input style="display:none" type="hidden" name="id" value="' . $id . '"></p>
                            <button type="submit" name="delete-utente">
                                <span style="font-size: 2em; color: Tomato;">
                                    <i class="far fa-trash-alt"></i>
                                </span>
                            </button>
                      </form>
                  </td>
                            
              </tr>
                            
                    ';
            }
        } else {
            echo '<div class="messaggio-avviso">Non ci sono utenti nel database</div>';
        }
        ?>

        </table>

