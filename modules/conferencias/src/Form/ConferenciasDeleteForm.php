<?php

namespace Drupal\conferencias\Form;

use Drupal\Core\Form\ConfirmFormBase;
use Drupal\Core\Url;
use Drupal\Core\Form\FormStateInterface;
use Drupal\conferencias\Dao\ConferenciasDao;

class ConferenciasDeleteForm extends ConfirmFormBase {

    protected $id;

    function getFormID() {
        return 'bd_conferencias_delete';
    }

    function getQuestion() {
        return t('¿Seguro de querer eliminar registro con id %id?', array('%id' => $this->id));
    }

    function getConfirmText() {
        return t('Eliminar');
    }

    function getCancelUrl() {
        return new Url('conferenciasList');
    }

    function buildForm(array $form, FormStateInterface $form_state, $id = '') {
        $this->id = $id;
        $pregunta = db_query("SELECT * FROM {conferencias} WHERE id = :id", array(':id' => $id))->fetchObject();
        $form['titulo'] = array(
            '#type' => 'textfield',
            '#title' => t('Titulo'),
            '#attributes' => array('readonly' => 'readonly'),
            '#default_value' => $pregunta->titulo,
        );
        $form['resumen'] = array(
            '#type' => 'textarea',
            '#title' => t('Resumen'),
            '#attributes' => array('readonly' => 'readonly'),
            '#default_value' => $pregunta->resumen,
        );
        $form['fecha'] = array(
            '#type' => 'date',
            '#title' => t('Fecha'),
            '#attributes' => array('readonly' => 'readonly'),
            '#default_value' => $pregunta->fecha,
        );
        $form['lugar'] = array(
            '#type' => 'textfield',
            '#title' => t('Lugar'),
            '#attributes' => array('readonly' => 'readonly'),
            '#default_value' => $pregunta->lugar,
        );
        $form['hora'] = array(
            '#type' => 'textfield',
            '#title' => t('Hora'),
            '#attributes' => array('readonly' => 'readonly'),
            '#default_value' => $pregunta->hora,
        );
        $form['conferencista'] = array(
            '#type' => 'textfield',
            '#title' => t('Conferencista'),
            '#attributes' => array('readonly' => 'readonly'),
            '#default_value' => $pregunta->conferencista,
        );
        $form['curriculum'] = array(
            '#type' => 'textarea',
            '#title' => t('Curriculum'),
            '#attributes' => array('readonly' => 'readonly'),
            '#default_value' => $pregunta->curriculum,
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
        ConferenciasDao::delete($this->id);
        drupal_set_message(t('Registro con id %id ha sido eliminado.', array('%id' => $this->id)));
        $form_state->setRedirect('conferenciasList');
    }
}