<?php

namespace App\Traits;

trait Searchable {
    public string $search = '';
    public string $sort;
    public string $order = 'ASC';
    public array $sortables;

    public function setSortables(array $sortables): void
    {
        $this->sortables = $sortables;
        $this->sort = $sortables[0];
    }


    public function changeOrder(): void
    {
       $this->order = $this->order === 'ASC' ? 'DESC' : 'ASC';
    }
}
