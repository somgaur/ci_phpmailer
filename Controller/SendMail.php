<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SendMail extends CI_Controller {

	 public function __construct(){    

        parent::__construct();
        error_reporting(-1);
        $this->load->library('email');
        $config['smtp_host']        = 'mail.goodlucktailors.online';
        $config['smtp_user']        = 'support@goodlucktailors.online';
        $config['smtp_pass']        = 'Good@2019';
        $config['smtp_port']        = '465';
        $config['smtp_crypto']      = 'ssl';   
        $config['charset']          = 'utf-8';
        $config['smtp_conn_options'] = array(
                                            'ssl' => array(
                                                'verify_peer' => false,
                                                'verify_peer_name' => false,
                                                'allow_self_signed' => true
                                            )
                                        );
        $this->email->initialize($config);
        $this->email_address='support@goodlucktailors.online';
        $this->email_tittle='Gigs';
        $this->logo_front=base_url().'uploads/150.jpg';
        $this->site_name ='Good Luck Tailors'; //Out Side Name of inbox before unread
        $this->base_domain = base_url();
	 }
	
	public function index()
	{
        //$url=base_url().'payment/somdev';
        
            $message='';

            $welcomemessage='';

            $bodyid=13;

            $tempbody_details= $this->db->query("select template_title, template_content FROM email_templates where template_id='13'")->row_array();
            $body=$tempbody_details['template_content'];

            $body = str_replace('{base_url}', $this->base_domain, $body);

            $body = str_replace('{base_image}',$this->base_domain.'/'.$this->logo_front, $body);

            $body = str_replace('{USER_NAME}', 'Somdev', $body);

            $body = str_replace('{sitetitle}',$this->site_name, $body);

            $body = str_replace('{SUBMIT_LINK}', $url, $body);
            
            
            
        
        
        $mail_message = '<table style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 14px; width: 100%; background-color: #f6f6f6; margin: 0;" bgcolor="#f6f6f6">

      <tr>

        <td></td>

        <td width="600" style="box-sizing: border-box; vertical-align: top; display: block !important; max-width: 600px !important; clear: both !important; margin: 0 auto;" valign="top">

          <div style="box-sizing: border-box; max-width: 600px; display: block; margin: 0 auto; padding: 20px;">

            <table width="100%" cellpadding="0" cellspacing="0" style="box-sizing: border-box; font-size: 14px; border-radius: 3px; background-color: #fff; margin: 0; border: 1px solid #e9e9e9;" bgcolor="#fff">

              <tr>

                <td style="box-sizing: border-box; vertical-align: top; text-align: left; margin: 0; padding: 20px;" valign="top">

                  <table width="100%" cellpadding="0" cellspacing="0">

                    <tr>

                      <td style="text-align:center;">

                        <a href="{base_url}" target="_blank"><img src="'.$this->logo_front.'" style="width:90px" /></a>

                      </td>

                    </tr>

                    <tr>

                      <td>'.$body.'</td>

                    </tr>

                  </table>

                </td>

              </tr>

            </table>

            <div style="box-sizing: border-box; width: 100%; clear: both; color: #999; margin: 0; padding: 15px 15px 0 15px;">

              <table width="100%">

                <tr>

                  <td style="font-family: Helvetica Neue,Helvetica,Arial,sans-serif; box-sizing: border-box; font-size: 12px; vertical-align: top; color: #999; text-align: center; margin: 0; padding: 0;" align="center" valign="top">

                    &copy; '.date("Y").' <a href="'.$this->base_domain.'" target="_blank" style="color:#bbadfc;" target="_blank">'.$this->site_name.'</a> All Rights Reserved.

                  </td>

                </tr>

              </table>

            </div>

          </div>

        </td>

      </tr>

    </table>';
    
    
        //$mail_message = $message;
        $this->email->to('somdevgaur@gmail.com');
        $this->email->from($this->email_address, $this->site_name);
        $this->email->subject($this->site_name.' New Registration');
        $this->email->message($mail_message);
        $send = $this->email->send();  
        if($send){
        	echo "Mail Send Success.";
        }
        else
        {
        	echo "Failed!";
        }
	}
}
