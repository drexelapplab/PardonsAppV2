<nav id="footer" class="navbar navbar-expand-lg navbar-dark bg-primary">
		<ul class="navbar-nav mr-auto">
			<li class="list-item">PardonMe™ © Philadelphia Lawyers for Social Equity 2018</li>
			<li class="list-item"><span >&nbsp;|&nbsp;</span></li>
			<li class="list-item"><a href="#">Privacy Policy</a></li>
		</ul>
		 <ul class="nav navbar-nav navbar-right">
		 	<li class="list-item">Created with funding from the <i class="text-success">Thomas Skelton Harrison Foundation</i></li>
		</ul>
</nav>

<script>
   window.Laravel = {!! json_encode([
       'csrfToken' => csrf_token(),
       'apiToken' => $currentUser->api_token ?? null,
   ]) !!};
</script>
