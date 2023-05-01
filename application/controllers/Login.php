<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller{

		public function __construct()
		{
			parent::__construct();
			$this->load->model('M_auth');
			$this->load->model("M_users");
			$this->load->model("M_mail");
		}

		public function index()
		{
			$session = $this->session->userdata('status');

			if ($session == '') {
				$this->load->view('_frontend/login');
			} else {
				redirect('Redaktur/Home');
			}
		}

		public function register()
		{
			$session = $this->session->userdata('status');

			if ($session == '') {
				$this->load->view('_frontend/register');
			} else {
				redirect('Redaktur/Home');
			}
		}

		public function signup()
		{
			$this->form_validation->set_error_delimiters('<div class="alert alert-block alert-danger">
			<button type="button" class="close" data-dismiss="alert">
			</button>

			<p>
				  <div style="font-size:12px">
					  <i class="fa fa-warning"></i>
					 <b>Failed!</b> ', '</div>
					 </p>
				 </div>');
			
			$this->form_validation->set_rules('NIK', 'NIK', 'required|is_unique[tb_members.NIK]',
			array(
				'required' => '{field} tidak boleh kosong!', 
				'is_unique' => '{field} sudah digunakan oleh '.@$this->M_users->cek($this->input->post('NIK'))->row()->Nama_Depan." ".@$this->M_users->cek($this->input->post('NIK'))->row()->Nama_Belakang."!"
			));
			$this->form_validation->set_rules('Email', 'Email', 'required|is_unique[tb_members.Email]',
			array(
				'required' => '{field} tidak boleh kosong!', 
				'is_unique' => '{field} sudah terdaftar!'
			));
	
			if ($this->form_validation->run()==FALSE){
				echo json_encode(array('msg' => 'succ', 'pwd' => 'mis', 'psn' => validation_errors()));
			}else{
				$data = $this->input->post();
				$data['MemberID']  = $this->M_users->autonumber();
				$data['user_pass']  = $this->M_users->random_pass();
				$data['user_status']  = '2';

						$result = $this->M_users->simpan_without_image($data);
						
						if ($result){

							$data['SendTo'] 	= $data['Email'];
							$data['Subject'] 	= "Pendaftaran Berhasil | BANK SAMPAH";
							$data['Attachment'] = "";
							$arr = array(
								"%FullName%" 	=> $data['Nama_Depan'].' '.$data['Nama_Belakang'],
								"%Email%" 		=> $data['Email'],
								"%Password%" 	=> $data['user_pass']
							);
							$data['TextMail'] 	= strtr(file_get_contents($_SERVER['DOCUMENT_ROOT'].'/SIABANKS/application/views/_layout/_emailRegist.php'), $arr);
							//echo $data['TextMail'];
							$result = $this->M_mail->sendMail($data);
							if ($result){
								// $this->session->set_flashdata("msg", $this->alert->info("Pendaftaran berhasil!<br>", "Silahkan cek email ".$data['Email']."!", '12px'));
								$this->session->set_flashdata("msg", $this->alert->info("Pendaftaran berhasil!<br>", "Server sedang error, password anda <b>".$data['user_pass']."</b><br>Silahkan ubah kata sandi anda!", '12px'));
								
								// redirect("Login");
							}else{
								$this->session->set_flashdata("msg", $this->alert->info("Pendaftaran berhasil!<br>", "Server sedang error, password anda <b>".$data['user_pass']."</b>!<br>Silahkan ubah kata sandi anda!", '12px'));
								// redirect("Login");
							}
							echo json_encode(array('msg' => 'succ', 'pwd' => 'mis'));
						}else{
							$this->session->set_flashdata("msg", $this->alert->failed("Silahkan ulangi pendaftaran!"));
							// redirect("Login");
						}
			}
		}

		public function sign()
		{
			$username = $this->db->escape_str(trim($_POST['uname']));
			$password = $this->db->escape_str(trim($_POST['passwd']));

			$data = $this->M_auth->login($username, $password);
			if ($data == false) {
				// Salah
				$this->session->set_flashdata("msg", $this->alert->failed("Username atau password salah!"));
				redirect('Login');
			} else {
				$session = [
					'userdata' => $data,
					'status' => "Loged in"
				];
				$this->session->set_userdata('file_manager',true);
				$this->session->set_userdata($session);
				//var_dump($this->session);
				redirect('Redaktur/Home');
			}
		}

		public function out()
		{
			$this->session->sess_destroy();
			redirect('Login');
		}
		public function showJSON(){
		header('Content-Type: application/javascript');
		$data = $this->M_users->select_all_json();
		echo json_encode($data);
	}
}

?>