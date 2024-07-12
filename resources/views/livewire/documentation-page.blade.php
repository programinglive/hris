<div class="flex flex-col md:flex-row">
	<aside class="w-full md:w-1/4 bg-gray-200">
		<div class="text-lg text-white font-bold bg-blue-600 p-4">
			<a href="/">HRIS</a>
		</div>
		<nav class="bg-gray-800 hover:bg-gray-900" x-data="{ isOpen: false }">
			<a href="#" class="block py-2 px-4 text-white" @click="isOpen = !isOpen">Introduction</a>
			<div class="space-y-1 bg-gray-600 text-white" x-show="isOpen">
				<a href="#" class="block py-2 px-4 rounded hover:bg-gray-500">Guides</a>
				<a href="#" class="block py-2 px-4 rounded hover:bg-gray-500">API Reference</a>
				<a href="#" class="block py-2 px-4 rounded hover:bg-gray-500">Quickstart</a>
				<a href="#" class="block py-2 px-4 rounded hover:bg-gray-500">Authentication</a>
				<a href="#" class="block py-2 px-4 rounded hover:bg-gray-500">Pagination</a>
				<a href="#" class="block py-2 px-4 rounded hover:bg-gray-500">Errors</a>
				<a href="#" class="block py-2 px-4 rounded hover:bg-gray-500">Webhooks</a>
				<a href="#" class="block py-2 px-4 rounded hover:bg-gray-500">Business Guide</a>
				<a href="#" class="block py-2 px-4 rounded hover:bg-gray-500">Invoice Guide</a>
			</div>
		</nav>
	</aside>
	<main class="flex-1 p-8">
		<div class="bg-gra-800 p-6 rounded-lg">
			<div class="flex justify-between items-center mb-4">
				<h1 class="text-2xl font-bold">API Documentation</h1>
				<button class="bg-blue-600 px-4 py-2 rounded-lg">Quickstart →</button>
			</div>
			<div>
				<h2 class="text-xl font-semibold mb-2">Getting started</h2>
				<p class="mb-4">To get started with our API, follow these steps:</p>
				<ol class="list-decimal list-inside space-y-2">
					<li>Contact us to obtain sandbox API keys. These keys will give you access to a testing environment where you
						can experiment and develop your integration without affecting live data.
					</li>
					<li>Familiarize yourself with the documentation on how to make requests for the specific resources you need to
						access. We provide comprehensive information on the available endpoints, request/response formats,
						authentication methods, and any required parameters.
					</li>
					<li>Develop and test your integration using the sandbox environment. Ensure that your application interacts
						correctly with the API and meets your requirements.
					</li>
					<li>When you're ready to deploy your integration in a production environment, reach out to us to obtain live
						API keys. These keys will enable access to the live data and resources of our API.
					</li>
				</ol>
				<p class="mt-4">By following these steps, you can seamlessly transition from the development and testing phase
					to the live deployment of your application.</p>
				<p class="mt-2">Feel free to include any additional instructions or guidelines specific to your API and its
					usage.</p>
				<a href="#" class="text-blue-400">Get your API key →</a>
			</div>
		</div>
	</main>
</div>