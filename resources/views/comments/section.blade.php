@props(['commentable'])

<div class="mt-8 border-t border-white/10 pt-8">
    <h3 class="text-xl font-bold mb-6">💬 Commentaires</h3>

    <!-- Comment Form -->
    <form method="POST" action="{{ route('comments.store') }}" class="mb-8">
        @csrf
        <input type="hidden" name="commentable_type" value="{{ get_class($commentable) }}">
        <input type="hidden" name="commentable_id" value="{{ $commentable->id }}">

        <div class="space-y-4">
            <textarea name="content" rows="3" required
                class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-500 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 transition"
                placeholder="Ajouter un commentaire..."></textarea>

            <div class="flex justify-end">
                <button type="submit"
                    class="px-6 py-2 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition">
                    Publier
                </button>
            </div>
        </div>
    </form>

    <!-- Comments List -->
    <div class="space-y-4">
        @forelse($commentable->comments as $comment)
            <div class="bg-white/5 border border-white/10 rounded-2xl p-6">
                <div class="flex items-start space-x-4">
                    <!-- User Avatar -->
                    <div
                        class="w-10 h-10 rounded-xl bg-indigo-600 flex items-center justify-center text-sm font-bold flex-shrink-0">
                        {{ substr($comment->user->name, 0, 1) }}
                    </div>

                    <div class="flex-1 min-w-0">
                        <!-- User Info -->
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <span class="font-bold text-white">{{ $comment->user->name }}</span>
                                <span class="text-sm text-gray-500 ml-2">{{ $comment->time_ago }}</span>
                            </div>

                            <!-- Delete Button -->
                            @if($comment->canDelete(auth()->user()))
                                <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" onclick="return confirm('Supprimer ce commentaire ?')"
                                        class="text-gray-500 hover:text-red-400 transition">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg>
                                    </button>
                                </form>
                            @endif
                        </div>

                        <!-- Comment Content -->
                        <p class="text-gray-300">{{ $comment->content }}</p>

                        <!-- Replies (if any) -->
                        @if($comment->replies->count() > 0)
                            <div class="mt-4 space-y-3 pl-4 border-l-2 border-white/10">
                                @foreach($comment->replies as $reply)
                                    <div class="flex items-start space-x-3">
                                        <div
                                            class="w-8 h-8 rounded-lg bg-gray-700 flex items-center justify-center text-xs font-bold flex-shrink-0">
                                            {{ substr($reply->user->name, 0, 1) }}
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2 mb-1">
                                                <span class="font-bold text-sm text-white">{{ $reply->user->name }}</span>
                                                <span class="text-xs text-gray-500">{{ $reply->time_ago }}</span>
                                            </div>
                                            <p class="text-sm text-gray-400">{{ $reply->content }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <div class="text-center py-12 bg-white/5 rounded-2xl border border-white/10 border-dashed">
                <svg class="w-12 h-12 mx-auto text-gray-600 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                </svg>
                <p class="text-gray-500 text-sm">Aucun commentaire pour le moment</p>
                <p class="text-gray-600 text-xs mt-1">Soyez le premier à commenter !</p>
            </div>
        @endforelse
    </div>
</div>