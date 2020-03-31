<?php
    class Covidmodel extends CI_Model
    {
        /* public function insert_data() { // inserts all the data into the database
            $this->db->db_debug = TRUE;
            $sql = "INSERT INTO Regioni (data, regione, codice_regione, latitudine, longitudine, ricoverati_sintomi, terapia_intensiva, ospedalizzati, isolamento_domiciliare, tot_att_positivi, nuovi_att_positivi, guariti, deceduti, totale_casi, tamponi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

            $json = file_get_contents('https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-regioni.json');
            if(substr($json, 0, 3) == pack("CCC", 0xEF, 0xBB, 0xBF)) {
                $json = substr($json, 3);
            }
            $obj = json_decode($json);

            foreach ($obj as $ob) {
                $date = new DateTime($ob->data);

                $formattedDate = $date->format('Y-m-d');

                $this->db->query($sql, array($formattedDate, $ob->denominazione_regione, $ob->codice_regione, $ob->lat, $ob->long, $ob->ricoverati_con_sintomi, $ob->terapia_intensiva, $ob->totale_ospedalizzati, $ob->isolamento_domiciliare, $ob->totale_positivi, $ob->variazione_totale_positivi, $ob->dimessi_guariti, $ob->deceduti, $ob->totale_casi, $ob->tamponi));
            }
        }

        public function update_data() { // updates the data in the database with the latest data retrieved from DCP repository
            $this->db->db_debug = FALSE;
            $sql = "INSERT INTO Andamento (data, ricoverati_sintomi, terapia_intensiva, ospedalizzati, isolamento_domiciliare, tot_att_positivi, nuovi_att_positivi, guariti, deceduti, totale_casi, tamponi) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

            $json = file_get_contents('https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-andamento-nazionale-latest.json');
            if(substr($json, 0, 3) == pack("CCC", 0xEF, 0xBB, 0xBF)) {
                $json = substr($json, 3);
            }
            $ob = json_decode($json)[0];

            $date = new DateTime($ob->data);

            $formattedDate = $date->format('Y-m-d');

            $this->db->query($sql, array($formattedDate, $ob->ricoverati_con_sintomi, $ob->terapia_intensiva, $ob->totale_ospedalizzati, $ob->isolamento_domiciliare, $ob->totale_positivi, $ob->variazione_totale_positivi, $ob->dimessi_guariti, $ob->deceduti, $ob->totale_casi, $ob->tamponi));
        } */

        public function get_regioni() {
            $this->load->library('curl');

            $dati = json_decode(file_get_contents('https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-regioni-latest.json'));

            return $dati;
        }

        public function get_andamento_naz() {
            $json = file_get_contents('https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-andamento-nazionale.json');
            if(substr($json, 0, 3) == pack("CCC", 0xEF, 0xBB, 0xBF)) {
                $json = substr($json, 3);
            }
            $obj = json_decode($json);
            $dati = end($obj);

            return $dati;
        }

        public function get_storico() {
            $json = file_get_contents('https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-andamento-nazionale.json');
            if(substr($json, 0, 3) == pack("CCC", 0xEF, 0xBB, 0xBF)) {
                $json = substr($json, 3);
            }
            $obj = json_decode($json);

            $dati = array(array(), array(), array());

            foreach($obj as $ob) {
                $date = new DateTime($ob->data);

                array_push($dati[0], array("label" => $date->format('d/m/Y'), "y" => $ob->totale_positivi));
                array_push($dati[1], array("label" => $date->format('d/m/Y'), "y" => $ob->dimessi_guariti));
                array_push($dati[2], array("label" => $date->format('d/m/Y'), "y" => $ob->deceduti));
            }

            return $dati;
        }

        public function get_incremento() {
            $json = file_get_contents('https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-andamento-nazionale.json');
            
            if(substr($json, 0, 3) == pack("CCC", 0xEF, 0xBB, 0xBF)) {
                $json = substr($json, 3);
            }
            $obj = json_decode($json);

            $dati = array();

            foreach($obj as $ob) {
                $date = new DateTime($ob->data);

                array_push($dati, array("label" => $date->format('d/m/Y'), "y" => $ob->variazione_totale_positivi));
            }

            return $dati;
        }

        public function get_prov() {
            $this->load->library('curl');

            $dati = json_decode(file_get_contents('https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-regioni-latest.json'));

            $prov = array();

            foreach($dati as $obj) {
                array_push($prov, $obj->denominazione_regione);
            }

            return $prov;
        }

        public function get_province(String $regione) {
            $json = file_get_contents('https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-province.json');
            if(substr($json, 0, 3) == pack("CCC", 0xEF, 0xBB, 0xBF)) {
                $json = substr($json, 3);
            }
            $obj = json_decode($json);

            $dati = array();

            $data = new DateTime(end($obj)->data);

            foreach($obj as $ob) {
                $obdata = new DateTime($ob->data);
                if ($obdata < $data) {
                    continue;
                }
                if ($ob->denominazione_regione === $regione && $ob->denominazione_provincia != "In fase di definizione/aggiornamento") {
                    array_push($dati, array("label" => $ob->denominazione_provincia, "y" => $ob->totale_casi));
                }
            }

            return $dati;
        }

        public function get_dettaglio_regione($regione) {
            $json = file_get_contents('https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-regioni.json');
            if(substr($json, 0, 3) == pack("CCC", 0xEF, 0xBB, 0xBF)) {
                $json = substr($json, 3);
            }
            $obj = json_decode($json);

            $result = new stdClass();
            $result->ricoverati = array();
            $result->terapia_intensiva = array();
            $result->isolamento_domiciliare = array();
            $result->nuovi_att_positivi = array();
            $result->guariti = array();
            $result->deceduti = array();
            $result->tamponi = array();

            $dati = array();
            foreach($obj as $ob) {
                $obdata = new Datetime($ob->data);

                if ($ob->denominazione_regione !== $regione) {
                    continue;
                }

                array_push($result->ricoverati, array("label" => $obdata->format('d/m/Y'), "y" => $ob->ricoverati_con_sintomi));
                array_push($result->terapia_intensiva, array("label" => $obdata->format('d/m/Y'), "y" => $ob->terapia_intensiva));
                array_push($result->isolamento_domiciliare, array("label" => $obdata->format('d/m/Y'), "y" => $ob->isolamento_domiciliare));
                array_push($result->nuovi_att_positivi, array("label" => $obdata->format('d/m/Y'), "y" => $ob->variazione_totale_positivi));
                array_push($result->guariti, array("label" => $obdata->format('d/m/Y'), "y" => $ob->dimessi_guariti));
                array_push($result->deceduti, array("label" => $obdata->format('d/m/Y'), "y" => $ob->deceduti));
                array_push($result->tamponi, array("label" => $obdata->format('d/m/Y'), "y" => $ob->tamponi));
            }

            return $result;
        }

        public function get_dataora() {
            $json = file_get_contents('https://raw.githubusercontent.com/pcm-dpc/COVID-19/master/dati-json/dpc-covid19-ita-andamento-nazionale-latest.json');
            if(substr($json, 0, 3) == pack("CCC", 0xEF, 0xBB, 0xBF)) {
                $json = substr($json, 3);
            }
            $obj = json_decode($json);

            $latest = end($obj);

            return $latest->data;
        }
    }
?>