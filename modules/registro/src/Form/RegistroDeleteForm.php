<?php

namespace Drupal\registro\Form;

use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Url;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Database\Database;

class RegistroDeleteForm extends ConfirmFormBase {

  protected $id;

  function getFormID() {
    return 'bd_registro_delete';
  }

  function getQuestion() {
    return t('¿Seguro de querer eliminar registro con id %id?', array('%id' => $this->id));
  }

  function getConfirmText() {
    return t('Eliminar');
  }

  function getCancelUrl() {
    return new Url('registro-list');
  }

  function buildForm(array $form, FormStateInterface $form_state, $id = '') {
    $this->id = $id;
    $query = db_query("SELECT * FROM {participante} WHERE id = :id", array(':id' => $id))->fetchObject();
    $form['nombre'] = array(
      '#type' => 'textfield',
      '#title' => t('Nombre'),
      '#attributes' => array('readonly' => 'readonly'),
      '#default_value' => $query->nombre,
    );
    $form['actions'] = array('#type' => 'actions');
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Eliminar'),
    );
    return parent::buildForm($form, $form_state);
    //return $form;
  }

  function submitForm(array &$form, FormStateInterface $form_state) {

      $conn = Database::getConnection();
      $conn->delete('participante')->condition('id',$this->id,'=')->execute();
    drupal_set_message(t('Registro con id %id ha sido eliminado.', array('%id' => $this->id)));
    $form_state->setRedirect('registro-list');
  }
}