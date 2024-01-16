<?php

namespace App\Livewire;

use Livewire\Component;

class PastResultsChart extends Component
{
    public $numberOfYears = 3;
    public $averages = [];
    public $years = [];

    public function mount()
    {
        $this->getAverages();
    }

    public function lastYears()
    {
        if (auth()->user()->events()->where('status', 'ended')->get()->count() == 0) {
            return;
        }
        $latestYear = auth()->user()->events()->orderBy('date', 'DESC')->where('status', 'ended')->first()->date->format('Y');
        for ($i = 0; $i <= $this->numberOfYears; $i++) {
            $year = $latestYear - $i;
            if (auth()->user()->events()->whereYear('date', $year)->where('status', 'ended')->get()->count() > 0) {
                $this->years[] = $year;
            }
        }
        $this->years = array_reverse($this->years);
    }

    public function getAverages()
    {
        $yearAverages = [];
        $this->lastYears();
        foreach ($this->years as $year) {
            foreach (auth()->user()->events()->whereYear('date', $year)->where('status', 'ended')->get() as $event) {
                $yearAverages[] = $event->summaries()->avg('score') / 100 * 20;
            }
            $this->averages[] = array_sum($yearAverages)/count($yearAverages);
            $yearAverages = [];
        }
    }

    public function render()
    {
        return view('livewire.past-results-chart');
    }
}
