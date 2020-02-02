<?php

namespace Core\Application\Service\Contracts;

interface Exportable
{
    /**
     * Export a resource or resources to a human-readable
     * format. E.g. PDF, Spreadsheet, CSV, etc.
     *
     * @param  string $format
     * @return mixed
     */
    public function export(string $format);
}
