@extends('layouts.vertical', ['title' => 'Animation', 'sub_title' => 'Extended', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('css')
<!-- Animation css -->
@vite(['node_modules/animate.css/animate.min.css',
 'node_modules/animate.css/animate.compat.css',])
@endsection

@section('content')
<div class="grid grid-cols-1 gap-6">
	<div class="card">

		<div class="p-6">
			<h4 class="header-title">CSS3 Animation</h4>

			<p class="sub-header">
				Just-add-water CSS animations.
			</p>

			<div class="flex justify-center">
				<div id="animationSandbox">
					<img src="/images/macbook.png" alt="" class="block mx-auto">
				</div>
			</div>


			<div class="flex w-1/2 mx-auto justify-center items-center gap-2 mt-4">

				<select class="form-select js--animations">
					<optgroup label="Attention Seekers">
						<option class="animate__bounce">bounce</option>
						<option class="animate__flash">flash</option>
						<option class="animate__flash">pulse</option>
						<option class="animate__rubberBand">rubberBand</option>
						<option class="animate__shakeX">shakeX</option>
						<option class="animate__shakeY">shakeY</option>
						<option class="animate__headShake">headShake</option>
						<option class="animate__swing">swing</option>
						<option class="animate__tada">tada</option>
						<option class="animate__wobble">wobble</option>
						<option class="animate__jello">jello</option>
						<option class="animate__heartBeat">heartBeat</option>
					</optgroup>

					<optgroup label="Back entrances">
						<option class="animate__backInDown">backInDown</option>
						<option class="animate__backInLeft">backInLeft</option>
						<option class="animate__backInRight">backInRight</option>
						<option class="animate__backInUp">backInUp</option>
					</optgroup>

					<optgroup label="Back exits">
						<option class="animate__backOutDown">backOutDown</option>
						<option class="animate__backOutLeft">backOutLeft</option>
						<option class="animate__backOutRight">backOutRight</option>
						<option class="animate__backOutUp">backOutUp</option>
					</optgroup>

					<optgroup label="Bouncing entrances">
						<option class="animate__bounceIn">bounceIn</option>
						<option class="animate__bounceInDown">bounceInDown</option>
						<option class="animate__bounceInLeft">bounceInLeft</option>
						<option class="animate__bounceInRight">bounceInRight</option>
						<option class="animate__bounceInUp">bounceInUp</option>
					</optgroup>

					<optgroup label="Bouncing exits">
						<option class="animate__bounceOut">bounceOut</option>
						<option class="animate__bounceOutDown">bounceOutDown</option>
						<option class="animate__bounceOutLeft">bounceOutLeft</option>
						<option class="animate__bounceOutRight">bounceOutRight</option>
						<option class="animate__bounceOutUp">bounceOutUp</option>
					</optgroup>

					<optgroup label="Fading Entrances">
						<option class="animate__fadeIn">fadeIn</option>
						<option class="animate__fadeInDown">fadeInDown</option>
						<option class="animate__fadeInDownBig">fadeInDownBig</option>
						<option class="animate__fadeInLeft">fadeInLeft</option>
						<option class="animate__fadeInLeftBig">fadeInLeftBig</option>
						<option class="animate__fadeInRight">fadeInRight</option>
						<option class="animate__fadeInRightBig">fadeInRightBig</option>
						<option class="animate__fadeInUp">fadeInUp</option>
						<option class="animate__fadeInUpBig">fadeInUpBig</option>
						<option class="animate__fadeInTopLeft">fadeInTopLeft</option>
						<option class="animate__fadeInTopRight">fadeInTopRight</option>
						<option class="animate__fadeInBottomLeft">fadeInBottomLeft</option>
						<option class="animate__fadeInBottomRight">fadeInBottomRight</option>
					</optgroup>

					<optgroup label="Fading Exits">
						<option class="animate__fadeOut">fadeOut</option>
						<option class="animate__fadeOutDown">fadeOutDown</option>
						<option class="animate__fadeOutDownBig">fadeOutDownBig</option>
						<option class="animate__fadeOutLeft">fadeOutLeft</option>
						<option class="animate__fadeOutLeftBig">fadeOutLeftBig</option>
						<option class="animate__fadeOutRight">fadeOutRight</option>
						<option class="animate__fadeOutRightBig">fadeOutRightBig</option>
						<option class="animate__fadeOutUp">fadeOutUp</option>
						<option class="animate__fadeOutUpBig">fadeOutUpBig</option>
						<option class="animate__fadeOutTopLeft">fadeOutTopLeft</option>
						<option class="animate__fadeOutTopRight">fadeOutTopRight</option>
						<option class="animate__fadeOutBottomRight">fadeOutBottomRight</option>
						<option class="animate__fadeOutBottomLeft">fadeOutBottomLeft</option>
					</optgroup>

					<optgroup label="Flippers">
						<option class="animate__flip">flip</option>
						<option class="animate__flipInX">flipInX</option>
						<option class="animate__flipInY">flipInY</option>
						<option class="animate__flipOutX">flipOutX</option>
						<option class="animate__flipOutY">flipOutY</option>
					</optgroup>

					<optgroup label="Lightspeed">
						<option class="animate__lightSpeedInRight">lightSpeedInRight</option>
						<option class="animate__lightSpeedInLeft">lightSpeedInLeft</option>
						<option class="animate__lightSpeedOutRight">lightSpeedOutRight</option>
						<option class="animate__lightSpeedOutLeft">lightSpeedOutLeft</option>
					</optgroup>

					<optgroup label="Rotating Entrances">
						<option class="animate__rotateIn">rotateIn</option>
						<option class="animate__rotateInDownLeft">rotateInDownLeft</option>
						<option class="animate__rotateInDownRight">rotateInDownRight</option>
						<option class="animate__rotateInUpLeft">rotateInUpLeft</option>
						<option class="animate__rotateInUpRight">rotateInUpRight</option>
					</optgroup>

					<optgroup label="Rotating Exits">
						<option class="animate__rotateOut">rotateOut</option>
						<option class="animate__rotateOutDownLeft">rotateOutDownLeft</option>
						<option class="animate__rotateOutDownRight">rotateOutDownRight</option>
						<option class="animate__rotateOutUpLeft">rotateOutUpLeft</option>
						<option class="animate__rotateOutUpRight">rotateOutUpRight</option>
					</optgroup>

					<optgroup label="Specials">
						<option class="animate__hinge">hinge</option>
						<option class="animate__jackInTheBox">jackInTheBox</option>
						<option class="animate__rollIn">rollIn</option>
						<option class="animate__rollOut">rollOut</option>
					</optgroup>

					<optgroup label="Sliding Entrances">
						<option class="animate__slideInDown">slideInDown</option>
						<option class="animate__slideInLeft">slideInLeft</option>
						<option class="animate__slideInRight">slideInRight</option>
						<option class="animate__slideInUp">slideInUp</option>
					</optgroup>

					<optgroup label="Sliding exits">
						<option class="animate__slideOutDown">slideOutUp</option>
						<option class="animate__slideOutLeft">slideOutDown</option>
						<option class="animate__slideOutRight">slideOutLeft</option>
						<option class="animate__slideOutUp">slideOutRight</option>

					</optgroup>

					<optgroup label="Zooming entrances">
						<option class="animate__zoomIn">zoomIn</option>
						<option class="animate__zoomInDown">zoomInDown</option>
						<option class="animate__zoomInLeft">zoomInLeft</option>
						<option class="animate__zoomInRight">zoomInRight</option>
						<option class="animate__zoomInUp">zoomInUp</option>
					</optgroup>

					<optgroup label="Zooming exits">
						<option class="animate__zoomOut">zoomOut</option>
						<option class="animate__zoomOutDown">zoomOutDown</option>
						<option class="animate__zoomOutLeft">zoomOutLeft</option>
						<option class="animate__zoomOutRight">zoomOutRight</option>
						<option class="animate__zoomOutUp">zoomOutUp</option>
					</optgroup>
				</select>

				<button class="grow w-44 rounded-md bg-indigo-600 border border-transparent py-2 px-3 text-sm font-semibold leading-5 text-white hover:bg-indigo-500 js--triggerAnimation" type="button">Animate Me !</button>
			</div>

		</form>
	</div>
</div>
@endsection

@section('script')
<!-- Animate.css Demo Component js -->
@vite(['resources/js/pages/extended-animation.js'])

@vite(['resources/js/pages/highlight.js'])
@endsection