<div id="Sticky_container">
    @foreach($stickies as $sticky)
        <div class="sticky-note" style="left: {{ $sticky->position_left }}%; top: {{ $sticky->position_top }}%">
            <textarea name="body" data-id="{{ $sticky->id }}" class="sticky">{{ $sticky->body }}</textarea>
            <button class="save"><i class="fa fa-save fa-lg"></i> </button>
            <button class="delete"><i class="fa fa-trash-o fa-lg"></i> </button>
        </div>;
    @endforeach
</div>