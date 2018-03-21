<?php
/**
 * Created by PhpStorm.
 * User: niluxer
 * Date: 3/7/18
 * Time: 20:35
 */

class Blog
{
    private $id;
    private $titulo;
    private $descripcion;
    private $fecha;
    private $foto;

    /**
     * FaqDao constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $question
     */
    public function setTitulo($titulo)
    {
        $this->question = $titulo;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $answare
     */
    public function setDescripcion($descripcion)
    {
        $this->answare = $descripcion;
    }
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $answare
     */
    public function setFecha($fecha)
    {
        $this->answare = $fecha;
    }
    public function getFoto()
    {
        return $this->foto;
    }

    /**
     * @param mixed $answare
     */
    public function setFoto($foto)
    {
        $this->answare = $foto;
    }






}