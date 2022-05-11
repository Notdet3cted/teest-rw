<?php

function apakahlogin()
{
    $ci = get_instance();
    if (!$ci->session->userdata('email')) {
        redirect('auth/login');
    }
}
