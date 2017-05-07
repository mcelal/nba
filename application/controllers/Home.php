<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->library('nba');
    }

    public function index()
	{
		$this->load->view('_partials/header');
		$this->load->view('home');
		$this->load->view('_partials/footer');
	}

	public function getDay()
    {
        if ( $this->input->post() ){

            // POST ile gelen veriler değişkene aktarılır.
            $data = $this->input->post();

            // POST ile gelen tarih ile 'nba' kütüphanesinden maçlar çekilir, view için değişkene atanır.
            $data['gameList'] = $this->nba->getDayGames($data['date_submit']);

            $return = array(
                'status' => true,
                'html'   => $this->load->view('gameList', $data, true)
            );

            // Hazırlanan veri json formatında ajax'a geri gönderilir
            echo json_encode($return);
        } else {

            // GET ile date indisli veri gelirse tarih değişkenine atanır.
            // Değer gelmez ise varsayılan belirlenir
            if ( ! $date = $this->input->get('date') ) {
                $date = '11/27/2015';
            }

            // İstenilen tarihli veri çekilir
            $data['gameList'] = $this->nba->getDayGames($date);

            // Çıkış olarak format indisli istek gelirse gerekli düzenlemeler yapılır
            if ($this->input->get('format') == 'json') {
                echo json_encode($data['gameList']);
                die();
            } else {
                $this->load->view('_partials/header');
                $this->load->view('home');
                $this->load->view('gameList', $data);
                $this->load->view('_partials/footer');

            }

        }
    }

    public function getGame()
    {
        if ( $this->input->post() ){

            $data = $this->input->post();

            $data['gameDetail'] = $this->nba->getGame($data['game']);

            $return = array(
                'status' => true,
                'html'   => $this->load->view('gameDetail', $data, true)
            );
            echo json_encode($return);

        } else {

            // GET ile 'gameid' indisli veri gelirse $gameid değişkenine atanır.
            // değer gelmez ise varsayılan belirlenir
            if ( ! $gameid = $this->input->get('gameid') ) {
                $gameid = '0021500227';
            }

            // İstenilen id'li maç verisi çekilir
            $data['gameDetail'] = $this->nba->getGame($gameid);


            // Çıkış olarak format indisli istek gelirse gerekli düzenlemeler yapılır
            // Format isteği gelmez ise view yardımıyla görüntülenir
            if ($this->input->get('format') == 'json') {
                echo json_encode($data['gameDetail']);
                die();
            } else {
                $this->load->view('_partials/header');
                $this->load->view('home');
                $this->load->view('gameDetail', $data);
                $this->load->view('_partials/footer');
            }

        }
    }


}
