<!DOCTYPE html>
<html lang="ru">

<head>
	<meta charset="utf-8">
	<title>{{ $info->meta_title }}</title>
	<meta name="description" content="{{ $info->meta_description }}">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<link rel="shortcut icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">
	<link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon"> 

	<meta name="theme-color" content="#20003E">

	<meta property="og:title" content="{{ $info->meta_title }}">
	<meta property="og:description" content="{{ $info->meta_description }}">
	<meta property="og:type" content="website">
	<meta property="og:url" content="{{ Request::url() }}">
	<meta property="og:image" content="{{ asset($info->image) }}">

	<link rel="stylesheet" href="{{ mix('/css/main.css') }}">

	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-T6J5K8H');</script>
	<!-- End Google Tag Manager -->

</head>

<body>

<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-T6J5K8H"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<header class="head">
	<picture>
		<source srcset="{{ asset($info->image_xs) }}" media="(max-width: 575px)">
		<img src="{{ asset($info->image) }}" alt="bg img" class="head__bg">
	</picture>
	<nav class="nav">
		<div class="container align-items-center justify-content-between">
			<img src="{{ asset('images/logo.svg') }}" alt="" class="logo">
			<img src="{{ asset('images/nav_note.svg') }}" alt="no limits" class="nav-note">
		</div>
	</nav>
	<div class="container container_main justify-content-between">
		<div class="info">
			<h1 class="title">{!! $info->title !!}</h1>
			<h2 class="text">{{ $info->sub_title }}</h2>
			@if( isset($info->text) )
			<h3 class="text">{{ $info->text }}</h3>
			@endif
		</div>
		<div class="wrap">
			<h4 class="wrap__ttl">{!! $info->form_title !!}</h4>
			<form class="form form_check" autocomplete="off">
				<input type="hidden" name="title" value="{{ $info->sender_title }}">
				<label class="rline">
					<input type="text" name="name" class="input rfield" placeholder="Имя">
				</label>
				<label class="rline align-items-center">
					<p class="rline__note">+380</p>
					<input type="text" name="phone" class="input rfield phonefield" placeholder="(хх) ххх-хх-хх">
				</label>
				<label class="rline">
					<input type="text" name="email" class="input rfield" placeholder="e-mail">
				</label>
				<button type="submit" class="btn btnsubmit">{{ $info->form_btn }}</button>
				<p class="form__note">Нажимая на кнопку получить я даю согласие на обработку <a href="#" target="_blank">персональных данных</a></p>
			</form>
		</div>
	</div>
	<div class="container">
		<div class="cprt">© {{date('Y')}}. LIFTA.SPACE</div>
	</div>
	<div class="note d-none d-xl-block">{!! $info->note !!}</div>
	<div class="note d-xl-none">{!! $info->note_xs !!}</div>
</header>

<div class="d-none">
	<div id="thanks" class="thanks_checklist">
		<p class="thanks_checklist__ttl">Отлично!</p>
		<p class="thanks_checklist__txt">{{ $info->thanks_text }}</p>
		<a href="{{ $info->link }}" target="_blank" class="btn">Открыть</a>
		<p class="thanks_checklist__soc"><a href="https://t.me/LS_vmarketing_bot" target="_blank">Присоединяйся к нам в Телеграм</a> и получай больше знаний о трендах и фишках в видеомаркетинге!</p>
	</div>
</div>

<script src="{{ mix('/js/plugins.js') }}"></script>
<script src="{{ mix('/js/scripts.js') }}"></script>

</body>
</html>