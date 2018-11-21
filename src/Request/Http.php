<?php

namespace Nyetbot\Request;

class Http extends Nyetbot{

	/**
	 * Method to make an HTTP Request using GET method.
	 * There are some API that needs an argument in its URL, so I added the $args parameter.
	 *
	 * @param  array $args
	 *
	 * @return mixed
	 */
	private function get(array $args = null)
	{
		if($args == null)
		{
			$ch = curl_init($this->api);
		}
		else
		{
			$ch = curl_init(vsprintf($this->api, $args));
		}
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Bearer '.$this->channelAccessToken
		));
		
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			error_log('Error:' . curl_error($ch));
		}
		curl_close($ch); 

		return $result;
	}

	/**
	 * Method to make an HTTP Request using POST method.
	 *
	 * @param  mixed $body Structural body to make a request
	 * @param  string $contentType Not all request is using json Content-Type. This is an optional parameter
	 * @param  array $args There are some API that needs an argument in its URL
	 *
	 * @return mixed
	 */
	protected function post($body = null, string $contentType = "application/json", array $args = null)
	{
		if($args == null)
		{
			$ch = curl_init($this->api);
		}
		else
		{
			$ch = curl_init(vsprintf($this->api, $args));
		}
		curl_setopt($ch, CURLOPT_POST, true); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
		if($contentType !== "application/json") {
			curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
		}
		else {
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($body));
		}
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array( 
			'Content-Type: '.$contentType, 
			'Authorization: Bearer '.$this->channelAccessToken
		));
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			error_log('Error:' . curl_error($ch));
		}
		curl_close($ch); 

		return $result;
	}

	/**
	 * Method to make an HTTP Request using DELETE method.
	 *
	 * @return mixed
	 */
	public function delete()
	{
		$ch = curl_init($this->api);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Bearer '.$this->channelAccessToken
		));
		
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			error_log('Error:' . curl_error($ch));
		}
		curl_close($ch); 

		return $result;
    }
}