<?php

namespace Drupal\talleres\Form;

use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Url;
use Drupal\Core\Form\FormStateInterface;
use Drupal\talleres\Dao\TalleresDao;

class TalleresDeleteForm extends ConfirmFormBase {

  protected $id;

  function getFormID() {
    return 'bd_talleres_delete';
  }

  function getQuestion() {
    return t('¿Seguro de querer eliminar registro con id %id?', array('%id' => $this->id));
  }

  function getConfirmText() {
    return t('Eliminar');
  }

  function getCancelUrl() {
    return new Url('faqList');
  }

  function buildForm(array $form, FormStateInterface $form_state, $id = '') {
    $this->id = $id;
    $pregunta = db_query("SELECT * FROM {talleres} WHERE id = :id", array(':id' => $id))->fetchObject();
    $form['taller'] = array(
      '#type' => 'textfield',
      '#title' => t('Taller'),
      '#attributes' => array('readonly' => 'readonly'),
      '#default_value' => $pregunta->taller,
    );
    $form['presenta'] = array(
      '#type' => 'textarea',
      '#title' => t('Presenta'),
      '#attributes' => array('readonly' => 'readonly'),
      '#default_value' => $pregunta->presenta,
    );
    $form['descripcion'] = array(
      '#type' => 'textfield',
      '#title' => t('Descripcion'),
      '#attributes' => array('readonly' => 'readonly'),
      '#default_value' => $pregunta->descripcion,
    );
    /*$form['actions'] = array('#type' => 'actions');
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Eliminar'),
    );*/
    return parent::buildForm($form, $form_state);
    //return $form;
  }

  function submitForm(array &$form, FormStateInterface $form_state) {
    TalleresDao::delete($this->id);
    drupal_set_message(t('Registro con id %id ha sido eliminado.', array('%id' => $this->id)));
    $form_state->setRedirect('talleresList');
  }
}
