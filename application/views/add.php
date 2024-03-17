<div class="grid grid-cols-12">
	<h1 class="col-span-6 md:col-span-4 text-2xl">Add a New Person</h1>
	<a href="/" class="col-span-3 md:col-span-1 col-start-10 md:col-start-12 rounded p-2 bg-purple-500 shadow-lg hover:brightness-75 transition-all duration-300 text-center">Go Back</a>
	<div class="col-span-12 mt-6">
		<?php echo form_open('people/add', ['class' => 'grid grid-cols-12 gap-2']); ?>
			<div class="mb-5 col-span-6">
				<label for="first_name" class="block mb-2 text-sm font-medium text-white">First Name</label>
				<input type="text" name="first_name" class="border text-sm rounded-lg block w-full p-2.5 bg-white border-gray-600 text-gray-800 focus:ring-purple-500 focus:border-purple-500" required />
				<?php if (form_error('first_name')) : ?><p class="mt-2 text-sm text-red-500"><span class="font-bold">Oops!</span> <?= form_error('first_name') ?></p> <?php endif; ?>
			</div>
			<div class="mb-5 col-span-6">
				<label for="last_name" class="block mb-2 text-sm font-medium text-white">Last Name</label>
				<input type="text" name="last_name" class="border text-sm rounded-lg block w-full p-2.5 bg-white border-gray-600 text-gray-800 focus:ring-purple-500 focus:border-purple-500" required />
				<?php if (form_error('last_name')) : ?><p class="mt-2 text-sm text-red-500"><span class="font-bold">Oops!</span> <?= form_error('last_name') ?></p> <?php endif; ?>
			</div>
			<div class="mb-5 col-span-6">
				<label for="email_address" class="block mb-2 text-sm font-medium text-white">Email Address</label>
				<input type="email" name="email_address" class="border text-sm rounded-lg block w-full p-2.5 bg-white border-gray-600 text-gray-800 focus:ring-purple-500 focus:border-purple-500" required />
				<?php if (form_error('email_address')) : ?><p class="mt-2 text-sm text-red-500"><span class="font-bold">Oops!</span> <?= form_error('email_address') ?></p> <?php endif; ?>
			</div>
			<div class="mb-5 col-span-6">
				<label for="phone_number" class="block mb-2 text-sm font-medium text-white">Phone Number</label>
				<input type="tel" name="phone_number" class="border text-sm rounded-lg block w-full p-2.5 bg-white border-gray-600 text-gray-800 focus:ring-purple-500 focus:border-purple-500" required />
				<?php if (form_error('phone_number')) : ?><p class="mt-2 text-sm text-red-500"><span class="font-bold">Oops!</span> <?= form_error('phone_number') ?></p> <?php endif; ?>
			</div>
			<div class="mb-5 col-span-12">
				<label for="notes" class="block mb-2 text-sm font-medium text-white">Notes</label>
				<textarea name="notes" rows="6" class="block p-2.5 w-full text-sm text-gray-800 bg-white rounded-lg border border-gray-300 focus:ring-purple-500 focus:border-purple-500" placeholder="Notes..."></textarea>
			</div>
			<button type="submit" class="col-span-2 text-white bg-purple-500 hover:brightness-75 focus:ring-4 focus:outline-none focus:ring-purple-300 font-medium rounded w-full sm:w-auto px-5 py-2.5 text-center transition-all duration-300">Save</button>
		</form>
	</div>
</div>
