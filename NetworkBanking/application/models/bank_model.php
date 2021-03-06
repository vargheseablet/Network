<?php
class bank_model extends CI_Model
{	
	public function __construct()
    {
            // Call the CI_Model constructor
            parent::__construct();
    }

    public function verify_email($data) 
    {
    	$where1 = array('email' => $data['email']);
    	$table = 'users';
    	$this->db->select('password');
    	$query = $this->db->get_where($table, $where1);

        foreach ( $query->result() as $pass1) {
        
            if ($pass1->password == $data['password']) {
                return 1;
            }
        }   
    }

    public function verify_user($data)
    {
        $where1 = array('mob_no' => $data['mob_no']);
        $table = 'users';
        $this->db->select('password');
        $query = $this->db->get_where($table, $where1);
        return $query->result();
    }

    public function getuser_name($data)
    {
        $this->db->from('users');
        $this->db->select('user_name');
        $this->db->where('mob_no', $data);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function select_email($table,$email) {
    $this->db->select();
    $result_cat= $this->db->get_where($table, array('email' => $email))->result();
    return $result_cat;
    }

    public function insert_into_db($data)
    {
        $this->db->insert('users', $data);
        return 1;
    }

    public function select($table) {

            $result=$this->db->get($table)->result_array();
            return $result;
        }

    public function getbank_data($data)
    {
        $where1 = array('mob_no' => $data['mob_no']);
        $table = $_SESSION['bank'];
        $this->db->select('balance');
        $query = $this->db->get_where($table, $where1);        
        return $query->result_array();;
    }
    public function getfederelbank_data($data)
    {
        $where1 = array('mob_no' => $data['mob_no']);
        $table = 'federel_bank';
        $this->db->select('balance');
        $query = $this->db->get_where($table, $where1);        
        return $query->result_array();;
    }

    public function getuser_data($data)
    {
        $where1 = array('mob_no' => $data['mob_no']);
        $table = 'users';
        $this->db->select('user_id');
        $query = $this->db->get_where($table, $where1);
        return $query->result_array();
    }

    public function bank_db($data)
    {
        $data1 = array(
        'balance' => $data['balance']
        );
        $this->db->where('mob_no', $data['mob_no']);
        $this->db->update($_SESSION['bank'], $data1);
        return 1;
    }
    
    public function txn_db($data)
    {

        $this->db->insert('user_txn', $data);
        return 1;
    }

    public function get_trans_db($data)
    {
        $this->db->from('user_txn');
        $this->db->where('from_mob', $data);
        $this->db->or_where('to_mob ', $data);
        $this->db->limit(20);
        $this->db->order_by('txn_id', 'desc');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_user_data($data)
    {
        $this->db->from('users');
        $this->db->where('mob_no', $data);
        $query = $this->db->get();
        return $query->result_array();
    }
     public function getmob_no($data)
    {
        $this->db->from('users');
        $this->db->where('mob_no', $data);
        $this->db->select('mob_no');
        $query = $this->db->get();
        $chk = $query->result_array();

        if($chk == null)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    public function getstates_user($data)
    {
        $this->db->from('states_bank');
        $this->db->where('mob_no', $data);
        $this->db->select('user_name');
        $query = $this->db->get();
        $chk = $query->result_array();
        if($chk == null)
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }

    public function getfederel_user($data)
    {
        $this->db->from('federel_bank');
        $this->db->where('mob_no', $data);
        $this->db->select('user_name');
        $query = $this->db->get();
        $chk = $query->result_array();
        if($chk == null)
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }

    public function getbankverify_to($data)
    {
        $this->db->from($_SESSION['bank']);
        $this->db->where('mob_no', $data);
        $this->db->select('user_name');
        $query = $this->db->get();
        $chk = $query->result_array();
        if($chk == null)
        {
            return 0;
        }
        else
        {
            return 1;
        }
    }
}    
