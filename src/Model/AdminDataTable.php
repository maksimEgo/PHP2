<?php

namespace src\Model;

class AdminDataTable
{
    private array $models;
    private array $functions;

    public function __construct(array $models, array $functions)
    {
        $this->models = $models;
        $this->functions = $functions;
    }

    public function render(): array
    {
        $tableData = [];

        foreach ($this->models as $model) {
            $rowData = [];
            foreach ($this->functions as $function) {
                $rowData[] = $function($model);
            }
            $tableData[] = $rowData;
        }

        return $tableData;
    }
}