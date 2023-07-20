<div>
    @forelse ($polls as $poll)
    <div class="mb-3">
      <h3 class="mb-4 text-lg">
        {{$poll->title}}
      </h3>
      @foreach ($poll->options as $option)
      <div class="mb-2">
        <button class="btn" wire:click="vote({{ $option->id }})">Vote</button>
        {{$option->name}} {{$option->votes->count()}}
      </div>
        
      @endforeach
    </div>
      
    @empty
      <p>No Polls available</p>
    @endforelse
</div>
