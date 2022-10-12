<div class="m-t-10 m-b-10 p-l-10 p-r-10 p-t-10 p-b-10">
	<div class="row">
		<div  class="event_details col-md-12">

	<b> Event Date Start (LOCAL)</b>	{{ \Carbon\Carbon::parse($event->event_date_start)->format(config('app.carbon_date_format')) }} {{ session()->get('timezone') }} <br>
<b> Event Date End (LOCAL)</b>	{{ \Carbon\Carbon::parse($event->event_date_end)->format(config('app.carbon_date_format')) }} {{ session()->get('timezone') }}  <br>

<br> <br>

	<b> Event Date Start (ACTUAL)</b>	{{ \Carbon\Carbon::parse($event->actual_event_date_start)->format(config('app.carbon_date_format')) }} {{ $event->tournament->timezone }} <br>
<b> Event Date End (ACTUAL)</b>	{{ \Carbon\Carbon::parse($event->actual_event_date_end)->format(config('app.carbon_date_format')) }} {{ $event->tournament->timezone }}  <br>


		</div>

	</div>
</div>
<div class="clearfix"></div>

<script>



</script>