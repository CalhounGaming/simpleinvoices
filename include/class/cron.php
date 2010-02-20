<?php
class cron {
	
 	public $start_date;
	public function insert()
	{
        	global $db;
        	global $auth_session;

		$domain_id = domain_id::get($this->domain_id);
		$today = date('Y-m-d');

        
	        $sql = "INSERT INTO ".TB_PREFIX."cron (
				domain_id,
				invoice_id,
				start_date,
				end_date,
				recurrence,
				recurrence_type,
				email_biller,
				email_customer
			) VALUES (
				:domain_id,
				:invoice_id,
				:start_date,
				:end_date,
				:recurrence,
				:recurrence_type,
				:email_biller,
				:email_customer
			)";
        	$sth = $db->query($sql,
				':domain_id',$domain_id, 
				':invoice_id',$this->invoice_id,
				':start_date',$this->start_date,
				':end_date',$this->end_date,
				':recurrence',$this->recurrence,
				':recurrence_type',$this->recurrence_type,
				':email_biller',$this->email_biller,
				':email_customer',$this->email_customer
			) or die(htmlspecialchars(end($dbh->errorInfo())));
        
 	       return $sth;

	}

	public function update()
	{
        	global $db;

		$domain_id = domain_id::get($this->domain_id);
        
	        $sql = "UPDATE 
				".TB_PREFIX."cron 
			SET 
				invoice_id = :invoice_id,
				start_date = :start_date,
				end_date = :end_date,
				recurrence = :recurrence,
				recurrence_type = :recurrence_type,
				email_biller = :email_biller,
				email_customer = :email_customer
			WHERE 
				id = :id 
				AND 
				domain_id = :domain_id
			";
        	$sth = $db->query($sql,
				':id',$this->id, 
				':domain_id',$domain_id, 
				':invoice_id',$this->invoice_id,
				':start_date',$this->start_date,
				':end_date',$this->end_date,
				':recurrence',$this->recurrence,
				':recurrence_type',$this->recurrence_type,
				':email_biller',$this->email_biller,
				':email_customer',$this->email_customer
			) or die(htmlspecialchars(end($dbh->errorInfo())));
        
 	       return $sth;
	}

	public function delete()
	{

	}

    	public function select_all($type='', $dir='DESC', $rp='25', $page='1')
	{
		global $LANG;
		global $db;
		/*SQL Limit - start*/
		$start = (($page-1) * $rp);
		$limit = "LIMIT ".$start.", ".$rp;
		/*SQL Limit - end*/

		/*SQL where - start*/
		$query = (isset($_POST['query'])) ? $_POST['query'] : "" ;
		$qtype = (isset($_POST['qtype'])) ? $_POST['qtype'] : "" ;

		$where = (isset($_POST['query'])) ? "  AND $qtype LIKE '%$query%' " : "";
		/*SQL where - end*/
		

		/*Check that the sort field is OK*/
		if (!empty($this->sort)) {
		    $sort = $this->sort;
		} else {
		    $sort = "id";
		}

		if($type =="count")
		{
		    //unset($limit);
		    $limit="";
		}


		$sql = "SELECT
				cron.* ,
                       		(SELECT CONCAT(pf.pref_description,' ',iv.index_id)) as index_name
			FROM 
				".TB_PREFIX."cron cron,
				".TB_PREFIX."invoices iv,
				".TB_PREFIX."preferences pf
			 WHERE 
				cron.domain_id = :domain_id
				and
				cron.invoice_id = iv.id
				and 
				iv.preference_id = pf.pref_id 
			GROUP BY
			    cron.id
			ORDER BY
			$sort $dir
			$limit";

		$sth = $db->query($sql,':domain_id',domain_id::get($this->domain_id)) or die(htmlspecialchars(end($dbh->errorInfo())));
		if($type =="count")
		{
			return $sth->rowCount();
		} else {
			return $sth->fetchAll();
		}
	}

	public function select()
	{
		global $LANG;
		global $db;

		$sql = "SELECT
				cron.* ,
                       		(SELECT CONCAT(pf.pref_description,' ',iv.index_id)) as index_name
			FROM 
				".TB_PREFIX."cron cron,
				".TB_PREFIX."invoices iv,
				".TB_PREFIX."preferences pf
			 WHERE 
				cron.domain_id = :domain_id
				and
				cron.invoice_id = iv.id
				and 
				iv.preference_id = pf.pref_id 
				and
				cron.id = :id;";
		$sth = $db->query($sql,':domain_id',domain_id::get($this->domain_id), ':id',$this->id) or die(htmlspecialchars(end($dbh->errorInfo())));

		return $sth->fetch();
	}

	public function run()
	{
        	global $db;
        	global $auth_session;

		$today = date('Y-m-d');
		$domain_id = domain_id::get($this->domain_id);

		$cron_log = new cronlog();
		$cron_log->run_date = empty($this->run_date) ? $today : $this->run_date;
		$check_cron_log = $cron_log->check();        	

		//only proceed if cron has not been run for today
		$i="0";
		if ($check_cron_log == 0)
		{
			#$sql = "SELECT * FROM ".TB_PREFIX."cron WHERE domain_id = :domain_id";
			#$sth  = $db->query($sql,':domain_id',$domain_id) or die(htmlspecialchars(end($dbh->errorInfo())));
			$cron = new cron();
			$data = $cron->select_all('');
			#print_r($data);
		
			$number_of_crons_run = "0";	
			foreach ($data as $key=>$value)
			{
				$run_cron ='false';
				$start_date = date('Y-m-d', strtotime( $data[$key]['start_date'] ) );
				$end_date = $data[$key]['end_date'] ;

				$diff = number_format((strtotime($today) - strtotime($start_date)) / (60 * 60 * 24),0);
				
		
				//only check if diff is positive
				if (($diff >= 0) AND ($end_date =="" OR $end_date >= $today))
				{

					if($data[$key]['recurrence_type'] == 'day')
					{
						$modulus = $diff % $data[$key]['recurrence'] ;
						if($modulus == 0)
						{ 
							$run_cron ='true';
						} else {
							#$return .= "cron does not runs TODAY-days";

						}

					}
					if($data[$key]['recurrence_type'] == 'week')
					{
						$period = 7 * $data[$key]['recurrence'];
						$modulus = $diff % $period ;
						if($modulus == 0)
						{ 
							$run_cron ='true';
						} else {
							#$return .= "cron is not runs TODAY-week";
						}

					}
					if($data[$key]['recurrence_type'] == 'month')
					{
						$start_day = date('d', strtotime( $data[$key]['start_date'] ) );
						$start_month = date('m', strtotime( $data[$key]['start_date'] ) );
						$start_year = date('Y', strtotime( $data[$key]['start_date'] ) );
						$today_day = date('d');	
						$today_month = date('m');	
						$today_year = date('Y'); 	

						$months = ($today_month-$start_month)+12*($today_year-$start_year);
						$modulus =  $months % $data[$key]['recurrence']  ;
						if( ($modulus == 0) AND ( $start_day == $today_day ) )
						{ 
							$run_cron ='true';
						} else {
							#$return .= "cron is not runs TODAY-month";
						}

					}
					if($data[$key]['recurrence_type'] == 'year')
					{
						$start_day = date('d', strtotime( $data[$key]['start_date'] ) );
						$start_month = date('m', strtotime( $data[$key]['start_date'] ) );
						$start_year = date('Y', strtotime( $data[$key]['start_date'] ) );
						$today_day = date('d');	
						$today_month = date('m');	
						$today_year = date('Y'); 	

						$years = $today_year-$start_year;
						$modulus =  $years % $data[$key]['recurrence']  ;
						if( ($modulus == 0) AND ( $start_day == $today_day ) AND  ( $start_month == $today_month ) )
						{ 
							$run_cron ='true';
						} else {
							#$return .= "cron is not runs TODAY-year";
						}


					}
					//run the recurrence for this invoice
					if ($run_cron == 'true')
					{
						$number_of_crons_run++;	
						$return['id'] = $i;
						$return['message'] = "Cron for ".$data[$key]['index_name']." with start date of ".$data[$key]['start_date'].", end date of '".$data[$key]['end_date']."' where it runs each ".$data[$key]['recurrence']." ".$data[$key]['recurrence_type']." was run today :: Info diff=".$diff."<br />";
						$i++;

						$ni = new invoice();
						$ni->id = $data[$key]['invoice_id'];
						$ni->recur();


						## email the people
						
						$invoice = getInvoice($data[$key]['invoice_id']);
						$preference = getPreference($invoice['preference_id']);
						$biller = getBiller($invoice['biller_id']);
						$customer = getCustomer($invoice['customer_id']);
						#print_r($customer);
						#create PDF nameVj
						$spc2us_pref = str_replace(" ", "_", $data[$key]['index_name']);
						$pdf_file_name = $spc2us_pref.".pdf";
							
						// Create invoice
						if($data[$key]['email_biller'] == "1" OR $data[$key]['email_customer'] == "1")
						{
							$export = new export();
							$export -> format = "pdf";
							$export -> file_location = 'file';
							$export -> module = 'invoice';
							$export -> id = $data[$key]['invoice_id'];
							$export -> execute();

							#$attachment = file_get_contents('./tmp/cache/' . $pdf_file_name);

							$email = new email();
							$email -> format = 'cron_invoice';
							$email -> notes = "Hi ".$customer['name'].",<br /><br /> Attached is your PDF copy of ".$data[$key]['index_name']." from ".$biller['name'];
							$email -> from = $biller['email'];
							$email -> from_friendly = $biller['name'];
							if($data[$key]['email_customer'] == "1")
							{
								$email -> to = $customer['email'];
							}
							if($data[$key]['email_biller'] == "1")
							{
								$email -> to = $biller['email'];
							}
							$email -> subject = $pdf_file_name." from ".$biller['name'];
							$email -> attachment = $pdf_file_name;
							$return['email_message'] = $email -> send ();
						}
					} else {

						#$return .= "<br />NOT RUN: Cron for ".$data[$key]['index_name']." with start date of ".$data[$key]['start_date'].", end date of ".$data[$key]['end_date']." where it runs each ".$data[$key]['recurrence']." ".$data[$key]['recurrence_type']." did not recur today :: Info diff=".$diff."<br />";
	
					}
			
				
				} else {		
						#$return .= "<br />NOT RUN: Cron for ".$data[$key]['index_name']." with start date of ".$data[$key]['start_date'].", end date of ".$data[$key]['end_date']." where it runs each ".$data[$key]['recurrence']." ".$data[$key]['recurrence_type']." did not recur today :: Info diff=".$diff."<br />";

				}
							
				
			}

			// no crons scheduled for today	
			if ($number_of_crons_run  == '0')
			{
				$return['id'] = $i;
				$return['cron_message'] = "No invoices are scheduled to recur today for domain: ".$domain_id." for the date: ".$today;
				$return['email_message'] = "";
			}
			//insert into cron_log date of run
			$cron_log = new cronlog();
			$cron_log->run_date = $today;
			$cron_log->domain_id = $domain_id;
			$cron_log->insert();

			$email = new email();
			$email -> format = 'cron';
			#$email -> notes = $return;
			$email -> from = "simpleinvoices@localhost";
			$email -> from_friendly = "Simple Invoices - Cron";
			$email -> to = "justin@localhost";
			#$email -> bcc = $_POST['email_bcc'];
			$email -> subject = "Cron for Simple Invoices has been run for today:";
			$email -> send ();

		} else {
	
			$return['id'] = $i;
			$return['cron_message'] = "Cron has already been run for domain: ".$domain_id." for the date: ".$today;
			$return['email_message'] = "";
		}

		return $return;
	}

}
