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
               

                 <div class="form-group {{($errors->has('firstname'))? 'has-error' : ''}}">
                     {{ Form::label('firstname', 'First Name') }}  <span class="red">*</span>
                     {{Form::text('firstname', NULL, array('class' => 'form-control'))}} 
                    @if ($errors->has('firstname'))
                        {{ $errors->first('firstname', '<label class="control-label"></i>:message</label>') }}
                    @endif

                </div>


                  <div class="form-group {{($errors->has('lastname'))? 'has-error' : ''}}">
                     {{ Form::label('lastname', 'Last Name') }} <span class="red">*</span>
                     {{Form::text('lastname', NULL, array('class' => 'form-control'))}} 
                    @if ($errors->has('lastname'))
                        {{ $errors->first('lastname', '<label class="control-label"></i>:message</label>') }}
                    @endif
                </div>

                 <div class="form-group">
                     {{ Form::label('address', 'Address') }} 
                     {{Form::text('address', NULL, array('class' => 'form-control'))}} 
                    @if ($errors->has('address'))
                        {{ $errors->first('address', '<label class="control-label"></i>:message</label>') }}
                    @endif
                </div>
                   <?php         
                   if(isset($user->dob))
                   $dob = $user->dob->toDateString();
                   else
                   $dob = NULL;
                   ?>
            
                 <div class="form-group">
                     {{ Form::label('dob', 'Date of birth') }}                      
                     {{Form::text('dob', $dob, array('class' => 'form-control'))}} 

                    @if ($errors->has('dob'))
                        {{ $errors->first('dob', '<label class="control-label"></i>:message</label>') }}
                    @endif
                </div>

                <div class="form-group">
                     {{ Form::label('gender1', 'Gender') }} 
                     <br/>
                    <label>
                    {{Form::radio('gender', '1', NULL, array('class' => 'minimal'))}} Male
                    </label>
                    <label>
                    {{Form::radio('gender', '0', NULL, array('class' => 'minimal'))}} Female
                    </label>

                </div>
                
                <div class="form-group {{($errors->has('bio'))? 'has-error' : ''}}">
                     {{ Form::label('bio', 'Bio') }}
                     {{Form::textarea('bio', NULL, array('class' => 'form-control'))}} 
                    @if ($errors->has('bio'))
                        {{ $errors->first('bio', '<label class="control-label"></i>:message</label>') }}
                    @endif
                </div>

                <div class="form-group {{($errors->has('avatar'))? 'has-error' : ''}}">
                     {{ Form::label('avatar', 'Avatar') }} 
                     {{Form::url('avatar', NULL, array('class' => 'form-control'))}} 
                    @if ($errors->has('avatar'))
                        {{ $errors->first('avatar', '<label class="control-label"></i>:message</label>') }}
                    @endif
                </div>

                <div class="form-group {{($errors->has('email'))? 'has-error' : ''}}">
                     {{ Form::label('email', 'Email') }} <span class="red">*</span>
                     {{Form::email('email', NULL, array('class' => 'form-control'))}} 
                    @if ($errors->has('email'))
                        {{ $errors->first('email', '<label class="control-label"></i>:message</label>') }}
                    @endif
                </div>

                  <div class="form-group {{($errors->has('password'))? 'has-error' : ''}}">
                     {{ Form::label('password', 'Password') }} <span class="red">*</span>
                     {{Form::password('password',  array('class' => 'form-control'))}} 
                   @if($current_route !='admin/users/create')
                     <small class="help">Leave this field blank if you don't want to change password</small>
                    @endif 
                   
                    @if ($errors->has('password'))
                        {{ $errors->first('password', '<label class="control-label"></i>:message</label>') }}
                    @endif
                </div>

                <div class="form-group {{($errors->has('social'))? 'has-error' : ''}} " >

                       {{ Form::label('social', 'Social') }}  
                       {{Form::select('social',  array(''=>'Select', 'facebook'=>'Facebook','twitter'=>'Twitter', 'linkedin'=>'Linkedin', 'mobile'=>'Mobile'),                       NULL, array('class' => 'form-control'))}}
                        @if ($errors->has('social'))
                            {{ $errors->first('social', '<label class="control-label"></i>:message</label>') }}
                        @endif                    
                </div>

                <div class="form-group {{($errors->has('role'))? 'has-error' : ''}} " >

                       {{ Form::label('role', 'Role') }}  <span class="red">*</span>
                       {{Form::select('role',  array(''=>'Select', 'user'=>'User','admin'=>'Admin'),
                       NULL, array('class' => 'form-control'))}}
                        @if ($errors->has('role'))
                            {{ $errors->first('role', '<label class="control-label"></i>:message</label>') }}
                        @endif                    
                </div>


                <div  class="form-group  {{ (isset($user->role) AND  $user->role == 'admin') ? 'mshow': 'mhide'}}  capability {{($errors->has('capability'))? 'has-error' : ''}} " >

                       {{ Form::label('capability', 'Admin Capability') }}  <span class="red">*</span>
                       {{Form::select('capability',  array('moderator'=>'Moderator', 'superadmin'=>'Superadmin'),
                       NULL, array('class' => 'form-control'))}}

                        @if ($errors->has('capability'))
                            {{ $errors->first('capability', '<label class="control-label"></i>:message</label>') }}
                        @endif                    
                </div>




                 <div class="form-group">
                     {{ Form::label('useractivated', 'Activated') }} 
                     <br/>
                    <label>
                    {{Form::radio('activated', 'true', NULL, array('class' => 'minimal'))}} Activated
                    </label>
                    <label>
                    {{Form::radio('activated', 'false', NULL, array('class' => 'minimal'))}} Deactivated
                    </label>

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