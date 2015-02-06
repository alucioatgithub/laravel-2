<style type="text/css">
.mshow  {display: block;}
.mhide {display: none}
.tag {margin-right: 10px}
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

             

                <div class="form-group {{($errors->has('type'))? 'has-error' : ''}} " >
                       {{ Form::label('type', 'Type') }}  <span class="red">*</span>
                       {{Form::select('type',  array(''=>'Select', 'linear'=>'Linear','non-linear'=>'Non-Linear'),
                       NULL, array('class' => 'form-control'))}}
                        @if ($errors->has('type'))
                            {{ $errors->first('type', '<label class="control-label"></i>:message</label>') }}
                        @endif                    
                </div>

                <div class="form-group {{($errors->has('information'))? 'has-error' : ''}}">
                     {{ Form::label('title', 'Title') }} <span class="red">*</span>
                     {{Form::text('title', NULL, array('class' => 'form-control'))}} 
                    @if ($errors->has('title'))
                        {{ $errors->first('title', '<label class="control-label"></i>:message</label>') }}
                    @endif
                </div>

                <div class="form-group {{($errors->has('information'))? 'has-error' : ''}}">
                     {{ Form::label('information', 'Information') }} <span class="red">*</span>
                     {{Form::textarea('information', NULL, array('class' => 'form-control'))}} 
                    @if ($errors->has('information'))
                        {{ $errors->first('information', '<label class="control-label"></i>:message</label>') }}
                    @endif
                </div>

                @if($users)
                <div class="form-group {{($errors->has('author'))? 'has-error' : ''}}">
                     {{ Form::label('author', 'Author') }} <span class="red">*</span>                     
                     {{Form::select('author', $users, NULL, array('class' => 'form-control'))}} 
                    @if ($errors->has('author'))
                        {{ $errors->first('author', '<label class="control-label"></i>:message</label>') }}
                    @endif
                </div>
                @endif         



                @if($tags)
                <div class="form-group {{($errors->has('tags'))? 'has-error' : ''}}">

                     {{ Form::label('tags', 'Tags') }} <span class="red">*</span>
                     <br/>
                     <?php 
                     $tag_array = array();
                     foreach($tags as $tag) {
                        $tag_array[$tag->tagid] = $tag->title;
                    } ?>
                    <!-- multiple dropdown -->
                     {{Form::select('tags[]', $tag_array, null, array(
                          'multiple' => true,
                          'class' => 'chosen form-control'
                    )); }}

                    @if ($errors->has('tags'))
                        {{ $errors->first('tags', '<label class="control-label"></i>:message</label>') }}
                    @endif
                </div>
                @endif

                <!-- targeting -->

                <?php
                    $target = array_merge(array('0' => 'None'),\survey\Target::lists('title', 'targetid'));
                ?>


                <div class="form-group {{($errors->has('polygon'))? 'has-error' : ''}}">
                     {{ Form::label('polygon', 'Polygon') }}                      
                     {{Form::select('polygon', $target , (isset($survey))?$survey->targeting['polygon']: "", array('class' => 'form-control'))}} 
                    @if ($errors->has('polygon'))
                        {{ $errors->first('polygon', '<label class="control-label"></i>:message</label>') }}
                    @endif
                </div>

                  <?php 
                    $start =  isset($survey->targeting['start']) ? $survey->targeting['start'] : '';
                   
                    if($start !='')
                    {
                        $start = \Carbon\Carbon::parse($start['date']);
                        $start = $start->toDateString();
                    }


                    $end =  isset($survey->targeting['end']) ? $survey->targeting['end'] : '';
                    if($end !='')
                    {
                        $end = \Carbon\Carbon::parse($end['date']);
                        $end = $end->toDateString();
                    }
                    ?>


                <div class="form-group">
                     {{ Form::label('start_date', 'Start Date') }} 
                     {{ Form::text('start_date', $start, array('type' => 'text', 'class' => 'form-control datepicker', 'id' => 'start_date')) }}
                    @if ($errors->has('start_date'))
                        {{ $errors->first('start_date', '<label class="control-label"></i>:message</label>') }}
                    @endif
                </div>

                <div class="form-group">
                     {{ Form::label('end_date', 'End Date') }} 
                     {{ Form::text('end_date', $end, array('type' => 'text', 'class' => 'form-control datepicker', 'data-datepicker' => 'datepicker', 'id' => 'end_date')) }}
                    @if ($errors->has('end_date'))
                        {{ $errors->first('end_date', '<label class="control-label"></i>:message</label>') }}
                    @endif
                </div>

                <div class="form-group {{($errors->has('referrer'))? 'has-error' : ''}}">
                     {{ Form::label('referrer', 'Referrer') }}
                     {{Form::number('referrer', (isset($survey))?$survey->targeting['referrer']: "", array('class' => 'form-control'))}} 
                    @if ($errors->has('referrer'))
                        {{ $errors->first('referrer', '<label class="control-label"></i>:message</label>') }}
                    @endif
                </div>

                <div class="form-group {{($errors->has('manualend'))? 'has-error' : ''}}">
                     {{ Form::label('manualend', 'Manual End') }} <span class="red">*</span>
                     {{Form::radio('manualend', 1, ((isset($survey) and $survey->targeting['manualend'] == 1) || !isset($survey))? TRUE : NULL, array('class' => 'form-control'))}} Yes  
                     {{Form::radio('manualend', 0, (isset($survey) and $survey->targeting['manualend'] == 0)? TRUE : NULL, array('class' => 'form-control'))}} No
                    @if ($errors->has('manualend'))
                        {{ $errors->first('manualend', '<label class="control-label"></i>:message</label>') }}
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


<script type="text/javascript">

$(document).ready(function() {

    $( "#start_date" ).datepicker({
        dateFormat: 'yy-mm-dd',
      minDate: 0,
      onClose: function( selectedDate ) {
        $( "#end_date" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#end_date" ).datepicker({
        dateFormat: 'yy-mm-dd',
      onClose: function( selectedDate ) {
        $( "#start_date" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
} );

jQuery(document).ready(function(){
    jQuery(".chosen").data("placeholder","Select Tags...").chosen();
});
</script>