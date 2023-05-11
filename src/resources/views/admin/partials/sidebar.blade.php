<nav class="sidebar sidebar-offcanvas" id="sidebar">
	<ul class="nav">
		<li class="nav-item">
			<a class="nav-link" href="{{ route('admin.dashboard') }}">
				<i class="material-icons-outlined">dashboard</i>
				<span class="menu-title">Dashboard</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('admin.products.list') }}">
				<i class="material-icons-outlined">shopping_basket</i>
				<span class="menu-title">Products</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('admin.banners') }}">
				<i class="material-icons-outlined">image</i>
				<span class="menu-title">Banner</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('admin.brands.list') }}">
				<i class="material-icons-outlined">verified</i>
				<span class="menu-title">Brands</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('admin.categories.list') }}">
				<i class="material-icons-outlined">category</i>
				<span class="menu-title">Categories</span>
			</a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="{{ route('admin.orders.list') }}">
				<i class="material-icons-outlined">widgets</i>
				<span class="menu-title">Orders</span>
			</a>
		</li>
	</ul>
</nav>
