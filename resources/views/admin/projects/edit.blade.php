<x-dashboard-layout>
    <x-slot name="title">Modifier le Projet: {{ $project->name }}</x-slot>

    <div class="max-w-5xl mx-auto py-12">
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" class="space-y-12">
            @csrf
            @method('PUT')

            <div
                class="bg-white/5 border border-white/10 rounded-[3rem] p-12 shadow-2xl backdrop-blur-md relative overflow-hidden">
                <div class="absolute -right-20 -top-20 w-80 h-80 bg-indigo-600/5 blur-[120px] rounded-full"></div>

                <div class="flex items-center justify-between mb-12 relative">
                    <h3 class="text-3xl font-black italic tracking-tighter">Edition Rapide</h3>
                    <a href="{{ route('admin.projects.show', $project) }}"
                        class="text-[10px] font-black uppercase tracking-widest text-gray-500 hover:text-white transition">←
                        Retour aux détails</a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 relative">
                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase tracking-widest text-indigo-400 ml-2">Nom du
                            projet</label>
                        <input type="text" name="name" value="{{ $project->name }}" required
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-5 text-lg font-bold text-white focus:border-indigo-500 transition outline-none">
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase tracking-widest text-indigo-400 ml-2">Statut
                            opérationnel</label>
                        <select name="status"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-5 text-lg font-bold text-white focus:border-indigo-500 transition outline-none appearance-none">
                            @foreach(['new', 'pending', 'in_progress', 'completed', 'rejected', 'cancelled'] as $status)
                                <option value="{{ $status }}" {{ $project->status === $status ? 'selected' : '' }}
                                    class="bg-gray-900">{{ ucfirst($status) }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase tracking-widest text-indigo-400 ml-2">Développeur
                            assigné</label>
                        <select name="developer_id"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-5 text-lg font-bold text-white focus:border-indigo-500 transition outline-none appearance-none">
                            <option value="" class="bg-gray-900">Aucun</option>
                            @foreach($developers as $dev)
                                <option value="{{ $dev->id }}" {{ $project->developer_id == $dev->id ? 'selected' : '' }}
                                    class="bg-gray-900">{{ $dev->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black uppercase tracking-widest text-indigo-400 ml-2">Prix Total
                            (FCFA)</label>
                        <input type="number" name="total_price" value="{{ (int) $project->total_price }}"
                            class="w-full bg-white/5 border border-white/10 rounded-2xl px-6 py-5 text-lg font-bold text-white focus:border-indigo-500 transition outline-none">
                    </div>
                </div>

                <div class="mt-12 pt-10 border-t border-white/5 flex justify-end items-center space-x-6">
                    <p class="text-xs text-gray-500 font-bold italic">* Les modifications de prix impactent directement
                        la facturation client.</p>
                    <button type="submit"
                        class="px-12 py-5 bg-indigo-600 rounded-2xl font-black uppercase tracking-widest text-xs hover:scale-105 active:scale-95 transition shadow-xl shadow-indigo-600/30">
                        Enregistrer les modifications
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-dashboard-layout>