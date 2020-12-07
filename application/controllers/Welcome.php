<?php
defined('BASEPATH') OR exit('No direct script access allowed');
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
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Welcome Index
	 */

	public function index()
	{
		$this->load->view('welcome_message');
	}

	/**
	 * Payment Method
	 */
	public function payment(){
		$this->form_validation->set_rules('amount', 'amount', 'trim|required');
		$amount = $this->input->post('amount');
		// Aamar Pay library
		$this->load->library("aamarpay");
		$data = array();
		$data['amount']        = '2000';
		$data['payment_type']  = 'bKash';
		$data['currency']      = 'BDT';
		$data['cus_name']      = 'Md Sazzad';
		$data['cus_email']     = 'contact@sazzad362.com';
		$data['cus_add1']      = 'Dhaka';
		$data['cus_add2']      = 'Mohakhali DOHS';
		$data['cus_city']      = 'Dhaka';
		$data['cus_state']     = 'Dhaka';
		$data['cus_postcode']  = '1206';
		$data['cus_country']   = 'Bangladesh';
		$data['cus_phone']     = '01612345678';
		// Those are optional Start
		$data['ship_name']     = 'Md Sazzad';
		$data['ship_add1']     = 'House B-121; Road 21';
		$data['ship_add2']     = 'Mohakhali';
		$data['ship_city']     = 'Dhaka';
		$data['ship_state']    = 'Dhaka';
		$data['ship_postcode'] = '1212';
		$data['ship_country']  = 'Bangladesh';
		// Those are optional End 
		$data['desc']          = 'Test Sazzad';
		$data['success_url']   = base_url('welcome/check_payment');
		$data['fail_url']      = base_url('welcome/fail');
		$data['cancel_url']    = base_url('welcome/cancel');
		$data['opt_a']         = 'Black Friday Offer';
		echo  $this->aamarpay->process($data);
	}

	/**
	 * Check Payment
	 */

	public function check_payment(){
		if($_POST['pay_status']	==	"Successful"){
		    $merTxnId =	$_POST['mer_txnid'];
		}
		if (!empty($merTxnId) || $_POST['status_code'] == 2) {
			$this->load->library("aamarpay");
			$response = $this->aamarpay->validatepayment($merTxnId);
			pre($response);
		}else{
			$this->fail();
		}
	}

	/**
	 * Load if cancel Payment
	 */

	public function cancel(){
		echo "Cancel";
	}

	/**
	 * Load if fail to pay
	 */

	public function fail(){
		echo "fail";
	}
}