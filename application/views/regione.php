<html>
    <head>
        <title>Dati COVID-19 - Italia - Andamento</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
        <link rel="icon" href="<?=base_url()?>/favicon.ico" type="image/icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/siimple@3.3.1/dist/siimple.min.css">
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    </head>
    <body>
        <script>
            window.onload = function() {
                chart();
            };

            function chart() {
                var chart = new CanvasJS.Chart("dati-reg", {
                    animationEnabled: true,
                    legend: {
                        cursor: "pointer",
                        verticalAlign: "top",
                        horizontalAlign: "center",
                        itemclick: toggleDataSeries
                    },
                    data: [{
                        type: "line",
                        name: "Nuovi attualmente positivi",
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($datiregione->nuovi_att_positivi, JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "line",
                        name: "Ricoverati",
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($datiregione->ricoverati, JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "line",
                        name: "Terapia intensiva",
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($datiregione->terapia_intensiva, JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "line",
                        name: "Isolamento domiciliare",
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($datiregione->isolamento_domiciliare, JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "line",
                        name: "Guariti",
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($datiregione->guariti, JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "line",
                        name: "Deceduti",
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($datiregione->deceduti, JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "line",
                        name: "tamponi",
                        showInLegend: true,
                        dataPoints: <?php echo json_encode($datiregione->tamponi, JSON_NUMERIC_CHECK); ?>
                    }]
                });
                chart.render();

                function toggleDataSeries(e){
                    if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                        e.dataSeries.visible = false;
                    }
                    else{
                        e.dataSeries.visible = true;
                    }
                    chart.render();
                }
            }
        </script>
        <style>
            .phone-show {
                display: none;
            }

            .phone-hidden {
                display: block;
            }

            @media only screen and (max-width: 768px) {
                .phone-hidden {
                    display: none;
                }

                .phone-show {
                    display: block;
                }
            }
        </style>
        <navbar>
            <div class="siimple-navbar siimple-navbar--large siimple-navbar--light animated slideInDown">
                <a href="<?php echo site_url('defcont/index'); ?>" class="siimple-navbar-title">Dati COVID-19</a>
                <div class="siimple-navbar-subtitle">Dati italiani sul COVID-19</div>
                <div class="siimple--float-right phone-hidden">
                    <a href="<?php echo site_url('defcont/andamento'); ?>" class="siimple-navbar-item">Andamento nazionale</a>
                    <a href="<?php echo site_url('defcont/regioni'); ?>" class="siimple-navbar-item">Regioni</a>
                    <a href="<?php echo site_url('defcont/province'); ?>" class="siimple-navbar-item">Province</a>
                </div>
            </div>
        </navbar>
        <main>
            <div class="siimple-content theme-content siimple-content--large">
                <div class="siimple-menu phone-show">
                    <a href="<?php echo site_url('defcont/andamento'); ?>" class="siimple-menu-item">Andamento nazionale</a>
                    <a href="<?php echo site_url('defcont/regioni'); ?>" class="siimple-menu-item siimple-menu-item--selected">Regioni</a>
                    <a href="<?php echo site_url('defcont/province'); ?>" class="siimple-menu-item">Province</a>
                </div>
                <div class="siimple-card">
                    <div class="siimple-card-header siimple--text-center">
                        Dati <?= $regione ?>
                    </div>
                    <div class="siimple-card-body">
                        <div id="dati-reg" style="height: 450px; width: 100%;"></div>
                    </div>
                </div>
                <blockquote class="siimple-blockquote">
                    Dati aggiornati il <?= $data ?> alle <?= $ora ?>
                </blockquote>
            </div>
        </main>
    </body>
</html>