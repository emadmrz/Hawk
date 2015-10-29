<div class="header-menu">

    <div class="row">
        <div class="col-sm-3 pull-right">
            <div class="logo"><img src="{{ asset('img/files/shop/'.$shop->logo) }}"></div>
        </div>
        <div class="col-sm-9">
            <div class="shop-properties">

                @foreach($advantages_list as $advantage)
                    <div class="col-md-2">
                        <div class="property-item @if(!in_array($advantage->id,$advantages)) disable  @endif"><i class="fa {{ $advantage->logo }} fa-2x"></i>
                            {{ $advantage->title }}
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>

    <div class="menu">
        <ul>
            <li class="{{ (strpos(URL::current(),route('home.shop.index', $shop->id)) !== false) ? 'active' : '' }}" ><a href="{{ route('home.shop.index', $shop->id) }}" ><i class="fa icon-home-1 fa-lg" ></i></a></li>
            <li class="dropdown">
                <a id="header_menu_products_list" href="#" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-caret-down" ></i> محصولات </a>
                <ul class="dropdown-menu" aria-labelledby="header_menu_products_list">
                    @foreach($categories as $key=>$category)
                        <li><a href="{{  route('home.shop.products', ['shop'=>$shop->id, 'category_id' => $key]) }}" > {{ $category }} </a></li>
                    @endforeach
                </ul>
            </li>
            <li><a href="#" >گالری تصاویر</a></li>
            <li class="{{ (strpos(URL::current(),route('home.shop.aboutus', $shop->id)) !== false) ? 'active' : '' }}" ><a href="{{ route('home.shop.aboutus', $shop->id) }}" >درباره ما</a></li>
            <li class="{{ (strpos(URL::current(),route('home.shop.contactus', $shop->id)) !== false) ? 'active' : '' }}" ><a href="{{ route('home.shop.contactus', $shop->id) }}" >ارتباط با ما</a></li>
            <div class="pull-left search-box">
                {!! Form::open(['route'=>['home.shop.products', $shop->id], 'method'=>'get']) !!}
                <input type="text" name="keyword" class="glass-input" placeholder="جستجو در فروشگاه ...">
                <button type="submit" class="glass-input"><i class="fa fa-search" ></i></button>
                {!! Form::close() !!}
            </div>
        </ul>
    </div>

</div>