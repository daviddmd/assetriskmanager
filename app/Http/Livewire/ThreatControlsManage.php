<?php

namespace App\Http\Livewire;

use App\Models\Control;
use App\Models\Threat;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class ThreatControlsManage extends Component
{
    public $threat;
    public $control;

    public function mount($threat)
    {
        $this->threat = $threat;
    }

    public function render(): Factory|View|Application
    {
        $controls = $this->threat->controls();
        $all_controls = Control::whereNotIn("id", $controls->pluck("control_id")->toArray())->get();
        return view('livewire.threat-controls-manage', [
                "controls" => $controls->get(),
                "all_controls" => $all_controls
            ]
        );
    }

    public function addControl()
    {
        if (!empty($this->control)) {
            $this->threat->controls()->attach($this->control);
            $this->control = null;
        }
    }

    public function removeControl($id)
    {
        $this->threat->controls()->detach($id);
    }
}
