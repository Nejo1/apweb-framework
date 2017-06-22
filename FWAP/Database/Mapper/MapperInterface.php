<?php

/**
 * Created by PhpStorm.
 * User: artphotografie
 * Date: 13/05/17
 * Time: 10:43
 */
namespace FWAP\Database\Mapper;

interface MapperInterface
{
    public function findById($id);
    public function find($critera="");
    public function insert($entity);
    public function update($entity);
    public function findeletedById($entity);

}