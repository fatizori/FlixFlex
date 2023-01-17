<div style="background: url({{ asset('build/assets/img/bgimg.jpg') }}) center center / cover no-repeat;" class="min-h-screen flex flex-col sm:justify-center items-center pt-8 sm:pt-0 bg-black">


    <div class="w-full sm:max-w-md mt-6 px-14 py-14 bg-f-black2  shadow-[0px_5px_25px_0px_rgba(0,0,0,0.3)] overflow-hidden sm:rounded-lg">
        <div class="flex flex-col sm:justify-center items-center">
            {{ $logo }}
        </div>
        {{ $slot }}
    </div>
</div>
