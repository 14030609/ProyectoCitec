<?php

namespace Drupal\hoteles\Controller;

use Drupal\hoteles\Dao\HotelesDao;
use Drupal\Core\Url;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Link;
use Drupal\Core\Render\RendererInterface;

class HotelesController extends ControllerBase
{

  public function add()
  {
    $extra = '612-123-4567';
    $form = \Drupal::formBuilder()->getForm('Drupal\hoteles\Form\HotelesAddForm', $extra);
    return array(
      '#title'   => 'HOTELES',
      '#type'    => 'markup',
      '#markup'  => RendererInterface::render($form),
    );

  }


  public function lista()
  {
    //$link = Link::fromTextAndUrl('Nuevo', Url::fromRoute('/faq/add'));
    $new_link = "";
    if(\Drupal::currentUser()->hasPermission('hoteles add')
) {
      $url = Url::fromRoute('hotelesAdd');
      $link_options = array(
        'attributes' => array(
            'class' => array(
                'btn',
                'btn-success',
            ),
        ),
      );
      $url->setOptions($link_options);
      $new_link = Link::fromTextAndUrl(t('Nuevo'), $url);

        $rows = array();

        foreach(HotelesDao::getAll() as $id=> $content) {
            $url = Url::fromRoute('hotelesDelete', ['id' => $content->id]);
            $delete_link = \Drupal::l(t('Eliminar'), $url);
            $url = Url::fromRoute('hotelesUpdate', ['id' => $content->id]);
            $update_link = \Drupal::l(t('Modificar'), $url);
            $rows[] = array(
                'data' => array($id, $content->nombre, $content->direccion, $content->telefono, $content->costo,$content->latitud,$content->longitud, $delete_link, $update_link)
            );
        }

        $header = array(
            'id' => t('Id'),
            'nombre' => t('Nombre'),
            'direccion' => t('Direccion'),
            'telefono' => t('Telefono'),
            'costo' => t('Costo'),
            'latitud' => t('Latitud'),
            'longitud' => t('Longitud'),
            'eliminar' => t('Eliminar'),
            'actualizar' => t('Actualizar'),
        );


    }else
    {
        $rows = array();

        foreach(HotelesDao::getAll() as $id=> $content) {
            $rows[] = array(
                'data' => array($id, $content->nombre, $content->direccion, $content->telefono, $content->costo,$content->latitud,$content->longitud)
            );
        }

        $header = array(
            'id' => t('Id'),
            'nombre' => t('Nombre'),
            'direccion' => t('Direccion'),
            'telefono' => t('Telefono'),
            'costo' => t('Costo'),
            'latitud' => t('Latitud'),
            'longitud' => t('Longitud'),
        );


    }



      $table = array(
          '#type' => 'table',
          '#header' => $header,
          '#rows' => $rows,
          '#attributes' => array(
              'id' => 'bd-hoteles-table',
              'class'=>array(
                  'table',
                  'table-success',
              ),
          ),
      );


      return array(
      '#title'   => 'HOTELES',
      '#theme'    => 'hoteles_list',
      '#new_hoteles'  => $new_link,
      '#tabla_lista' => \Drupal::service('renderer')->render($table),
    );
  }

  public function lista2()
  {
    //$link = Link::fromTextAndUrl('Nuevo', Url::fromRoute('/faq/add'));
    $new_link = "";
    if(\Drupal::currentUser()->hasPermission('hoteles add')
) {
      $url = Url::fromRoute('hotelesAdd');
      $new_link = \Drupal::l(t('Nuevo'), $url);
    }
    
    //$data = FaqDao::getAll();
    //$data = db_query('select * from {faq}')->fetchAll();
    $conn = Database::getConnection();
    $data = $conn->query('select * from {hoteles}')->fetchAll();

    return array(
      '#title'   => 'HOTELES',
      '#theme'    => 'hoteles_list2',
      '#tabla_lista' => $data,
    );
  }


}