<?php

namespace Customer\Support\Crm;

class FileNumber
{
    /**
     * The file number instance.
     *
     * @var string
     */
    protected $number;

    /**
     * Initialize the class with the number parameter.
     *
     * @param string $number
     */
    public function __construct(string $number)
    {
        return $this->number = $number;
    }

    /**
     * Return the number property.
     *
     * @return string
     */
    public function __toString()
    {
        return $this->number;
    }
}
