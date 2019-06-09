<?php

require 'partials/header.php';

?>

   <div class="content-body">
       <h1>TOOLS</h1>


<?php

$sql = "SELECT * FROM tools";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0)
{
    while ($row = mysqli_fetch_assoc($result)) {

        $nome = replace_special_character($row["nome"]);
        $tipologia = replace_special_character($row["tipo"]);
        $data_insert = $row["data_insert"];
        $id = $row["id"];

        $img = 'articolo' . $id . '.jpg';

        echo '
                           <form action="/im-ict/articolo.php" method="POST">
                                
                                <div style="background-image:url(resources/img/articoli1/' . $img . ')"; class="tool">
                                <p class="tooltesto"> 
                                        <input type="hidden" name="id" value="' . $id . '"></p>
                                        <h1>' . $nome . '</h1>
                                        <h4>' . $tipologia . '</h4>
                                        <h6>Data: ' . $data_insert . '</h6>
                                </p>        
                                </div>
                           </form>                        
                                
               
                        ';
    }
}
else
{
    echo "<p class='messaggio-avviso'>Non è presente presente alcun tool. </p>";
}

echo '</div>';

require('partials/footer.php');
