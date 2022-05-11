<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function index()
    {
        if ($this->session->userdata('email')) {
            redirect('home');
        }
        redirect('auth/login');
    }

    public function login()
    {
        $this->load->view("login");
    }

    public function register()
    {
        $this->load->view("register");
    }
    public function proses_login()
    {
        $this->form_validation->set_error_delimiters('<div style="display:block" class="invalid-feedback">', '</div>');

        $this->form_validation->set_rules('email', 'Email', 'required|trim|callback_cek_email');
        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim|min_length[12]|callback_cek_password',
            array('required' => 'Password harus diisi.')
        );

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('login');
        } else {
            $data['email'] = $this->input->post('email');
            $this->session->set_userdata($data);
            redirect('home');
        }
    }

    public function proses_register()
    {
        $this->form_validation->set_error_delimiters('<div style="display:block" class="invalid-feedback">', '</div>');

        $this->form_validation->set_rules(
            'password',
            'Password',
            'required|trim|min_length[12]|callback_cek_password',
            array('required' => 'password harus diisi.')
        );
        $this->form_validation->set_rules('password_confirmation', 'Konfirmasi Password', 'required|matches[password]', array('matches' => 'Password tidak sama'));
        $this->form_validation->set_rules('email', 'Email', 'required|trim|callback_cek_email');
        $this->form_validation->set_rules('bday', 'Tanggal lahir', 'required|callback_cek_umur');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('register');
        } else {
            $this->session->set_flashdata('flash', 'Berhasil Register, Silahkan Login');
            redirect("auth/login");
        }
    }

    public function cek_email($email)
    {
        $pecah_email = explode('@', $email);
        $end_email = end($pecah_email);

        if ($end_email != 'rumahweb.co.id') {
            $this->form_validation->set_message('cek_email', "{field} harus menggunakan @rumahweb.co.id");
            return FALSE;
        } else {
            return TRUE;
        }
    }


    public function cek_password($password)
    {
        if (preg_match('/[^a-zA-Z0-9]/i', $password)) {
            if (preg_match('/[A-Z]/i', $password)) {
                if (preg_match('/[a-z]/i', $password)) {
                    if (preg_match('/[0-9]/i', $password)) {
                        return TRUE;
                    } else {
                        $this->form_validation->set_message('cek_password', "Password harus mengandung angka");
                        return FALSE;
                    }
                } else {
                    $this->form_validation->set_message('cek_password', "Password harus mengandung kecil");
                    return FALSE;
                }
            } else {
                $this->form_validation->set_message('cek_password', "Password harus mengandung huruf Kapital");
                return FALSE;
            }
        } else {
            $this->form_validation->set_message('cek_password', "Password harus mengandung simbol");
            return FALSE;
        }

        // if (preg_match('/[^a-zA-Z0-9]/', $password) && preg_match('/[a-zA-Z]/', $password) && preg_match('/[0-9]/', $password)) {
        //     return TRUE;
        // } else {
        //     $this->form_validation->set_message('cek_password', "Password harus mengandung angka, simbol, dan huruf kapital");
        //     return FALSE;
        // }
    }

    public function cek_umur($bday)
    {
        $bday = strtotime($bday);
        $umur = strtotime('+17 years', $bday);
        if (time() < $umur) {
            $this->form_validation->set_message('cek_umur', "Usia minimal 17 tahun");
            return FALSE;
        } else {
            return TRUE;
        }
    }

    public function logout()
    {
        $this->session->unset_userdata('email');
        redirect('auth/login');
    }
}
