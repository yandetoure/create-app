@props(['commentable'])

<div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
    <h3 class="text-2xl font-black mb-6 flex items-center space-x-2">
        <span>💬</span>
        <span>Commentaires</span>
    </h3>

    @if($commentable->comments && $commentable->comments->count() > 0)
        <div class="space-y-4 mb-6">
            @foreach($commentable->comments as $comment)
                <div class="bg-black/20 rounded-xl p-6">
                    <div class="flex items-start justify-between mb-3">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-indigo-600 rounded-full flex items-center justify-center font-bold">
                                {{ substr($comment->user->name, 0, 1) }}
                            </div>
                            <div>
                                <p class="font-bold">{{ $comment->user->name }}</p>
                                <p class="text-xs text-gray-500">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    </div>
                    <p class="text-gray-300">{{ $comment->content }}</p>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12 bg-black/20 rounded-xl mb-6">
            <span class="text-4xl mb-3 block">💬</span>
            <p class="text-gray-500">Aucun commentaire pour le moment</p>
        </div>
    @endif

    <!-- Comment Form -->
    <form action="{{ route('comments.store') }}" method="POST" class="bg-black/20 rounded-xl p-6">
        @csrf
        <input type="hidden" name="commentable_type" value="{{ get_class($commentable) }}">
        <input type="hidden" name="commentable_id" value="{{ $commentable->id }}">

        <textarea name="content" rows="3" required placeholder="Ajouter un commentaire..."
            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-600 mb-4"></textarea>

        <button type="submit" class="px-6 py-3 bg-indigo-600 hover:bg-indigo-700 rounded-xl font-bold transition">
            Envoyer
        </button>
    </form>
</div>