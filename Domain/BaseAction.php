<?php

namespace Domain;

class BaseAction
{
    protected array $data = [];

    public function fromData(array $data)
    {
        $this->data = $data;

        return $this;
    }
}
