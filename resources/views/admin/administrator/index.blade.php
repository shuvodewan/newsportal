@extends('layouts.admin') 

@section('content')  
					<input type="hidden" id="headerdata" value="{{ __('Administrator') }}">
					<div class="content-area">
						<div class="mr-breadcrumb">
							<div class="row">
								<div class="col-lg-12">
										<h4 class="heading">{{ __('User') }}</h4>
										<ul class="links">
											<li>
												<a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
											</li>
											<li>
												<a href="{{ route('admin.administator.index') }}">{{ __('Manage Administrator') }}</a>
											</li>
										</ul>
								</div>
							</div>
						</div>
						<div class="product-area">
							<div class="row">
								<div class="col-lg-12">
									<div class="mr-table allproduct">
										@include('includes.admin.form-error')
    									@include('includes.admin.form-success')
										<div class="table-responsiv">
												<table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
													<thead>
														<tr>
									                        <th>{{ __('Name') }}</th>
									                        <th>{{ __('Email') }}</th>
									                        <th>{{ __('Phone') }}</th>
									                        <th>{{ __('Role') }}</th>
									                        <th>{{ __('Options') }}</th>
														</tr>
													</thead>
												</table>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

{{-- ADD / EDIT MODAL --}}

				<div class="modal fade-scale" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1" aria-hidden="true">			
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="submit-loader">
									<img  src="{{asset('assets/images/'.$gs->admin_loader)}}" alt="">
							</div>
							<div class="modal-header">
								<h5 class="modal-title"></h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">

							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Close') }}</button>
							</div>
						</div>
					</div>

				</div>

{{-- ADD / EDIT MODAL ENDS --}}


@endsection    



@section('scripts')

{{-- DATA TABLE --}}


    <script type="text/javascript">

		var table = $('#geniustable').DataTable({
			   ordering: false,
               processing: true,
               serverSide: true,
               ajax: '{{ route('admin.administator.datatables') }}',
               columns: [
                        { data: 'name', name: 'name' },
                        { data: 'email', name: 'email' },
                        { data: 'phone', name: 'phone' },
                        { data: 'role_id', name: 'role_id' },
            			{ data: 'action', searchable: false, orderable: false }

                     ],
               language : {
                	processing: '<img src="{{asset('assets/images/'.$gs->admin_loader)}}">'
                }
            });						
    </script>
    
@endsection   