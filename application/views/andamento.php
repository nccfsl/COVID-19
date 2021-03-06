<html>
    <head>
        <title>Dati COVID-19 - Italia - Andamento</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
        <link rel="icon" href="<?=base_url()?>/favicon.ico" type="image/icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/siimple@3.3.1/dist/siimple.min.css">
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    </head>
    <body>
        <script>
            function chart1() {
                var chart = new CanvasJS.Chart("and-naz", {
                    animationEnabled: true,
                    axisY: {
                        title: "Totale positivi"
                    },
                    legend: {
                        cursor: "pointer",
                        verticalAlign: "top",
                        horizontalAlign: "center",
                        itemclick: toggleDataSeries
                    },
                    data: [{
                        type: "line",
                        name: "Attualmente positivi",
                        showInLegend: true,
                        color: "#ffbf00",
                        legendMarkerColor: "#ffbf00",
                        legendLineColor: "#ffbf00",
                        markerColor: "#ffbf00",
                        lineColor: "#ffbf00",
                        dataPoints: <?php echo json_encode($storico, JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "line",
                        name: "Guariti",
                        showInLegend: true,
                        color: "green",
                        legendMarkerColor: "green",
                        legendLineColor: "green",
                        markerColor: "green",
                        lineColor: "green",
                        dataPoints: <?php echo json_encode($dimessi, JSON_NUMERIC_CHECK); ?>
                    },
                    {
                        type: "line",
                        name: "Deceduti",
                        showInLegend: true,
                        color: "red",
                        legendMarkerColor: "red",
                        legendLineColor: "red",
                        markerColor: "red",
                        lineColor: "red",
                        dataPoints: <?php echo json_encode($deceduti, JSON_NUMERIC_CHECK); ?>
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

            function chart2() {
                var chart = new CanvasJS.Chart("increment", {
                    animationEnabled: true,
                    axisY: {
                        title: "Nuovi positivi"
                    },
                    data: [{
                        type: "line",
                        dataPoints: <?php echo json_encode($incremento, JSON_NUMERIC_CHECK); ?>
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

            window.onload = function () {
                chart1();
                chart2();
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
                    <a href="<?php echo site_url('defcont/andamento'); ?>" class="siimple-menu-item siimple-menu-item--selected">Andamento nazionale</a>
                    <a href="<?php echo site_url('defcont/regioni'); ?>" class="siimple-menu-item">Regioni</a>
                    <a href="<?php echo site_url('defcont/province'); ?>" class="siimple-menu-item">Province</a>
                </div>
                <div class="siimple-grid animated zoomIn">
                    <div class="siimple-grid-row">
                        <div class="siimple-grid-col siimple-grid-col--3 siimple-grid-col--sm-12">
                            <div class="siimple-card siimple--color-warning">
                                <div class="siimple-card-header siimple--text-center">
                                    Attualmente positivi
                                </div>
                                <div class="siimple-card-body">
                                    <div class="siimple-h1 siimple--mb-0 siimple--text-center"><?= $andamento->totale_positivi ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="siimple-grid-col siimple-grid-col--3 siimple-grid-col--sm-12">
                            <div class="siimple-card siimple--color-success">
                                <div class="siimple-card-header siimple--text-center">
                                    Guariti
                                </div>
                                <div class="siimple-card-body">
                                    <div class="siimple-h1 siimple--mb-0 siimple--text-center"><?= $andamento->dimessi_guariti ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="siimple-grid-col siimple-grid-col--3 siimple-grid-col--sm-12">
                            <div class="siimple-card siimple--color-error">
                                <div class="siimple-card-header siimple--text-center">
                                    Deceduti
                                </div>
                                <div class="siimple-card-body">
                                    <div class="siimple-h1 siimple--mb-0 siimple--text-center"><?= $andamento->deceduti ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="siimple-grid-col siimple-grid-col--3 siimple-grid-col--sm-12">
                            <div class="siimple-card">
                                <div class="siimple-card-header siimple--text-center">
                                    Totale casi
                                </div>
                                <div class="siimple-card-body">
                                    <div class="siimple-h1 siimple--mb-0 siimple--text-center"><?= $andamento->totale_casi ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="siimple-card">
                    <div class="siimple-card-header siimple--text-center">
                        Andamento nazionale
                    </div>
                    <div class="siimple-card-body">
                        <div id="and-naz" style="height: 450px; width: 100%;"></div>
                    </div>
                </div>
                <div class="siimple-card">
                    <div class="siimple-card-header siimple--text-center">
                        Incremento giornaliero degli attualmente positivi
                    </div>
                    <div class="siimple-card-body">
                        <div id="increment" style="height: 450px; width: 100%;"></div>
                    </div>
                </div>
                <blockquote class="siimple-blockquote">
                    Dati aggiornati il <?= $data ?> alle <?= $ora ?>
                </blockquote>
            </div>
        </main>
    </body>
</html>