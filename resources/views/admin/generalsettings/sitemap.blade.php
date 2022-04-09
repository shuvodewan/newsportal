@extends('layouts.admin')

@section('content')

<div class="content-area">
              <div class="mr-breadcrumb">
                <div class="row">
                  <div class="col-lg-12">
                      <h4 class="heading">{{ __('Sitemaps') }}</h4>
                    <ul class="links">
                      <li>
                        <a href="{{ route('admin.dashboard') }}">{{ __('Dashboard') }} </a>
                      </li>
                      <li>
                        <a href="{{ route('admin.sitemap.all') }}">{{ __('Sitemaps') }}</a>
                      </li>

                    </ul>
                  </div>
                </div>
              </div>



              <div class="product-area">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="mr-table allproduct">
                            @include('includes.admin.form-both')
                            <div class="table-responsiv">
                            <div class="gocover" style="background: url({{asset('assets/images/'.$gs->admin_loader)}}) no-repeat scroll center center rgba(45, 45, 45, 0.5);"></div>
                                    <table id="geniustable" class="table table-hover dt-responsive" cellspacing="0" width="100%">
                                        <thead>
                                            <tr>
                                                <th>{{ __('Title') }}</th>
                                                <th>{{ __('Sitemap') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </thead>
                                       <tbody>
                                            <tr>
                                                <td> {{ __('All Site Maps') }} </td>
                                                <td>{{ route('sitemap.index') }}</td>
                                                <td>
                                                <div class="action-list">
                                                    <a href="{{ route('sitemap.index') }}" target="_blank" class="btn btn-primary product-btn"><i class="fa fa-eye"></i> {{ __('View') }}</a>
                                                </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td> {{ __('Post') }} </td>
                                                <td>{{ route('sitemap.posts') }}</td>
                                                <td>
                                                  <div class="action-list">
                                                    <a href="{{ route('sitemap.posts') }}" target="_blank" class="btn btn-primary product-btn"><i class="fa fa-eye"></i> {{ __('View') }}</a>
                
                                                  </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td> {{ __('Categories') }} </td>
                                                <td>{{ route('sitemap.categories') }}</td>
                                                <td>
                                                  <div class="action-list">
                                                    <a href="{{ route('sitemap.categories') }}" target="_blank" class="btn btn-primary product-btn"><i class="fa fa-eye"></i> {{ __('View') }}</a>
                                                  </div>
                                                </td>
                                            </tr>

                                            <tr>
                                                <td> {{ __('Subcategories') }} </td>
                                                <td>{{ route('sitemap.subcategories') }}</td>
                                                <td>
                                                  <div class="action-list">
                                                    <a href="{{ route('sitemap.subcategories') }}" target="_blank" class="btn btn-primary product-btn"><i class="fa fa-eye"></i> {{ __('View') }}</a>
                                                  </div>
                                                </td>
                                            </tr>

                                      </tbody>
                                    </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection





@section('scripts')

{{-- DATA TABLE --}}

    <script type="text/javascript">

        var table = $('#geniustable').DataTable({
               ordering: false
           });
                                                                
    </script>

{{-- DATA TABLE --}}
    
@endsection   