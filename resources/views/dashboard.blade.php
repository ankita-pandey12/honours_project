<x-app-layout>


    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Simplified content without excessive boxes or shadows -->
            <div class="text-white text-2xl text-center p-6">
                {{ __("You're logged in!") }}
            </div>
        </div>

        <!-- Single gradient section for action -->
        <div class="mt-6 p-6 bg-gradient-to-r from-purple-400 via-pink-500 to-red-500 rounded-lg text-white text-center">
            <p class="text-2xl">
                Start managing your tasks and making progress today.
            </p>
        </div>
    </div>
</x-app-layout>