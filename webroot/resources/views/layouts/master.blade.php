<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('page_title','Ford Mustangs')</title>
		@yield('metas')

		<link rel="stylesheet" href="{{ mix('/css/app.css') }}" type="text/css">
		<link rel="stylesheet" href="{{ mix('/css/build.css') }}" type="text/css">
		<link rel="apple-touch-icon" sizes="57x57" href="/images/icon/apple-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="/images/icon/apple-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="/images/icon/apple-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="/images/icon/apple-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="/images/icon/apple-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="/images/icon/apple-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="/images/icon/apple-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="/images/icon/apple-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="/images/icon/apple-icon-180x180.png">
		<link rel="icon" type="image/png" sizes="192x192"  href="/images/icon/android-icon-192x192.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/images/icon/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="96x96" href="/images/icon/favicon-96x96.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/images/icon/favicon-16x16.png">
		<link rel="manifest" href="/images/icon/manifest.json">
		<meta name="msapplication-TileColor" content="#ffffff">
		<meta name="msapplication-TileImage" content="/images/icon/ms-icon-144x144.png">
		<meta name="theme-color" content="#ffffff">
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

			ga('create', 'UA-418381-32', 'auto');
			ga('send', 'pageview');

		</script>

		<meta name="csrf-token" content="{{ csrf_token() }}">

		<script>
			window.Laravel = <?php echo json_encode([
				'csrfToken' => csrf_token(),
			]); ?>
		</script>

		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({
			google_ad_client: "ca-pub-8306229047580482",
			enable_page_level_ads: true
		});
		</script>
	</head>
	<body class="@yield('body_class','')">
		<div id="app"></div>

		<header id="header">
			<nav class="navbar navbar-inverse" role="banner">
				<div class="container">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="{{ route('home') }}"><img src="/images/ford-mustangs.png" alt="Ford Mustangs"></a>
					</div>

					<div class="collapse navbar-collapse navbar-right">
						<ul class="nav navbar-nav">
							<li class="{{ isset($request->route()->uri) && $request->route()->uri == '/'  ? 'active' : '' }}"><a href="{{ route('home') }}">Ford Mustangs</a></li>
							<li class="{{ isset($request->route()->uri) && strpos(' ' . $request->route()->uri,'mustang-gallery') ? 'active' : '' }}"><a href="{{ route('gallery') }}">Gallery</a></li>
							<li class="{{ isset($request->route()->uri) && $request->route()->uri == 'for-sale' ? 'active' : '' }}"><a href="{{ route('sales.index') }}">Mustangs For Sale</a></li>
							<li class="{{ isset($request->route()->uri) && $request->route()->uri == 'articles' ? 'active' : '' }}"><a href="{{ route('article.index') }}">Articles</a></li><!--
							--><!-- <li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Pages <i class="fa fa-angle-down"></i></a>
								<ul class="dropdown-menu">
									<li><a href="blog-item.html">Blog Single</a></li>
									<li><a href="pricing.html">Pricing</a></li>
									<li><a href="404.html">404</a></li>
									<li><a href="shortcodes.html">Shortcodes</a></li>
								</ul>
							</li> -->
							<!-- <li class="{{ isset($request->route()->uri) && $request->route()->uri == 'blog' ? 'active' : '' }}"><a href="{{ route('blog') }}">Blog</a></li> -->
							<li class="{{ isset($request->route()->uri) && $request->route()->uri == 'contact' ? 'active' : '' }}"><a href="{{ route('contact') }}">Contact</a></li>
						</ul>
					</div>
				</div><!--/.container-->
			</nav><!--/nav-->

		</header><!--/header-->

		@yield('content')

		<section id="bottom">
			<div class="container">
				<div class="row">
					<div class="col-md-3 col-sm-6">
						<div class="widget">
							<h3>Social</h3>
							<ul>
								<li>Instagram: <a href="https://instagram.com/FordMustangs_UK" target="_blank" title="View the Ford Mustangs UK Instagram pics">@FordMustangs_UK</a></li>
								<li>Twitter: <a href="https://twitter.com/FordMustangsUK" target="_blank" title="View the Ford Mustangs UK tweets">@FordMustangsUK</a></li>
								<li>Facebook: <a href="https://www.facebook.com/Fordmustangsuk" target="_blank" title="View the Ford Mustangs UK Facebook page">Ford mustangs</a></li>
							</ul>
						</div>
					</div><!--/.col-md-3-->

					<div class="col-md-3 col-sm-6">
						<div class="widget">
							<!-- <h3>Site Support</h3>
							<ul>
								<li><a href="#">Site Faqs</a></li>
								<li><a href="#">Blog</a></li>
								<li><a href="#">Forum</a></li>
							</ul> -->
						</div>
					</div><!--/.col-md-3-->

					<div class="col-md-3 col-sm-6">
						<div class="widget">
							<h3>Pages</h3>
							<ul>
								<li><a href="{{ route('gallery') }}">Gallery</a></li>
								<li><a href="{{ route('article.index') }}">Articles</a></li>
								<!-- <li><a href="{{ route('gallery') }}">For Sale</a></li>
								<li><a href="{{ route('blog') }}">Blog</a></li> -->
								<li><a href="{{ route('contact') }}">Contact</a></li>
							</ul>
						</div>
					</div><!--/.col-md-3-->

				</div>
			</div>
		</section><!--/#bottom-->

		<footer id="footer" class="midnight-blue">
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						&copy; {{ date('Y') }} <a target="_blank" href="http://www.ford-mustangs.co.uk/" title="Ford Mustangs">Ford Mustangs</a>. All Rights Reserved. Site maintained by <a href="https://www.coderstudios.com" target="_blank">Coder Studios</a>
					</div>
					<div class="col-sm-6">
						<ul class="pull-right">
							<li><a href="{{ route('home') }}">Home</a></li>
							<!--<li><a href="#">About Us</a></li>
							<li><a href="#">Faq</a></li> -->
							<li><a href="{{ route('contact') }}">Contact Us</a></li>
						</ul>
					</div>
				</div>
			</div>
		</footer><!--/#footer-->

		<script type="text/javascript" src="{{ mix('/js/app.js') }}"></script>
		<script type="text/javascript" src="{{ mix('/js/libraries.js') }}"></script>

		@yield('footer')

	</body>
</html>