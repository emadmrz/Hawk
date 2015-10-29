<div class="adv">
    <div class="row">

        @foreach($shop->commercials()->get() as $commercial)
            <div class="col-sm-4">
                <div class="item">
                    <a href="{{ $commercial->url }}">
                    <img src="{{ asset('img/files/shop/'.$commercial->file->name) }}">
                    <div class="info">{{ $commercial->title }}</div>
                    </a>
                </div>
            </div>
        @endforeach

    </div>
</div>