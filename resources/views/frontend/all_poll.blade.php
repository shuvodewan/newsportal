@extends('layouts.front')

@push('css')

@endpush

@section('contents')
    	<!-- Breadcrumb Area Start -->
	<div class="breadcrumb-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<ul class="pages">
						<li>
							<a href="#">
								{{__('Home')}}
							</a>
						</li>
						<li>
							<a href="#">
								{{__('News')}}
							</a>
						</li>
						<li class="active">
							<a href="#">
								{{__('Poll')}}
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<!-- Breadcrumb Area Start -->

	<!-- News Details Page Start -->
	<section class="polls-page">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="poll-area mb-4">
						<div class="header-area">
							<h4 class="title">
									<i class="fas fa-poll"></i>	{{__('Poll Result')}}
							</h4>
						</div>
                        @foreach ($polls as $poll)
						    <div class="poll-box">
                                <h4 class="title">
                                    <i class="far fa-question-circle"></i> {{$poll->question}}
								</h4>
								@php
									 $result = \App\Models\PollResult::where('poll_question_id','=',$poll->id)->get();
								@endphp
								@if (count($result)>0)
								<div class="options">
									@php
											$row = count( $result);
											$values = $result->groupBy('poll_answer_id');
											$i = 0;
											$answer = array();
											if(count($values)>0){
												foreach($values as $value){
													$answer[$i] = round((count($value)/$row)*100,2);
													$i++;
												}
											}
											$count = DB::table('poll_results')
														->select(DB::raw('COUNT(*) as total'), 'poll_answer_id')
														->groupBy('poll_question_id', 'poll_answer_id')
														->having('poll_question_id', '=',$poll->id)
														->get();
											$total_ans_count = count($count);

									@endphp

									@for($c=0; $c<$total_ans_count; $c++)
										@php
											$id = $count[$c]->poll_answer_id;
											if(!empty($id)){
												$child = \App\Models\PollAnswer::find($id)->poll_option;
											}
											$pollResults = $answer[$c];
										@endphp	
										

										<div class="single-option">
											@if ($child)
												<div class="header">
													<label>{{$child}}</label>
													<label>{{$pollResults}}%</label>
												</div>
												<div class="progress">
													<div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="{{$pollResults}}" aria-valuemin="0" aria-valuemax="{{$pollResults}}" style="width: {{ $pollResults }}%"></div>
												</div>
											@endif
										</div>
									@endfor
                                </div>
								@else 
								<div class="options">
										<div class="single-option">
											@foreach ($poll->child as $child)
												<div class="header">
													<label>{{$child->poll_option}}</label>
												</div>
											@endforeach
										</div>
                                </div>
								@endif
                                <p class="total-vot">
                                    {{__('Total Vots')}}: {{count($poll->results)}}
                                </p>
							</div>
                        @endforeach
					</div>
				</div>
				<div class="col-lg-4 aside">
					<div class="categori-widget-area">
						<div class="header-area">
							<h4 class="title">
									{{__('CATEGORIES')}}
							</h4>
						</div>
						<ul class="categori-list">
							@foreach ($categories as $category)   
                            <li>
                                <a href="{{ route('frontend.category',$category->slug)}}">
                                    <span>
                                        {{$category->title}}
                                    </span>
                                    <span>
                                        ({{$category->posts()->where('schedule_post','=',0)->where('status','=',true)->count()}})
                                    </span>
                                </a>
                            </li>
                        	@endforeach
						</ul>
					</div>
					<div class="aside-newsletter-widget mt-3 subarea">
						<h4 class="title">{{__('Newsletter')}}</h4>
						<p class="text">{{__('Subscribe to our newsletter to stay.')}}</p>
						<form action="{{ route('front.subscribers.store') }}" class="subscribe-form" method="POST" id="subForm">
							@csrf
							<input type="text" placeholder="Enter Your Email Address" name="email" class="subEmail">
							<button type="submit" class="submit subBtn">{{__('Subscribe')}}</button>
						</form>
					</div>
					<div class="celander-widget-area mt-4">
							<div id="datecalender">
							</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- News Details Page End -->
@endsection

@push('js')
<script src="{{asset('assets/front/js/notify.min.js')}}"></script>
<script src="{{asset('assets/front/js/rfront.js')}}"></script>

@endpush