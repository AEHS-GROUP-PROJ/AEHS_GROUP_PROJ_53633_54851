<h1>New user registration</h1>
<div id="<?=dom_id('create_user_form')?>" class="grid">
	<div>Full name</div>
	<div>
		<input type="text" name="full_name" autocomplete="name" maxlength="50"/>
	</div>
	<div>Email</div>
	<div>
		<input type="text" name="email" autocomplete="email" maxlength="50"/>
	</div>
	<div>Home address</div>
	<div>
		<input type="text" name="address" autocomplete="street-address" maxlength="50"/>
	</div>
	<div>Phone number</div>
	<div>
		<input type="text" name="phone" autocomplete="mobile" maxlength="50"/>
	</div>
	<div>Roles</div>
	<div>
		<label for="<?=dom_id('create_user_form_is_student')?>">
			<input id="<?=dom_id('create_user_form_is_student')?>" type="checkbox" name="is_student" checked/>
			Student
		</label>
		<label for="<?=dom_id('create_user_form_is_lecturer')?>">
			<input id="<?=dom_id('create_user_form_is_lecturer')?>" type="checkbox" name="is_lecturer"/>
			Lecturer
		</label>
		<label for="<?=dom_id('create_user_form_is_admin')?>">
			<input id="<?=dom_id('create_user_form_is_admin')?>" type="checkbox" name="is_admin"/>
			Admin
		</label>
	</div>
	<div>Password</div>
	<div>
		<input type="password" name="password" autocomplete="new-password"  maxlength="50"/>
	</div>
	<div>Confirm password</div>
	<div>
		<input type="password" name="password_confirm" autocomplete="new-password" maxlength="50"/>
	</div>
	<div></div>
	<div>
		<div class="button" c-click="action(create_user,form(<?=dom_id('create_user_form')?>))">
			<i class="fa fa-user-plus"></i>
			<i>Create user</i>
		</div>
	</div>
</div>