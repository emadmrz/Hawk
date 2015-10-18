<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs"  id="collapseListGroupHeadingAmount" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroupAmount" aria-expanded="true" aria-controls="collapseListGroupAmount">
                قیمت ها
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse" id="collapseListGroupAmount" aria-labelledby="collapseListGroupHeadingAmount" aria-expanded="false">
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.skill.add.amount', $skill->id], 'method'=>'post', 'data-remote-file', 'class'=>'form-horizontal', 'enctype'=>'multipart/form-data']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'عنوان خدمت :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-8 pull-right panel-form">
                        {!! Form::text('title', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('pricing_type', 'نوع قیمت گذاری :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-2 pull-right panel-form">
                        {!! Form::select('pricing_type', $amount_types, null, ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div id="pricing_properties" style="display: none">

                    <div class="form-group">
                        {!! Form::label('price', 'قیمت : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                        <div class="col-md-3 pull-right panel-form">
                            {!! Form::text('price', null, ['class'=>'form-control']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('price_unit', 'واحد پولی : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                        <div class="col-md-2 pull-right panel-form">
                            {!! Form::select('price_unit', $amount_units, null, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('price_per', 'به ازای هر : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                        <div class="col-md-2 pull-right panel-form">
                            {!! Form::input('number', 'price_per', null, ['class'=>'form-control']) !!}
                            <i class="input-icon fa fa-edit"></i>
                        </div>
                    </div>

                    <div class="form-group">
                        {!! Form::label('per_unit', 'واحد شمارش : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                        <div class="col-md-2 pull-right panel-form">
                            {!! Form::select('per_unit', $amount_per_units, null, ['class'=>'form-control']) !!}
                        </div>
                    </div>

                </div>


                <div class="form-group">
                    {!! Form::label('description', 'توضیحات  :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-8 pull-right panel-form">
                        {!! Form::text('description', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>


                <p>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i> افزودن دستاورد یا افتخار  </button>
                </p><hr>

                {!! Form::close() !!}

                <table class="table table-striped text-right editable-table" id="amount_table_list">
                    <thead>
                    <tr>
                        <th  class="text-right" >عنوان</th>
                        <th  class="text-right" >نوع قیمت گذاری</th>
                        <th  class="text-right" >قیمت</th>
                        <th  class="text-right" >واحد پولی</th>
                        <th  class="text-right" >به ازای هر</th>
                        <th  class="text-right" >واحد شمارش</th>
                        <th  class="text-right" >توضیحات</th>
                        <th  class="text-right" >عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($amounts as $amount)
                        <tr>
                            <td width="10%">{{ $amount->title }}</td>
                            <td width="15%">{{ $amount->type_name }}</td>
                            <td width="15%">{{ $amount->price }}</td>
                            <td width="10%">{{ $amount->unit_name }}</td>
                            <td width="10%">{{ $amount->price_per }}</td>
                            <td width="15%">{{ $amount->per_unit_name }}</td>
                            <td width="20%" ><a href="#" id="description" data-editable  data-type="textarea" data-pk="{{ $amount->id }}">{{ $amount->description }}</a></td>
                            <td width="5%" ><button id="delete_amount" data-value="{{ $amount->id }}" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer info">
            <i class="fa icon-information" ></i> در این بخش شما می توانید مهارت خود را با  واحدهای پولی مختلف و  تعدادهای مختلف (مثلاٌ ً تعداد عمده) قیمت گذاری نمایید.
        </div>
    </div>
</div>