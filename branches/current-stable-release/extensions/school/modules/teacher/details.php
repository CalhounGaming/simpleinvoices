<?php
/*
* Script: details.php
* 	Customers details page
*
* Authors:
*	 Justin Kelly, Nicolas Ruflin
*
* Last edited:
* 	 2007-07-19
*
* License:
*	 GPL v2 or above
*
* Website:
* 	http://www.simpleinvoices.org
 */

//stop the direct browsing to this file - let index.php handle which files get displayed
checkLogin();


#get the invoice id
$customer_id = $_GET['id'];

$customer = school_teacher::getTeacher($customer_id);

$customer['wording_for_enabled'] = $customer['enabled']==1?$LANG['enabled']:$LANG['disabled'];

#get custom field labels



$customFieldLabel = getCustomFieldLabels();


//$customFieldLabel = getCustomFieldLabels("biller");
$pageActive = "teacher";
$smarty->assign('pageActive', $pageActive);


$smarty -> assign("stuff",$stuff);
$smarty -> assign('customer',$customer);
$smarty -> assign('customer_date',$customer_date = format_date($customer['date']) );
$smarty -> assign('customer_birthday',$customer_birthday = format_date($customer['birthday']) );
$smarty -> assign('customer_passport_issued_on',$customer_passport_issued_on = format_date($customer['passport_issued_on']) );
$smarty -> assign('customer_guardian1_passport_issued_on',$customer_guardian1_passport_issued_on = format_date($customer['guardian1_passport_issued_on']) );
$smarty -> assign('customer_guardian2_passport_issued_on',$customer_guardian2_passport_issued_on = format_date($customer['guardian2_passport_issued_on']) );
$smarty -> assign('invoices',$invoices);
$smarty -> assign('customFieldLabel',$customFieldLabel);

/*Place of enrolment function*/
$sql = "select * from ".TB_PREFIX."branch"; 
$branch_sql = sql2array($sql);
$smarty -> assign('branch',$branch_sql);

$sql_enrol = "select name from ".TB_PREFIX."branch where id = ".$customer['place_of_registration'] ; 
$enrol_sql = mysql_fetch_object(mysqlQuery($sql_enrol));
$smarty -> assign('place_of_enrolment',$enrol_sql->name);

$sql_lesson = "select name from ".TB_PREFIX."branch where id = ".$customer[place_of_lesson].""; 
$lesson_sql = mysql_fetch_object(mysqlQuery($sql_lesson));
$smarty -> assign('place_of_lesson',$lesson_sql->name);

$sql_branch = "select name from ".TB_PREFIX."branch where id = ".$customer[branch_id].""; 
$branch_sql = mysql_fetch_object(mysqlQuery($sql_branch));
$smarty -> assign('branch_id',$branch_sql->name);

/*Relationship function*/
/*
$sql_rel = "select * from ".TB_PREFIX."student_relation"; 
$rel_sql = sql2array($sql_rel);
$smarty -> assign('relation',$rel_sql);

$sql_g1_rel = "select relation from ".TB_PREFIX."student_relation where id = ".$customer[guardian1_relationship].""; 
$g1_rel_sql = mysql_fetch_object(mysqlQuery($sql_g1_rel));
$smarty -> assign('guardian1_relationship',$g1_rel_sql->relation);

$sql_g2_rel = "select relation from ".TB_PREFIX."student_relation where id = ".$customer[guardian2_relationship].""; 
$g2_rel_sql = mysql_fetch_object(mysqlQuery($sql_g2_rel));
$smarty -> assign('guardian2_relationship',$g2_rel_sql->relation);
*/

/* Gender */
$smarty->assign('gender', array('Male','Female'));

/* date selctors */
$smarty -> assign('year',$year = year());
$smarty -> assign('year_now',$year_now = date('Y') );
$smarty -> assign('month',month());
$smarty -> assign('day',$day = day());

/* Age */
$calc_month = $customer_birthday['month']; 
$calc_day = $customer_birthday['day']; 
$calc_year = $customer_birthday['year'];

$smarty -> assign('age',$calc_age = calc_age($calc_month, $calc_day, $calc_year));
/* Course*/

/*
$course_sql = "select * from si_course_enrol where student_id = ".$customer_id."";
$course_sql_result = mysql_fetch_object(mysqlQuery($course_sql));
*/
//$course_enrol = school_enrol::getStudentEnrollment($customer_id);
//print_r($course_enrol);
//$smarty->register_object("course_enrol",$course_sql_result);
/*
$course_dropped_sql = "select * from si_course_dropped_reason where id = ".$cource_sql_result['dropped_reason_id']."";
$course_dropped_sql_result = mysql_fetch_object(mysqlQuery($course_dropped_sql));
$course_sql_result['dropped_reaon'] = 
*/
//$smarty -> assign('course_enrol',$course_enrol);

$smarty -> assign('auth_role_name',$auth_session->role_name);
$smarty -> assign('auth_user_domain',$auth_session->user_domain);


$sql_branch = "select name from ".TB_PREFIX."branch where id = ".$customer[branch_id].""; 
$branch_sql = mysql_fetch_object(mysqlQuery($sql_branch));
$smarty -> assign('branch_id',$branch_sql->name);
?>