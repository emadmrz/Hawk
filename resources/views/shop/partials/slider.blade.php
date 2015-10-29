<div class="slider">
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            @foreach($shop->files()->get() as $key=>$file)
                <li data-target="#carousel-example-generic" data-slide-to="{{ $key }}" class="@if($key==0) active @endif"></li>
            @endforeach
        </ol>

        <!-- Wrapper for slides -->
        <div class="carousel-inner" role="listbox">

            @foreach($shop->files()->get() as $key=>$file)
                <div class="item @if($key==0) active @endif">
                    <img src="{{ asset('img/files/shop/'.$file->name) }}" alt="...">
                    <div class="carousel-caption">
                        <!--caption if exist-->
                    </div>
                </div>
            @endforeach

        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</div>