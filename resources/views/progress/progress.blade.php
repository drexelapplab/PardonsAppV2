<!-- Only show for thos logged in -->
@guest
@else



<div class="row" style="width:75%;margin-left:10%;margin-right:10%;padding:20px;">
	<div class="col-sm-1 btn level-bar">Level:</div>
	@for ($i = 1; $i < 11; $i++)
		@if ($application->status >= $i)
			<div class="col-sm-1 btn bg-info level-bar {{ set_level('applications/level'.$i.'*') }}">
				<a href="../level{{ $i }}/{{ $application->id }}"><span>{{ $i }}</span></a>
			</div>
			
		@elseif ($application->status == ($i - 1))
			<div class="col-sm-1 btn bg-success level-bar {{ set_level('applications/level'.$i.'*') }}">
				<a href="../level{{ $i }}/{{ $application->id }}"><span>{{ $i }}</span></a>
			</div>
		@elseif ($application->status < $i )
			<div class="col-sm-1 btn bg-secondary level-bar">{{ $i }}</div>
		@endif
	@endfor

</div>
@endguest

