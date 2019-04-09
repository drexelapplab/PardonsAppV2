<!-- Only show for thos logged in -->
@guest
@else
<div style="width:75%;padding-left:5%;padding-bottom:20px;" class="panel panel-primary">
  <div class="panel-heading h5">Status: <span class="label label-warning">Level 2</span></div>
  <div class="panel-body">
    <div class="progress progress-striped">
		<div class="progress-bar progress-bar-info" style="width: 10%"></div>
	</div>
  </div>
</div>
@endguest

