<?php

namespace App\Http\Livewire;

use App\Models\Control;
use App\Models\Threat;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class ThreatControlsManage extends Component
{
    use AuthorizesRequests;
    public $threat;
    public $control;

    public function mount($threat)
    {
        $this->threat = $threat;
    }

    public function render(): Factory|View|Application
    {
        $this->authorize("update", $this->threat);
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
        $this->authorize("update", $this->threat);
        if (!empty($this->control)) {
            $this->threat->controls()->attach($this->control);
            $this->control = null;
        }
    }

    public function removeControl($id)
    {
        $this->authorize("update", $this->threat);
        $this->threat->controls()->detach($id);
    }
}
