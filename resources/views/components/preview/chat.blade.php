@if($isMobile)
    <div class="fixed bottom-20 right-4 z-[60]">
        <div class="bg-primary w-14 h-14 rounded-full flex items-center justify-center text-white shadow-custom pulse">
            💬
        </div>
    </div>
@else
    <div class="fixed bottom-8 right-8 z-[100] group">
        <div
            class="bg-primary text-white px-6 py-4 rounded-custom flex items-center space-x-3 shadow-custom cursor-pointer hover:opacity-90 transition">
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
            box-shadow: 0 0 0 0px var(--primary-color)44;
        }

        100% {
            box-shadow: 0 0 0 20px var(--primary-color)00;
        }
    }
</style>