<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs" id="collapseListGroupHeadingInfo" role="tab">

        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroupInfo" aria-expanded="true" aria-controls="collapseListGroupInfo"> مشخصات
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>

        <div class="collapse in" id="collapseListGroupInfo" aria-labelledby="collapseListGroupHeadingInfo" aria-expanded="true">
            <div class="panel-body" id="user_info_form" >

                @role('user')
                    <div class="form-horizontal panel-form panel-view"   data-role="preview" >

                        <div class="row">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right">نام : </label>
                                    <div class="col-sm-8">
                                        <span data-get="info.user.first_name" class="form-control-static">{{ $info->user->first_name }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right">نام خانوادگی :</label>
                                    <div class="col-sm-8">
                                        <span class="form-control-static">{{ $info->user->last_name }}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right">شماره تلفن : </label>
                                    <div class="col-sm-8">
                                        <span class="form-control-static">{{ $info->phone1 }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right">شماره فکس : </label>
                                    <div class="col-sm-8">
                                        <span class="form-control-static">{{ $info->fax }}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right">شماره همراه :</label>
                                    <div class="col-sm-8">
                                        <span class="form-control-static">{{ $info->cell_phone }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right">آدرس آیمیل :</label>
                                    <div class="col-sm-8">
                                        <span class="form-control-static">{{ $info->user->email }}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right"> شهر : </label>
                                    <div class="col-sm-8">
                                        <span class="form-control-static">تهران</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right"> استان : </label>
                                    <div class="col-sm-8">
                                        <span class="form-control-static">تهران</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right"> آدرس : </label>
                                    <div class="col-sm-8">
                                        <span class="form-control-static">{{ $info->address }}</span>
                                    </div>
                                </div>
                            </div>

                            <button type="button" class="btn btn-default btn-sm" data-role="edit" > <i class="fa fa-pencil"></i>  ویرایش  </button>

                        </div>

                    </div>
                    {!! Form::model($info, ['url'=>'profile/userinfo', 'method'=>'post', 'class'=>'form-horizontal panel-form', 'style'=>'display: none', 'data-role'=>'editor', 'data-remote']) !!}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('user[first_name]', 'نام : ', ['class'=>'control-label pull-right']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('user[first_name]', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                                        <i class="input-icon fa fa-edit"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    {!! Form::label('user[last_name]', 'نام خانوادگی : ', ['class'=>'control-label pull-right']) !!}
                                    <div class="col-sm-5">
                                        {!! Form::text('user[last_name]', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                                        <i class="input-icon fa fa-edit"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('phone1', 'شماره تلفن : ', ['class'=>'control-label pull-right']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('phone1', null, ['class'=>'form-control', 'placeholder'=>'شماره تلفن به همراه پیش شماره']) !!}
                                        <i class="input-icon fa fa-edit"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('fax', 'شماره فکس : ', ['class'=>'control-label pull-right']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('fax', null, ['class'=>'form-control', 'placeholder'=>'شماره فکس شما']) !!}
                                        <i class="input-icon fa fa-edit"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    {!! Form::label('cell_phone', 'شماره همراه : ', ['class'=>'control-label pull-right']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('cell_phone', null, ['class'=>'form-control', 'placeholder'=>'شماره تلفن همراه']) !!}
                                        <i class="input-icon fa fa-edit"></i>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    {!! Form::label('address', 'آدرس  :', ['class'=>'control-label pull-right']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::text('address', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                                        <i class="input-icon fa fa-edit"></i>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" name="submit" class="btn btn-success" > <i class="fa fa-save"></i> ذخیره تغییرات  </button>
                            <button type="button" class="btn btn-default" data-role="return" > <i class="fa fa-retweet"></i>  بازگشت  </button>

                        </div>
                    {!! Form::close() !!}
                @endrole



                @role('legal')
                <div class="form-horizontal panel-form panel-view"   data-role="preview" >

                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">نام مجموعه :</label>
                                <div class="col-sm-8">
                                    <span data-get="company" class="form-control-static">{{ $info->user->company }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">نام : </label>
                                <div class="col-sm-8">
                                    <span data-get="first_name" class="form-control-static">{{ $info->user->first_name }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">نام خانوادگی :</label>
                                <div class="col-sm-8">
                                    <span data-get="last_name" class="form-control-static">{{ $info->user->last_name }}</span>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">شماره تلفن  1 :</label>
                                <div class="col-sm-8">
                                    <span data-get="phone1" class="form-control-static">{{ $info->phone1 }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">شماره تلفن  2 :</label>
                                <div class="col-sm-8">
                                    <span data-get="phone2" class="form-control-static">{{ $info->phone2 }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">شماره فکس : </label>
                                <div class="col-sm-8">
                                    <span data-get="fax" class="form-control-static">{{ $info->fax }}</span>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">شماره همراه :</label>
                                <div class="col-sm-8">
                                    <span data-get="cell_phone" class="form-control-static">{{ $info->cell_phone }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">آدرس آیمیل :</label>
                                <div class="col-sm-8">
                                    <span data-get="email" class="form-control-static">{{ $info->user->email }}</span>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right"> شهر : </label>
                                <div class="col-sm-8">
                                    <span class="form-control-static">تهران</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right"> استان : </label>
                                <div class="col-sm-8">
                                    <span class="form-control-static">تهران</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right"> آدرس : </label>
                                <div class="col-sm-8">
                                    <span data-get="address" class="form-control-static">{{ $info->address }}</span>
                                </div>
                            </div>
                        </div>

                        <button type="button" class="btn btn-default btn-sm" data-role="edit" > <i class="fa fa-pencil"></i>  ویرایش  </button>

                    </div>

                </div>
                {!! Form::model($info, ['url'=>'profile/userinfo', 'method'=>'post', 'class'=>'form-horizontal panel-form', 'style'=>'display: none', 'data-role'=>'editor', 'data-remote']) !!}
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('user[company]', 'نام مجموعه :', ['class'=>'control-label pull-right']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('user[company]', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                                <i class="input-icon fa fa-edit"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('user[first_name]', 'نام : ', ['class'=>'control-label pull-right']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('user[first_name]', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                                <i class="input-icon fa fa-edit"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('user[last_name]', 'نام خانوادگی : ', ['class'=>'control-label pull-right']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('user[last_name]', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                                <i class="input-icon fa fa-edit"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('phone1', 'شماره تلفن 1 : ', ['class'=>'control-label pull-right']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('phone1', null, ['class'=>'form-control', 'placeholder'=>'شماره تلفن به همراه پیش شماره']) !!}
                                <i class="input-icon fa fa-edit"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('phone2', 'شماره تلفن 2 : ', ['class'=>'control-label pull-right']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('phone2', null, ['class'=>'form-control', 'placeholder'=>'شماره تلفن به همراه پیش شماره']) !!}
                                <i class="input-icon fa fa-edit"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('fax', 'شماره فکس : ', ['class'=>'control-label pull-right']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('fax', null, ['class'=>'form-control', 'placeholder'=>'شماره فکس شما']) !!}
                                <i class="input-icon fa fa-edit"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('cell_phone', 'شماره همراه : ', ['class'=>'control-label pull-right']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('cell_phone', null, ['class'=>'form-control', 'placeholder'=>'شماره تلفن همراه']) !!}
                                <i class="input-icon fa fa-edit"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('cell_phone', 'شماره همراه : ', ['class'=>'control-label pull-right']) !!}
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="form-group">
                            {!! Form::label('address', 'آدرس  :', ['class'=>'control-label pull-right']) !!}
                            <div class="col-sm-10">
                                {!! Form::text('address', null, ['class'=>'form-control', 'placeholder'=>'']) !!}
                                <i class="input-icon fa fa-edit"></i>
                            </div>
                        </div>
                    </div>

                    <button type="submit" name="submit" class="btn btn-success" > <i class="fa fa-save"></i> ذخیره تغییرات  </button>
                    <button type="button" class="btn btn-default" data-role="return" > <i class="fa fa-retweet"></i>  بازگشت  </button>

                </div>
                {!! Form::close() !!}
                @endrole



            </div>

        </div>
        <div style="color: #666;font-size: 13px" class="panel-footer"> <i class="fa fa-clock-o fa-lg" style="margin-left: 5px; top: 0"></i>
            آخرین ویرایش {{ $info->human_updated_at }}
        </div>
    </div>
</div>