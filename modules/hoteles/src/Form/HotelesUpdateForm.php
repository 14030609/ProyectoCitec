<?php

namespace Drupal\hoteles\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\Html;
use Drupal\hoteles\Dao\HotelesDao;

class HotelesUpdateForm extends FormBase
{

	protected $id;

	function getFormID() {
		return 'bd_hoteles_update';
	}

	function buildForm(array $form, FormStateInterface $form_state, $id = '') {
		$this->id = $id;
		$pregunta = db_query("SELECT * FROM {hoteles} WHERE id = :id", array(':id' => $id))->fetchObject();
		$form['nombre'] = array(
		  '#type' => 'textfield',
		  '#title' => t('Nombre'),
		  '#default_value' => $pregunta->nombre,
		);
		$form['direccion'] = array(
		  '#type' => 'textfield',
		  '#title' => t('Direccion'),
		  '#default_value' => $pregunta->direccion,
		);
        $form['telefono'] = array(
            '#type' => 'textfield',
            '#title' => t('Telefono'),
            '#default_value' => $pregunta->telefono,
        );
        $form['costo'] = array(
            '#type' => 'textfield',
            '#title' => t('Costo'),
            '#default_value' => $pregunta->costo,
        );
        $form['latitud'] = array(
            '#type' => 'textfield',
            '#title' => t('Latitud'),
            '#default_value' => $pregunta->latitud,
        );
        $form['longitud'] = array(
            '#type' => 'textfield',
            '#title' => t('Longitud'),
            '#default_value' => $pregunta->longitud,
        );
		$form['actions'] = array('#type' => 'actions');
		$form['actions']['submit'] = array(
		  '#type' => 'submit',
		  '#value' => t('Guardar'),
		);
		return $form;
	}

	function validateForm(array &$form, FormStateInterface $form_state) {

	    if (strlen($form_state->getValue('nombre')) <= 0) {
            $form_state->setErrorByName('nombre', $this->t('Please enter Nombre'));
        }
        if (strlen($form_state->getValue('direccion')) <= 0) {
            $form_state->setErrorByName('direccion', $this->t('Please enter Direccion'));
        }
        if (strlen($form_state->getValue('telefono')) <= 0) {
            $form_state->setErrorByName('telefono', $this->t('Please enter Telefono'));
        }
        if (strlen($form_state->getValue('costo')) <= 0) {
            $form_state->setErrorByName('costo', $this->t('Please enter Costo'));
        }
        if (strlen($form_state->getValue('latitud')) <= 0) {
            $form_state->setErrorByName('latitud', $this->t('Please enter Latitud'));
        }
        if (strlen($form_state->getValue('longitud')) <= 0) {
            $form_state->setErrorByName('longitud', $this->t('Please enter Longitud'));
        }

    }

	function submitForm(array &$form, FormStateInterface $form_state) {
        $nombre = $form_state->getValue('nombre');
        $direccion = $form_state->getValue('direccion');
        $telefono= $form_state->getValue('telefono');
        $costo = $form_state->getValue('costo');
        $latitud = $form_state->getValue('latitud');
        $longitud = $form_state->getValue('longitud');

        HotelesDao::update($this->id,Html::escape($nombre), Html::escape($direccion), Html::escape($telefono), Html::escape($costo),Html::escape($latitud),Html::escape($longitud));

		drupal_set_message(t('Tu Hotel  ha sido actualizado.'));
		$form_state->setRedirect('hotelesList');
		return;
	}
}