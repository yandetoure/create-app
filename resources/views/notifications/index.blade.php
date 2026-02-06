<x-dashboard-layout>
    <x-slot name="title">Notifications</x-slot>

    <div class="space-y-8">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-3xl font-black tracking-tight">Toutes les Notifications</h2>
                <p class="text-gray-400 mt-2">Gérez vos notifications et restez informé</p>
            </div>
            @if($notifications->where('read_at', null)->count() > 0)
                <form method="POST" action="{{ route('notifications.read-all') }}">
                    @csrf
                    <button type="submit"
                        class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition">
                        Tout marquer comme lu
                    </button>
                </form>
            @endif
        </div>

        <!-- Filter Tabs -->
        <div x-data="{ filter: 'all' }" class="space-y-6">
            <div class="flex space-x-2 p-1 bg-white/5 rounded-2xl border border-white/10 w-fit">
                <button @click="filter = 'all'"
                    :class="filter === 'all' ? 'bg-indigo-600 text-white' : 'text-gray-400 hover:text-white'"
                    class="px-6 py-2 rounded-xl font-bold text-sm transition">
                    Toutes ({{ $notifications->count() }})
                </button>
                <button @click="filter = 'unread'"
                    :class="filter === 'unread' ? 'bg-yellow-600 text-white' : 'text-gray-400 hover:text-white'"
                    class="px-6 py-2 rounded-xl font-bold text-sm transition">
                    Non lues ({{ $notifications->where('read_at', null)->count() }})
                </button>
                <button @click="filter = 'read'"
                    :class="filter === 'read' ? 'bg-gray-600 text-white' : 'text-gray-400 hover:text-white'"
                    class="px-6 py-2 rounded-xl font-bold text-sm transition">
                    Lues ({{ $notifications->whereNotNull('read_at')->count() }})
                </button>
            </div>

            <!-- Notifications List -->
            <div class="space-y-3">
                @forelse($notifications as $notification)
                    <div x-show="filter === 'all' || (filter === 'unread' && {{ $notification->isUnread() ? 'true' : 'false' }}) || (filter === 'read' && {{ $notification->isUnread() ? 'false' : 'true' }})"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 transform scale-95"
                        x-transition:enter-end="opacity-100 transform scale-100"
                        class="bg-white/5 border border-white/10 rounded-2xl p-6 hover:border-indigo-500/30 transition {{ $notification->isUnread() ? 'bg-indigo-600/5 border-indigo-500/20' : '' }}">
                        <div class="flex items-start justify-between">
                            <div class="flex items-start space-x-4 flex-1">
                                <span class="text-3xl">{{ $notification->icon }}</span>
                                <div class="flex-1">
                                    <p
                                        class="text-base {{ $notification->isUnread() ? 'font-bold text-white' : 'text-gray-400' }}">
                                        {{ $notification->message }}
                                    </p>
                                    <p class="text-sm text-gray-500 mt-2">
                                        {{ $notification->created_at->diffForHumans() }}
                                        <span class="mx-2">•</span>
                                        {{ $notification->created_at->format('d/m/Y à H:i') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center space-x-2">
                                @if($notification->isUnread())
                                    <form method="POST" action="{{ route('notifications.read', $notification->id) }}">
                                        @csrf
                                        <button type="submit"
                                            class="px-4 py-2 bg-indigo-600/20 text-indigo-400 hover:bg-indigo-600 hover:text-white rounded-xl text-sm font-bold transition">
                                            Marquer comme lu
                                        </button>
                                    </form>
                                @endif

                                @if($notification->url && $notification->url !== '#')
                                    <a href="{{ $notification->url }}"
                                        class="px-4 py-2 bg-white/5 text-gray-400 hover:bg-white/10 hover:text-white rounded-xl text-sm font-bold transition">
                                        Voir
                                    </a>
                                @endif

                                <form method="POST" action="{{ route('notifications.destroy', $notification->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-gray-500 hover:text-red-400 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20 bg-white/5 rounded-[2rem] border border-white/5 border-dashed">
                        <svg class="w-16 h-16 mx-auto text-gray-500 mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                        <p class="text-gray-500 italic">Aucune notification pour le moment.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if($notifications->hasPages())
                <div class="mt-6">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </div>
</x-dashboard-layout>