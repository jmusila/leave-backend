<?php

namespace Domain;

class BaseAction
{
    private array $data = [];

    public function fromData(array $data)
    {
        $this->data = $data;

        return $this;
    }
}
