@section('content')
    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
                جستجو دوستان
            </div>
            <div class="panel-body" id="friendship_list">
                <div class="list-item-image">



                    <ul class="">

                            <li>
                                <div class="media">
                                    <div class="media-right">

                                    </div>
                                    <div class="media-body">
                                        <div class="media-heading">


                                        </div>
                                        <div class="actions">
                                            {!! Form::open(['route'=>'profile.friends.search.results']) !!}
                                            <div class="col-sm-12 pull-right">
                                                <div class="col-sm-6 pull-right">
                                                    <div class="form-group">
                                                        <label class="col- control-label pull-right" >ایمیل :</label>
                                                        <div class="col-sm-8 pull-right">
                                                            {!! Form::text('email',null,['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 pull-right">
                                                    <div class="form-group">
                                                        <label class="col- control-label pull-right" >شماره موبایل :</label>
                                                        <div class="col-sm-8 pull-right">
                                                            {!! Form::text('cell_phone',null,['class'=>'form-control']) !!}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <h3><button style="margin: 10px"; class="btn btn-default btn-sm pull-right">جستجو در سایت</button></h3>
                                            {!! Form::close() !!}


                                            <h3><a href="{{route('profile.friend.find')}}" style="margin: 10px"; class="btn btn-default btn-sm pull-right">پیشنهاد سایت</a></h3>

                                        </div>
                                    </div>
                                </div>
                            </li>

                    </ul>
                </div>
            </div>
            <div class="panel-footer text-footer ">
                <i class="fa icon-information fa-lg" ></i>
                درخواست های دوستی خود را مدیریت کنید و دوستان جدید برای خود پیدا نمایید.
            </div>
        </div>
    </div>
@endsection