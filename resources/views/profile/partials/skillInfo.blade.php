<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs">
        <div class="panel-heading panel-heading-gray title">
            ثبت مشخصات عمومی مهارت
        </div>
        <div class="panel-body skill_info_form">
            @if($hasEdit)
                {!! Form::model($skill, ['route'=>['profile.skill.update', $skill->id], 'method'=>'put', 'class'=>' panel-view form-horizontal']) !!}
            @else
                {!! Form::open(['route'=>'profile.skill.add', 'method'=>'post', 'class'=>' panel-view form-horizontal']) !!}
            @endif

            <div class="col-md-12">
                <div class="form-group panel-form">
                    {!! Form::label('title', 'عنوان مهارت : ', ['class'=>'control-label pull-right']) !!}
                    <div class="col-sm-6 pull-right">
                        {!! Form::text('title', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group panel-form">
                    {!! Form::label('my_rate', 'سطح مهارت : ', ['class'=>'control-label pull-right']) !!}
                    <div class="col-sm-3 pull-right">
                        {!! Form::select('my_rate', $my_rate, null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-12 pull-right">
                <div class="form-group panel-form">
                    {!! Form::label('category_id', 'دسته بندی سطح اول : ', ['class'=>'control-label pull-right']) !!}
                    <div class="col-sm-4 pull-right">
                        {!! Form::select('category_id', $categories, null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-12 pull-right">
                <div class="form-group panel-form">
                    {!! Form::label('sub_category_id', 'دسته بندی سطح دوم : ', ['class'=>'control-label pull-right']) !!}
                    <div class="col-sm-4 pull-right">
                        {!! Form::select('sub_category_id', $sub_categories, null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-12 pull-right">
                <div class="form-group panel-form">
                    {!! Form::label('status', 'وضعیت ارائه مهارت : ', ['class'=>'control-label pull-right']) !!}
                    <div class="col-sm-2 pull-right">
                        {!! Form::select('status', $statuses, null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group panel-form">
                    {!! Form::textarea('description', null, ['class'=>'form-control', 'placeholder'=>'شرح مهارت را به طور کامل برای بازدیدکنندگان بیان نمایید.']) !!}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group panel-form">
                    {!! Form::textarea('requirements', null, ['class'=>'form-control', 'placeholder'=>'امکانات و ابزارهای مورد نیاز برای ارائه مهارت خود را به طور کامل وارد نمایید.']) !!}
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    {!! Form::select('tags_list[]', $all_tags, null, ['class'=>'form-control', 'id'=>'select_tags', 'multiple'=>'multiple', 'dir'=>'rtl']) !!}
                </div>
            </div>

            <input type="submit" class="btn btn-success" value="ذخیره و ادامه به مرحله بعد">&ensp;

                @if($hasEdit)
                    <a class="btn btn-default" href="{{ route('profile.skill.edit.step2', ['skill'=>$skill->id]) }}">عدم ذخیره و ادامه به مرحله بعد</a>
                @endif

            {!! Form::close() !!}

        </div>
        <div class="panel-footer info">
            <i class="fa icon-information" ></i> در این بخش شما می توانید اطلاعات اولیه مهارت، وضعیت ارائه مهارت و برچسب های مرتبط با مهارت را برای جستجوی بهتر وارد نمایید.
        </div>
    </div>
</div>