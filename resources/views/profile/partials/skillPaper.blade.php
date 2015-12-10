<div class="timeline-block">
    <div class="panel panel-default share clearfix-xs"  id="collapseListGroupHeadingPaper" role="tab">
        <div class="panel-heading panel-heading-gray title">
            <a class="collapse-title collapsed" aria-expanded="true" data-toggle="collapse" href="#collapseListGroupPaper" aria-expanded="true" aria-controls="collapseListGroupPaper">
                کتب و مقالات منتشر شده
                <i class="status fa fa-chevron-circle-up"></i>
            </a>
        </div>
        <div class="collapse" id="collapseListGroupPaper" aria-labelledby="collapseListGroupHeadingPaper" aria-expanded="false">
            <div class="panel-body">
                {!! Form::open(['route'=>['profile.skill.add.paper', $skill->id], 'method'=>'post', 'data-remote-file', 'class'=>'form-horizontal', 'enctype'=>'multipart/form-data']) !!}

                <div class="form-group">
                    {!! Form::label('title', 'عنوان مقاله :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-4 pull-right panel-form">
                        {!! Form::text('title', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('type', 'نوع :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-4 pull-right panel-form">
                        {!! Form::select('type', $papers_type, null, ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('publish_year', 'سال نشر : ', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-4 pull-right panel-form">
                        {!! Form::text('publish_year', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('publisher', 'ناشر کتاب / مقاله :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-4 pull-right panel-form">
                        {!! Form::text('publisher', null, ['class'=>'form-control']) !!}
                        <i class="input-icon fa fa-edit"></i>
                    </div>
                </div>

                <div class="form-group">
                    {!! Form::label('sample_file', 'فایل مقاله یا کتاب :', ['class'=>'col-md-2 pull-right form-control-static']) !!}
                    <div class="col-md-8 pull-right">
                        {!! Form::file('sample_file', ['class'=>'form-control-static']) !!}
                    </div>
                </div>

                <p>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save" ></i> افزودن مقاله یا کتاب </button>
                </p><hr>

                {!! Form::close() !!}

                <table class="table table-striped text-right editable-table" id="paper_table_list">
                    <thead>
                    <tr>
                        <th  class="text-right" >عنوان</th>
                        <th  class="text-right" >نوع</th>
                        <th  class="text-right" >سال نشر</th>
                        <th  class="text-right" >ناشر</th>
                        <th  class="text-right" >عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($papers as $paper)
                        <tr>
                            <td width="40%"><a href="#" id="title" data-editable data-type="text" data-pk="{{ $paper->id }}">{{ $paper->title }}</a></td>
                            <td width="15%">{{ $paper->type_name }}</td>
                            <td width="15%"><a href="#" id="publish_year" data-editable data-type="text" data-pk="{{ $paper->id }}">{{ $paper->publish_year }}</a></td>
                            <td width="25%"><a href="#" id="publisher" data-editable data-type="text" data-pk="{{ $paper->id }}">{{ $paper->publisher }}</a></td>
                            @if(count($paper->file)>0)
                                <td width="15%" ><a target="_blank" href="{{ asset('img/files/'.$paper->file->name) }}"><button class="btn btn-default btn-sm"><i class="fa fa-file-image-o fa-lg" ></i> مشاهده تصویر </button></a></td>
                            @else
                                <td width="15%" ></td>
                            @endif
                            <td width="5%" ><button id="delete_paper" data-value="{{ $paper->id }}" type="button" class="btn btn-danger btn-xs " ><p class="fa fa-trash-o fa-lg" ></p></button></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="panel-footer info">
            <i class="fa icon-information" ></i> در این بخش مقالات و کتاب های خود را که مرتبط با این مهارت می باشد وارد نمایید.
        </div>
    </div>
</div>