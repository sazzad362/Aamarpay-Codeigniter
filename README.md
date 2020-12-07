# Aamar Pay codeigniter 


### Installation

Require Codeigniter Version 3

### Clone Repositorie
```sh
$ git clone https://github.com/sazzad362/Aamarpay-Codeigniter.git
```

Copy those files on your project directory
```sh
application/libraries/Aamarpay.php 
application/helpers/aamarpay_helper.php
application/controllers/Welcome.php 
```
Setup API credentials 
```sh
Open application/helpers/aamarpay_helper.php and change following with appropriate informations
define("STORE_ID", "");
define("SIGNATURE_KEY", "");
define("API_LINK", "");
```
### Setup Payment Process
Payment process example code: application/controllers/Welcome.php
### Important Methods 
  - payment
  - check_payment
  - cancel
  - fail
 ### Setup Payment Process example
```sh
1:Load aamarpay library 
$this->load->library("aamarpay");
2: Send Payment informations 
$data = array();
		$data['amount']        = '2000';
		$data['payment_type']  = 'bKash';
		$data['currency']      = 'BDT';
		$data['cus_name']      = 'Md Sazzad';
		$data['cus_email']     = 'mail@example.com';
		$data['cus_add1']      = 'Dhaka';
		$data['cus_add2']      = 'Mohakhali DOHS';
		$data['cus_city']      = 'Dhaka';
		$data['cus_state']     = 'Dhaka';
		$data['cus_postcode']  = '1206';
		$data['cus_country']   = 'Bangladesh';
		$data['cus_phone']     = '01612345678';
		$data['ship_name']     = 'Md Sazzad';
		$data['ship_add1']     = 'House B-121; Road 21';
		$data['ship_add2']     = 'Mohakhali';
		$data['ship_city']     = 'Dhaka';
		$data['ship_state']    = 'Dhaka';
		$data['ship_postcode'] = '1212';
		$data['ship_country']  = 'Bangladesh';
		$data['desc']          = 'Test Payment';
		$data['success_url']   = base_url('welcome/check_payment');
		$data['fail_url']      = base_url('welcome/fail');
		$data['cancel_url']    = base_url('welcome/cancel');
		$data['opt_a']         = 'Test Payment';
3: Send to Aamarpay 
$this->aamarpay->process($data)
```
 ### Setup Payment Validation Method
 Create another function on your payment controller. For example here it is.
 ```sh
 public function check_payment(){
		if($_POST['pay_status']	==	"Successful"){
		    $merTxnId =	$_POST['mer_txnid'];
		}
		if (!empty($merTxnId) || $_POST['status_code'] == 2) {
			$this->load->library("aamarpay");
			$response = $this->aamarpay->validatepayment($merTxnId);
			pre($response);
			// Do what you want.
		}else{
			$this->fail();
		}
	}
 ```
 
  ### Setup Cancel & Fail Method
 Create Cancel & Fail function on your payment controller. For example here it is.
 ```sh
public function cancel(){
	// Do what you want 
}
public function fail(){
	// Do what you want 
}
 ```
 #### Official Documentation

See [AamarPay API Documentation](https://aamarpay.com/download/aamarpay-integration-api-document/)