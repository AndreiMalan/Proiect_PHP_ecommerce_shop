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
include("conectare.php");
$error = '';
if (isset($_POST['submit'])) {
    // preluam datele de pe formular
    $id = htmlentities($_POST['id'], ENT_QUOTES);
    $nume = htmlentities($_POST['nume'], ENT_QUOTES);
    $code = htmlentities($_POST['code'], ENT_QUOTES);
    $imagine = htmlentities($_POST['imagine'], ENT_QUOTES);
    $price = htmlentities($_POST['price'], ENT_QUOTES);
    $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
    $categorie = htmlentities($_POST['categorie'], ENT_QUOTES);
    // verificam daca sunt completate
    if ($id == '' || $nume == '' || $code == '' || $imagine == '' || $price == '' || $descriere == '' || $categorie == '') {
        // daca sunt goale se afiseaza un mesaj
        $error = 'ERROR: Campuri goale!';
    } else {
        // insert
        if ($stmt = $mysqli->prepare("INSERT into tbl_product (id, name, code, image, price, descriere, categorie) VALUES (?, ?, ?, ?, ?, ?, ?)")) {
            $stmt->bind_param("isssdss", $id, $nume, $code, $imagine, $price, $descriere, $categorie);
            $stmt->execute();
            $stmt->close();
        }
        // eroare le inserare
        else {
            echo "ERROR: Nu se poate executa insert.";
        }
    }
}
// se inchide conexiune mysqli
$mysqli->close();
?>


<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>

<head>
    <title><?php echo "Inserare inregistrare"; ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
    <h1><?php echo "Inserare inregistrare"; ?></h1>
    <?php if ($error != '') {
        echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
    } ?>
    <form action="" method="post">
        <div>
            <strong>ID: </strong> <input type="text" name="id" value="" /><br />
            <strong>Nume: </strong> <input type="text" name="nume" value="" /><br />
            <strong>Code: </strong> <input type="text" name="code" value="" /><br />
            <strong>Imagine: </strong> <input type="text" name="imagine" value="" /><br />
            <strong>Pret: </strong> <input type="text" name="price" value="" /><br />
            <strong>Descriere: </strong> <input type="text" name="descriere" value="" /><br />
            <strong>Categorie: </strong> <input type="text" name="categorie" value="" /><br />
            <br />
            <input type="submit" name="submit" value="Submit" />
            <a href="Vizualizare.php">Index</a>
        </div>
    </form>
</body>

</html>