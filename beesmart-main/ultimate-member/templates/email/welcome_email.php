<?php if ( ! defined( 'ABSPATH' ) ) exit; ?>

<div style="max-width: 560px;padding: 20px;background: #ffffff;border-radius: 5px;margin:40px auto;font-family: Open Sans,Helvetica,Arial;font-size: 15px;color: #666;">

	<div class="email-header" >
		<div class="site-name"
		>{site_name}</div>
		
		<div style="clear:both"></div>
	</div>
	
	<div style="padding: 0 30px 30px 30px;border-bottom: 3px solid #eeeeee;">

		<div style="padding: 30px 0;font-size: 24px;text-align: center;line-height: 40px;">Thank you for signing up!<span style="display: block;">Your account is now active.</span></div>

		<div style="padding: 10px 0 50px 0;text-align: center;"><a href="{login_url}" style="background: #555555;color: #fff;padding: 12px 30px;text-decoration: none;border-radius: 3px;letter-spacing: 0.3px;">Login to our site</a></div>
		
		<div style="padding:20px;">If you have any problems, please contact us at <a href="mailto:{admin_email}" style="color: #3ba1da;text-decoration: none">{admin_email}</a></div>
		
		
	</div>
	
	<div style="color: #999;padding: 20px 30px">

		<div style="">Thank you!</div>
		<div style="">The <a href="{site_url}" style="color: #3ba1da;text-decoration: none;">{site_name}</a> Team</div>
		
	</div>

</div>

<style>
	.email-header{
		color: #fff;
    font-weight: normal;
    background: #DB9B36;
    display: flex;
    justify-content: center;
    padding: 15px;
	}
	.email-header>.site-name{
		text-align: center;
		font-weight:bold;
		font-size:28px;
		font-family: Nunito;
	}
</style>