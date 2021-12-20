<?php

function isLogged()
{
    if(!empty($_SESSION['user'])) {
        if (!empty($_SESSION['user']['id'])) {
            if (!empty($_SESSION['user']['email'])) {
                if (!empty($_SESSION['user']['name'])) {
                    if (!empty($_SESSION['user']['role'])) {
                        if (!empty($_SESSION['user']['ip'])) {
                            if ($_SESSION['user']['ip'] == $_SERVER['REMOTE_ADDR']) {
                                return true;
                            }
                        }
                    }
                }
            }
        }
    }
    return false;
}

function isAdmin()
{
    if(isLogged()) {
        if($_SESSION['user']['role'] == 'admin') {
            return true;
        }
    }
    return false;
}