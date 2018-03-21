<?php

namespace Drupal\blog\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\Html;
use Drupal\blog\Dao\BlogDao;

class BlogAddForm extends FormBase
{

	function getFormID() {
		return 'bd_blog_add2';
	}

	function buildForm(array $form, FormStateInterface $form_state, $extra=null) {
		$form['titulo'] = array(
		  '#type' => 'textfield',
		  '#title' => t('   Titulo'),
		  //'#value' => $extra,
		);
		$form['descripcion'] = array(
		  '#type' => 'textarea',
		  '#title' => t('Descripcion'),
		);
        $form['fecha'] = array(
            '#type' => 'textfield',
            '#title' => t('Fecha'),
        );
        $form['foto'] = array(
            '#type' => 'textfield',
            '#title' => t('Foto'),
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

        if (strlen($form_state->getValue('titulo')) <= 0) {
            $form_state->setErrorByName('titulo', $this->t('Please enter titulo'));
        }
        if (strlen($form_state->getValue('descripcion')) <= 0) {
            $form_state->setErrorByName('descripcion', $this->t('Please enter descripcion'));
        }
        if (strlen($form_state->getValue('fecha')) <= 0) {
            $form_state->setErrorByName('fecha', $this->t('Please enter fecha'));
        }
        if (strlen($form_state->getValue('foto')) <= 0) {
            $form_state->setErrorByName('foto', $this->t('Please enter foto'));
        }

	}

	function submitForm(array &$form, FormStateInterface $form_state) {

        $input = $form_state->getUserInput();

        if (isset($input['op']) && $input['op'] === 'Cancel') {
            $form_state->setRedirect('blogList');
            return;
        }

		$titulo = $form_state->getValue('titulo');
		$descripcion = $form_state->getValue('descripcion');
        $fecha= $form_state->getValue('fecha');
        $foto = $form_state->getValue('foto');

		BlogDao::add(Html::escape($titulo), Html::escape($descripcion), Html::escape($fecha), Html::escape($foto));

		drupal_set_message(t('El Blog  ha sido agregado.'));
		$form_state->setRedirect('blogList');
		return;
	}
}