<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	/*functions
	*index
	*login
	*logout
	*registro
	*change_password
	*forgot_password
	*_get_csrf_nonce
	*_valid_csrf_nonce
	*_render_page
	*/

	function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('cliente_model');
		$this->load->library(array('ion_auth','form_validation'));
		$this->load->helper(array('url','language'));

		$this->form_validation->set_error_delimiters($this->config->item('error_start_delimiter', 'ion_auth'), 
			$this->config->item('error_end_delimiter', 'ion_auth'));

		$this->lang->load('ion_auth');
		$this->lang->load('auth');
	}

	//redirect if needed, otherwise display the user list
	function index()
	{
		$data['title'] = "Inicio";
		$data['producto'] = $this->cliente_model->productos();
		if(!$this->ion_auth->logged_in())
		{
			$this->load->view('cliente/header_login', $data);
			$this->load->view('cliente/index', $data);
		}
		if ($this->ion_auth->is_cliente() && $this->ion_auth->logged_in()) //remove this elseif if you want to enable this for non-admins
		{
			$this->load->view('cliente/header_logout', $data);
			$this->load->view('cliente/index', $data);
		}
	}

	//log the user in
	function login()
	{

		$data['title'] = "Login";

		$data['producto'] = $this->cliente_model->productos();
		if(!$this->ion_auth->logged_in())
		{
			
		//validate form input
		$this->form_validation->set_rules('identity', 'Identity', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if ($this->form_validation->run() == true)
		{
			//check to see if the user is logging in
			//check for "remember me"
			$remember = (bool) $this->input->post('remember');

			if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
			{
				//if the login is successful
				//redirect them back to the home page
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect('cliente/index', 'refresh', $data);
			}
			else
			{
				//if the login was un-successful
				//redirect them back to the login page
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				$this->load->view('cliente/header_logout');
				redirect('cliente/login', 'refresh');
				 //use redirects instead of loading views for compatibility with MY_Controller libraries
			}
		}
		else
		{
			//the user is not logging in so display the login page
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['identity'] = array('name' => 'identity',
				'id' => 'identity',
				'type' => 'text',
				'value' => $this->form_validation->set_value('identity'),
			);
			$this->data['password'] = array('name' => 'password',
				'id' => 'password',
				'type' => 'password',
			);

			$this->load->view('cliente/header_login', $data);
			$this->_render_page('cliente/login', $this->data);
		}
		}else{
			redirect('cliente/index');
		}
	}

	//log the user out
	function logout()
	{
		if($this->ion_auth->logged_in())
		{
		$this->data['title'] = "Logout";

		//log the user out
		$logout = $this->ion_auth->logout();

		//redirect them to the login page
		$this->session->set_flashdata('message', $this->ion_auth->messages());
		redirect('cliente/login', 'refresh');
		}else{
			redirect('cliente/login', 'refresh');
		}
	}



	//create a new cliente
	function registro()
	{
		$this->data['title'] = "Registro Cliente";

		if ($this->ion_auth->logged_in())
		{
			redirect('cliente', 'refresh');
		}

		$tables = $this->config->item('tables','ion_auth');

		//validate form input
		$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
		$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
		$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 
			'required|valid_email|is_unique['.$tables['users'].'.email]');
		$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required');
		$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 
			'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . 
			$this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
		$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 
			'required');

		if ($this->form_validation->run() == true)
		{
			$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
			$email    = strtolower($this->input->post('email'));
			$password = $this->input->post('password');

			$additional_data = array(
				'first_name' => $this->input->post('first_name'),
				'last_name'  => $this->input->post('last_name'),
				'phone'      => $this->input->post('phone'),
			);
		}
		if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, 
			$additional_data, $groups = array('id' => '3')))
		{
			//check to see if we are creating the user
			//redirect them back to the admin page
			$this->session->set_flashdata('message', $this->ion_auth->messages());
			redirect("cliente", 'refresh');
		}
		else
		{
			//display the create user form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ?
			 $this->ion_auth->errors() : $this->session->flashdata('message')));

			$this->data['first_name'] = array(
				'name'  => 'first_name',
				'id'    => 'first_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('first_name'),
			);
			$this->data['last_name'] = array(
				'name'  => 'last_name',
				'id'    => 'last_name',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('last_name'),
			);
			$this->data['email'] = array(
				'name'  => 'email',
				'id'    => 'email',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('email'),
			);
			$this->data['phone'] = array(
				'name'  => 'phone',
				'id'    => 'phone',
				'type'  => 'text',
				'value' => $this->form_validation->set_value('phone'),
			);
			$this->data['password'] = array(
				'name'  => 'password',
				'id'    => 'password',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password'),
			);
			$this->data['password_confirm'] = array(
				'name'  => 'password_confirm',
				'id'    => 'password_confirm',
				'type'  => 'password',
				'value' => $this->form_validation->set_value('password_confirm'),
			);
			$data['title']='Registro';
			$data['producto'] = $this->cliente_model->productos();
			$this->load->view('cliente/header_login', $data);
			$this->_render_page('cliente/registro', $this->data);
		}
	}

	//change password
	function change_password()
	{

		$this->form_validation->set_rules('old', $this->lang->line('change_password_validation_old_password_label'), 
			'required');
		$this->form_validation->set_rules('new', $this->lang->line('change_password_validation_new_password_label'), 
			'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . 
			$this->config->item('max_password_length', 'ion_auth') . ']|matches[new_confirm]');
		$this->form_validation->set_rules('new_confirm', $this->lang->line('change_password_validation_new_password_confirm_label'), 
			'required');

		if (!$this->ion_auth->logged_in())
		{
			redirect('cliente/login', 'refresh');
		}

		$user = $this->ion_auth->user()->row();

		if ($this->form_validation->run() == false)
		{
			//display the form
			//set the flash data error message if there is one
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

			$this->data['min_password_length'] = $this->config->item('min_password_length', 'ion_auth');
			$this->data['old_password'] = array(
				'name' => 'old',
				'id'   => 'old',
				'type' => 'password',
			);
			$this->data['new_password'] = array(
				'name' => 'new',
				'id'   => 'new',
				'type' => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['new_password_confirm'] = array(
				'name' => 'new_confirm',
				'id'   => 'new_confirm',
				'type' => 'password',
				'pattern' => '^.{'.$this->data['min_password_length'].'}.*$',
			);
			$this->data['user_id'] = array(
				'name'  => 'user_id',
				'id'    => 'user_id',
				'type'  => 'hidden',
				'value' => $user->id,
			);

			//render
			$this->_render_page('cliente/change_password', $this->data);
		}
		else
		{
			$identity = $this->session->userdata('identity');

			$change = $this->ion_auth->change_password($identity, $this->input->post('old'), $this->input->post('new'));

			if ($change)
			{
				//if the password was successfully changed
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				$this->logout();
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect('cliente/change_password', 'refresh');
			}
		}
	}

	//forgot password
	function forgot_password()
	{
		
			$data['title']='Registro';
			$data['producto'] = $this->cliente_model->productos();
			$this->load->view('cliente/header_login', $data);
		if(!$this->ion_auth->logged_in())
		{
			//setting validation rules by checking wheather identity is username or email
		if($this->config->item('identity', 'ion_auth') == 'username' )
		{
		   $this->form_validation->set_rules('email', $this->lang->line('forgot_password_username_identity_label'), 'required');
		}
		else
		{
		   $this->form_validation->set_rules('email', $this->lang->line('forgot_password_validation_email_label'), 
		   	'required|valid_email');
		}


		if ($this->form_validation->run() == false)
		{
			//setup the input
			$this->data['email'] = array('name' => 'email',
				'id' => 'email',
			);

			if ( $this->config->item('identity', 'ion_auth') == 'username' ){
				$this->data['identity_label'] = $this->lang->line('forgot_password_username_identity_label');
			}
			else
			{
				$this->data['identity_label'] = $this->lang->line('forgot_password_email_identity_label');
			}

			//set any errors and display the form
			$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
			$this->_render_page('cliente/forgot_password', $this->data);
		}
		else
		{
			// get identity from username or email
			if ( $this->config->item('identity', 'ion_auth') == 'username' ){
				$identity = $this->ion_auth->where('username', strtolower($this->input->post('email')))->users()->row();
			}
			else
			{
				$identity = $this->ion_auth->where('email', strtolower($this->input->post('email')))->users()->row();
			}
	            	if(empty($identity)) {

	            		if($this->config->item('identity', 'ion_auth') == 'username')
		            	{
                                   $this->ion_auth->set_message('forgot_password_username_not_found');
		            	}
		            	else
		            	{
		            	   $this->ion_auth->set_message('forgot_password_email_not_found');
		            	}

		                $this->session->set_flashdata('message', $this->ion_auth->messages());
                		redirect("auth/forgot_password", 'refresh');
            		}

			//run the forgotten password method to email an activation code to the user
			$forgotten = $this->ion_auth->forgotten_password($identity->{$this->config->item('identity', 'ion_auth')});

			if ($forgotten)
			{
				//if there were no errors
				$this->session->set_flashdata('message', $this->ion_auth->messages());
				redirect("cliente/login", 'refresh'); //we should display a confirmation page here instead of the login page
			}
			else
			{
				$this->session->set_flashdata('message', $this->ion_auth->errors());
				redirect("cliente/forgot_password", 'refresh');
			}
		}
		}else{
			redirect("cliente/", 'refresh');
		}
	}

	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function _render_page($view, $data=null, $render=false)
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;

		$view_html = $this->load->view($view, $this->viewdata, $render);

		if (!$render) return $view_html;
	}

	function catalogo($id = null)
	{
		$data['title']='catalogo';
		$data['producto'] = $this->cliente_model->productos();
		//get producto 
			
			if($id != null)
			{
				$data['productos'] = $this->cliente_model->productos_detalle($id);	
			}else
			{
				$data['productos'] = $this->cliente_model->productos_detalle();	
			}

			if(!$this->ion_auth->logged_in())
			{
				$this->load->view('cliente/header_login', $data);
			}
			else
			{
				$this->load->view('cliente/header_logout', $data);
			}
			$this->load->view('cliente/catalogo', $data);
		
	}

	function compras($id = null)
	{
		$data['title']='compras';
		$data['producto'] = $this->cliente_model->productos();

		if($this->ion_auth->logged_in())
		{	
			$data['iduser']=$this->ion_auth->get_user_id();
			$data['idpro']=$id;		
			$this->load->view('cliente/header_logout', $data);
			$this->load->view('cliente/compras', $data);
		}else
		{
			redirect('cliente/login');
		}
	}


	function quienes()
	{
		$data['title']='¿quienes somos?';
		$data['producto'] = $this->cliente_model->productos();
		if(!$this->ion_auth->logged_in())
		{
			$this->load->view('cliente/header_login', $data);
		}else
		{
			$this->load->view('cliente/header_logout', $data);
		}	
		$this->load->view('cliente/quienes', $data);
		
	}

}