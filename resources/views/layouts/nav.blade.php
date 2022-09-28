<nav class="border-b border-gray-200 bg-white" x-data="{showMenu : false}">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex">
                <div class="flex flex-shrink-0 items-center">
                    <img class="block h-8 w-auto lg:hidden"
                         src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                    <img class="hidden h-8 w-auto lg:block"
                         src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600" alt="Your Company">
                </div>
                <div class="hidden sm:-my-px sm:ml-6 sm:flex sm:space-x-8">
                    <x-menu.menu-item route="home" title="Home" />
                    <x-menu.menu-item route="recipes.overview" title="Mijn recepten" />
                </div>
            </div>
            <div class="hidden sm:ml-6 sm:flex sm:items-center">
                <div class="relative ml-3">
                    <div>
                        <x-buttons.button :href="route('recipe.create')" color="success">
                            Recept aanmaken
                        </x-buttons.button>
                    </div>
                </div>
            </div>
            <div class="-mr-2 flex items-center sm:hidden" @click.prevent="showMenu = !showMenu">
                <!-- Mobile menu button -->
                <button type="button"
                        class="inline-flex items-center justify-center rounded-md bg-white p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2"
                        aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <!--
                      Heroicon name: outline/bars-3

                      Menu open: "hidden", Menu closed: "block"
                    -->
                    <svg class="block h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                    <!--
                      Heroicon name: outline/x-mark

                      Menu open: "block", Menu closed: "hidden"
                    -->
                    <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                         stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div class="sm:hidden" id="mobile-menu" x-show="showMenu">
        <div class="space-y-1 pt-2 pb-3">
            <x-menu.menu-item route="home" title="Home" />
            <x-menu.menu-item route="recipes.overview" title="Mijn recepten" />
        </div>
    </div>
</nav>
