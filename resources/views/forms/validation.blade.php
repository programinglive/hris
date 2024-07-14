@extends('layouts.vertical', ['title' => 'Validation', 'sub_title' => 'Forms', 'mode' => $mode ?? '', 'demo' => $demo ?? ''])

@section('content')
<div class="flex flex-col gap-6">
	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">Browser defaults</h4>
				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="browserDefaultsValidation">
						<i class="mgc_eye_line text-lg"></i>
						<span class="ms-2">Code</span>
					</button>

					<button class="btn-code" data-clipboard-action="copy">
						<i class="mgc_copy_line text-lg"></i>
						<span class="ms-2">Copy</span>
					</button>
				</div>
			</div>
		</div>
		<div class="p-6">
			<form class="grid lg:grid-cols-3 gap-6">
				<div>
					<label for="validationDefault01" class="text-gray-800 text-sm font-medium inline-block mb-2">First name</label>
					<input type="text" class="form-input" id="validationDefault01" value="Mark" required>
				</div>
				<div>
					<label for="validationDefault02" class="text-gray-800 text-sm font-medium inline-block mb-2">Last name</label>
					<input type="text" class="form-input" id="validationDefault02" value="Otto" required>
				</div>
				<div>
					<label for="validationDefaultUsername" class="text-gray-800 text-sm font-medium inline-block mb-2">Username</label>
					<div class="flex items-center">
						<span class="py-2 px-3 bg-light rounded-l dark:bg-gray-700" id="inputGroupPrepend2">@</span>
						<input type="text" class="form-input rounded-l-none" id="validationDefaultUsername" aria-describedby="inputGroupPrepend2" required>
					</div>
				</div>
				<div>
					<label for="validationDefault03" class="text-gray-800 text-sm font-medium inline-block mb-2">City</label>
					<input type="text" class="form-input" id="validationDefault03" required>
				</div>
				<div>
					<label for="validationDefault04" class="text-gray-800 text-sm font-medium inline-block mb-2">State</label>
					<select class="form-select" id="validationDefault04" required>
						<option selected disabled value="">Choose...</option>
						<option>...</option>
					</select>
				</div>
				<div>
					<label for="validationDefault05" class="text-gray-800 text-sm font-medium inline-block mb-2">Zip</label>
					<input type="text" class="form-input" id="validationDefault05" required>
				</div>
				<div class="col-span-3">
					<div class="form-check">
						<input class="form-checkbox rounded" type="checkbox" value="" id="invalidCheck2" required>
						<label class="ms-1.5" for="invalidCheck2">
							Agree to terms and conditions
						</label>
					</div>
				</div>
				<div class="col-span-3">
					<button class="btn bg-primary text-white" type="submit">Submit form</button>
				</div>
			</form>

			<div id="browserDefaultsValidation" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-56">
								<code>
									&lt;form class=&quot;grid lg:grid-cols-3 gap-6&quot;&gt;
										&lt;div&gt;
											&lt;label for=&quot;validationDefault01&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;First name&lt;/label&gt;
											&lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;validationDefault01&quot; value=&quot;Mark&quot; required&gt;
										&lt;/div&gt;
										&lt;div&gt;
											&lt;label for=&quot;validationDefault02&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Last name&lt;/label&gt;
											&lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;validationDefault02&quot; value=&quot;Otto&quot; required&gt;
										&lt;/div&gt;
										&lt;div&gt;
											&lt;label for=&quot;validationDefaultUsername&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Username&lt;/label&gt;
											&lt;div class=&quot;flex items-center&quot;&gt;
												&lt;span class=&quot;py-2 px-3 bg-light rounded-l&quot; id=&quot;inputGroupPrepend2&quot;&gt;@&lt;/span&gt;
												&lt;input type=&quot;text&quot; class=&quot;form-input rounded-l-none&quot; id=&quot;validationDefaultUsername&quot; aria-describedby=&quot;inputGroupPrepend2&quot; required&gt;
											&lt;/div&gt;
										&lt;/div&gt;
										&lt;div&gt;
											&lt;label for=&quot;validationDefault03&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;City&lt;/label&gt;
											&lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;validationDefault03&quot; required&gt;
										&lt;/div&gt;
										&lt;div&gt;
											&lt;label for=&quot;validationDefault04&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;State&lt;/label&gt;
											&lt;select class=&quot;form-select&quot; id=&quot;validationDefault04&quot; required&gt;
												&lt;option selected disabled value=&quot;&quot;&gt;Choose...&lt;/option&gt;
												&lt;option&gt;...&lt;/option&gt;
											&lt;/select&gt;
										&lt;/div&gt;
										&lt;div&gt;
											&lt;label for=&quot;validationDefault05&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Zip&lt;/label&gt;
											&lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;validationDefault05&quot; required&gt;
										&lt;/div&gt;
										&lt;div class=&quot;col-span-3&quot;&gt;
											&lt;div class=&quot;form-check&quot;&gt;
												&lt;input class=&quot;form-checkbox rounded&quot; type=&quot;checkbox&quot; value=&quot;&quot; id=&quot;invalidCheck2&quot; required&gt;
												&lt;label class=&quot;ms-1.5&quot; for=&quot;invalidCheck2&quot;&gt;
													Agree to terms and conditions
												&lt;/label&gt;
											&lt;/div&gt;
										&lt;/div&gt;
										&lt;div class=&quot;col-span-3&quot;&gt;
											&lt;button class=&quot;btn bg-primary text-white&quot; type=&quot;submit&quot;&gt;Submit form&lt;/button&gt;
										&lt;/div&gt;
									&lt;/form&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<div class="flex justify-between items-center">
				<h4 class="card-title">PristineJS Validation</h4>
				<div class="flex items-center gap-2">
					<button type="button" class="btn-code" data-fc-type="collapse" data-fc-target="pristineJSValidation">
						<i class="mgc_eye_line text-lg"></i>
						<span class="ms-2">Code</span>
					</button>

					<button class="btn-code" data-clipboard-action="copy">
						<i class="mgc_copy_line text-lg"></i>
						<span class="ms-2">Copy</span>
					</button>
				</div>
			</div>
		</div>
		<div class="p-6">
			<p class="text-gray-400 text-sm mb-4">Three part must included
				<code>.form-valid, .form-group and required</code>
				element. More details about Pristine please read
				<a target="_blank" href="https://github.com/sha256/Pristine" class="text-primary">on here</a>
			</p>
			<form class="valid-form grid lg:grid-cols-3 gap-6">
				<div class="form-group">
					<label for="inputEmail4" class="text-gray-800 text-sm font-medium inline-block mb-2">Email</label>
					<input type="email" class="form-input" id="inputEmail4" required>
				</div>
				<div class="form-group">
					<label for="inputPassword4" class="text-gray-800 text-sm font-medium inline-block mb-2">Password</label>
					<input type="password" class="form-input" id="inputPassword4" required>
				</div>
				<div class="form-group">
					<label for="inputAddress" class="text-gray-800 text-sm font-medium inline-block mb-2">Address</label>
					<input type="text" class="form-input" id="inputAddress" placeholder="1234 Main St" required>
				</div>
				<div class="form-group">
					<label for="inputAddress2" class="text-gray-800 text-sm font-medium inline-block mb-2">Address 2</label>
					<input type="text" class="form-input" id="inputAddress2" placeholder="Apartment, studio, or floor" required>
				</div>
				<div class="form-group">
					<label for="inputCity" class="text-gray-800 text-sm font-medium inline-block mb-2">City</label>
					<input type="text" class="form-input" id="inputCity" required>
				</div>
				<div class="form-group">
					<label for="inputState" class="text-gray-800 text-sm font-medium inline-block mb-2">State</label>
					<select id="inputState" class="form-input" required>
						<option>Choose...</option>
						<option>...</option>
					</select>
				</div>
				<div class="form-group">
					<label for="inputZip" class="text-gray-800 text-sm font-medium inline-block mb-2">Zip</label>
					<input type="text" class="form-input" id="inputZip" required>
				</div>
				<div class="form-group col-span-3">
					<div class="form-check">
						<input class="form-checkbox rounded" type="checkbox" value="" id="checked-demo" required>
						<label class="ms-1.5" for="checked-demo">
							I agree to the Terms of Use
						</label>
					</div>
				</div>

				<div class="form-group col-span-3">
					<button type="submit" class="btn bg-primary text-white">Register Now</button>
				</div>
			</form>

			<div id="pristineJSValidation" class="hidden w-full overflow-hidden transition-[height] duration-300">
				<pre class="language-html h-56">
								<code>
									&lt;form class=&quot;valid-form grid lg:grid-cols-3 gap-6&quot;&gt;
										&lt;div class=&quot;form-group&quot;&gt;
											&lt;label for=&quot;inputEmail4&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Email&lt;/label&gt;
											&lt;input type=&quot;email&quot; class=&quot;form-input&quot; id=&quot;inputEmail4&quot; required&gt;
										&lt;/div&gt;
										&lt;div class=&quot;form-group&quot;&gt;
											&lt;label for=&quot;inputPassword4&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Password&lt;/label&gt;
											&lt;input type=&quot;password&quot; class=&quot;form-input&quot; id=&quot;inputPassword4&quot; required&gt;
										&lt;/div&gt;
										&lt;div class=&quot;form-group&quot;&gt;
											&lt;label for=&quot;inputAddress&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Address&lt;/label&gt;
											&lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;inputAddress&quot; placeholder=&quot;1234 Main St&quot; required&gt;
										&lt;/div&gt;
										&lt;div class=&quot;form-group&quot;&gt;
											&lt;label for=&quot;inputAddress2&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Address 2&lt;/label&gt;
											&lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;inputAddress2&quot; placeholder=&quot;Apartment, studio, or floor&quot; required&gt;
										&lt;/div&gt;
										&lt;div class=&quot;form-group&quot;&gt;
											&lt;label for=&quot;inputCity&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;City&lt;/label&gt;
											&lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;inputCity&quot; required&gt;
										&lt;/div&gt;
										&lt;div class=&quot;form-group&quot;&gt;
											&lt;label for=&quot;inputState&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;State&lt;/label&gt;
											&lt;select id=&quot;inputState&quot; class=&quot;form-input&quot; required&gt;
												&lt;option&gt;Choose...&lt;/option&gt;
												&lt;option&gt;...&lt;/option&gt;
											&lt;/select&gt;
										&lt;/div&gt;
										&lt;div class=&quot;form-group&quot;&gt;
											&lt;label for=&quot;inputZip&quot; class=&quot;text-gray-800 text-sm font-medium inline-block mb-2&quot;&gt;Zip&lt;/label&gt;
											&lt;input type=&quot;text&quot; class=&quot;form-input&quot; id=&quot;inputZip&quot; required&gt;
										&lt;/div&gt;
										&lt;div class=&quot;form-group col-span-3&quot;&gt;
											&lt;div class=&quot;form-check&quot;&gt;
												&lt;input class=&quot;form-checkbox rounded&quot; type=&quot;checkbox&quot; value=&quot;&quot; id=&quot;checked-demo&quot; required&gt;
												&lt;label class=&quot;ms-1.5&quot; for=&quot;checked-demo&quot;&gt;
													I agree to the Terms of Use
												&lt;/label&gt;
											&lt;/div&gt;
										&lt;/div&gt;
		
										&lt;div class=&quot;form-group col-span-3&quot;&gt;
											&lt;button type=&quot;submit&quot; class=&quot;btn bg-primary text-white&quot;&gt;Register Now&lt;/button&gt;
										&lt;/div&gt;
									&lt;/form&gt;
								</code>
							</pre>
			</div>
		</div>
	</div>
</div>
@endsection

@section('script')
    @vite(['resources/js/pages/highlight.js', 'resources/js/pages/form-validation.js'])
@endsection