<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des données du formulaire
    $nom = $_POST["nom"];
    $prenom = $_POST["prenom"];
    $age = $_POST["age"];
    $temperature = $_POST["temperature"];
    $maux_de_tete = $_POST["maux-de-tete"];
    $diarrhee = $_POST["diarrhee"];
    $toux = $_POST["toux"];
    $perte_odorat = $_POST["perte-odorat"];

    // Calcul du score en fonction des critères spécifiés
    $score = 0;

    if ($age == "0-12" || $age == "45plus") {
        $score += 15;
    }

    if ($temperature == "38.0-40.0") {
        $score += 5;
    } elseif ($temperature == "40plus") {
        $score += 15;
    }

    if ($maux_de_tete == "oui") {
        $score += 17.5;
    }
    
    if ($diarrhee == "oui") {
        $score += 17.5;
    }
    
    if ($toux == "oui") {
        $score += 17.5;
    }
    
    if ($perte_odorat == "oui") {
        $score += 17.5;
    }

    // Enregistrement des résultats dans la session
    $_SESSION["resultats"][] = [
        "date" => date("Y-m-d H:i:s"),
        "nom" => $nom,
        "prenom" => $prenom,
        "score" => $score,
    ];

    // Affichage des résultats
    echo "<h2>Résultats pour $nom $prenom :</h2>";
    echo "<p>Score : $score%</p>";

    // Affichage du message en fonction du score
    if ($score >= 80) {
        echo "<p>Résultat : Score critique. Veuillez consulter un médecin.</p>";
    } elseif ($score >= 50) {
        echo "<p>Résultat : Vous êtes susceptible.</p>";
    } else {
        echo "<p>Résultat : Vous êtes sain(e).</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Covid Test</title>
    <!-- Styles CSS (identiques à ceux du formulaire) -->
    <style>
        /* ... (styles identiques) ... */
    </style>
</head>
<body>
    <div class="container">
        <h2>Covid Test</h2>
        <form action="#" method="post">
            <!-- (Le contenu du formulaire reste inchangé) -->
        </form>
    </div>
    <div class="container">
        <h2>Historique des résultats</h2>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_SESSION["resultats"])) {
                    foreach ($_SESSION["resultats"] as $resultat) {
                        echo "<tr>";
                        echo "<td>" . $resultat["date"] . "</td>";
                        echo "<td>" . $resultat["nom"] . "</td>";
                        echo "<td>" . $resultat["prenom"] . "</td>";
                        echo "<td>" . $resultat["score"] . "%</td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>


<!DOCTYPE html>
<html>
<head>
    <title>Covid Test </title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        label {
            font-weight: bold;
        }

        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        input[type="radio"], input[type="checkbox"] {
            vertical-align: middle;
        }

        .submit-button {
            background-color: #007BFF;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Covid Test</h2>
        <form action="#" method="post">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" maxlength="20" required><br>

            <label for="prenom">Prénom:</label>
            <input type="text" id="prenom" name="prenom" maxlength="50" required><br>

            <label for="poids">Poids (en Kg):</label>
            <input type="number" id="poids" name="poids" min="0" max="500" required><br>

            <label>Âge:</label><br>
            <input type="radio" id="age0-12" name="age" value="0-12">
            <label for="age0-12">0-12 ans</label><br>

            <input type="radio" id="age13-24" name="age" value="13-24">
            <label for="age13-24">13-24 ans</label><br>

            <input type="radio" id="age25-45" name="age" value="25-45">
            <label for="age25-45">25-45 ans</label><br>

            <input type="radio" id="age45plus" name="age" value="45plus">
            <label for="age45plus">45 ans et plus</label><br>

            <label>Température corporelle (en °C):</label><br>
            <input type="radio" id="temp36.8-37.9" name="temperature" value="36.8-37.9">
            <label for="temp36.8-37.9">36.8-37.9 °C</label><br>

            <input type="radio" id="temp38.0-40.0" name="temperature" value="38.0-40.0">
            <label for="temp38.0-40.0">38.0-40.0 °C</label><br>

            <input type="radio" id="temp40plus" name="temperature" value="40plus">
            <label for="temp40plus">Plus de 40.0 °C</label><br>

            <label for="maux-de-tete">Avez-vous des maux de tête ?</label><br>
            <input type="radio" id="maux-de-tete-oui" name="maux-de-tete" value="oui">
            <label for="maux-de-tete-oui">Oui</label><br>

            <input type="radio" id="maux-de-tete-non" name="maux-de-tete" value="non">
            <label for="maux-de-tete-non">Non</label><br>

            <label for="diarrhee">Avez-vous de la diarrhée ?</label><br>
            <input type="radio" id="diarrhee-oui" name="diarrhee" value="oui">
            <label for="diarrhee-oui">Oui</label><br>

            <input type="radio" id="diarrhee-non" name="diarrhee" value="non">
            <label for="diarrhee-non">Non</label><br>

            <label for="toux">Avez-vous de la toux ?</label><br>
            <input type="radio" id="toux-oui" name="toux" value="oui">
            <label for="toux-oui">Oui</label><br>

            <input type="radio" id="toux-non" name="toux" value="non">
            <label for="toux-non">Non</label><br>

            <label for="perte-odorat">Avez-vous une perte d'odorat ?</label><br>
            <input type="radio" id="perte-odorat-oui" name="perte-odorat" value="oui">
            <label for="perte-odorat-oui">Oui</label><br>

            <input type="radio" id="perte-odorat-non" name="perte-odorat" value="non">
            <label for="perte-odorat-non">Non</label><br>

            <input type="submit" class="submit-button" value="Soumettre">
        </form>
    </div>
</body>
</html>
