<?php

namespace Drupal\registro\Form;

use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;
use Drupal\Component\Utility\Html;

class RegistroAddForm implements FormInterface
{

	function getFormId() {
		return 'bd_registro_add';
	}

	function buildForm(array $form, FormStateInterface $form_state) {
		$form['nombre'] = array(
		  '#type' => 'textfield',
		  '#title' => t('Nombre'),
		);
		$form['apaterno'] = array(
		  '#type' => 'textfield',
		  '#title' => t('Apellido Paterno'),
		);
        $form['amaterno'] = array(
            '#type' => 'textfield',
            '#title' => t('Apellido Materno'),
        );
        $form['email'] = array(
            '#type' => 'textfield',
            '#title' => t('Email'),
        );
        $form['telefono'] = array(
            '#type' => 'textfield',
            '#title' => t('Telefono'),
        );
        $form['genero'] = array(
            '#type' => 'textfield',
            '#title' => t('Genero'),
        );
        $form['ciudad'] = array(
            '#type' => 'textfield',
            '#title' => t('Ciudad'),
        );
        $form['pais'] = array(
            '#type' => 'textfield',
            '#title' => t('País'),
        );
        $form['empresa'] = array(
        	'#type' => 'textfield',
			'#title' => t('Empresa'),
		);
        $form['tipo_identificacion'] = array(
            '#type' => 'select',
            '#title' => t('Tipo de Identificación'),
            '#options' => array(t('--- SELECT ---'), 'INE/IFE'=>t('INE/IFE'), 'Pasaporte'=>t('Pasaporte'), 'Cartilla Militar'=>t('Cartilla Militar'),
								'Cedula Profesional'=>t('Cedula Profesional'))
        );
        $form['tipo_participante'] = array(
        	'#type' => 'select',
        	'#title' => t('Tipo Participante'),
			'#options' => array(t('--- SELECT ---'),'Participante' => t('Participante'),'Conferencista'=>t('Conferencista'),'Invitado Especial'=>t('Invitado Especial')),
		);
		$form['actions'] = array('#type' => 'actions');
		$form['actions']['submit'] = array(
		  '#type' => 'submit',
		  '#value' => t('Agregar'),
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
        $empresa	= $form_state->getValue('empresa');
        $tipo_identificacion = $form_state->getValue('tipo_identificacion');
        $tipo_participante	 = $form_state->getValue('tipo_participante');

		$conn = Database::getConnection();
		$conn->insert('participante')->fields(
		  array(
		  	'nombre' 		=> $nombre,
			  'apaterno' 	=> $apaterno,
			  'amaterno' 	=> $amaterno,
              'email' 		=> $email,
              'telefono' 	=> $telefono,
              'genero' 		=> $genero,
			  'ciudad'		=> $ciudad,
			  'pais'		=> $pais,
			  'empresa'		=> $empresa,
			  'tipo_identificacion' => $tipo_identificacion,
			  'tipo_participante'	=> $tipo_participante,
		  )
		)->execute();

		drupal_set_message(t('Participante Registrado'));
		$form_state->setRedirect('registro-list');
		return;
	}
}
?>
