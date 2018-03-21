<?php

namespace Drupal\hoteles\Form;

use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Url;
use Drupal\Core\Form\FormStateInterface;
use Drupal\hoteles\Dao\HotelesDao;

class HotelesDeleteForm extends ConfirmFormBase {

  protected $id;

  function getFormID() {
    return 'bd_hoteles_delete';
  }

  function getQuestion() {
    return t('¿Seguro de querer eliminar el hotel  con id %id?', array('%id' => $this->id));
  }

  function getConfirmText() {
    return t('Eliminar');
  }

  function getCancelUrl() {
    return new Url('hotelesList');
  }

  function buildForm(array $form, FormStateInterface $form_state, $id = '') {
    $this->id = $id;
    $pregunta = db_query("SELECT * FROM {hoteles} WHERE id = :id", array(':id' => $id))->fetchObject();
    $form['nombre'] = array(
      '#type' => 'textfield',
      '#title' => t('Nombre'),
      '#attributes' => array('readonly' => 'readonly'),
      '#default_value' => $pregunta->nombre,
    );
    $form['direccion'] = array(
      '#type' => 'textfield',
      '#title' => t('Direccion'),
      '#attributes' => array('readonly' => 'readonly'),
      '#default_value' => $pregunta->direccion,
    );
      $form['telefono'] = array(
          '#type' => 'textfield',
          '#title' => t('Telefono'),
          '#attributes' => array('readonly' => 'readonly'),
          '#default_value' => $pregunta->telefono,
      );
      $form['costo'] = array(
          '#type' => 'textfield',
          '#title' => t('Costo'),
          '#attributes' => array('readonly' => 'readonly'),
          '#default_value' => $pregunta->costo,
      );

      $form['latitud'] = array(
          '#type' => 'textfield',
          '#title' => t('Latitud'),
          '#attributes' => array('readonly' => 'readonly'),
          '#default_value' => $pregunta->latitud,
      );
      $form['longitud'] = array(
          '#type' => 'textfield',
          '#title' => t('Longitud'),
          '#attributes' => array('readonly' => 'readonly'),
          '#default_value' => $pregunta->longitud,
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
    HotelesDao::delete($this->id);
    drupal_set_message(t('El hotel  con el  id %id ha sido eliminado.', array('%id' => $this->id)));
    $form_state->setRedirect('hotelesList');
  }
}