<?php
class Bank extends CI_Controller
{
	function __construct()
   	{
	    parent::__construct();
	    $this->load->library('session');
   	}
   	
	public function homepage() {
		$this->load->view('bank/BankingNetwork');
	}

	public function create_user()		//loads the user signin page
	{
		$this->load->view('bank/create_acc');
	}
	public function insert_db()		//passes the user data to the model method 'insert_into_db'
	{
		$b1 = $_POST['uname'];	
		$b2 = $_POST['email'];
		$b3 = $_POST['mob_no'];
		$b4 = $_POST['psw'];
		
		$this->load->model('bank_model');
		$mob_check = $this->bank_model->getmob_no($b3);
		if($mob_check == 1)
		{
			$hash_b4 = password_hash($b4, PASSWORD_DEFAULT);		//password is hashed

			$create_info = array('user_name' => $b1, 'email' => $b2, 'mob_no' => $b3, 'password' => $hash_b4);
			$this->load->model('bank_model');
			$db_stat = $this->bank_model->insert_into_db($create_info);

			if ($db_stat == 1) {
				$this->load->view('bank/BankingNetwork');  
			}
			else{
				$this->load->view('bank/BankingNetworkerror1'); 
			}
		}
		else{
			$this->load->view('bank/BankingNetworkerror2');
		}	
	}

	public function error()
	{
		$this->load->view('bank/error');  
	} 

	public function authenticate()
	{
		$this->load->library('session');

		$n1= $_POST['mob_no'];
    	$n2= $_POST['psw'];

    	$user_info= array('mob_no' => $n1,
					'password' => $n2
		);
    	$this->load->model('bank_model');
		$db_pass= $this->bank_model->verify_user($user_info);

		foreach ($db_pass as $pss) {
			$dp = $pss->password;
		}

		if (password_verify($n2, $dp))		//password verified
		{	
			$user = $this->bank_model->getuser_name($n1);
			$states = $this->bank_model->getstates_user($n1);
			$federel = $this->bank_model->getfederel_user($n1);
			if ($states == 0 && $federel == 0) 
			{
				$this->load->view('bank/BankingNetworkerror3');  
			}
			else
			{ 
				
				$this->session->set_userdata('mob_no',$n1);
				$this->bank_user();
			}	
		}
		else
		{
			$this->load->view('bank/errors');
		}
	}

	public function bank_user()
	{
		$bu1 = $_SESSION['mob_no'];

		$this->load->model('bank_model');
		$user = $this->bank_model->getuser_name($bu1);

		$states = $this->bank_model->getstates_user($bu1);
		$federel = $this->bank_model->getfederel_user($bu1);
		if ($states == 0 && $federel == 0) 
		{
			$this->load->view('bank/BankingNetworkerror3');  
		}
		else
		{ 
			if($states == 0 && $federel == 1)
			{
				$bank1 = array("Federel");			
			}
			elseif ($states == 1 && $federel == 0) {
				$bank1 = array("States");	
			}
			elseif ($states == 1 && $federel == 1)
			{
				$bank1 = array("States", "Federel");	
			}	
			$this->load->view('bank/BankingNetworkUser', array('u_n' => $user, 'u_b' => $bank1));
		}
	}

	public function deposit()
	{
		$this->load->view('bank/deposit');
	}

	public function transfer()
	{
		$this->load->view('bank/transfer');
	}

	public function withdraw()
	{
		$this->load->view('bank/withdraw');
	}

	public function exit1()
	{
		if ($_SESSION['bank'] == "states_bank") 
		{
			$this->load->view('bank/menupg_States');
		}
		else
		{
			$this->load->view('bank/menupg_Federel');
		}
	}

	public function menupg_States()
	{	
		$this->session->unset_userdata('bank');
		$this->session->set_userdata('bank',"states_bank");
		$this->load->view('bank/menupg_States');
	}
	public function menupg_Federel()
	{	
		$this->session->unset_userdata('bank');
		$this->session->set_userdata('bank',"federel_bank");
		$this->load->view('bank/menupg_Federel');
	}

	public function exit_home()
	{
		$this->session->sess_destroy();
		$this->load->view('bank/BankingNetwork');
	}
	public function dep_auth()
	{
		$dep1 = $_SESSION['mob_no'];
		$dep2 = $_POST['amt'];
		$dep3 = "Deposit";			//Transaction type


		if($dep2 <= 0)
		{
			$this->load->view('bank/depositerror1');
		}
		else
		{
			$new_amt = $dep2;

			$this->load->model('bank_model');
			$bank_info = array('mob_no' => $dep1);
			$curr_user = $this->bank_model->getbank_data($bank_info);
			foreach ( $curr_user as $bal1) 
			{
	        	$new_bal = $bal1['balance'] + $new_amt;
	        }
			
			$dep_info = array('mob_no' => $dep1, 'balance' =>$new_bal);
			$this->load->model('bank_model');
			$bank_stat = $this->bank_model->bank_db($dep_info);


			$this->load->model('bank_model');
			$curr_id = $this->bank_model->getuser_data($bank_info);

			foreach ( $curr_id as $id1) 
			{
	        	$new_id = $id1['user_id'];
	        }
	        $txn_info = array(
	        			'user_id' => $new_id,
	    				'from_mob' => $dep1,
	    				'from_bank' => $_SESSION['bank'], 
	    				'to_mob' => $dep1,
	    				'to_bank' => $_SESSION['bank'], 
	    				'txn_amt' => $new_amt,
	    				'txn_type' => $dep3,
	        			);

			$this->load->model('bank_model');
			$txn_stat = $this->bank_model->txn_db($txn_info);	


			if($bank_stat == 1 && $txn_stat == 1)
			{
				if ($_SESSION['bank'] == "states_bank") 
				{
					$this->load->view('bank/menupg_States');
				}
				else
				{
					$this->load->view('bank/menupg_Federel');
				}
			}

			else
			{
				$this->load->view('bank/depositerror2');
			}
		}	
	}

	public function wdraw_auth()		
	{
		$wd1 = $_SESSION['mob_no'];   
		$wd2 = $_POST['amt'];	
		$wd3 = "Withdraw";		//Transaction type

		if($wd2 <= 0)		//checking if the amount being withdrawn is negative
 		{
			$this->load->view('bank/withdrawerror3');		//if yes, then 
		}
		else
		{
			$new_amt = $wd2;	//else continue
	
			$this->load->model('bank_model');
			$bank_info = array('mob_no' => $wd1);
			$curr_user = $this->bank_model->getbank_data($bank_info);
			foreach ( $curr_user as $bal1) 
			{
				if ($bal1['balance'] < $new_amt) 				//Checking if the balance is less than the amount being withdrawn
				{
					$this->load->view('bank/withdrawerror1');				//if yes 
				}
				else 											//if no continue
				{	
	        		$new_bal = $bal1['balance'] - $new_amt;			//subtraction of the withdrawn amount from the balance in the bank
			
					$wd_info = array('mob_no' => $wd1, 'balance' => $new_bal);
					$this->load->model('bank_model');
					$bank_stat = $this->bank_model->bank_db($wd_info);			//passing the new balance to the model



					$this->load->model('bank_model');
					$curr_id = $this->bank_model->getuser_data($bank_info);		

					foreach ( $curr_id as $id1) 
					{
			        	$new_id = $id1['user_id'];
			        }
			        $txn_info = array(
			        			'user_id' => $new_id,
			    				'from_mob' => $wd1,
			    				'from_bank' => $_SESSION['bank'],
			    				'to_mob' => $wd1,
								'to_bank' => $_SESSION['bank'],
			    				'txn_amt' => $new_amt,
			    				'txn_type' => $wd3,
			        			);

					$this->load->model('bank_model');
					$txn_stat = $this->bank_model->txn_db($txn_info);	//passing the above data to the model to be inserted into the transaction table

					if($bank_stat == 1 && $txn_stat == 1)
					{
						if ($_SESSION['bank'] == "states_bank") 
						{
							$this->load->view('bank/menupg_States');
						}
						else
						{
							$this->load->view('bank/menupg_Federel');
						}
					}
					else
					{
						$this->load->view('bank/withdrawerror2');
					}
				}
	        }
		}
	}	

	public function tr_auth()		
	{
		$tr1 = $_POST['to_mob_no'];   //Transaction to
		$tr2 = $_POST['amt'];
		$tr3 = $_SESSION['mob_no'];	//Transaction from
		$tr4 = "Transfer";			//Transaction type

		if($tr1 == $tr3)
		{
			$this->load->view('bank/transfererror4');
		}
		else
		{
			$this->load->model('bank_model');
			$to_user = $this->bank_model->getbankverify_to($tr1);

			if($to_user == 0)
			{
				$this->load->view('bank/transfererror5');
			}

			else
			{
				if($tr2 <= 0)		//checking if the amount being transfered is negative
		 		{
					$this->load->view('bank/transfererror3');	//if yes, then 
				}
				else
				{
					$new_amt = $tr2;	//else continue

					$this->load->model('bank_model');
					$bank_info = array('mob_no' => $tr3);
					$curr_user = $this->bank_model->getbank_data($bank_info);
					foreach ( $curr_user as $bal1) 
					{
						if ($bal1['balance'] < $new_amt) 				//Checking if the balance is less than the amount being withdrawn
						{
							$this->load->view('bank/transfererror1');				//if yes 
						}
						else 											//if no continue
						{	
			        		$new_bal_from = $bal1['balance'] - $new_amt;		//subtraction of the withdrawn amount from the balance in the bank

							$tr_info = array('mob_no' => $tr3, 'balance' => $new_bal_from);
							$this->load->model('bank_model');
							$bank_stat = $this->bank_model->bank_db($tr_info);			//passing the new balance to the model

							$this->load->model('bank_model');
							$bank_info1 = array('mob_no' => $tr1);
							$other_user = $this->bank_model->getbank_data($bank_info1);
							foreach ( $other_user as $bal2) 
							{
					        	$new_bal1 = $bal2['balance'] + $new_amt;			//addition of the deposited amount with the balance in the bank
					        }

							$tr_info1 = array(
										'mob_no' => $tr1, 
										'balance' => $new_bal1
										);
							$this->load->model('bank_model');
							$bank_stat1 = $this->bank_model->bank_db($tr_info1);			//passing the new balance to the model

							$this->load->model('bank_model');
							$curr_id = $this->bank_model->getuser_data($bank_info);		
							foreach ( $curr_id as $id1) 
							{
					        	$new_id = $id1['user_id'];
					        }
					        $txn_info = array(
					        			'user_id' => $new_id,
					        			'from_mob' => $tr3,
					        			'from_bank' => $_SESSION['bank'],
					        			'to_mob' => $tr1,
										'to_bank' => $_SESSION['bank'],
					        			'txn_amt' => $tr2,
					        			'txn_type' => $tr4,
					        			);

							$this->load->model('bank_model');
							$txn_stat = $this->bank_model->txn_db($txn_info);	//passing the above data to the model to be inserted into the transaction table

							if($bank_stat == 1 && $txn_stat == 1 && $bank_stat1 == 1)
							{
								if ($_SESSION['bank'] == "states_bank") 
								{
									$this->load->view('bank/menupg_States');
								}
								else
								{
									$this->load->view('bank/menupg_Federel');
								}
							}
							else
							{
								$this->load->view('bank/transfererror2');
							}
						}
			        }
				}
			}
		}		
	}

	public function trans_slip()
	{	
		$trans1 = $_SESSION['mob_no'];
		$this->load->model('bank_model');
		$trans_info1 = $this->bank_model->get_trans_db($trans1);
		if ($trans_info1 != null) 
		{
			$i = 0;
			foreach ($trans_info1 as $key) 
			{
				if($key['from_bank'] == $_SESSION['bank'])
				{
					$trans_info2[$i++] = $key;
				}
			}
			$this->load->view('bank/trans_slip',array('trs' => $trans_info2));
		}
		else
		{
			$this->load->view('bank/trans_slip1');
		}
	}

	public function user_details()
	{	
		$abt1 = $_SESSION['mob_no'];
		$this->load->model('bank_model');
		$abt_info = $this->bank_model->get_user_data($abt1);
		$bal_info1 = $this->bank_model->getbank_data(array('mob_no' => $abt1));
		// $bal_info2 = $this->bank_model->getfederelbank_data(array('mob_no' => $abt1));
		$this->load->view('bank/user_details',array('u_d1' => $abt_info, 'u_d2' => $bal_info1));
	}	
}	
?>
	
	