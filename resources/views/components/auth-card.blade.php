<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-blue-400"  style="padding-top: 30px; padding-bottom: 30px">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-blue-500 shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div>
</div>
