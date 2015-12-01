@foreach($user->skills as $skill)
<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs" id="collapseListGroupHeading{{ $skill->id }}" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroup{{ $skill->id }}" aria-expanded="true" aria-controls="collapseListGroup{{ $skill->id }}">{{ $skill->title }}
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
            <div class="skill-rate ltr" style="position: absolute; left:50px; top: 12px" data-id="1" data-rating="2.2"></div>
        </div>

        <div class="collapse in" id="collapseListGroup{{ $skill->id }}" aria-labelledby="collapseListGroupHeading{{ $skill->id }}" aria-expanded="true">
            <div class="panel-body">
                <div class="skills-tab">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#home{{ $skill->id }}" aria-controls="home{{ $skill->id }}" role="tab" data-toggle="tab">مهارت</a></li>
                        <li role="presentation"><a href="#messages{{ $skill->id }}" aria-controls="messages{{ $skill->id }}" role="tab" data-toggle="tab">زمان و مکان ارائه</a></li>

                        @if(count($skill->degrees))
                        <li role="presentation"><a href="#settings{{ $skill->id }}" aria-controls="settings{{ $skill->id }}" role="tab" data-toggle="tab">مدارک و گواهینامه ها</a></li>
                        @endif

                        <li role="presentation"><a href="#amount{{ $skill->id }}" aria-controls="amount{{ $skill->id }}" role="tab" data-toggle="tab">قیمت</a></li>

                        @if(count($skill->experiences))
                        <li role="presentation"><a href="#gallery{{ $skill->id }}" aria-controls="gallery{{ $skill->id }}" role="tab" data-toggle="tab">نمونه کارها </a></li>
                        @endif

                        @if(count($skill->histories))
                        <li role="presentation"><a href="#history{{ $skill->id }}" aria-controls="history{{ $skill->id }}" role="tab" data-toggle="tab">سوابق</a></li>
                        @endif

                        <li role="presentation"><a href="#papers{{ $skill->id }}" aria-controls="papers{{ $skill->id }}" role="tab" data-toggle="tab">کتب و مقالات</a></li>

                        @if(count($skill->honors))
                        <li role="presentation"><a href="#honors{{ $skill->id }}" aria-controls="honors{{ $skill->id }}" role="tab" data-toggle="tab">افتخارات و جوایز</a></li>
                        @endif

                        @if(count($skill->galleries))
                            <li role="presentation"><a href="#portfolio{{ $skill->id }}" aria-controls="portfolio{{ $skill->id }}" role="tab" data-toggle="tab">گالری تصاویر</a></li>
                        @endif

                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="home{{ $skill->id }}">
                            <div class="text-content">{{ $skill->description }}</div>
                            @if(!empty($skill->requirements))
                                <hr>
                                <div class="text-content">
                                    <h5>وسایل و تجهیزات مورد نیاز : </h5>
                                    {{ $skill->requirements }}
                                </div>
                            @endif
                        </div>
                        <div role="tabpanel" class="tab-pane" id="messages{{ $skill->id }}">
                            <table class="table table-striped table-bordered schedule-table">
                                <thead>
                                <tr>
                                    <th width="10%" >روز هفته</th>
                                    <th width="90%" >
                                        برای مشاهده ساعات ارائه خدمات بر روی هر مورد کلیک نمایید.
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <th>شنبه</th>
                                    <td>
                                        @foreach($skill->schedules as $schedule)
                                            @if($schedule->week_day == 1)
                                                <div class="alert alert-success" style="width: {{ $schedule->schedule_table['width'] }}% ; position: absolute ; right: {{ $schedule->schedule_table['margin'] }}%" role="alert" data-toggle="tooltip" data-placement="top" title="{{ $schedule->start_time }} - {{ $schedule->end_time }}  {{ $schedule->title  }}"  >&ensp;</div>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>یکشنبه</th>
                                    <td>
                                        @foreach($skill->schedules as $schedule)
                                            @if($schedule->week_day == 2)
                                                <div class="alert alert-success" style="width: {{ $schedule->schedule_table['width'] }}% ; position: absolute ; right: {{ $schedule->schedule_table['margin'] }}%" role="alert" data-toggle="tooltip" data-placement="top" title="{{ $schedule->start_time }} - {{ $schedule->end_time }}  {{ $schedule->title  }}"  >&ensp;</div>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>دوشنبه</th>
                                    <td>
                                        @foreach($skill->schedules as $schedule)
                                            @if($schedule->week_day == 3)
                                                <div class="alert alert-success" style="width: {{ $schedule->schedule_table['width'] }}% ; position: absolute ; right: {{ $schedule->schedule_table['margin'] }}%" role="alert" data-toggle="tooltip" data-placement="top" title="{{ $schedule->start_time }} - {{ $schedule->end_time }}  {{ $schedule->title  }}"  >&ensp;</div>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>سه شنبه</th>
                                    <td>
                                        @foreach($skill->schedules as $schedule)
                                            @if($schedule->week_day == 4)
                                                <div class="alert alert-success" style="width: {{ $schedule->schedule_table['width'] }}% ; position: absolute ; right: {{ $schedule->schedule_table['margin'] }}%" role="alert" data-toggle="tooltip" data-placement="top" title="{{ $schedule->start_time }} - {{ $schedule->end_time }}  {{ $schedule->title  }}"  >&ensp;</div>
                                            @endif
                                        @endforeach                                    </td>
                                </tr>
                                <tr>
                                    <th>چهارشنبه</th>
                                    <td>
                                        @foreach($skill->schedules as $schedule)
                                            @if($schedule->week_day == 5)
                                                <div class="alert alert-success" style="width: {{ $schedule->schedule_table['width'] }}% ; position: absolute ; right: {{ $schedule->schedule_table['margin'] }}%" role="alert" data-toggle="tooltip" data-placement="top" title="{{ $schedule->start_time }} - {{ $schedule->end_time }}  {{ $schedule->title  }}"  >&ensp;</div>
                                            @endif
                                        @endforeach                                    </td>
                                </tr>
                                <tr>
                                    <th>پنجشنبه</th>
                                    <td>
                                        @foreach($skill->schedules as $schedule)
                                            @if($schedule->week_day == 6)
                                                <div class="alert alert-success" style="width: {{ $schedule->schedule_table['width'] }}% ; position: absolute ; right: {{ $schedule->schedule_table['margin'] }}%" role="alert" data-toggle="tooltip" data-placement="top" title="{{ $schedule->start_time }} - {{ $schedule->end_time }}  {{ $schedule->title  }}"  >&ensp;</div>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <th>جمعه</th>
                                    <td>
                                        @foreach($skill->schedules as $schedule)
                                            @if($schedule->week_day == 7)
                                                <div class="alert alert-success" style="width: {{ $schedule->schedule_table['width'] }}% ; position: absolute ; right: {{ $schedule->schedule_table['margin'] }}%" role="alert" data-toggle="tooltip" data-placement="top" title="{{ $schedule->start_time }} - {{ $schedule->end_time }}  {{ $schedule->title  }}"  >&ensp;</div>
                                            @endif
                                        @endforeach
                                    </td>
                                </tr>
                                </tbody>
                            </table><hr>
                            <table class="table table-bordered  table-striped">
                                <thead>
                                    <tr>
                                       <th class="text-right" >استان ارائه مهارت</th>
                                       <th class="text-right" >شهر ارائه مهارت</th>
                                       <th class="text-right">توضیحات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($skill->areas as $area)
                                    <tr>
                                        <td width="25%">{{ $area->city->getRoot()->name }}</td>
                                        <td width="25%">{{ $area->city->name }}</td>
                                        <td width="50%">{{ $area->description }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if(count($skill->degrees))
                        <div role="tabpanel" class="tab-pane" id="settings{{ $skill->id }}">

                            <div class="show-case" id="show-case-degrees">
                                <div class="col-sm-4 pull-right">
                                    <div class="image">
                                        <img data-toggle="magnify" src="{{ asset('/img/files/'.$skill->degrees->first()->files->first()->name ) }}">
                                        <div class="title clearfix">
                                            <div class="pull-right name">{{ $skill->degrees->first()->title }}</div>
                                        </div>
                                    </div>
                                    <div class="popularity">
                                        <div class="pull-left like">
                                            <a href="#" id="like" data-type="1" data-value="{{ $skill->degrees->first()->id }}" ><span id="num" > {{ $skill->degrees->first()->num_like }} </span><i class="fa fa-thumbs-o-up fa-lg"></i></a>
                                            <a href="#" id="dislike" data-type="-1" data-value="{{ $skill->degrees->first()->id }}" ><i class="fa fa-thumbs-o-down fa-lg"></i><span id="num" > {{ $skill->degrees->first()->num_dislike }} </span></a>
                                        </div>
                                        <a id="view_item" href="{{ asset('img/files/'.$skill->degrees->first()->files->first()->name) }}" target="_blank" class="view-file btn btn-default btn-sm pull-right"><i class="fa fa-file-image-o" ></i> مشاهده فایل </a>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="info">
                                        <h3 id="license_name" >{{ $skill->degrees->first()->title }}</h3><hr>
                                        <div id="properties_list">
                                            <p> صادر کننده : {{ $skill->degrees->first()->creator }}</p>
                                            <p>تاریخ اخذ مدرک : {{ $skill->degrees->first()->get_date }}</p>
                                            <p>مدت اعتبار : {{ $skill->degrees->first()->expiration_date }}</p>
                                            <p>{{ $skill->degrees->first()->description }}</p>
                                        </div>
                                    </div>
                                    <div class="license-list">
                                        <h4>لیست مدارک و گواهی نامه ها : </h4>
                                        <ul class="row" id="item_list">
                                            @foreach($skill->degrees as $degree)
                                                @if($degree->files->first()->extension == 'image')
                                                    <li class="col-sm-3" data-value="{{ $degree->id }}" ><a href="{{ asset('img/files/'.$degree->files->first()->name )}}" ><img src="{{ asset('img/files/'.$degree->files->first()->name )}}"></a></li>
                                                @else
                                                    <li class="col-sm-2" data-value="{{ $degree->id }}" ><a href="{{ asset('img/files/'.$degree->files->first()->name) }}" ><img class="file" src="{{ asset('img/icons/'.$degree->files->first()->extension.'.png' )}}"></a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endif

                        <div role="tabpanel" class="tab-pane" id="amount{{ $skill->id }}">

                            <table class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th width="30%" class="text-right" >عنوان</th>
                                    <th width="15%" class="text-right">قیمت</th>
                                    <th width="10%" class="text-right">واحد پولی</th>
                                    <th width="10%" class="text-right">به ازای هر</th>
                                    <th width="15%" class="text-right" >واحد شمارش</th>
                                    <th width="30%" class="text-right">توضیحات</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($skill->amounts as $amount)
                                    <tr>
                                        <td>{{ $skill->title }}</td>
                                        <td>{{ $amount->price_value }}</td>
                                        <td>{{ $amount->unit_name }}</td>
                                        <td>{{ $amount->price_per }}</td>
                                        <td>{{ $amount->per_unit_name }}</td>
                                        <td>{{ $amount->description }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>

                        @if(count($skill->experiences))
                        <div role="tabpanel" class="tab-pane" id="gallery{{ $skill->id }}">
                            <div class="show-case" id="show-case-experience">
                                <div class="col-sm-4 pull-right">
                                    <div class="image">
                                        <img data-toggle="magnify" src="{{ asset('/img/files/'.$skill->experiences->first()->files->first()->name ) }}">
                                        <div class="title clearfix">
                                            <div class="pull-right name">{{ $skill->experiences->first()->title }}</div>
                                        </div>
                                    </div>
                                    <div class="popularity">
                                        <div class="pull-left like">
                                            <a href="#" id="like" data-type="1" data-value="{{ $skill->experiences->first()->id }}" ><span id="num" > {{ $skill->experiences->first()->num_like }} </span><i class="fa fa-thumbs-o-up fa-lg"></i></a>
                                            <a href="#" id="dislike" data-type="-1" data-value="{{ $skill->experiences->first()->id }}" ><i class="fa fa-thumbs-o-down fa-lg"></i><span id="num" > {{ $skill->experiences->first()->num_dislike }} </span></a>
                                        </div>
                                        <a id="view_item" href="{{ asset('img/files/'.$skill->experiences->first()->files->first()->name) }}" target="_blank" class="view-file btn btn-default btn-sm pull-right"><i class="fa fa-file-image-o" ></i> مشاهده فایل </a>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="info">
                                        <h3 id="license_name" >{{ $skill->experiences->first()->title }}</h3><hr>
                                        <div id="properties_list">
                                            <p>{{ $skill->experiences->first()->description }}</p>
                                        </div>
                                    </div>
                                    <div class="license-list">
                                        <h4> لیست نمونه کارها : </h4>
                                        <ul class="row" id="item_list">
                                            @foreach($skill->experiences as $experience)
                                                @if($experience->files->first()->extension == 'image')
                                                    <li class="col-sm-3" data-value="{{ $experience->id }}" ><a href="{{ asset('img/files/'.$experience->files->first()->name )}}" ><img src="{{ asset('img/files/'.$experience->files->first()->name )}}"></a></li>
                                                @else
                                                    <li class="col-sm-3"  data-value="{{ $experience->id }}" ><a class="file" href="{{ asset('img/files/'.$experience->files->first()->name) }}" ><img class="file" src="{{ asset('img/icons/'.$experience->files->first()->extension.'.png' )}}"></a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif

                        @if(count($skill->histories))
                        <div role="tabpanel" class="tab-pane" id="history{{ $skill->id }}">
                            <div class="timeline-content">
                                <ul class="timeline">
                                    <?php $alignment = 'timeline-inverted'; ?>
                                    @foreach($skill->histories as $history)

                                        <li class="{{ $alignment }}">
                                            <div class="timeline-badge info"><i class="glyphicon glyphicon-briefcase"></i></div>
                                            <div class="timeline-panel">
                                                <div class="timeline-heading">
                                                    <h4 class="timeline-title">{{ $history->title }}</h4>
                                                    <p><small class="text-muted"><i class="glyphicon glyphicon-time"></i>&ensp;  از سال {{ $history->start_year }} تا سال {{ $history->end_year }} </small></p>
                                                </div>
                                                @if(count($history->files)>0)
                                                    <div class="timeline-image">
                                                        <img src="{{ asset('img/files/'.$history->files->first()->name) }}">
                                                    </div>
                                                @endif
                                                <div class="timeline-body">
                                                    <p>{{ $history->description }}</p>
                                                    <p>{{ $history->email }}</p>
                                                    <p>{{ $history->phone }}</p>
                                                    <p>{{ $history->address }}</p>
                                                </div>
                                            </div>
                                        </li>
                                        <?php if($alignment == '') $alignment = 'timeline-inverted'; else $alignment = ''; ?>

                                    @endforeach


                                </ul>
                            </div>
                        </div>
                        @endif

                        <div role="tabpanel" class="tab-pane" id="papers{{ $skill->id }}">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th width="40%" class="text-right" >عنوان</th>
                                        <th width="20%" class="text-right">نوع</th>
                                        <th width="20%" class="text-right" >سال نشر</th>
                                        <th width="30%" class="text-right">ناشر</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($skill->papers as $paper)
                                        <tr>
                                            <td>{{ $paper->title }}</td>
                                            <td>{{ $paper->type_name }}</td>
                                            <td>{{ $paper->publish_year }}</td>
                                            <td>{{ $paper->publisher }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        @if(count($skill->honors))
                        <div role="tabpanel" class="tab-pane" id="honors{{ $skill->id }}">

                            <div class="show-case" id="show-case-honor">
                                <div class="col-sm-4 pull-right">
                                    <div class="image">
                                        <img data-toggle="magnify" src="{{ asset('/img/files/'.$skill->honors->first()->files->first()->name ) }}">
                                        <div class="title clearfix">
                                            <div class="pull-right name">{{ $skill->honors->first()->title }}</div>
                                        </div>
                                    </div>
                                    <div class="popularity">
                                        <div class="pull-left like">
                                            <a href="#" id="like" data-type="1" data-value="{{ $skill->honors->first()->id }}" ><span id="num" > {{ $skill->honors->first()->num_like }} </span><i class="fa fa-thumbs-o-up fa-lg"></i></a>
                                            <a href="#" id="dislike" data-type="-1" data-value="{{ $skill->honors->first()->id }}" ><i class="fa fa-thumbs-o-down fa-lg"></i><span id="num" > {{ $skill->honors->first()->num_dislike }} </span></a>
                                        </div>
                                        <a id="view_item" target="_blank" href="{{ asset('img/files/'.$skill->honors->first()->files->first()->name) }}" class="view-file btn btn-default btn-sm pull-right"><i class="fa fa-file-image-o" ></i> مشاهده فایل </a>
                                    </div>
                                </div>
                                <div class="col-sm-8">
                                    <div class="info">
                                        <h3 id="license_name" >{{ $skill->honors->first()->title }}</h3><hr>
                                        <div id="properties_list">
                                            <p>{{ $skill->honors->first()->description }}</p>
                                        </div>
                                    </div>
                                    <div class="license-list">
                                        <h4> لیست نمونه کارها : </h4>
                                        <ul class="row" id="item_list">
                                            @foreach($skill->honors as $honor)
                                                @if($honor->files->first()->extension == 'image')
                                                    <li class="col-sm-3" data-value="{{ $honor->id }}" ><a href="{{ asset('img/files/'.$honor->files->first()->name )}}" ><img src="{{ asset('img/files/'.$honor->files->first()->name )}}"></a></li>
                                                @else
                                                    <li class="col-sm-2" data-value="{{ $honor->id }}" ><a href="{{ asset('img/files/'.$honor->files->first()->name) }}" ><img class="file" src="{{ asset('img/icons/'.$honor->files->first()->extension.'.png' )}}"></a></li>
                                                @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>

                        </div>
                        @endif

                        @if(count($skill->galleries))
                            <div role="tabpanel" class="tab-pane" id="portfolio{{ $skill->id }}">

                                <div class="skill-gallery">

                                    @foreach($skill->galleries as $gallery)
                                    <div class="col-sm-4 pull-right">
                                        <div class="image">
                                            <a href="{{ asset('img/files/'.$gallery->files->first()->name) }}" target="_blank" ><img class="img-responsive" src="{{ asset('img/files/'.$gallery->files->first()->name) }}"></a>
                                            <div class="title">{{ $gallery->title }}</div>
                                        </div>
                                    </div>
                                    @endforeach

                                </div>

                            </div>
                        @endif


                    </div>

                </div>
            </div>
        </div>
        <div class="panel-footer">
            {!! Form::open(['route'=>['profile.skill.endorse.store', $skill->id], 'method'=>'post', 'style'=>'display:inline-block', 'data-remote-multiple']) !!}
            <button type="submit" class="btn btn-violet btn-sm"><i class="fa fa-check fa-lg" ></i> تایید مهارت </button>
            {!! Form::close() !!}
            <a href="{{route('home.corporation.create',[$user->id,$skill->id])}}" class="btn btn-success btn-sm"><img src="{{ asset('img/icons/handshake.png') }}" > دست دادن </a>
            <button id="open_recommendation" class="btn btn-info btn-sm" ><i class="fa fa-pencil fa-lg" ></i> افزودن توصیه نامه </button>
            @if($skill->status == 0)
                <span class="btn btn-danger btn-xs pull-left skill-status">غیر قابل ارائه </span>
            @else
                <span class="btn btn-success btn-xs pull-left skill-status">قابل ارائه</span>
            @endif
            {!! Form::open(['route'=>['profile.skill.recommendation.store', $skill->id], 'method'=>'post', 'id'=>'add_recommendation_form']) !!}
                <div class="recommendation-form">
                    <div class="media">
                        <div class="media-right">
                            <a href="#">
                                <img class="media-object" src="{{ asset('img/persons/'.Auth::user()->avatar) }}" alt="...">
                            </a>
                        </div>
                        <div class="media-body">
                            <textarea name="text" placeholder=" شما هم می توانید مهارت این کاربر را به دیگران پیشنهاد دهید. "></textarea>
                            <button type="submit" class="btn btn-default btn-sm" ><i class="fa fa-pencil fa-lg" ></i> ارسال توصیه نامه </button>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>

    <div class="endorse-person" id="endorse_persons">
    @if(count($skill->endorses))
        <ul>
            @foreach($skill->endorses as $endorse)
            <li><img data-toggle="tooltip" data-placement="bottom" title="{{ $endorse->user->username}} " src="{{ asset('img/persons/'.$endorse->user->avatar) }}" class="img-circle"  ></li>
            @endforeach
        </ul>
    @endif
    </div>

    @if(count($skill->recommendations))
    <div class="recommendation">
        <div class='row'>
            <div class='col-sm-12'>
                <div class="carousel slide quote-carousel" data-ride="carousel" id="quote-carousel{{ $skill->id }}">

                    @if(count($skill->recommendations)>1 )
                    <!-- Bottom Carousel Indicators -->
                    <ol class="carousel-indicators">
                        @foreach($skill->recommendations as $index=>$recommendation)
                        <li data-target="#quote-carousel{{ $skill->id }}" data-slide-to="{{ $index }}" class="@if($index == 0) active @endif"></li>
                        @endforeach
                    </ol>
                    @endif

                    <!-- Carousel Slides / Quotes -->
                    <div class="carousel-inner">
                        @foreach($skill->recommendations as $index=>$recommendation)
                        <!-- Quote 1 -->
                        <div class="item @if($index == 0) active @endif">
                            <blockquote>
                                <div class="row">
                                    <div class="col-sm-2 text-center pull-right">
                                        <img class="img-circle" src="{{ asset('img/persons/'.$recommendation->user->avatar) }}" style="width: 100px;height:100px;">                                                        </div>
                                    <div class="col-sm-10 pull-right">
                                        <p>{{ $recommendation->text }}</p>
                                        <small>{{ $recommendation->user->first_name }} {{ $recommendation->user->last_name }}</small>
                                    </div>
                                </div>
                            </blockquote>
                        </div>
                        @endforeach

                    </div>

                    <!-- Carousel Buttons Next/Prev -->
                    <a data-slide="prev" href="#quote-carousel{{ $skill->id }}" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
                    <a data-slide="next" href="#quote-carousel{{ $skill->id }}" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>
@endforeach