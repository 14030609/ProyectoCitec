<?php

namespace Drupal\talleres\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\Html;
use Drupal\talleres\Dao\TalleresDao;

class TalleresAddForm extends FormBase
{

	function getFormID() {
		return 'bd_talleres_add2';
	}

	function buildForm(array $form, FormStateInterface $form_state, $extra=null) {
		$form['taller'] = array(
                  '#type' => 'textfield',
                  '#title' => t('Taller'),
                );
                $form['presenta'] = array(
                  '#type' => 'textfield',
                  '#title' => t('Presenta'),
                );
                $form['descripcion'] = array(
                  '#type' => 'textfield',
                  '#title' => t('Descripcion'),
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

        $input = $form_state->getUserInput();

        if (isset($input['op']) && $input['op'] === 'Cancel') {
            $form_state->setRedirect('talleresList');
            return;
        }

		$taller = $form_state->getValue('taller');
                $presenta = $form_state->getValue('presenta');
		$descripcion = $form_state->getValue('descripcion');
		TalleresDao::add(Html::escape($taller), Html::escape($presenta), Html::escape($descripcion));

		drupal_set_message(t('Tu taller ha sido agregado.'));
		$form_state->setRedirect('talleresList');
		return;
	}
}
