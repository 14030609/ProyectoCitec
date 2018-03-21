<?php
/**
 * Created by PhpStorm.
 * User: antony
 * Date: 3/17/18
 * Time: 20:35
 */

class Talleres
{
    private $id;
    private $taller;
    private $presenta;
    private $descripcion;

    /**
     * TalleresDao constructor.
     */
    public function __construct()
    {
    }

    /**
     * @return mielsd
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
    public function getTaller()
    {
        return $this->taller;
    }

    /**
     * @param mixed $taller
     */
    public function setTaller($taller)
    {
        $this->taller = $taller;
    }

    /**
     * @return mixed
     */
    public function getPresenta()
    {
        return $this->presenta;
    }

    /**
     * @param mixed $presenta
     */
    public function setPresenta($presenta)
    {
        $this->presenta = $presenta;
    }

    /**
     * @return mixed
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param mixed $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
}
