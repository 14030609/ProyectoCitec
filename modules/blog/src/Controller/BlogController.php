<?php

namespace Drupal\blog\Controller;

use Drupal\blog\Dao\BlogDao;
use Drupal\Core\Url;
use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Database\Database;
use Drupal\Core\Link;
use Drupal\Core\Render\RendererInterface;


class BlogController extends ControllerBase
{

  public function add()
  {
    $extra = '612-123-4567';
    $form = \Drupal::formBuilder()->getForm('Drupal\blog\Form\BlogAddForm', $extra);
    return array(
      '#title'   => 'BLOG',
      '#type'    => 'markup',
      '#markup'  => RendererInterface::render($form),
    );

  }


  public function lista()
  {
    //$link = Link::fromTextAndUrl('Nuevo', Url::fromRoute('/faq/add'));
    $new_link = "";
    if(\Drupal::currentUser()->hasPermission('blog add')
) {
      $url = Url::fromRoute('blogAdd');
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

    }

    $header = array(
      'id' => t('Id'),
      'titulo' => t('Titulo'),
      'descripcion' => t('Descripcion'),
      'fecha' => t('Fecha'),
      'foto' => t('Foto'),
      'eliminar' => t('Eliminar'),
      'actualizar' => t('Actualizar'),
    );
    
    $rows = array();
    
    foreach(BlogDao::getAll() as $id=> $content) {
      $url = Url::fromRoute('blogDelete', ['id' => $content->id]);
      $delete_link = \Drupal::l(t('Eliminar'), $url);
      $url = Url::fromRoute('blogUpdate', ['id' => $content->id]);
      $update_link = \Drupal::l(t('Modificar'), $url);
      $rows[] = array(
        'data' => array($id, $content->titulo, $content->descripcion, $content->fecha, $content->foto, $delete_link, $update_link)
      );
    }


    $table = array(
      '#type' => 'table',
      '#header' => $header,
      '#rows' => $rows,
      '#attributes' => array(
        'id' => 'bd-blog-table',
          'class'
      ),
    );

    return array(
      '#title'   => 'BLOG',
      '#theme'    => 'blog_list',
      '#new_blog'  => $new_link,
      '#tabla_lista' => \Drupal::service('renderer')->render($table),
    );
  }

  public function lista2()
  {
    //$link = Link::fromTextAndUrl('Nuevo', Url::fromRoute('/faq/add'));
    $new_link = "";
    if(\Drupal::currentUser()->hasPermission('blog add')
) {
      $url = Url::fromRoute('blogAdd');
      $new_link = \Drupal::l(t('Nuevo'), $url);
    }
    
    //$data = FaqDao::getAll();
    //$data = db_query('select * from {faq}')->fetchAll();
    $conn = Database::getConnection();
    $data = $conn->query('select * from {blog}')->fetchAll();

    return array(
      '#title'   => 'BLOG',
      '#theme'    => 'blog_list2',
      '#tabla_lista' => $data,
    );
  }


}