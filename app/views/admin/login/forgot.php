
<div class="row">
	<div class="col-sm-12 col-md-8 col-md-offset-2">

	<h1>Reset password</h1>

	<hr/>

	<?php if (Session::has('error')) { ?>
	    <div class="alert alert-danger"><?=trans(Session::get('reason'))?></div>
	<?php } else if (Session::has('success')) { ?>
	    <div class="alert alert-success">An e-mail with the password reset has been sent.</div>
	<?php } ?>

	<?=Form::open(array('action' => 'AdminLoginController@postForgot','method'=>'post','class'=>'form-horizontal'))?>

		<div class="form-group">
			<?=Form::label('email','Email:',array('class'=>'col-md-3 control-label'))?>
			<div class="col-md-9">
				<?=Form::text('email',null,array('class'=>'form-control'))?>
			</div>
		</div>

		<hr/>

		<div class="form-group">
			<div class="col-md-9 col-md-offset-3">
					<a href="<?=URL::action('AdminLoginController@getIndex')?>" class="btn btn-default">Cancel</a>
					<button type="submit" class="btn btn-primary">Reset</button>
			</div>
		</div>


	<?=Form::close()?>

</div>