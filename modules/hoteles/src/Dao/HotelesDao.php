<?php

namespace Drupal\hoteles\Dao;

use Drupal\Core\Database\Database;

class HotelesDao {

	static function getAll()
	{
        $conn = Database::getConnection();
        $result = $conn->query('select * from {hoteles}')->fetchAllAssoc('id');

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
        $result = $conn->query('SELECT 1 FROM {hoteles} WHERE id = :id', array(':id' => $id))->fetchField();

        //$result = db_query('SELECT 1 FROM {faq} WHERE id = :id', array(':id' => $id))->fetchField();
        return (bool) $result;
    }

    static function add($nombre, $direccion,$telefono,$costo,$latitud,$longitud) {
        $conn = Database::getConnection();
        $conn->insert('hoteles')->fields(
            array(
                'nombre' => $nombre,
                'direccion' => $direccion,
                'telefono' => $telefono,
                'costo' => $costo,
                'latitud' => $latitud,
                'longitud'=>$longitud,

            )
        )->execute();

    }

    static function update($id, $nombre, $direccion,$telefono,$costo,$latitud,$longitud) {
        $conn = Database::getConnection();
        $conn->update('hoteles')->fields(
            array(
                'nombre' => $nombre,
                'direccion' => $direccion,
                'telefono' => $telefono,
                'costo' => $costo,
                'latitud' => $latitud,
                'longitud'=>$longitud,

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
        $conn->delete('hoteles')->condition('id', $id, '=')->execute();

    }

}