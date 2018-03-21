<?php
namespace Drupal\registro\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class RegistroListForm extends FormBase {
  
  public function getFormId() {

    return 'bd_faq_list';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {

    $sql = "select * from {faq}";
    $rs = db_query($sql)->fetchAll();

    $header = array(
      'question' => t('Pregunta'),
      'answare' => t('Descripcion'),
    );
    $options = array();
    foreach ($rs as $faq) {
      $options[$faq->id] = array(
        'question' => $faq->question,
        'answare' => $faq->answare,
      );
    }
    $form['table'] = array(
      '#type' => 'tableselect',
      '#header' => $header,
      '#options' => $options,
      '#empty' => t('No questions found'),
      '#weight' => 0,
      '#multiple' => false,
    );

    $form['submit'] = array(
      '#type' => 'submit',
      '#value' => t('Delete'),
    );
    return $form;
  }

  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    $selected = $form_state->getValue("table");

    $form_state->setRedirect('faqDelete', ['id'=>$selected]);
    
  }
}