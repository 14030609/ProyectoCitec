<?php

namespace Drupal\blog\Form;

use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Url;
use Drupal\Core\Form\FormStateInterface;
use Drupal\blog\Dao\BlogDao;

class BlogDeleteForm extends ConfirmFormBase {

  protected $id;

  function getFormID() {
    return 'bd_blog_delete';
  }

  function getQuestion() {
    return t('¿Seguro de querer eliminar registro con id %id?', array('%id' => $this->id));
  }

  function getConfirmText() {
    return t('Eliminar');
  }

  function getCancelUrl() {
    return new Url('blogList');
  }

  function buildForm(array $form, FormStateInterface $form_state, $id = '') {
    $this->id = $id;
    $pregunta = db_query("SELECT * FROM {blog} WHERE id = :id", array(':id' => $id))->fetchObject();
    $form['titulo'] = array(
      '#type' => 'textfield',
      '#title' => t('Titulo'),
      '#attributes' => array('readonly' => 'readonly'),
      '#default_value' => $pregunta->titulo,
    );
    $form['descripcion'] = array(
      '#type' => 'textarea',
      '#title' => t('Descripcion'),
      '#attributes' => array('readonly' => 'readonly'),
      '#default_value' => $pregunta->descripcion,
    );
      $form['fecha'] = array(
          '#type' => 'textfield',
          '#title' => t('Fecha'),
          '#attributes' => array('readonly' => 'readonly'),
          '#default_value' => $pregunta->fecha,
      );
      $form['foto'] = array(
          '#type' => 'textfield',
          '#title' => t('Foto'),
          '#attributes' => array('readonly' => 'readonly'),
          '#default_value' => $pregunta->foto,
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
    BlogDao::delete($this->id);
    drupal_set_message(t('Registro con id %id ha sido eliminado.', array('%id' => $this->id)));
    $form_state->setRedirect('blogList');
  }
}