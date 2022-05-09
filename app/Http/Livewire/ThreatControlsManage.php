<?php

namespace App\Http\Livewire;

use App\Models\Control;
use App\Models\Threat;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

/**
 * This livewire component is used to manage the controls of a threat, by adding or removing controls of a threat.
 */
class ThreatControlsManage extends Component
{
    use AuthorizesRequests;

    public $threat;
    public $control = "";
    public $searchTerm = "";
    public $controls_search = array();

    public function mount($threat)
    {
        $this->threat = $threat;
    }

    public function clearForm()
    {
        $this->controls_search = array();
        $this->control = "";
    }

    public function render(): Factory|View|Application
    {
        $this->authorize("update", $this->threat);
        $controls = $this->threat->controls();
        if (!empty($this->searchTerm)) {
            $filter = $this->searchTerm;
            $search = Control::whereNotIn("id", $controls->pluck("control_id")->toArray())->
            where(function ($query) use ($filter) {
                $query->where("name", "like", "%" . $filter . "%")->orWhere("description", "like", "%" . $filter . "%");
            })->get();
            if ($search->count() > 0) {
                $this->controls_search = $search;
                $this->control = $search->get(0)->id;
            }
            else {
                $this->clearForm();
            }
        }
        else {
            $this->clearForm();
        }
        return view('livewire.threat-controls-manage', [
                "controls" => $controls->get(),
                "controls_search" => $this->controls_search
            ]
        );
    }

    public function addControl()
    {
        $this->authorize("update", $this->threat);
        $validated = $this->validate([
            "control" => [Rule::exists("controls", "id"), "required"],
        ]);
        $this->threat->controls()->attach($this->control);
        $this->control = "";
        $this->searchTerm = "";
    }

    public function removeControl($id)
    {
        $this->authorize("update", $this->threat);
        $this->threat->controls()->detach($id);
    }
}
