<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->view('welcome_message');
	}

	public function generate(){
		$query = $this->db->get('quran_bm');

		foreach($query->result_array() as $row){
			// var_dump($row);
			$location = $row['SuraID'].':'.$row['VerseID'];
			$ayat = $row['AyahText'];
			$texts = explode(' ', $ayat);

			foreach($texts as $word){
				$word = strtolower(preg_replace("/[^A-Za-z0-9-?!]/",'',$word));

				$index[$word][] = $location;
			}

			// var_dump($ayat.' - '.$location);
		}

		$query = $this->db->get('quran_bi');

		foreach($query->result_array() as $row){
			// var_dump($row);
			$location = $row['SuraID'].':'.$row['VerseID'];
			$ayat = $row['AyahText'];
			$texts = explode(' ', $ayat);

			foreach($texts as $word){
				$word = strtolower(preg_replace("/[^A-Za-z0-9-?!]/",'',$word));

				$index[$word][] = $location;
			}

			// var_dump($ayat.' - '.$location);
		}

		// $this->dumper($index);

		$json = json_encode($index);
		file_put_contents('./assets/json.txt', $json);

		echo 'Done';
	}

	function dumper($multi){
		echo '<pre>';
		var_dump($multi);
		echo '</pre>';
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */