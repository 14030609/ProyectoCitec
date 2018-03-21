<?php

namespace Drupal\registro\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Request;

class RegistroController extends ControllerBase
{
    public function lista()
    {
        $is_admin_registro=false;
        if(\Drupal::currentUser()->hasPermission('registro add'))
        {
            $is_admin_registro=true;
        }
        $sql    = "select * from {participante}";
        $rs     = db_query($sql)->fetchAll();

        return array(
            '#title' => 'Registro',
            '#theme' => 'registro-list',
            '#registro_list_table' => $rs,
            '#is_admin_registro' => $is_admin_registro,
        );
    }
}
