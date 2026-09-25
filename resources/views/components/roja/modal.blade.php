@props([
    'id' => 'roja-modal',
    'title' => 'Modal Title',
    'maxWidth' => 'max-w-md',
])

<div id="{{ $id }}" class="hidden fixed inset-0 z-50 overflow-y-auto bg-black/60 backdrop-blur-xs flex items-center justify-center p-4 transition-all duration-300">
    <div class="relative w-full {{ $maxWidth }} bg-white rounded-3xl shadow-2xl overflow-hidden border border-white/40 transform transition-all">
        <!-- Header -->
        <div class="flex items-center justify-between px-6 py-4 bg-slate-50/80 border-b border-slate-100">
            <h3 class="text-base font-bold text-[#17283c]">{{ $title }}</h3>
            <button type="button" onclick="closeModal('{{ $id }}')" class="text-slate-400 hover:text-slate-600 p-1.5 rounded-xl hover:bg-slate-100 transition-colors">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>

        <!-- Body -->
        <div class="p-6">
            {{ $slot }}
        </div>
    </div>
</div>

<script>
if (typeof openModal === 'undefined') {
    window.openModal = function(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('hidden');
            document.body.classList.add('overflow-hidden');
        }
    };
    window.closeModal = function(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.add('hidden');
            document.body.classList.remove('overflow-hidden');
        }
    };
}
</script>
