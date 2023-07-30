<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>Vizualizare Utilizatori</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
</head>

<body>
    <h1>Inregistrarile din tabela Users</h1>
    <p><b>Toate inregistrarile din Users</b< /p>
            <br><br>
            <?php
            // connectare bazadedate
            
            include("conectare.php");
            // se preiau inregistrarile din baza de date
            if ($result1 = $mysqli->query("SELECT * FROM users ORDER BY id ")) { // Afisare inregistrari pe ecran
                if ($result1->num_rows > 0) {
                    // afisarea inregistrarilor intr-o table
                    echo "<table border='1' cellpadding='10'>";
                    // antetul tabelului
                    echo "<tr><th>ID</th><th>Username</th><th>Email</th></tr>";
                    while ($row1 = $result1->fetch_object()) {
                        // definirea unei linii pt fiecare inregistrare
                        echo "<tr>";
                        echo "<td>" . $row1->id . "</td>";
                        echo "<td>" . $row1->username . "</td>";
                        echo "<td>" . $row1->email . "</td>";
                        echo "<td><a href='stergere-users.php?id=" . $row1->id . "'>Stergere</a></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } // daca nu sunt inregistrari se afiseaza un rezultat de eroare
                else {
                    echo "Nu sunt inregistrari in tabela!";
                }
            } // eroare in caz de insucces in interogare
            else {
                echo "Error: " . $mysqli->error;
            }
            // se inchide
            $mysqli->close();
            ?>
            <a href="vizualizare.php">Pagina de gestiune a produselor</a><br><br>

            <a href="logout-admin.php">LogOut</a>
</body>

</html>