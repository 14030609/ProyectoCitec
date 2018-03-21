<?php

namespace Drupal\talleres\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\Html;
use Drupal\talleres\Dao\TalleresDao;

class TalleresUpdateForm extends FormBase
{

	protected $id;

	function getFormID() {
		return 'bd_talleres_update';
	}

	function buildForm(array $form, FormStateInterface $form_state, $id = '') {
		$this->id = $id;
		$pregunta = db_query("SELECT * FROM {talleres} WHERE id = :id", array(':id' => $id))->fetchObject();
		$form['taller'] = array(
		  '#type' => 'textfield',
		  '#title' => t('Taller'),
		  '#default_value' => $pregunta->taller,
		);
		$form['presenta'] = array(
		  '#type' => 'textarea',
		  '#title' => t('Presenta'),
		  '#default_value' => $pregunta->presenta,
		);
                $form['descripcion'] = array(
                  '#type' => 'textarea',
                  '#title' => t('Descripcion'),
                  '#default_value' => $pregunta->descripcion,
                );

		$form['actions'] = array('#type' => 'actions');
		$form['actions']['submit'] = array(
		  '#type' => 'submit',
		  '#value' => t('Guardar'),
		);
		return $form;
	}

	function validateForm(array &$form, FormStateInterface $form_state) {

	    if (strlen($form_state->getValue('taller')) <= 0) {
              $form_state->setErrorByName('taller', $this->t('Please enter taller'));
            }
            if (strlen($form_state->getValue('presenta')) <= 0) {
              $form_state->setErrorByName('presenta', $this->t('Please enter presenta'));
            }
            if (strlen($form_state->getValue('descripcion')) <= 0) {
              $form_state->setErrorByName('descripcion', $this->t('Please enter descripcion'));
            }
        }

	function submitForm(array &$form, FormStateInterface $form_state) {
		$taller = $form_state->getValue('taller');
		$presenta = $form_state->getValue('presenta');
                $descripcion = $form_state->getValue('descripcion');
		TalleresDao::update($this->id, Html::escape($taller), Html::escape($presenta), Html::escape($descripcion));

		drupal_set_message(t('Tu taler ha sido actualizado.'));
		$form_state->setRedirect('talleresList');
		return;
	}
}
