<html>
    <head>
        <title>Dati COVID-19 - Italia</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=yes">
        <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
        <link rel="icon" href="<?=base_url()?>/favicon.ico" type="image/icon">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/siimple@3.3.1/dist/siimple.min.css">
    </head>
    <body>
        <navbar>
            <div class="siimple-navbar siimple-navbar--large siimple-navbar--light animated slideInDown">
                <a href="<?php echo site_url('defcont/index'); ?>" class="siimple-navbar-title">Dati COVID-19</a>
                <div class="siimple-navbar-subtitle">Dati italiani sul COVID-19</div>
            </div>
        </navbar>
        <main>
            <div class="siimple-content theme-content siimple-content--large">
                <div class="siimple-box">
                    <div class="siimple-box-title">COVID-19</div>
                    <div class="siimple-box-subtitle">Dati italiani sulla diffusione del Coronavirus</div>
                    <div class="siimple-box-detail">Scopri l'andamento nazionale, i dati per regione o i dati per provincia</div>
                </div>
                <div class="siimple-grid animated zoomIn">
                    <div class="siimple-grid-row">
                        <div class="siimple-grid-col siimple-grid-col--4 siimple-grid-col--sm-12">
                            <div class="siimple-card">
                                <div class="siimple-card-header">
                                    Dati andamento nazionale
                                </div>
                                <div class="siimple-card-body">
                                    Scopri l'andamento dell'Italia, come contagiati totali e numero di guariti<br><br>
                                    Grafici dell'andamento generale del paese e aggiornati ogni giorno
                                </div>
                                <div class="siimple-card-footer">
                                    <a href="<?php echo site_url('defcont/andamento'); ?>" class="siimple-btn siimple-btn--primary siimple-btn--fluid">Scopri</a>
                                </div>
                            </div>
                        </div>
                        <div class="siimple-grid-col siimple-grid-col--4 siimple-grid-col--sm-12">
                            <div class="siimple-card">
                                <div class="siimple-card-header">
                                    Dati per regione
                                </div>
                                <div class="siimple-card-body">
                                    Scopri i dati per ogni singola regione, con grafici e mappa<br><br>
                                    <span class="siimple-tag siimple-tag--success siimple-tag--rounded">New</span> Clicca sul nome della regione per avere info dettagliate sulla regione
                                </div>
                                <div class="siimple-card-footer">
                                <a href="<?php echo site_url('defcont/regioni'); ?>" class="siimple-btn siimple-btn--primary siimple-btn--fluid">Scopri</a>
                                </div>
                            </div>
                        </div>
                        <div class="siimple-grid-col siimple-grid-col--4 siimple-grid-col--sm-12">
                            <div class="siimple-card">
                                <div class="siimple-card-header">
                                    Dati per provincia <span class="siimple-tag siimple-tag--error siimple-tag--rounded">Preview</span>
                                </div>
                                <div class="siimple-card-body">
                                    Scopri i dati di ogni singola provincia, con grafici<br><br>
                                    Grafici del totale casi per ogni provincia, basta scegliere la regione
                                </div>
                                <div class="siimple-card-footer">
                                <a href="<?php echo site_url('defcont/province'); ?>" class="siimple-btn siimple-btn--primary siimple-btn--fluid">Scopri</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <blockquote class="siimple-blockquote">
                    Dati aggiornati il <?= $data ?> alle <?= $ora ?>
                </blockquote>
            </div>
        </main>
    </body>
</html>