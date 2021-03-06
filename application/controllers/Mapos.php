<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Mapos extends CI_Controller
{

    
    public function __construct()
    {
        parent::__construct();
        $this->load->model('mapos_model', '', true);
        
    }

    public function index()
    {
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('mapos/login');
        }

        $this->data['ordens'] = $this->mapos_model->getOsAbertas();
        $this->data['produtos'] = $this->mapos_model->getProdutosMinimo();
        $this->data['os'] = $this->mapos_model->getOsEstatisticas();
        $this->data['menuPainel'] = 'Painel';
        $this->data['view'] = 'mapos/painel';
        $this->load->view('tema/topo', $this->data);
      
    }

    public function minhaConta()
    {
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('mapos/login');
        }

        $this->data['usuario'] = $this->mapos_model->getById($this->session->userdata('id'));
        $this->data['view'] = 'mapos/minhaConta';
        $this->load->view('tema/topo', $this->data);
     
    }



    public function pesquisar()
    {
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('mapos/login');
        }
        
        $termo = $this->input->get('termo');

        $data['results'] = $this->mapos_model->pesquisar($termo);
        $this->data['produtos'] = $data['results']['produtos'];
        $this->data['servicos'] = $data['results']['servicos'];
        $this->data['os'] = $data['results']['os'];
        $this->data['clientes'] = $data['results']['clientes'];
        $this->data['view'] = 'mapos/pesquisa';
        $this->load->view('tema/topo', $this->data);
      
    }

    public function login()
    {
        
        $this->load->view('mapos/login');
        
    }
    public function sair()
    {
        $this->session->sess_destroy();
        redirect('mapos/login');
    }


    public function verificarLogin()
    {
        
        header('Access-Control-Allow-Origin: '.base_url());
        header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
        header('Access-Control-Max-Age: 1000');
        header('Access-Control-Allow-Headers: Content-Type');
        
        $this->load->library('form_validation');
        $this->form_validation->set_rules('email', 'E-mail', 'valid_email|required|trim');
        $this->form_validation->set_rules('senha', 'Senha', 'required|trim');
        if ($this->form_validation->run() == false) {
            $json = array('result' => false, 'message' => validation_errors());
            echo json_encode($json);
        } else {
            $email = $this->input->post('email');
            $password = $this->input->post('senha');
            $this->load->model('Mapos_model');
            $user = $this->Mapos_model->check_credentials($email);

            if ($user) {
                if (password_verify($password, $user->senha)) {
                    $session_data = array('nome' => $user->nome, 'email' => $user->email, 'id' => $user->idUsuarios,'permissao' => $user->permissoes_id , 'logado' => true);
                    $this->session->set_userdata($session_data);
                    $json = array('result' => true);
                    echo json_encode($json);
                } else {
                    $json = array('result' => false, 'message' => 'Os dados de acesso est??o incorretos.');
                    echo json_encode($json);
                }
            } else {
                $json = array('result' => false, 'message' => 'Usu??rio n??o encontrado, verifique se suas credenciais est??o corretass.');
                echo json_encode($json);
            }
        }
        die();
    }


   


   
    function do_upload()
    {

        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('mapos/login');
        }

  
        $this->load->library('upload');

        $image_upload_folder = FCPATH . 'assets/uploads';

        if (!file_exists($image_upload_folder)) {
            mkdir($image_upload_folder, DIR_WRITE_MODE, true);
        }

        $this->upload_config = array(
            'upload_path'   => $image_upload_folder,
            'allowed_types' => 'png|jpg|jpeg|bmp',
            'max_size'      => 2048,
            'remove_space'  => true,
            'encrypt_name'  => true,
        );

        $this->upload->initialize($this->upload_config);

        if (!$this->upload->do_upload()) {
            $upload_error = $this->upload->display_errors();
            print_r($upload_error);
            exit();
        } else {
            $file_info = array($this->upload->data());
            return $file_info[0]['file_name'];
        }

    }




    public function editarLogo()
    {
        
        if ((!session_id()) || (!$this->session->userdata('logado'))) {
            redirect('mapos/login');
        }

        $id = $this->input->post('id');
        if ($id == null || !is_numeric($id)) {
            $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar alterar a logomarca.');
            redirect(base_url().'index.php/mapos/emitente');
        }
        $this->load->helper('file');
        delete_files(FCPATH .'assets/uploads/');

        $image = $this->do_upload();
        $logo = base_url().'assets/uploads/'.$image;

        $retorno = $this->mapos_model->editLogo($id, $logo);
        if ($retorno) {

            $this->session->set_flashdata('success', 'As informa????es foram alteradas com sucesso.');
            redirect(base_url().'index.php/mapos/emitente');
        } else {
            $this->session->set_flashdata('error', 'Ocorreu um erro ao tentar alterar as informa????es.');
            redirect(base_url().'index.php/mapos/emitente');
        }

    }
}
