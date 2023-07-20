<?php

namespace App\Http\Livewire;

use App\Models\Option;
use App\Models\Poll;
use Livewire\Component;

class Polls extends Component
{

  protected $listeners = ['pollAdded' => 'render'];

  private function getPolls()
  {
   return Poll::with('options.votes')->latest()->get();
  }

  public function vote($optionId)
  {
    $option = Option::findOrFail($optionId);
    $option->votes()->create();
  }

    public function render()
    {
        return view('livewire.polls', ['polls' => $this->getPolls()]);
    }
}
