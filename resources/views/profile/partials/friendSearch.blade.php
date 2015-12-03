    <div class="timeline-block">
        <div class="panel panel-default share clearfix-xs">
            <div class="panel-heading panel-heading-gray title">
یافتن دوستان جدید
            </div>
            <div class="panel-body" id="friendship_list">

                {!! Form::open(['route'=>'profile.friends.search.results', 'class'=>'form-horizontal']) !!}

                        <div class="form-group">
                            <label class="col-sm-2 control-label pull-right" >ایمیل :</label>
                            <div class="col-sm-4 pull-right  panel-form">
                                {!! Form::text('email',null,['class'=>'form-control']) !!}
                                <i class="input-icon fa fa-search"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-sm-2 control-label pull-right" >شماره موبایل :</label>
                            <div class="col-sm-4 pull-right  panel-form">
                                {!! Form::text('cell_phone',null,['class'=>'form-control']) !!}
                                <i class="input-icon fa fa-search"></i>
                            </div>
                        </div>

                        <button class="btn btn-default btn-sm pull-right">جستجو در سایت</button>

                {!! Form::close() !!}

            </div>
            <div class="panel-footer text-footer ">
                <i class="fa icon-information fa-lg" ></i>
                درخواست های دوستی خود را مدیریت کنید و دوستان جدید برای خود پیدا نمایید.
            </div>
        </div>
    </div>