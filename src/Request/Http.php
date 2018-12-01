<?php

namespace Nyetbot\Request;

/**
 * Http class for handling http client
 * 
 * @author Mohamad Radisha (pr0ph0z23@gmail.com)
 * @license MIT
 * @version 0.1.0
 * @since 0.0.1
 * @package \Nyetbot\Request
 */
class Http
{
	/**
	 * @var string PUSH_API URL of Push API
	 */
	public const PUSH_API = "https://api.line.me/v2/bot/message/push";

	/**
	 * @var string REPLY_API URL of Reply API
	 */
	public const REPLY_API = "https://api.line.me/v2/bot/message/reply";
	
	/**
	 * @var string PROFILE_API URL of Profile API
	 */
	public const PROFILE_API = "https://api.line.me/v2/bot/profile/%s";
	
	/**
	 * @var string PROFILE_API URL of Group API
	 */
	public const GROUP_API = "https://api.line.me/v2/bot/group/%s/members/ids";

    /**
     * Constructor
     *
     * @param  mixed $parent
     *
     * @return void
     */
    public function __construct($parent)
    {
        $this->bot = $parent;
    }

	/**
	 * Method to make an HTTP Request using GET method.
	 * There are some API that needs an argument in its URL, so I added the $args parameter.
	 *
	 * @param  array $args
	 *
	 * @return mixed
	 */
	public function get(array $args = null)
	{
		if($args == null)
		{
			$ch = curl_init($this->bot->getApi());
		}
		else
		{
			$ch = curl_init(vsprintf($this->bot->api, $args));
		}
		curl_setopt($ch, CURLOPT_HTTPGET, true);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Bearer '.$this->bot->channelAccessToken
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
	public function post($body, string $contentType = "application/json", array $args = null)
	{
		if($args == null)
		{
			$ch = curl_init($this->bot->api);
		}
		else
		{
			$ch = curl_init(vsprintf($this->bot->api, $args));
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
			'Authorization: Bearer '.$this->bot->channelAccessToken
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
		$ch = curl_init($this->bot->api);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Authorization: Bearer '.$this->bot->channelAccessToken
		));
		
		$result = curl_exec($ch);
		if (curl_errno($ch)) {
			error_log('Error:' . curl_error($ch));
		}
		curl_close($ch); 

		return $result;
    }
}