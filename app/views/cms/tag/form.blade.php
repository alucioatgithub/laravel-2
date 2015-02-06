<style type="text/css">
.mshow  {display: block;}
.mhide {display: none}
</style>
<div class="row">
    <!-- left column -->
    <div class="col-md-12">
        <!-- general form elements -->
    <div class="box box-primary">
      
        <!-- form start -->
    <div class="row">        
         <div class="col-md-8">
            <div class="box-body">

                 <div class="form-group {{($errors->has('title'))? 'has-error' : ''}}">
                     {{ Form::label('title', 'Title') }}  <span class="red">*</span>
                     {{Form::text('title', NULL, array('class' => 'form-control'))}} 
                    @if ($errors->has('title'))
                        {{ $errors->first('title', '<label class="control-label"></i>:message</label>') }}
                    @endif

                </div>


                  <div class="form-group {{($errors->has('description'))? 'has-error' : ''}}">
                     {{ Form::label('description', 'Description') }} <span class="red">*</span>
                     {{Form::textarea('description', NULL, array('class' => 'form-control'))}} 
                    @if ($errors->has('description'))
                        {{ $errors->first('description', '<label class="control-label"></i>:message</label>') }}
                    @endif
                </div>

                 <div class="form-group">
                     {{ Form::label('graphics', 'Graphics') }} 
                     {{Form::text('graphics', NULL, array('class' => 'form-control'))}} 
                    @if ($errors->has('graphics'))
                        {{ $errors->first('graphics', '<label class="control-label"></i>:message</label>') }}
                    @endif
                </div>
                   
            </div><!-- /.box-body -->

            <div class="box-footer">
                {{ Form::submit('Save', array('class' => 'btn btn-primary')) }}
            </div>
        </div>
    </div>

    </div><!-- /.box -->

    </div><!--/.col (right) -->
</div>