<?php

namespace Drupal\conferencias\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Component\Utility\Html;
use Drupal\conferencias\Dao\ConferenciasDao;

class ConferenciasAddForm extends FormBase
{

    function getFormID() {
        return 'bd_conferencias_add2';
    }

    function buildForm(array $form, FormStateInterface $form_state, $extra=null) {
        $form['titulo'] = array(
            '#type' => 'textfield',
            '#title' => t('Titulo'),
            //'#value' => $extra,
        );
        $form['resumen'] = array(
            '#type' => 'textarea',
            '#title' => t('Resumen'),
        );
        $form['fecha'] = array(
            '#type' => 'date',
            '#title' => t('Fecha'),
            //'#value' => $extra,
        );
        $form['lugar'] = array(
            '#type' => 'textfield',
            '#title' => t('Lugar'),
        );
        $form['hora'] = array(
            '#type' => 'textfield',
            '#placeholder'=>'hh:mm:ss',
            //'#date_date_element' => 'none',
            //'#date_time_element' => 'text',
            '#title' => t('Hora'),
            //'#min'=>'07:00:00',
            //'#max' => '20:30:00',
        );
        $form['conferencista'] = array(
            '#type' => 'textfield',
            '#title' => t('Conferencista'),
        );
        $form['curriculum'] = array(
            '#type' => 'textarea',
            '#title' => t('Curriculum'),
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
            $form_state->setErrorByName('titulo', $this->t('Por favor ingreza un titulo'));
        }
        if (strlen($form_state->getValue('resumen')) <= 0) {
            $form_state->setErrorByName('resumen', $this->t('Por favor ingreza un resumen'));
        }
        if (strlen($form_state->getValue('fecha')) <= 0) {
            $form_state->setErrorByName('fecha', $this->t('Por favor ingreza una fecha'));
        }
        if (strlen($form_state->getValue('lugar')) <= 0) {
            $form_state->setErrorByName('lugar', $this->t('Por favor ingreza un lugar'));
        }
        if (strlen($form_state->getValue('hora')) <= 0) {
            $form_state->setErrorByName('hora', $this->t('Por favor ingreza una hora'));
        }
        if (strlen($form_state->getValue('conferencista')) <= 0) {
            $form_state->setErrorByName('conferencista', $this->t('Por favor ingreza un conferencista'));
        }
        if (strlen($form_state->getValue('curriculum')) <= 0) {
            $form_state->setErrorByName('curriculum', $this->t('Por favor ingreza un curriculum'));
        }

    }

    function submitForm(array &$form, FormStateInterface $form_state) {

        $input = $form_state->getUserInput();

        if (isset($input['op']) && $input['op'] === 'Cancel') {
            $form_state->setRedirect('conferenciasList');
            return;
        }

        $titulo = $form_state->getValue('titulo');
        $resumen = $form_state->getValue('resumen');
        $fecha = $form_state->getValue('fecha');
        $lugar = $form_state->getValue('lugar');
        $hora = $form_state->getValue('hora');
        $conferencista = $form_state->getValue('conferencista');
        $curriculum = $form_state->getValue('curriculum');
        ConferenciasDao::add(Html::escape($titulo), Html::escape($resumen), Html::escape($fecha), Html::escape($lugar), Html::escape($hora), Html::escape($conferencista), Html::escape($curriculum));

        drupal_set_message(t('Tu conferencia ha sido agregada.'));
        $form_state->setRedirect('conferenciasList');
        return;
    }
}