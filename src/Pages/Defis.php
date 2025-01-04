<?php
    require_once("../Utils/headerInit.php");
    require_once("../CRUD/CRUDDefis.php");
    require_once("../CRUD/CRUDMaitrise.php");
    require_once("../CRUD/CRUDDefiSelected.php");

    $defis = readDefisReussiByUser($_SESSION['userId']);
    $defiexists = readAllDefisSelected();
    $idDefis = 0;
    $idDefisMaitrise = 0;

    if (!$defiexists) {
        $defi = readThreeDefis();
        foreach ($defi as $d) {
            createDefisSelected($d['id'], $d['nom'], $d['Description'], $d['gain']);
        }
        header("Location: Defis.php");
        exit;
    }
?>
    <link rel="stylesheet" href="../../assets/css/styleDefis.css">
    <link rel="stylesheet" href="../../assets/css/styleHeader.css">
</head>
<body>
    <?php require_once("../Utils/headerBody.php"); ?>
    <div class="Defis">
        <h2>Voici les défis qui vous attendent :</h2>
        <h2>Temps restant avant le renouvellement des défis :</h2>
        <h2 id="tempsRestant"></h2>
        <?php foreach ($defiexists as $defi): ?>
            <?php
                $idDefis = $defi['id'];
                $idDefisMaitrise = 0;
                foreach ($defis as $def) {
                    if ($def['id'] === $idDefis) {
                        $idDefisMaitrise = 1;
                        break;
                    }
                }
            ?>
            <div class="defi">
                <h3>Nom : <?= htmlspecialchars($defi['nom'], ENT_QUOTES, 'UTF-8') ?></h3>
                <p>Condition : <?= htmlspecialchars($defi['Description'], ENT_QUOTES, 'UTF-8') ?></p>
                <p>Gain : <?= htmlspecialchars($defi['gain'], ENT_QUOTES, 'UTF-8') ?></p>
                <label for="validation_<?= $idDefis ?>">Défis valider ? :</label>
                <input type="radio" <?= $idDefisMaitrise == 1 ? 'checked' : '' ?> id="validation_<?= $idDefis ?>" name="valider_<?= $idDefis ?>" disabled>
            </div>
        <?php endforeach; ?>
        
        <form id="defisForm" action="Defis.php" method="POST">
            <h2>Formulaire de création de Défis : </h2>
            <input type="text" name="nomDefis" id="nomDefis" placeholder="Insérer le nom du Défis" maxlength="50">
            <input type="text" name="descriptionDefis" id="descriptionDefis" placeholder="Insérer une description du Défis" maxlength="150">
            <input type="number" name="gainDefis" id="gainDefis" placeholder="Insérer le gain du Défis" maxlength="3">
            <button type="submit">Créer le défi</button>
        </form>
    </div>
    <script src="../../assets/JS/scriptDefis.js"></script>
</body>
</html>
