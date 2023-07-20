<?php

namespace App\Http\Livewire;

use App\Models\Poll;
use Livewire\Component;

class CreatePoll extends Component
{
  public $title;  
  public $options = [''];

  public function updated($propertyName)
  {
    $this->validateOnly($propertyName);
  }

  protected $rules = [
    'title' => 'required|min:3|max:255',
    'options' => 'required|array|min:1|max:10',
    'options.*' => 'required|min:1|max:255'
];

protected $messages = [
    'options.*' => 'The option can\'t be empty.'
];


  // You can use this to initialise values for your properties 
  //if you need something more interesting that basic data 
  // public function mount()
  // {

  // }

  public function removeOption(int $index)
  {
    unset($this->options[$index]);
    $this->options = array_values($this->options);
  }

  public function addOption()
  {
    $this->options[] = '';
  }

  public function createPoll()
  {
    $this->validate();
    Poll::create(
      [
        'title' => $this->title
      ]
      )->options()->createMany(
        collect($this->options)
        ->map(fn($option) => ['name' => $option]))
        ->all();

      $this->reset(['title', 'options']);

      $this->emitTo('polls','pollAdded');
  }
  
  public function render()
    {
        return view('livewire.create-poll');
    }
}
