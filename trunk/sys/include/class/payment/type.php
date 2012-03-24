<?php

class payment_type
{

    public $start_date;
    public $end_date;
    public $filter;

    function select_or_insert_where() {
        global $auth_session;
        global $db;
        
	$domain_id = domain_id::get($this->domain_id);

        if($this->filter == "date")
        {
            $where = "and ap.ac_date between '$this->start_date' and '$this->end_date'";
        }

        $sql = "SELECT 
                    pt_id,
		            count(DISTINCT pt_id) as count
                from 
                    ".TB_PREFIX."payment_types 
                WHERE 
                    pt_description = :pt_description
		        AND 
		            domain_id = :domain_id
                GROUP BY
                    pt_id;";
        
        $sth = $db->query($sql,':pt_description',$this->type,':domain_id',$domain_id);
	$pt = $sth->fetch();
	
	if($pt['count'] =="1")
	{
		return $pt['pt_id'];
	}
	//add new payment type if no Paypal type
	if($pt =="")
	{
        $SI_PAYMENT_TYPES = new SimpleInvoices_Db_Table_PaymentTypes();
        
        $new_payment_type_data = array(
            'pt_description'    => $this->type,
            'pt_enabled'        => 1
        );
		$SI_PAYMENT_TYPES->insert($new_payment_type_data);

		$payment_type = new payment_type();
		$payment_type->type = $this->type;
		$payment_type->domain_id = $domain_id;
		return $payment_type->select_or_insert_where();
	}
    }

	public function insert()
	{
  	global $db;
  	global $auth_session;
  	global $dbh;

		$domain_id = domain_id::get($this->domain_id);
        
    $sql = "INSERT INTO ".TB_PREFIX."payment_types (
				pt_description,
				pt_enabled,
				domain_id
			) VALUES (
				:pt_description,
				:pt_enabled,
				:domain_id
			)";
        	$sth = $db->query($sql,
				':pt_description',$this->pt_description,
				':pt_enabled',$this->pt_enabled,
				':domain_id',$domain_id 
			) or die(htmlsafe(end($dbh->errorInfo())));
        
 	       return $sth;
	}

}
