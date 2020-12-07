<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * AamarPay 
 * Author: Md Sazzad Hossain
 * URL: https://sazzad362.com 
 * Version: 1.0 
 */
class Aamarpay {

	protected $store_id;
	protected $signature_key;
  protected $api_link;

	public function __construct()
	{
    $this->store_id      = STORE_ID;
    $this->signature_key = SIGNATURE_KEY;
    $this->api_link      = API_LINK;
	}

  /**
   * Aamar Pay payment process
   */

    function process($fields){
    	
      $cur_random_value        = $this->rand_string(10);
      
      $url  = $this->api_link.'/request.php';
      
      $fields['store_id']      = $this->store_id;
      $fields['signature_key'] = $this->signature_key;
      $fields['tran_id']       = $cur_random_value;

  		$fields_string = '';

  		foreach($fields as $key=>$value) {
  		     $fields_string .= $key.'='.$value.'&'; 
  		}

  		$fields_string = rtrim($fields_string, '&'); 
  		$ch = curl_init();
  		curl_setopt($ch, CURLOPT_VERBOSE, true);
  		curl_setopt($ch, CURLOPT_URL, $url);  
  		curl_setopt($ch, CURLOPT_POST, count($fields)); 
  		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
  		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  		$url_forward = str_replace('"', '', stripslashes(curl_exec($ch)));	
  		curl_close($ch); 

  		$this->redirect_to_merchant($url_forward);

    }

    /**
     * Redirect To Payment merchant
     */

    function redirect_to_merchant($url) {

    	$from_action = "{$this->api_link}/{$url}";

    	echo '<html xmlns="http://www.w3.org/1999/xhtml">
          <head>
            <script type="text/javascript">
            function closethisasap() { 
                document.forms["redirectpost"].submit(); 
            } 
          </script>
         </head>
          <body onLoad="closethisasap();">
            <form name="redirectpost" method="post" action="'.$from_action.'"></form>
          </body>
        </html>';
    } 

    /**
     * Payment validation
     */

    function validatepayment($data){

      $merTxnId    = '6K1N55ZZ1Y';
      $curl_handle = curl_init();

      curl_setopt($curl_handle,CURLOPT_URL,"{$this->api_link}/api/v1/trxcheck/request.php?request_id={$merTxnId}&store_id={$this->store_id}&signature_key={$this->signature_key}&type=json");

      curl_setopt($curl_handle, CURLOPT_VERBOSE, true);
      curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);

      $buffer = curl_exec($curl_handle);
      curl_close($curl_handle);

      $payment_data = (array)json_decode($buffer);
      return $payment_data;

    }

    /**
     * Generate Random Transation ID
     */
    function rand_string( $length ) {

        $str    =   "";
        $chars  =   "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $size   =   strlen( $chars );

        for( $i = 0; $i < $length; $i++) { 
            $str .= $chars[ rand( 0, $size - 1 ) ]; 
        }
    	return $str;
    }

}

?>