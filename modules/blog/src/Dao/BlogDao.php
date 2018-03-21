<?php

namespace Drupal\blog\Dao;

use Drupal\Core\Database\Database;

class BlogDao {

	static function getAll()
	{
        $conn = Database::getConnection();
        $result = $conn->query('select * from {blog}')->fetchAllAssoc('id');

		return $result;
	}

    /*static function getOne()
    {
        //$conn = Database::getConnection();
        //$result = $conn->query('select * from {faq}')->fe
        $result = db_query('select * from {faq}')->fetchAllAssoc('id');
        return $result;
    }*/

    static function exists($id) {
        $conn = Database::getConnection();
        $result = $conn->query('SELECT 1 FROM {blog} WHERE id = :id', array(':id' => $id))->fetchField();

        //$result = db_query('SELECT 1 FROM {faq} WHERE id = :id', array(':id' => $id))->fetchField();
        return (bool) $result;
    }

    static function add($titulo, $descripcion,$fecha,$foto) {
        $conn = Database::getConnection();
        $conn->insert('blog')->fields(
            array(
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'fecha' => $fecha,
                'foto' => $foto,

            )
        )->execute();

    }

    static function update($id, $titulo, $descripcion,$fecha,$foto) {
        $conn = Database::getConnection();
        $conn->update('blog')->fields(
            array(
                'titulo' => $titulo,
                'descripcion' => $descripcion,
                'fecha' => $fecha,
                'foto' => $foto,
            )
        )->condition('id', $id, '=')->execute();
        /*db_update('faq')
        ->fields(array(
          'question' => $question,
          'answare' => $answare,
        ))
        ->condition('id', $id, '=')
        ->execute();*/
    }

    static function delete($id) {
        //db_delete('faq')->condition('id', $id)->execute();
        $conn = Database::getConnection();
        $conn->delete('blog')->condition('id', $id, '=')->execute();

    }

}