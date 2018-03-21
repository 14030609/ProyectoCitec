<?php

namespace Drupal\conferencias\Controller;

use Drupal\conferencias\Dao\ConferenciasDao;
use Drupal\Core\Url;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Link;
use Drupal\Core\Render\RendererInterface;

class ConferenciasController extends ControllerBase
{

    public function add()
    {
        $extra = '612-123-4567';
        $form = \Drupal::formBuilder()->getForm('Drupal\conferencias\Form\ConferenciasAddForm', $extra);
        return array(
            '#title'   => 'CONFERENCIAS',
            '#type'    => 'markup',
            '#markup'  => RendererInterface::render($form),
        );

    }


    public function lista()
    {
        //$link = Link::fromTextAndUrl('Nuevo', Url::fromRoute('/faq/add'));
        $new_link = "";
        if(\Drupal::currentUser()->hasPermission('conferencias add')
        ) {
            $url = Url::fromRoute('conferenciasAdd');
            $link_options = array(
                'attributes' => array(
                    'class' => array(
                        'btn',
                        'btn-primary',
                    ),
                ),
            );
            $url->setOptions($link_options);
            $new_link = Link::fromTextAndUrl(t('Nuevo'), $url);

            $header = array(
                'id' => t('Id'),
                'titulo' => t('Titulo'),
                'resumen' => t('Resumen'),
                'fecha' => t('Fecha'),
                'lugar' => t('Lugar'),
                'hora' => t('Hora'),
                'conferencista' => t('Conferencista'),
                'curriculum' => t('Curriculum'),
                'eliminar' => t('Eliminar'),
                'actualizar' => t('Actualizar'),
            );

            $rows = array();

            foreach(ConferenciasDao::getAll() as $id=> $content) {
                $url = Url::fromRoute('conferenciasDelete', ['id' => $content->id]);
                $delete_link = \Drupal::l(t('Eliminar'), $url);
                $url = Url::fromRoute('conferenciasUpdate', ['id' => $content->id]);
                $update_link = \Drupal::l(t('Modificar'), $url);
                $rows[] = array(
                    'data' => array($id, $content->titulo, $content->resumen, $content->fecha, $content->lugar, $content->hora, $content->conferencista, $content->curriculum, $delete_link, $update_link)
                );
            }


            $table = array(
                '#type' => 'table',
                '#header' => $header,
                '#rows' => $rows,
                '#attributes' => array(
                    'id' => 'bd-conferencias-table',
                    'class' => array(
                        'table',
                        'table-dark',
                    ),

                ),
            );

            return array(
                '#title'   => 'CONFERENCIAS',
                '#theme'    => 'conferencias_list',
                '#new_conferencias'  => $new_link,
                '#tabla_lista' => \Drupal::service('renderer')->render($table),
            );
        }else{
            $header = array(
                'titulo' => t('Titulo'),
                'resumen' => t('Resumen'),
                'fecha' => t('Fecha'),
                'lugar' => t('Lugar'),
                'hora' => t('Hora'),
                'conferencista' => t('Conferencista'),
                'curriculum' => t('Curriculum'),
            );

            $rows = array();

            foreach(ConferenciasDao::getAll() as $id=> $content) {
                $rows[] = array(
                    'data' => array($content->titulo, $content->resumen, $content->fecha, $content->lugar, $content->hora, $content->conferencista, $content->curriculum)
                );
            }


            $table = array(
                '#type' => 'table',
                '#header' => $header,
                '#rows' => $rows,
                '#attributes' => array(
                    'id' => 'bd-conferencias-table',
                ),
            );

            return array(
                '#title'   => 'CONFERENCIAS',
                '#theme'    => 'conferencias_list',
                '#new_conferencias'  => $new_link,
                '#tabla_lista' => \Drupal::service('renderer')->render($table),
            );
        }

    }

}