<?php

namespace Drupal\hoteles\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\Html;
use Drupal\hoteles\Dao\HotelesDao;

class HotelesAddForm extends FormBase
{

	function getFormID() {
		return 'bd_hoteles_add2';
	}

	function buildForm(array $form, FormStateInterface $form_state, $extra=null) {
		$form['nombre'] = array(
		  '#type' => 'textfield',
		  '#title' => t('   Nombre'),
		  //'#value' => $extra,
		);
		$form['direccion'] = array(
		  '#type' => 'textfield',
		  '#title' => t('Direccion'),
		);
        $form['telefono'] = array(
            '#type' => 'textfield',
            '#title' => t('Telefono'),
        );
        $form['costo'] = array(
            '#type' => 'textfield',
            '#title' => t('Costo'),
        );
        $form['latitud'] = array(
            '#type' => 'textfield',
            '#title' => t('Latitud'),
        );
        $form['longitud'] = array(
            '#type' => 'textfield',
            '#title' => t('Longitud'),
        );
		$form['actions'] = array('#type' => 'actions');
		$form['actions']['submit'] = array(
		  '#type' => 'submit',
		  '#value' => t('Agregar'),
		);
		$form['actions']['cancel'] = array(
		  '#type' => 'submit',
		  '#value' => t('Cancel'),
		);
		return $form;
	}

	function validateForm(array &$form, FormStateInterface $form_state) {

        $input = $form_state->getUserInput();

        if (isset($input['op']) && $input['op'] === 'Cancel') {
            return;
        }

        if (strlen($form_state->getValue('nombre')) <= 0) {
            $form_state->setErrorByName('nombre', $this->t('Please enter nombre'));
        }
        if (strlen($form_state->getValue('direccion')) <= 0) {
            $form_state->setErrorByName('direccion', $this->t('Please enter direccion'));
        }
        if (strlen($form_state->getValue('telefono')) <= 0) {
            $form_state->setErrorByName('telefono', $this->t('Please enter telefono'));
        }
        if (strlen($form_state->getValue('costo')) <= 0) {
            $form_state->setErrorByName('costo', $this->t('Please enter costo'));
        }

        if (strlen($form_state->getValue('latitud')) <= 0) {
            $form_state->setErrorByName('latitud', $this->t('Please enter latitud'));
        }
        if (strlen($form_state->getValue('longitud')) <= 0) {
            $form_state->setErrorByName('longitud', $this->t('Please enter longitud'));
        }

	}

	function submitForm(array &$form, FormStateInterface $form_state) {

        $input = $form_state->getUserInput();

        if (isset($input['op']) && $input['op'] === 'Cancel') {
            $form_state->setRedirect('hotelesList');
            return;
        }

		$nombre = $form_state->getValue('nombre');
		$direccion = $form_state->getValue('direccion');
        $telefono= $form_state->getValue('telefono');
        $costo = $form_state->getValue('costo');
        $latitud = $form_state->getValue('latitud');
        $longitud = $form_state->getValue('longitud');

		HotelesDao::add(Html::escape($nombre), Html::escape($direccion), Html::escape($telefono), Html::escape($costo),Html::escape($latitud),Html::escape($costo),Html::escape($longitud));

		drupal_set_message(t('El Hoteles  ha sido agregado.'));
		$form_state->setRedirect('hotelesList');
		return;
	}
}