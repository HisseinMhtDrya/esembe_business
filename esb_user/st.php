<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques de vente et de commande</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <div class="bg-white shadow py-3 row">
        <div class="col-12 col-lg-6">
            <canvas id="myChart" width="400" height="400"></canvas>
        </div>
        <div class="col-12 col-lg-6">
            <canvas id="myLineChart" width="400" height="400"></canvas>
        </div>
    </div>

    <?php
    require_once('../connexiondb.php');

    $recup_s_vente = $bdd->prepare("SELECT DATE_FORMAT(date_vente, '%d/%m/%Y') as jour_mois_annee, COUNT(*) as nombre_vente
                                    FROM vente
                                    WHERE date_vente >= DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND date_vente <= CURDATE()
                                    GROUP BY jour_mois_annee");

    $recup_s_vente->execute();

    $vente = array();
    while ($row = $recup_s_vente->fetch()) {
        $vente[] = $row;
    }

    $json_vente = json_encode($vente);

    $recup_s_cmd = $bdd->prepare("SELECT DATE_FORMAT(date_commande, '%d/%m/%Y') as jour_mois_annee, COUNT(*) as nombre_commande
                                    FROM commande
                                    WHERE date_commande >= DATE_SUB(CURDATE(), INTERVAL 6 DAY) AND date_commande <= CURDATE()
                                    GROUP BY jour_mois_annee");

    $recup_s_cmd->execute();

    $cmd = array();
    while ($row = $recup_s_cmd->fetch()) {
        $cmd[] = $row;
    }

    $json_cmd = json_encode($cmd);
    ?>

    <script>
        //stat vente
        var ctx = document.getElementById('myChart').getContext('2d');

        var data = <?php echo $json_vente; ?>;

        var dates = data.map(function (item) {
            return item.jour_mois_annee;
        });
        var nombreVente = data.map(function (item) {
            return item.nombre_vente;
        });

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: dates,
                datasets: [{
                    label: 'Nombre de ventes par jour',
                    data: nombreVente,
                    backgroundColor: '#0d66ff',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            }
        });

        //stat commande
        var ctx2 = document.getElementById('myLineChart').getContext('2d');

        var data2 = <?php echo $json_cmd; ?>;

        var dates2 = data2.map(function (item) {
            return item.jour_mois_annee;
        });
        var nombreCmd = data2.map(function (item) {
            return item.nombre_commande;
        });

        var myChart2 = new Chart(ctx2, {
            type: 'line',
            data: {
                labels: dates2,
                datasets: [{
                    label: 'Nombre de commandes par jour',
                    data: nombreCmd,
                    fill: false,
                    borderColor: '#ff6384',
                    lineTension: 0.1
                }]
            }
        });
    </script>
</body>

</html>