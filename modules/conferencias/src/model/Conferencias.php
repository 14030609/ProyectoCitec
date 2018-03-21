<?php
/**
 * Created by PhpStorm.
 * User: niluxer
 * Date: 3/7/18
 * Time: 20:35
 */

class Conferencias
{
    private $id;
    private $titulo;
    private $resumen;
    private $fecha;
    private $lugar;
    private $hora;
    private $conferencista;
    private $curriculum;

    /**
     * ConferenciasDao constructor.
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
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getResumen()
    {
        return $this->resumen;
    }

    /**
     * @param mixed $resumen
     */
    public function setResumen($resumen)
    {
        $this->resumen = $resumen;
    }

    /**
     * @return mixed
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;
    }

    /**
     * @return mixed
     */
    public function getLugar()
    {
        return $this->lugar;
    }

    /**
     * @param mixed $lugar
     */
    public function setLugar($lugar)
    {
        $this->lugar = $lugar;
    }

    /**
     * @return mixed
     */
    public function getHora()
    {
        return $this->hora;
    }

    /**
     * @param mixed $hora
     */
    public function setHora($hora)
    {
        $this->hora = $hora;
    }

    /**
     * @return mixed
     */
    public function getConferencista()
    {
        return $this->conferencista;
    }

    /**
     * @param mixed $conferencista
     */
    public function setConferencista($conferencista)
    {
        $this->conferencista = $conferencista;
    }

    /**
     * @return mixed
     */
    public function getCurriculum()
    {
        return $this->curriculum;
    }

    /**
     * @param mixed $curriculum
     */
    public function setCurriculum($curriculum)
    {
        $this->curriculum = $curriculum;
    }

}