<style>
    body {
        background: linear-gradient(-45deg, #b3a8a4, #e0e090, #c4dfea, #c8e6df);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
        height: 100vh;
    }

    @keyframes gradient {
        0% {
            background-position: 0% 50%;
        }

        50% {
            background-position: 100% 50%;
        }

        100% {
            background-position: 0% 50%;
        }
    }
</style>
<?php
 // conectare la baza de date database
 include("conectare.php");
 // se verifica daca id a fost primit
 if (isset($_GET['id']) && is_numeric($_GET['id'])) {
     // preluam variabila 'id' din URL
     $id1 = $_GET['id'];
     // stergem inregistrarea cu ib=$id
     if ($stmt1 = $mysqli->prepare("DELETE FROM users WHERE id = ?")) {
         $stmt1->bind_param("i", $id1);
         if ($stmt1->execute())
             $stmt1->close();
     } else {
         echo "ERROR: Nu se poate executa delete.";
     }
     $mysqli->close();
     echo "<div>Inregistrarea a fost stearsa!!!!</div>";
 }
 echo "<p><a href=\"Vizualizare-users.php\">Index</a></p>"; 