<?php

class Defcont extends CI_Controller {
    public function index() {
        $date = new DateTime($this->covidmodel->get_dataora());
        $formattedDate = $date->format('d/m/Y');
        $formattedTime = $date->format('H:i');

        $data['data'] = $formattedDate;
        $data['ora'] = $formattedTime;

        $this->load->view('home', $data);
    }

    public function regioni() {
        $dati = $this->covidmodel->get_regioni();

        $data['regioni'] = $dati;

        $datagraph = array();

        foreach($dati as $dato) {
            array_push($datagraph, array("label" => $dato->denominazione_regione, "y" => $dato->totale_casi));
        }

        $date = new DateTime($this->covidmodel->get_dataora());
        $formattedDate = $date->format('d/m/Y');
        $formattedTime = $date->format('H:i');

        $data['data'] = $formattedDate;
        $data['ora'] = $formattedTime;

        $data['graph'] = $datagraph;

        $this->load->view('regioni', $data);
    }

    public function andamento() {
        $dati_generali = $this->covidmodel->get_andamento_naz();
        $storico = $this->covidmodel->get_storico();
        $incremento = $this->covidmodel->get_incremento();

        $data['andamento'] = $dati_generali;
        $data['storico'] = $storico[0];
        $data['dimessi'] = $storico[1];
        $data['deceduti'] = $storico[2];
        $data['incremento'] = $incremento;

        $date = new DateTime($this->covidmodel->get_dataora());
        $formattedDate = $date->format('d/m/Y');
        $formattedTime = $date->format('H:i');

        $data['data'] = $formattedDate;
        $data['ora'] = $formattedTime;

        $this->load->view('andamento', $data);
    }

    public function province() {
        $prov = $this->covidmodel->get_prov();

        $data['prov'] = $prov;

        $date = new DateTime($this->covidmodel->get_dataora());
        $formattedDate = $date->format('d/m/Y');
        $formattedTime = $date->format('H:i');

        $data['data'] = $formattedDate;
        $data['ora'] = $formattedTime;

        $this->load->view('province', $data);
    }

    public function province_input() {
        $this->load->library('json');
        
        $regione = $this->input->post('regione');

        $dati = $this->covidmodel->get_province($regione);

        $this->json->write_for_chart($dati);
    }
}

?>