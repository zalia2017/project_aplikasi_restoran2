<?php

function cek_login()
{
    //Membuat sebuan instans
    $ci = get_instance();

    //Mengecek apakah tidak ada session email
    if (!$ci->session->userdata('email')) {
        //Maka akan memunculkan pesan akses ditolak
        $ci->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Akses ditolak. Anda belum login!! </div>');
        //Jika role_id dari sessionnya adalah 1 (admin)
        if($ci->session->userdata('role_id') == 1){
            //akan diarahkan ke controller autentifikasi
            redirect('autentifikasi');
        }else{
            //jika bukan admin akan diarahkan ke controller home
            redirect('home');
        }
        
    } else {
        //Jika di session sudah ada atau sudah login sebelumnya, maka
        // memasukkan $role_id  dengan session role_id
        // Memasukkan $id_user dengan session id_user
        $role_id = $ci->session->userdata('role_id');
        $id_user = $ci->session->userdata('id_user');
    }
}

function cek_user()
{
    $ci = get_instance();
    $role_id = $ci->session->userdata('role_id');
    if($role_id != 1){
        $ci->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Akses tidak diizinkan </div>');
        redirect('home');
    }
}