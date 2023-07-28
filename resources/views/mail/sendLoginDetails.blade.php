@extends('mail.layout.layout')
@section('content')
<tr>
	<td style="padding: 10px 30px 25px; text-align: left;">
		<h1 style="margin: 0; font-family: 'Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif'; font-size: 11pt; line-height: 27px; color: #444;"><b>Hello {{$business_name}},</b>
		</h1>
	</td>
</tr>
<tr>
	<td style="padding: 0 30px 30px; font-family: 'Open Sans','Lucida Grande','Segoe UI',Arial,Verdana,'Lucida Sans Unicode',Tahoma,'Sans Serif'; font-size: 11pt; line-height: 27px; color: #444; text-align: left;">
		<p style="margin: 0;"><b><br> Your driver account has been created by ARA administrator.  Please find the below login details.</b>
		</p>
		<br>
		<p style="margin: 0;">
			<b>
				Email:- {{$email}}
				<br>
				Password:- {{$password}}
			</b>
		</p>
		<br>
    </td>
</tr>
@stop