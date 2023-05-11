@push('style')
<style>
	.breadcrumbs {
		font-size: 13px;
		margin: 0;
		padding: 0;
		list-style: none;
	}
	.breadcrumbs li {
		display: inline-block;
	}
	.breadcrumbs li a {
		color: var(--gray);
		text-decoration: none;
		transition: 0.3s color ease;
	}
	.breadcrumbs li:not(:last-child) a:after {
		content: " › ";
		font-size: 12px;
		color: var(--gray-light);
	}
	.breadcrumbs li a:hover {
		color: var(--gray-dark);
	}
</style>
@endpush

<div class="row page-title-header">
	<div class="col-12">
		<div class="page-header">
			<h4 class="page-title w-100">{{ $__page_title }}</h4>
			<div class="quick-link-wrapper w-100 d-md-flex flex-md-wrap">
				<ul class="breadcrumbs ml-auto">
					@if ($__page_title !== "Dashboard")
					<li>
						<a href="{{ route('admin.dashboard') }}">Dashboard</a>
					</li>
					<li>
						<a href="javascript:;">{{ $__page_title }}</a>
					</li>
					@endif
				</ul>
			</div>
		</div>
	</div>
</div>
