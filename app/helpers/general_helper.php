<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/*if( ! ini_get('date.timezone') )
{
   date_default_timezone_set('GMT');
} */

function codeToMessage($code)
{
	switch ($code) {
		case UPLOAD_ERR_INI_SIZE:
			$message = "The uploaded file exceeds the upload_max_filesize directive in php.ini";
			break;
		case UPLOAD_ERR_FORM_SIZE:
			$message = "The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form";
			break;
		case UPLOAD_ERR_PARTIAL:
			$message = "The uploaded file was only partially uploaded";
			break;
		case UPLOAD_ERR_NO_FILE:
			$message = "No file was uploaded";
			break;
		case UPLOAD_ERR_NO_TMP_DIR:
			$message = "Missing a temporary folder";
			break;
		case UPLOAD_ERR_CANT_WRITE:
			$message = "Failed to write file to disk";
			break;
		case UPLOAD_ERR_EXTENSION:
			$message = "File upload stopped by extension";
			break;

		default:
			$message = "Unknown upload error";
			break;
	}
	
	return $message;
}

function gen_xml_data($data, $t_count=0, $array_pre="", $array_post="") {
	if(is_array($data)) {
		if(sizeof($data) > 0) {
			foreach($data as $key => $val) {
				if(is_array($val)) {
					if(sizeof($val) > 0) {
						echo $array_pre;
						foreach($val as $key2 => $val2) {
							if(!is_numeric($key)) {
								echo "\n";
								for($i = 0; $i < $t_count + 0; $i++) 
									echo "\t";
								echo "<" . $key . ">";
							}
							
							if(!is_numeric($key2)) {
								$pre_content = "\n";
								for($i = 0; $i < $t_count + 0; $i++) 
									$pre_content .= "\t";
								$pre_content .= "<" . $key2 . ">";
								$post_content = "\n";
								for($i = 0; $i < $t_count + 0; $i++) 
									$post_content .= "\t";
								$post_content .= "</" . $key2 . ">";
								
								gen_xml_data($val2, $t_count+1, $pre_content, $post_content);
							} else {
								gen_xml_data($val2, $t_count+1);
								
							}
							
							if(!is_numeric($key)) {
								echo "\n";
								for($i = 0; $i < $t_count + 0; $i++) 
									echo "\t";
								echo "</" . $key . ">";
							}
						}
						echo $array_post;
					} else {
						echo str_replace(">", " />", $array_pre);
					}
				} else {
					echo $array_pre;
					echo "\n";
					for($i = 0; $i < $t_count; $i++) 
						echo "\t";
					if($val == '')
						echo "<" . $key . " />";
					else 
						echo "<" . $key . ">" . xml_escape($val) . "</" . $key . ">";
					echo $array_post;
				}
			}
		} else {
			echo str_replace(">", " />", $array_pre);
		}
	} else {
		if($data == '') {
			echo str_replace(">", " />", $array_pre);
		} else {
			echo $array_pre;
			echo xml_escape($data);
			echo str_replace(array("\n", "\t"), "", $array_post);
		}
	}
}

function xml_escape($s) {
	$s = html_entity_decode($s, ENT_QUOTES, 'UTF-8');
	$s = htmlspecialchars($s, ENT_QUOTES, 'UTF-8', false);
	return $s;
}



/**
 * Array debug
 *
 * @access	public
 * @param	string
 * @return	string
 */	
function array_debug($data)
{
	//Array Debug. 
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

function ad($data, $write = false)
{
	//Array Debug. 
	if($write) {
		ob_start();
		print_r($data);
		$output = ob_get_contents();
		ob_end_clean();

		$myFile = "C:/testFile.txt";
		$fh = fopen($myFile, 'a') or die("can't open file");
		
		$date = date("d-m-Y H:i:s") . "\n";
		fwrite($fh, $date);
		fwrite($fh, $output);
		fclose($fh);
	}
	else {
		echo "<pre>";
		print_r($data);
		echo "</pre>";
	}
}

// ------------------------------------------------------------------------

/**
 * Set message for display to browser. Useful for confirming certain process.
 *
 * @access	public
 * @param	string
 * @return	string
 */	
function set_message($feedback, $type = 'info')
{
	#save notice.
	#Message Type: error, info
	
	$obj =& get_instance();
	$obj->session->set_userdata('system-message', $feedback);
	$obj->session->set_userdata('message-type', $type);
}

// ------------------------------------------------------------------------

/**
 * Display message to browser.
 *
 * @access	public
 * @param	string
 * @return	string
 */	
function get_message()
{
	$obj =& get_instance();
	
	//Display notice.
	if($obj->session->userdata('system-message') != '')
	{ 
		echo '<div class="container-fluid"><div class="row-fluid"><div><div class="alert alert-' . $obj->session->userdata('message-type') . '"><button type="button" class="close" data-dismiss="alert">&times;</button>' .
			$obj->session->userdata('system-message') .
			'</div></div></div></div>';
			
		$obj->session->unset_userdata('system-message');
		$obj->session->unset_userdata('message-type');
	}
}


/*
 * Security Checking.
 *
 * @access	public
 * @param	string
 * @return	true or false
 * group 1 => admin
 * group 2 => user
 */	
 
function security_checking($group = false) {
	$obj =& get_instance();
	
	#If group is being specified
	if($group !== false) {
		if(is_array($group)) {
			$found = FALSE;
			foreach($group AS $key => $value) {
				if($obj->session->userdata('user_type') == $value)
					$found = TRUE;
			}
		}
		else
			$found = ($obj->session->userdata('user_type') == $group) ? TRUE : FALSE;
			
		if($found == TRUE AND $obj->session->userdata('logged_in') == TRUE)
			return true;
		else  {
			if($found == FALSE)
				$obj->session->userdata('redirect_login', 'home');
			else 
				$obj->session->userdata('redirect_login', $_SERVER['REQUEST_URI']);
		
			redirect('login/errorLogout');
			exit();
		}
	}
	#General checking for already logged in without specifying group type
	else {
		if($obj->session->userdata('logged_in') == TRUE AND $obj->session->userdata('user_type') != '')
			return true;
		else {
			redirect('login/errorLogout');
			exit();
		}
	}
	
}

function sendmail($subject = null, $body = null, $to = null)
{
	require 'phpmailer/class.phpmailer.php';
	
	$mail             = new PHPMailer();
	
// 	$body             = $mail->getFile('contents.html');
// 	$body             = eregi_replace("[\]",'',$body);
	
	$mail->IsSMTP();
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
	
	$mail->Username   = "";  // GMAIL username
	$mail->Password   = "";            // GMAIL password
	
	$mail->From       = "admin@mudahurus.my";
	$mail->FromName   = "System Admin";
	
	$mail->Subject    = $subject;
	
	$mail->Body       = "THIS IS AN AUTOMATED EMAIL. PLEASE DO NOT REPLY. YOUR REPLY WILL GO NOWHERE.<br /><br />" . $body; //HTML Body
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->WordWrap   = 50; // set word wrap
	
	$mail->MsgHTML($mail->Body);
	
	$mail->AddAddress($to);
	
	// $mail->AddAttachment("images/phpmailer.gif");             // attachment
	
	$mail->IsHTML(true); // send as HTML
	
	if(!$mail->Send())
		return $mail->ErrorInfo;
	else 
		return true;
		
	return false;
}

/**
 * Use for Audit Trail
 */
function audit_trail($sql = null, $filename = null, $function = null, $comment = null) 
{
	$CI =& get_instance();
	
	$sql = $CI->db->escape($sql);
	$filename = $CI->db->escape($filename);
	$function = $CI->db->escape($function);
	$comment = $CI->db->escape($comment);
	$ip_address = $CI->db->escape($_SERVER['REMOTE_ADDR']);
	$username = $CI->db->escape($CI->session->userdata('username'));
	
	$sql = "INSERT INTO ci_audit_trail SET `sql_str` = $sql, `filename` = $filename, `function` = $function, `comment` = $comment, `ip_address` = $ip_address, `username` = $username, insert_date = NOW()";
	$query = $CI->db->query($sql);
	
	return false;
}

function jquerydate2mysql($jquerydate)
{
	$jquerydate_arr = explode(' ', trim($jquerydate));
    if(sizeof($jquerydate_arr) == 3) {
	    #Due to the fact that jquery calendar passes month in short annotation, we then need to translate it for DB.
	    $date_arr = array(
	    	'Jan' => '01', 'Feb' => '02', 'Mar' => '03', 'Apr' => '04', 'May' => '05', 'Jun' => '06',
	    	'Jul' => '07', 'Aug' => '08', 'Sep' => '09', 'Oct' => '10', 'Nov' => '11', 'Dec' => '12'
	    );
	    
	    return $jquerydate_arr[2] . '-' . $date_arr[$jquerydate_arr[1]] . '-' . str_pad($jquerydate_arr[0], 2, "0", STR_PAD_LEFT);
    }
    
    return $jquerydate;
}


if(!function_exists('restricted_urlChange')) {

function restricted_urlChange()
{
	$CI =& get_instance();
	if($CI->session->flashdata('current_url') != "")
			{
				if($CI->session->flashdata('current_url') != $CI->uri->uri_string())
				{	$a = $CI->session->flashdata('current_url');
					redirect(books/restricted);
				}
			}
}

}

function baseImage( $image_path )
{
	$image = file_get_contents( $image_path );
	
	$encrypted = base64_encode( $image );
	
	$url = "data:image/png;base64," . $encrypted;
	
	echo $url;
}

function _array_map_recursive($func, $arr) {

    $new = array();

    foreach($arr as $key => $value) {

        $new[$key] = (is_array($value) ? _array_map_recursive($func, $value) : ( is_array($func) ? call_user_func_array($func, $value) : $func($value) ) );

    }

    return $new;
}

function _escape_html($string) {

    // 4th parameter for double_encode set to false, ignore if already encoded

    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8', false);

}

function _escape_xss($data) {

    if ( _array($data) ) {

        return _array_map_recursive('_escape_html',$data);

    }

    return ( !is_null($data) ? _escape_html($data) : null );

}


?>