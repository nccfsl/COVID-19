<?php
    class covidmodel extends CI_Model
    {
        public function get_regioni() {
            $this->load->library('curl');

            $dati = json_decode($this->curl->_simple_call('get', 'https://openpuglia.org/api/?q=getdatapccovid-19'));

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

                array_push($dati[0], array("label" => $date->format('d/m/Y'), "y" => $ob->totale_attualmente_positivi));
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

                array_push($dati, array("label" => $date->format('d/m/Y'), "y" => $ob->nuovi_attualmente_positivi));
            }

            return $dati;
        }

        public function get_prov() {
            $this->load->library('curl');

            $dati = json_decode($this->curl->_simple_call('get', 'https://openpuglia.org/api/?q=getdatapccovid-19'));

            $prov = array();

            foreach($dati as $obj) {
                array_push($prov, $obj->regione);
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
    }
?>