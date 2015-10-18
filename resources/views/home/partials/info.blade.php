<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs" id="collapseListGroupHeadingInfo" role="tab">

        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroupInfo" aria-expanded="true" aria-controls="collapseListGroupInfo"> مشخصات
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>

        <div class="collapse in" id="collapseListGroupInfo" aria-labelledby="collapseListGroupHeadingInfo" aria-expanded="true">
            <div class="panel-body" id="user_info_form" >

                @if($role == 'user')
                    <div class="form-horizontal panel-form panel-view"   data-role="preview" >

                        <div class="">

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right">نام : </label>
                                    <div class="col-sm-8">
                                        <span data-get="first_name" class="form-control-static">{{ $user->first_name }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right">نام خانوادگی :</label>
                                    <div class="col-sm-8">
                                        <span data-get="last_name" class="form-control-static">{{ $user->last_name }}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right">شماره تلفن : </label>
                                    <div class="col-sm-8">
                                        <span data-get="phone1" class="form-control-static">{{ $user->info->phone1 }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right">شماره فکس : </label>
                                    <div class="col-sm-8">
                                        <span data-get="fax" class="form-control-static">{{ $user->info->fax }}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right">شماره همراه :</label>
                                    <div class="col-sm-8">
                                        <span data-get="cell_phone" class="form-control-static">{{ $user->info->cell_phone }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right">آدرس آیمیل :</label>
                                    <div class="col-sm-8">
                                        <span data-get="email" class="form-control-static">{{ $user->email }}</span>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right"> شهر : </label>
                                    <div class="col-sm-8">
                                        <span data-get="city" class="form-control-static">{{ $user->info->city }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right"> استان : </label>
                                    <div class="col-sm-8">
                                        <span data-get="province" class="form-control-static">{{ $user->info->province }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name" class="control-label pull-right"> آدرس : </label>
                                    <div class="col-sm-8">
                                        <span data-get="address" class="form-control-static">{{ $user->info->address }}</span>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                @endif



                @if($role == 'legal')
                <div class="form-horizontal panel-form panel-view"   data-role="preview" >

                    <div class="">

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">نام مجموعه :</label>
                                <div class="col-sm-8">
                                    <span data-get="company" class="form-control-static">{{ $user->company }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">نام : </label>
                                <div class="col-sm-8">
                                    <span data-get="first_name" class="form-control-static">{{ $user->first_name }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">نام خانوادگی :</label>
                                <div class="col-sm-8">
                                    <span data-get="last_name" class="form-control-static">{{ $user->last_name }}</span>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">شماره تلفن  ۱ :</label>
                                <div class="col-sm-8">
                                    <span data-get="phone1" class="form-control-static">{{ $user->info->phone1 }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">شماره تلفن  ۲ :</label>
                                <div class="col-sm-8">
                                    <span data-get="phone2" class="form-control-static">{{ $user->info->phone2 }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">شماره فکس : </label>
                                <div class="col-sm-8">
                                    <span data-get="fax" class="form-control-static">{{ $user->info->fax }}</span>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">شماره همراه :</label>
                                <div class="col-sm-8">
                                    <span data-get="cell_phone" class="form-control-static">{{ $user->info->cell_phone }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right">آدرس آیمیل :</label>
                                <div class="col-sm-8">
                                    <span data-get="email" class="form-control-static">{{ $user->info->user->email }}</span>
                                </div>
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right"> شهر : </label>
                                <div class="col-sm-8">
                                    <span data-get="city" class="form-control-static">{{ $user->info->city }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right"> استان : </label>
                                <div class="col-sm-8">
                                    <span data-get="province" class="form-control-static">{{ $user->info->province }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="name" class="control-label pull-right"> آدرس : </label>
                                <div class="col-sm-8">
                                    <span data-get="address" class="form-control-static">{{ $user->info->address }}</span>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                @endif



            </div>

        </div>
        <div style="color: #666;font-size: 13px" class="panel-footer"> <i class="fa fa-clock-o fa-lg" style="margin-left: 5px; top: 0"></i>
            آخرین ویرایش {{ $user->info->human_updated_at }}
        </div>
    </div>
</div>