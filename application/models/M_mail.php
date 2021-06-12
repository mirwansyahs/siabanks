<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_mail extends CI_Model {
	
	public function sendMail($data){

	  	// Konfigurasi email

        $config = [

               'mailtype'  => 'html',

               'charset'   => 'utf-8',

               'protocol'  => 'smtps',

               'smtp_host' => 'mail.lanishod.com',

               'smtp_user' => 'admin@lanishod.com',    // Ganti dengan email gmail kamu

               'smtp_pass' => 'lanishod123',      // Password gmail kamu

               'smtp_port' => 465,

               'crlf'      => "\r\n",

               'newline'   => "\r\n"

           ];



        // Load library email dan konfigurasinya

        $this->load->library('email', $config);



        // Email dan nama pengirim

        $this->email->from('no-reply@siabanks.lanishod.com', 'BANK SAMPAH');



        // Email penerima

        // $this->email->to($EAdmin); // Ganti dengan email tujuan kamu

		$this->email->to($data['SendTo']);

        // Lampiran email, isi dengan url/path file

        $this->email->attach($data['Attachment']);



        // Subject email

        $this->email->subject($data['Subject']);



        // Isi email

        $this->email->message($data['TextMail']);



        // Tampilkan pesan sukses atau error

        if ($this->email->send()) {

            // echo '{msg:succ}';
            return true;

        } else {

            // echo '{msg:err}';
            return false;

        }

	  }

	  public function sendWA($data){
	  		$data = $this->session->set_flashdata("msg", $this->alert->success("Sending to whatsapp", "<script>window.open('https://api.whatsapp.com/send?phone=62".$data['NumberPhone']."&text=".rawurlencode($data['Text'])."&source=&data=');</script>"));
	  }

	  public function sendNotification($data){
		//$text 	= "Surat Masuk | ".$this->userdata->Name." \n\n\nHi ".$data['Email']."\n\n\nAda surat masuk dengan judul '<b>".$data['Title']."</b> nih, kamu bisa buka di pesan ini atau buka Aplikasinya. :-) \n\n\n*Note: Email ini adalah Percobaan (BETA), Aplikasi ini masih dalam tahap Development.\nTerimakasih";
		$text = "[+] Surat Masuk | ".$this->userdata->Name." [+]\n\nHai **".$data['Nama']."**\n\n_Ada surat masuk dengan judul '".$data['Title']."' nih,kamu bisa buka melalui link dibawah ini atau buka Aplikasinya._ :-)\n\nLink :\n".base_url()."Login/downloadPesan/17?MailID=".$data['MailID']."&MemberID=".$data['MemberID']."&InstanceID=".$data['InstanceID']."&File=".$data['File'];
		$url 	= "https://api.telegram.org/bot1019164591:AAEyQ6JnZa7Si7DNE6NmIXPI4UAq2peFbHo/sendMessage?parse_mode=markdown&chat_id=".$data['TokenID']."&text=".urlencode($text);
		echo $url;
		$ch		= curl_init();
		$optArray = array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true
		);
		curl_setopt_array($ch, $optArray);
		$result = curl_exec($ch);
		curl_close($ch);
		//echo $result;
	}
}

/* End of file M_admin.php */
/* Location: ./application/models/M_admin.php */
