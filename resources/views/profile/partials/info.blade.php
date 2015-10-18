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

                        <div class="">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right">نام : </label>
                                    <div class="col-sm-8">
                                        <span data-get="first_name" class="form-control-static">{{ $info->user->first_name }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right">نام خانوادگی :</label>
                                    <div class="col-sm-8">
                                        <span data-get="last_name" class="form-control-static">{{ $info->user->last_name }}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right">شماره تلفن : </label>
                                    <div class="col-sm-8">
                                        <span data-get="phone1" class="form-control-static">{{ $info->phone1 }}</span>
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

                            <div class="col-md-4">
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
                                        <span data-get="city" class="form-control-static">{{ $info->city }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right"> استان : </label>
                                    <div class="col-sm-8">
                                        <span data-get="province" class="form-control-static">{{ $info->province }}</span>
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
                        <div class="">
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

                            <div class="col-sm-4">
                                <div class="form-group">
                                    {!! Form::label('province_id', 'استان : ', ['class'=>'control-label pull-right']) !!}
                                    <div class="col-sm-8">
                                        {!! Form::select('province_id', $provinces, null, ['class'=>'form-control']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <div class="form-group">
                                    {!! Form::label('city_id', 'شهر : ', ['class'=>'control-label pull-right']) !!}
                                    <div class="col-sm-4">
                                        {!! Form::select('city_id', $cities, null, ['class'=>'form-control']) !!}
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

                    <div class="">

                        <div class="col-md-12">
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

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">نام خانوادگی :</label>
                                <div class="col-sm-8">
                                    <span data-get="last_name" class="form-control-static">{{ $info->user->last_name }}</span>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">شماره تلفن  ۱ :</label>
                                <div class="col-sm-8">
                                    <span data-get="phone1" class="form-control-static">{{ $info->phone1 }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">شماره تلفن  ۲ :</label>
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
                                    <span data-get="city" class="form-control-static">{{ $info->city }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right"> استان : </label>
                                <div class="col-sm-8">
                                    <span data-get="province" class="form-control-static">{{ $info->province }}</span>
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
                            <div id="legal_other_address">
                                @foreach($info->user->addresses as $address)
                                    <div class="form-group">
                                        <label for="name" class="control-label pull-right"> آدرس : </label>
                                        <div class="col-sm-8">
                                            <span class="form-control-static">{{ $address->address }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <button type="button" class="btn btn-default btn-sm" data-role="edit" > <i class="fa fa-pencil"></i>  ویرایش  </button>

                    </div>

                </div>
                {!! Form::model($info, ['url'=>'profile/userinfo', 'method'=>'post', 'class'=>'form-horizontal panel-form', 'style'=>'display: none', 'data-role'=>'editor', 'data-remote']) !!}
                <div class="">
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
                            {!! Form::label('phone1', 'شماره تلفن ۱ : ', ['class'=>'control-label pull-right']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('phone1', null, ['class'=>'form-control', 'placeholder'=>'شماره تلفن به همراه پیش شماره']) !!}
                                <i class="input-icon fa fa-edit"></i>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            {!! Form::label('phone2', 'شماره تلفن ۲ : ', ['class'=>'control-label pull-right']) !!}
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
                            {!! Form::label('province_id', 'استان : ', ['class'=>'control-label pull-right']) !!}
                            <div class="col-sm-8">
                                {!! Form::select('province_id', $provinces, null, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4">
                        <div class="form-group">
                            {!! Form::label('city_id', 'شهر : ', ['class'=>'control-label pull-right']) !!}
                            <div class="col-sm-8">
                                {!! Form::select('city_id', $cities, null, ['class'=>'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12" id="legal_address">
                        <div class="form-group">
                            {!! Form::label('address', 'آدرس  :', ['class'=>'control-label pull-right']) !!}
                            <div class="col-sm-8">
                                {!! Form::text('address', null, ['class'=>'form-control new-address', 'placeholder'=>'']) !!}
                                <i class="input-icon fa fa-edit"></i>
                            </div>
                        </div>
                        <?php $loop_end = 0; ?>
                        @foreach($info->user->addresses as $key=>$address)
                            <?php $loop_end++; ?>
                            <div class="form-group">
                                {!! Form::label('other_address[]', 'آدرس  :', ['class'=>'control-label pull-right']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('other_address[]', $address->address, ['class'=>'form-control new-address', 'placeholder'=>'']) !!}
                                    <i class="input-icon fa fa-edit"></i>
                                </div>
                            </div>
                        @endforeach

                        @if(($loop_end < 4 and $loop_end > 0) or ($loop_end == 0 and !empty($info->address) ) )
                            <div class="form-group">
                                {!! Form::label('other_address[]', 'آدرس  :', ['class'=>'control-label pull-right']) !!}
                                <div class="col-sm-8">
                                    {!! Form::text('other_address[]', null, ['class'=>'form-control new-address', 'placeholder'=>'درصورتی که آدرس دیگری نیز دارید می توانید در این بخش ثبت نمایید.']) !!}
                                    <i class="input-icon fa fa-edit"></i>
                                </div>
                            </div>
                        @endif

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