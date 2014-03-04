<?php defined('SYSPATH') OR die('No direct script access.');

class MCAPI_Core {

	private $api_key;
	
	public  $list_id;

	public function __construct()
	{
		$config =Kohana::$config->load('mcapi');
		$this->api_key = $config['api_key'];
		$this->list_id = $config['list_id'];
	}

	public function subscribe($email, $merge_vars, $double_optin = FALSE, $update_existing = TRUE, $replace_interests = FALSE, $send_welcome=FALSE)
	{
		$mailchimp = new Mailchimp($this->api_key);

		try
		{
			$mailchimp->call('lists/subscribe', array(
		                'id'                => $this->list_id,
		                'email'             => array('email'=> $email),
		                'merge_vars'        => $merge_vars,
		                'double_optin'      => $double_optin,
		                'update_existing'   => $update_existing,
		                'replace_interests' => $replace_interests,
		                'send_welcome'      => $send_welcome
		            ));
		}
		catch(Exception $e)
		{
			 echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	} 
}
          