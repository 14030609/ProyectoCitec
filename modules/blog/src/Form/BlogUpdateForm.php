<?php

namespace Drupal\blog\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\Html;
use Drupal\blog\Dao\BlogDao;

class BlogUpdateForm extends FormBase
{

	protected $id;

	function getFormID() {
		return 'bd_blog_update';
	}

	function buildForm(array $form, FormStateInterface $form_state, $id = '') {
		$this->id = $id;
		$pregunta = db_query("SELECT * FROM {blog} WHERE id = :id", array(':id' => $id))->fetchObject();
		$form['titulo'] = array(
		  '#type' => 'textfield',
		  '#title' => t('Titulo'),
		  '#default_value' => $pregunta->titulo,
		);
		$form['descripcion'] = array(
		  '#type' => 'textarea',
		  '#title' => t('Descripcion'),
		  '#default_value' => $pregunta->descripcion,
		);
        $form['fecha'] = array(
            '#type' => 'textfield',
            '#title' => t('Fecha'),
            '#default_value' => $pregunta->fecha,
        );
        $form['foto'] = array(
            '#type' => 'textfield',
            '#title' => t('Foto'),
            '#default_value' => $pregunta->foto,
        );
		$form['actions'] = array('#type' => 'actions');
		$form['actions']['submit'] = array(
		  '#type' => 'submit',
		  '#value' => t('Guardar'),
		);
		return $form;
	}

	function validateForm(array &$form, FormStateInterface $form_state) {

	    if (strlen($form_state->getValue('titulo')) <= 0) {
            $form_state->setErrorByName('titulo', $this->t('Please enter Titulo'));
        }
        if (strlen($form_state->getValue('descripcion')) <= 0) {
            $form_state->setErrorByName('descripcion', $this->t('Please enter Descripcion'));
        }
        if (strlen($form_state->getValue('fecha')) <= 0) {
            $form_state->setErrorByName('fecha', $this->t('Please enter Fecha'));
        }
        if (strlen($form_state->getValue('foto')) <= 0) {
            $form_state->setErrorByName('foto', $this->t('Please enter Foto'));
        }

    }

	function submitForm(array &$form, FormStateInterface $form_state) {
        $titulo = $form_state->getValue('titulo');
        $descripcion = $form_state->getValue('descripcion');
        $fecha= $form_state->getValue('fecha');
        $foto = $form_state->getValue('foto');

        BlogDao::update($this->id,Html::escape($titulo), Html::escape($descripcion), Html::escape($fecha), Html::escape($foto));

		drupal_set_message(t('Tu pregunta ha sido actualizada.'));
		$form_state->setRedirect('blogList');
		return;
	}
}