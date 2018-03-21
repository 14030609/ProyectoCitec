<?php
/**
 * Created by PhpStorm.
 * User: niluxer
 * Date: 3/7/18
 * Time: 20:35
 */

class Hoteles
{
    private $id;
    private $nombre;
    private $direccion;
    private $telefono;
    private $costo;
    private $latitud;
    private $longitud;

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
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $id
     */
    public function setNombre($nombre)
    {
        $this->id = $nombre;
    }

    /**
     * @return mixed
     */
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param mixed $id
     */
    public function setDireccion($direccion)
    {
        $this->id = $direccion;
    }

    /**
     * @return mixed
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param mixed $id
     */
    public function setTelefono($telefono)
    {
        $this->id = $telefono;
    }

    /**
     * @return mixed
     */
    public function getCosto()
    {
        return $this->costo;
    }

    /**
     * @param mixed $id
     */
    public function setCosto($costo)
    {
        $this->id = $costo;
    }

    /**
     * @return mixed
     */
    public function getLatitud()
    {
        return $this->latitud;
    }

    /**
     * @param mixed $id
     */
    public function setLatitud_Longitud($latitud)
    {
        $this->id = $latitud;
    }


    /**
     * @return mixed
     */
    public function getLongitud()
    {
        return $this->longitud;
    }

    /**
     * @param mixed $id
     */
    public function setLongitud($longitud)
    {
        $this->id = $longitud;
    }






}