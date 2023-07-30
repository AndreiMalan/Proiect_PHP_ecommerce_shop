<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title>Vizualizare Inregistrari</title>
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
    <h1>Inregistrarile din tabela datepers</h1>
    <p><b>Toate inregistrarile din datepers</b< /p>
            <br><br>
            <?php
            // connectare bazadedate
            
            include("conectare.php");
            // se preiau inregistrarile din baza de date
            if ($result = $mysqli->query("SELECT * FROM tbl_product ORDER BY id ")) { // Afisare inregistrari pe ecran
                if ($result->num_rows > 0) {
                    // afisarea inregistrarilor intr-o table
                    echo "<table border='1' cellpadding='10'>";
                    // antetul tabelului
                    echo "<tr><th>ID</th><th>Nume Produs</th><th>Cod
Produs</th><th>Imagine</th><th>Descriere</th><th>Categorie</th><th></th><th></th></tr>";
                    while ($row = $result->fetch_object()) {
                        // definirea unei linii pt fiecare inregistrare
                        echo "<tr>";
                        echo "<td>" . $row->id . "</td>";
                        echo "<td>" . $row->name . "</td>";
                        echo "<td>" . $row->code . "</td>";
                        echo "<td>" . $row->image . "</td>";
                        echo "<td>" . $row->price . "</td>";
                        echo "<td>" . $row->descriere . "</td>";
                        echo "<td>" . $row->categorie . "</td>";
                        echo "<td><a href='modificare.php?id=" . $row->id . "'>Modificare</a></td>";
                        echo "<td><a href='stergere.php?id=" . $row->id . "'>Stergere</a></td>";
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
            <a href="inserare.php">Adaugarea unei noi inregistrari</a>
            <br><br>
            <a href="vizualizare-users.php"><b>Gestiunea tabelei de utilizatori</a><br><br>
            <a href="logout-admin.php">LogOut</a>
</body>

</html>