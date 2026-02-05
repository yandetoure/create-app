@if($isMobile)
    <div class="fixed bottom-20 right-4 z-[60]">
        <div class="bg-green-500 w-14 h-14 rounded-full flex items-center justify-center text-white shadow-2xl pulse">
            💬
        </div>
    </div>
@else
    <div class="fixed bottom-8 right-8 z-[100] group">
        <div
            class="bg-green-500 text-white px-6 py-4 rounded-full flex items-center space-x-3 shadow-2xl cursor-pointer hover:bg-green-600 transition">
            <span class="font-bold">Contactez-nous</span>
            <span class="text-xl">💬</span>
        </div>
    </div>
@endif

<style>
    .pulse {
        animation: pulse-animation 2s infinite;
    }

    @keyframes pulse-animation {
        0% {
            box-shadow: 0 0 0 0px rgba(34, 197, 94, 0.7);
        }

        100% {
            box-shadow: 0 0 0 20px rgba(34, 197, 94, 0);
        }
    }
</style>