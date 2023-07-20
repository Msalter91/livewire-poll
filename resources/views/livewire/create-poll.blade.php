<div>
    <form wire:submit.prevent="createPoll">
      <label>Poll Title</label>
      <input type="text" wire:model="title">
      @error('title')
      <div class="text-red-500">{{$message}}</div>
      @enderror
      <div class="mb-4">
        <button class="btn" wire:click.prevent="addOption">Add Option</button>
      </div>
      <div class="mb-5 mt-5">
        @foreach ($options as $index => $option)
        <div class="mb-2">
          <label>Option {{$index +1}}</label>
          <div class="flex gap-2">
            <input type="text"  wire:model="options.{{$index}}"/>
            @error("options.{$index}")
            <div class="text-red-500">{{ $message }}</div>
          @enderror
            <button class="btn" wire:click.prevent="removeOption({{$index}})">Remove Option</button>
          </div>
        </div>
        @endforeach
      </div>
      <button class="btn" type="submit">Create Poll</button>
    </form>
</div>
