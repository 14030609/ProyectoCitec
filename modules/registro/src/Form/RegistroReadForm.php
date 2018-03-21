<?php

namespace Drupal\registro\Form;

use Drupal\Core\Database\Database;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\Html;

class RegistroReadForm extends FormBase
{

    protected $id;

    function getFormID() {
        return 'bd_regitro_update';
    }

    function buildForm(array $form, FormStateInterface $form_state, $id = '') {
        $this->id = $id;
        $query = db_query("SELECT * FROM {participante} WHERE id = :id", array(':id' => $id))->fetchObject();
        $form['nombre'] = array(
            '#type' => 'textfield',
            '#title' => t('Nombre: '),
            '#default_value' => $query->nombre,
        );
        $form['apaterno'] = array(
            '#type' => 'textfield',
            '#title' => t('Apellido Paterno: '),
            '#default_value'=> $query->apaterno,
        );
        $form['amaterno'] = array(
            '#type' => 'textfield',
            '#title' => t('Apellido Materno: '),
            '#default_value'=> $query->amaterno,
        );
        $form['email'] = array(
            '#type' => 'textfield',
            '#title' => t('Email'),
            '#default_value'=> $query->email,
        );
        $form['telefono'] = array(
            '#type' => 'textfield',
            '#title' => t('Telefono'),
            '#default_value'=> $query->telefono,
        );
        $form['genero'] = array(
            '#type' => 'textfield',
            '#title' => t('Genero'),
            '#default_value'=> $query->genero,
        );
        $form['ciudad'] = array(
            '#type' => 'textfield',
            '#title' => t('Ciudad'),
            '#default_value'=> $query->ciudad
        );
        $form['pais'] = array(
            '#type' => 'textfield',
            '#title' => t('País'),
            '#default_value'=> $query->pais,
        );
        $form['empresa'] = array(
            '#type' => 'textfield',
            '#title' => t('Empresa'),
            '#default_value'=> $query->empresa,
        );
        $form['tipo_identificacion'] = array(
            '#type' => 'select',
            '#title' => t('Tipo de Identificación'),
            '#options' => array(t('--- SELECT ---'), 'INE/IFE'=>t('INE/IFE'), 'Pasaporte'=>t('Pasaporte'), 'Cartilla Militar'=>t('Cartilla Militar'),
                'Cedula Profesional'=>t('Cedula Profesional')),
            '#default_value'=> $query->tipo_identificacion,
        );
        $form['tipo_participante'] = array(
            '#type' => 'select',
            '#title' => t('Tipo Participante'),
            '#options' => array(t('--- SELECT ---'),'Participante' => t('Participante'),'Conferencista'=>t('Conferencista'),'Invitado Especial'=>t('Invitado Especial')),
            '#default_value'=> $query->tipo_participante,
        );
        $form['actions'] = array('#type' => 'actions');
        $form['actions']['submit'] = array(
            '#type' => 'submit',
            '#value' => t('Regresar'),
        );
        return $form;
    }

    function validateForm(array &$form, FormStateInterface $form_state) {
    }

    function submitForm(array &$form, FormStateInterface $form_state) {
        $nombre 	= $form_state->getValue('nombre');
        $apaterno 	= $form_state->getValue('apaterno');
        $amaterno 	= $form_state->getValue('amaterno');
        $email 		= $form_state->getValue('email');
        $telefono 	= $form_state->getValue('telefono');
        $genero 	= $form_state->getValue('genero');
        $ciudad		= $form_state->getValue('ciudad');
        $pais		= $form_state->getValue('pais');
        $empresa	= $form_state->getValue('Empresa');
        $tipo_identificacion = $form_state->getValue('tipo_identificacion');
        $tipo_participante	 = $form_state->getValue('tipo_participante');
        $conn = Database::getConnection();

        $form_state->setRedirect('registro-list');
        return;
    }
}
?>
