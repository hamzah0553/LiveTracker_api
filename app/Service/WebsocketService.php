<?php
namespace App\Service;

class WebsocketService {


	/**
	 * @var int
	 */
	private $port = 3002;

	/**
	 * @var string
	 */
	private $server_ip = "http://185.134.28.74";

	/**
	 * @param $data
	 *
	 * @return string
	 */
	private function parseDataToParams($data) {

		// parse data t
		$params = '';
		foreach($data as $key=>$value) {
			$value = str_replace(' ', '%20', $value);
			$params .= $key . '=' . $value . '&';
		}

		$params = trim($params, '&');

		return $params;

	}

	/**
	 * Send driver-data to the socket server,
	 * by curling to it.
	 */
	public function sendData($data) {

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->server_ip.":" .$this->port . "/api/socket?" . $this->parseDataToParams($data));
		
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');

		// Receive server response ...
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);

		// close curl for memory
		curl_close ($ch);

		return $server_output;

	}

}