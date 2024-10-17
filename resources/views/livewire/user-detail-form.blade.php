<div class="flex flex-col gap-4 mt-2 border-t pt-4">
	<h2 class="mb-1 text-2xl">User Details</h2>
	<div class="flex justify-between gap-6">
		<div class="flex flex-col gap-4 flex-1">
			<div class="flex flex-col gap-3">
				<label for="nik" class="block text-sm font-medium text-gray-700">NIK</label>
				<input
					wire:model="details.nik"
					type="text"
					id="nik"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				>
				@error('details.nik')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
			<div class="flex flex-col gap-3">
				<label for="date_in" class="block text-sm font-medium text-gray-700">Date In</label>
				<input
					wire:model="details.date_in"
					type="date"
					id="date_in"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				>
				@error('details.date_in')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
			<div class="flex flex-col gap-3">
				<label for="date_out" class="block text-sm font-medium text-gray-700">Date Out</label>
				<input
					wire:model="details.date_out"
					type="date"
					id="date_out"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				>
				@error('details.date_out')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
			<div class="flex flex-col gap-3">
				<label for="note" class="block text-sm font-medium text-gray-700">Note</label>
				<textarea
					wire:model="details.note"
					id="note"
					name="note"
					rows="4"
					class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				></textarea>
				@error('details.note')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
		</div>
		<div class="flex flex-col gap-4 flex-1">
			<div class="flex flex-col gap-3">
				<label for="first_name" class="block text-sm font-medium text-gray-700">First Name</label>
				<input
					wire:model="details.first_name"
					type="text"
					id="first_name"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				>
				@error('details.first_name')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
				     role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
			<div class="flex flex-col gap-3">
				<label for="last_name" class="block text-sm font-medium text-gray-700">Last Name</label>
				<input
					wire:model="details.last_name"
					type="text"
					id="last_name"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				>
				@error('details.last_name')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
				     role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
			<div class="flex flex-col gap-3">
				<label for="gender" class="block text-sm font-medium text-gray-700">Gender</label>
				<input
					wire:model="details.gender"
					type="text"
					id="gender"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				>
				@error('details.gender')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
				     role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
			<div class="flex flex-col gap-3">
				<label for="last_education" class="block text-sm font-medium text-gray-700">Last Education</label>
				<input
					wire:model="details.last_education"
					type="text"
					id="last_education"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				>
				@error('details.last_education')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
				     role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
			<div class="flex flex-col gap-3">
				<label for="date_of_birth" class="block text-sm font-medium text-gray-700">Date of Birth</label>
				<input
					wire:model="details.date_of_birth"
					type="date"
					id="date_of_birth"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				>
				@error('details.date_of_birth')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
				     role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
			<div class="flex flex-col gap-3">
				<label for="address" class="block text-sm font-medium text-gray-700">Address</label>
				<textarea
					wire:model="details.address"
					id="address"
					name="address"
					rows="4"
					class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				></textarea>
				@error('$formTextId')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
		</div>
		<div class="flex flex-col gap-4 flex-1">
			<div class="flex flex-col gap-3">
				<label for="phone" class="block text-sm font-medium text-gray-700">Phone</label>
				<input
					wire:model="details.phone"
					type="text"
					id="phone"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				>
				@error('details.phone')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
				     role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
			<div class="flex flex-col gap-3">
				<label for="religion" class="block text-sm font-medium text-gray-700">Religion</label>
				<input
					wire:model="details.religion"
					type="text"
					id="religion"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				>
				@error('details.religion')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
				     role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
			<div class="flex flex-col gap-3">
				<label for="marriage_status" class="block text-sm font-medium text-gray-700">Marriage</label>
				<input
					wire:model="details.marriage_status"
					type="text"
					id="marriage_status"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				>
				@error('details.marriage_status')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
				     role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
			<div class="flex flex-col gap-3">
				<label for="place_of_birth" class="block text-sm font-medium text-gray-700">Place of Birth</label>
				<input
					wire:model="details.place_of_birth"
					type="text"
					id="place_of_birth"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				>
				@error('details.place_of_birth')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
				     role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
			<div class="flex flex-col gap-3">
				<label for="npwp" class="block text-sm font-medium text-gray-700">NPWP</label>
				<input
					wire:model="details.npwp"
					type="text"
					id="npwp"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				>
				@error('details.npwp')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
				     role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
			<div class="flex flex-col gap-3">
				<label for="ktp" class="block text-sm font-medium text-gray-700">KTP</label>
				<input
					wire:model="details.ktp"
					type="text"
					id="ktp"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				>
				@error('details.ktp')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
				     role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
			<div class="flex flex-col gap-3">
				<label for="bank_account" class="block text-sm font-medium text-gray-700">Bank Account</label>
				<input
					wire:model="details.bank_account"
					type="text"
					id="bank_account"
					class="mt-1 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border border-gray-300 rounded-md p-2"
				>
				@error('details.bank_account')
				<div class="p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800"
				     role="alert">
					<span class="font-medium">Error!</span> {{ $message }}
				</div>
				@enderror
			</div>
		</div>
	</div>
</div>