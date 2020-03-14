<?php

class Cast
{

    private $name;
    private $alias;
    private $image;

    public function __construct($name, $alias, $image)
    {
        $this->name = $name;
        $this->alias = $alias;
        $this->image = $image;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getAlias()
    {
        return $this->alias;
    }

    public function getImage()
    {
        return $this->image;
    }
}
