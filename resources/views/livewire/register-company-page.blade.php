<div class="h-screen flex items-center justify-center">
	<div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 w-[500px]">
		<h2 class="text-xl font-semibold mb-4">Register Company</h2>
		<form wire:submit.prevent="registerCompany">
			<div class="flex flex-col gap-4">
				<div>
					<label for="company_name" class="text-gray-800 text-sm font-medium inline-block mb-2">Company Name</label>
					<input type="text" id="company_name" class="form-input">
				</div>
				<div>
					<label for="company_address" class="text-gray-800 text-sm font-medium inline-block mb-2">Address</label>
					<textarea id="company_address" class="form-input" rows="4"></textarea>
				</div>
				<div>
					<label for="company_phone" class="text-gray-800 text-sm font-medium inline-block mb-2">Phone</label>
					<input type="text" id="company_phone" class="form-input">
				</div>
				<div>
					<label for="company_email" class="text-gray-800 text-sm font-medium inline-block mb-2">Email</label>
					<input type="text" id="company_email" class="form-input">
				</div>
			</div>
			<div class="flex justify-end mt-6">
				<button type="submit" class="btn bg-primary text-white">Submit</button>
			</div>
		</form>
	</div>
</div>