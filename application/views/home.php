<div class="grid grid-cols-12" x-data="{
	  search: '',
	  show_item(el) {
		return this.search === '' || el.textContent.includes(this.search)
	  }
	}">
	<h1 class="col-span-4 text-2xl">Your Contacts</h1>
	<input type="search" class="col-span-4 col-start-9 text-gray-700 rounded px-2" x-model="search"
		   placeholder="Search..."/>
	<?php if ($message) : ?>
		<p class="col-span-12 text-green-600 bold font-lg"><?= $message ?></p>
	<?php endif ?>
	<div class="col-span-12">
		<ul role="list" class="divide-y divide-gray-100">
			<?php foreach ($people as $person): ?>
				<li class="flex justify-between gap-x-6 py-5" x-data="{ 'showModal<?= $person->id ?>': false }"
					x-show="show_item($el)">
					<div class="flex min-w-0 gap-x-4">
						<div class="min-w-0 flex-auto">
							<p class="text-sm font-semibold leading-6"><?= $person->first_name ?> <?= $person->last_name ?></p>
							<div class="grid grid-cols-12 align-items-center">
								<span class="pt-1"><?php include "icons/email.php" ?></span>
								<p class="mt-1 truncate text-xs leading-5 text-gray-300 col-span-11 pl-2"><?= $person->email_address ?></p>
								<span class="pt-1"><?php include "icons/phone.php" ?></span>
								<p class="mt-1 truncate text-xs leading-5 text-gray-300 col-span-11 pl-2"><?= $person->phone_number ?></p>
							</div>
						</div>
					</div>
					<div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
						<a href="#" @click="showModal<?= $person->id ?> = true"
						   class="text-sm leading-6 text-purple-400 hover:brightness-75 transition-all duration-300">View
							Notes</a>
						<a href="/people/edit/<?=$person->id?>"
						   class="text-sm leading-6 text-purple-400 hover:brightness-75 transition-all duration-300">Edit
							Contact</a>
						<a href="/people/delete/<?=$person->id?>"
						   class="text-sm leading-6 text-red-400 hover:brightness-75 transition-all duration-300">Delete
							Contact</a>
					</div>
					<!-- Modal -->
					<div
						class="fixed inset-0 z-30 flex items-center justify-center overflow-auto bg-black bg-opacity-50"
						x-show="showModal<?= $person->id ?>">
						<!-- Modal inner -->
						<div class="max-w-3xl px-6 py-4 mx-auto text-left bg-white rounded shadow-lg"
							 @click.away="showModal<?= $person->id ?> = false"
							 x-transition:enter="motion-safe:ease-out duration-300"
							 x-transition:enter-start="opacity-0 scale-90"
							 x-transition:enter-end="opacity-100 scale-100">
							<!-- Title / Close-->
							<div class="flex items-center justify-between text-black">
								<h5 class="mr-3 text-black max-w-none"><?= $person->first_name ?>'s Notes</h5>

								<button type="button" class="z-50 cursor-pointer"
										@click="showModal<?= $person->id ?> = false">
									<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
										 fill="none" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
											  d="M6 18L18 6M6 6l12 12"/>
									</svg>
								</button>
							</div>

							<!-- content -->
							<div class="w-96">
								<textarea cols="40" rows="10" class="p-1 w-full border-2 rounded box-shadow text-black"
										  readonly><?= $person->notes ?></textarea>
							</div>
						</div>
					</div>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
<a href="/people/add" class="flex items-center shadow-lg m-4 absolute bottom-0 right-0 rounded-full bg-purple-500 w-16 h-16 hover:brightness-75 cursor-pointer transition-all duration-300">
	<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
		 class="w-12 h-12 mx-auto">
		<path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15"/>
	</svg>
</a>
