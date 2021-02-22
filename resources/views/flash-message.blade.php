
	
	@if ($message = Session::get('success'))
		<div class="col-12"  style="padding: 15px">
			<div class="alert alert-success alert-dismissible fade show" role="alert">
				<p class="mb-0">
			        <strong>{{ $message }}</strong>
			    </p>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		        	<span aria-hidden="true">×</span>
		      	</button>
			</div>
		</div>
	@endif

	@if ($message = Session::get('error'))
		<div class="col-12" style="padding: 15px">
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<p class="mb-0">
			        <strong>{{ $message }}</strong>
			    </p>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		        	<span aria-hidden="true">×</span>
		      	</button>
			</div>
		</div>
	@endif

	@if ($message = Session::get('warning'))
		<div class="col-12" style="padding: 15px">
			<div class="alert alert-warning alert-dismissible fade show" role="alert">
				<p class="mb-0">
			        <strong>{{ $message }}</strong>
			    </p>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		        	<span aria-hidden="true">×</span>
		      	</button>
			</div>
		</div>
	@endif


	@if ($message = Session::get('info'))
		<div class="col-12" style="padding: 15px">
			<div class="alert alert-info alert-dismissible fade show" role="alert">
				<p class="mb-0">
			        <strong>{{ $message }}</strong>
			    </p>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		        	<span aria-hidden="true">×</span>
		      	</button>
			</div>
		</div>
	@endif


	@if ($errors->any())
	<div class="col-12" style="padding: 15px">
		<div class="alert alert-danger">
		    <button type="button" class="close" data-dismiss="alert">×</button>    
		    Please check the form below for errors
		</div>
	</div>
	@endif

</div>
                           