<?php

namespace Drupal\talleres\Dao;

use Drupal\Core\Database\Database;

class TalleresDao {

	static function getAll()
	{
        $conn = Database::getConnection();
        $result = $conn->query('select * from {talleres}')->fetchAllAssoc('id');

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
        $result = $conn->query('SELECT 1 FROM {talleres} WHERE id = :id', array(':id' => $id))->fetchField();

        //$result = db_query('SELECT 1 FROM {faq} WHERE id = :id', array(':id' => $id))->fetchField();
        return (bool) $result;
    }

    static function add($taller,$presenta,$descripcion) {
        $conn = Database::getConnection();
        $conn->insert('talleres')->fields(
            array(
                'taller'=> $taller,
                'presenta'=> $presenta,
                'descripcion'=> $descripcion,
            )
        )->execute();

    }

    static function update($id, $taller, $presenta, $descripcion) {
        $conn = Database::getConnection();
        $conn->update('talleres')->fields(
            array(
                'taller' => $taller,
                'presenta' => $presenta,
                'descripcion' => $descripcion,
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
        $conn->delete('talleres')->condition('id', $id, '=')->execute();

    }

}
