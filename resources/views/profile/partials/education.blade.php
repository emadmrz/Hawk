<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs" id="collapseListGroupHeading2" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroup2" aria-expanded="true" aria-controls="collapseListGroup2">تحصیلات
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse in" id="collapseListGroup2" aria-labelledby="collapseListGroupHeading2" aria-expanded="true">
            <div class="panel-body" id="education_form">

                <div class="" data-role="preview">

                    <table class="table education-table">
                        <thead>
                            <tr>
                                <th>مقطع</th>
                                <th>رشته تحصیلی</th>
                                <th>دانشگاه</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>کارشناسی</td>
                                <td>برق قدرت</td>
                                <td>شهید بهشتی</td>
                            </tr>
                        </tbody>
                    </table>

                    <button type="button" class="btn btn-default btn-sm" data-role="edit" > <i class="fa fa-pencil"></i>  ویرایش  </button>

                </div>

                <div class="" data-role="editor" style="display: none">

                    <div class="panel panel-default new-education">
                        <div class="panel-heading title">
                            <h5>ثبت مقطع تحصیلی جدید</h5>
                        </div>
                        <div class="panel-body">
                            {!! Form::open('url'
                            <form class="form-horizontal panel-form">

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="degree" class="control-label pull-right">مقطع : </label>
                                        <div class="col-sm-9">
                                            <select name="degree" id="degree" class="form-control" title="انتخاب مقطع">
                                                <option>انتخاب مقطع</option>
                                                <option>کارشناسی</option>
                                                <option>کارشناسی ارشد</option>
                                                <option>دکتری</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name" class="control-label pull-right">رشته : </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" placeholder="رشته تحصیلی" >
                                            <i class="input-icon fa fa-edit"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="name" class="control-label pull-right">دانشگاه : </label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" id="name" placeholder="دانشگاه محل تحصیل">
                                            <i class="input-icon fa fa-edit"></i>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="form-group">
                                        <button type="button" class=" btn btn-success btn-block">افزودن</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>

                    <div class="seprator"></div>


                    <form class="form-horizontal panel-form">

                        <table class="table education-table">
                            <thead>
                            <tr>
                                <th>مقطع</th>
                                <th>رشته تحصیلی</th>
                                <th>دانشگاه</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>
                                    <div class="col-md-11">
                                        <div class="form-group">
                                            <select name="degree" id="degree" class="form-control" title="انتخاب مقطع">
                                                <option>انتخاب مقطع</option>
                                                <option selected >کارشناسی</option>
                                                <option>کارشناسی ارشد</option>
                                                <option>دکتری</option>
                                            </select>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-11">
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="برق قدرت" id="name" placeholder="نام شما">
                                            <i class="input-icon fa fa-edit"></i>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-11">
                                        <div class="form-group">
                                            <input type="text" class="form-control" value="دانشگاه شهید بهشتی" id="name" placeholder="نام شما">
                                            <i class="input-icon fa fa-edit"></i>
                                        </div>
                                    </div>

                                </td>
                                <td>
                                    <div class="form-group control-button">
                                        <button type="button" class=" btn btn-success  btn-xs"><i class="fa fa-pencil fa-lg" ></i></button>
                                        <button type="button" class=" btn btn-danger btn-xs"><i class="fa fa-trash-o fa-lg" ></i></button>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>





                    </form>


                    <button type="button" class="btn btn-default" data-role="return" > <i class="fa fa-retweet"></i>  بازگشت  </button>


                </div>


            </div>
        </div>
        <div style="color: #666;font-size: 13px" class="panel-footer"><i class="fa fa-clock-o fa-lg" style="margin-left: 5px; top: 0"></i>
            آخرین ویرایش چهارشنبه 28 مرداد
        </div>
    </div>
</div>