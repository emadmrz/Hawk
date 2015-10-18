@extends('profile.layout')

@section('content')

    <div id="skill-carousel" class="carousel slide skill-carousel carousel-fade" data-ride="carousel">

    <div class="skill-panel">
        <div class="title">لیست مهارت ها</div>
        <ul class="skill-list">
            @foreach($skills as $index=>$skill)
                <li data-target="#skill-carousel" data-slide-to="{{ $index }}" class="@if($index == 0) active  current @endif" >
                    <a href="#" >{{ $skill->title }}</a>
                    @if($skill->status == 0)
                        <span class="label label-danger" >غیر قابل ارائه</span>
                    @elseif($skill->status == 1)
                        <span class="label label-success" >قابل ارائه</span>
                    @endif
                </li>
            @endforeach
        </ul>
    </div>

    <div class="text-center skill-carousel-nav">
        <a href="#skill-carousel" role="button" data-slide="next" class="bounceeRight"><i class="fa icon-chevron-right fa-3x" ></i></a>
        <a class="name" href="#"><span>{{ $skills->first()->title }}</span></a>
        <a href="#skill-carousel" role="button" data-slide="prev" class="bounceeLeft"><i class="fa icon-chevron-left fa-3x" ></i></a>
    </div>

    <div class="carousel-inner" role="listbox">

    @foreach($skills as $index=>$skill)

        <div data-index="{{ $index }}" data-title="{{ $skill->title }}" class="item @if($index == 0) active @endif">

        <div class="skill-panel">
            <div class="title">شرح مهارت</div>
            <div class="skill-panel-body">
                {{ $skill->description }}
            </div>
        </div>

        @if(!empty($skill->description))
        <div class="skill-panel">
            <div class="title">ابزارها و وسایل مورد نیاز برای ارائه مهارت</div>
            <div class="skill-panel-body">
                {{ $skill->requirements }}
            </div>
        </div>
        @endif

        @if(count($skill->schedules) or count($skill->areas))
        <div class="skill-panel">
            <div class="title">زمان و مکان ارائه مهارت</div>
            @if(count($skill->schedules))
                <div class="skill-panel-body">
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
                    </table><br>
                </div>
            @endif
            @if(count($skill->areas))
                <div class="skill-panel-body">
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
            @endif
        </div>
        @endif

        @if(count($skill->degrees))
            <div class="skill-panel">
                <div class="title">مدارک و گواهینامه ها</div>
                <div class="skill-panel-body">
                    <div class="show-case clearfix" id="show-case-degrees">
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
            </div>
        @endif

        @if(count($skill->amounts))
            <div class="skill-panel">
                <div class="title">هزینه ارائه مهارت</div>
                <div class="skill-panel-body">
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
            </div>
        @endif

        @if(count($skill->experiences))
            <div class="skill-panel">
                <div class="title">نمونه کارها</div>
                <div class="skill-panel-body">
                    <div class="show-case clearfix" id="show-case-experience">
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
                                            <li class="col-sm-2"  data-value="{{ $experience->id }}" ><a href="{{ asset('img/files/'.$experience->files->first()->name) }}" ><img class="file" src="{{ asset('img/icons/'.$experience->files->first()->extension.'.png' )}}"></a></li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        @if(count($skill->histories))
            <div class="skill-panel fixed-height">
                <div class="title">سوابق کاری</div>
                <div class="skill-panel-body">
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
            </div>
        @endif

        @if(count($skill->papers))
            <div class="skill-panel">
                <div class="title">کتب و مقالات منتشر شده</div>
                <div class="skill-panel-body">
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
            </div>
        @endif

        @if(count($skill->honors))
            <div class="skill-panel">
                <div class="title">افتخارات و جوایز</div>
                <div class="skill-panel-body">
                    <div class="show-case clearfix" id="show-case-honor">
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
            </div>
        @endif


        </div>

    @endforeach

        </div>
    </div>
@endsection

@section('side')
    @include('profile.partials.latestArticles')
    @include('profile.partials.latestPosts')
@endsection