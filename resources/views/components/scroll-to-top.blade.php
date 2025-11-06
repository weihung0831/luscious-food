@props([
    'threshold' => 300, // 滾動多少像素後顯示
    'position' => 'right', // 'right' 或 'left'
])

{{-- 返回頂部按鈕 --}}
<button
    id="scroll-to-top"
    type="button"
    class="fixed bottom-8 {{ $position === 'left' ? 'left-8' : 'right-8' }} z-50 hidden items-center justify-center w-14 h-14 bg-gradient-to-br from-indigo-600 to-purple-600 text-white rounded-full shadow-lg hover:shadow-xl hover:scale-110 transition-all duration-300 group"
    aria-label="返回頂部"
>
    <svg class="w-6 h-6 transform group-hover:-translate-y-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
    </svg>
    <span class="absolute -top-12 {{ $position === 'left' ? 'left-0' : 'right-0' }} bg-gray-900 text-white text-xs px-3 py-1.5 rounded-lg opacity-0 group-hover:opacity-100 transition-opacity duration-300 whitespace-nowrap">
        返回頂部
    </span>
</button>

<script>
    (function() {
        const scrollToTopBtn = document.getElementById('scroll-to-top');
        const threshold = {{ $threshold }};

        // 監聽滾動事件
        window.addEventListener('scroll', function() {
            if (window.pageYOffset > threshold) {
                scrollToTopBtn.classList.remove('hidden');
                scrollToTopBtn.classList.add('flex');
                setTimeout(() => {
                    scrollToTopBtn.style.opacity = '1';
                }, 10);
            } else {
                scrollToTopBtn.style.opacity = '0';
                setTimeout(() => {
                    scrollToTopBtn.classList.add('hidden');
                    scrollToTopBtn.classList.remove('flex');
                }, 300);
            }
        });

        // 平滑滾動到頂部
        scrollToTopBtn.addEventListener('click', function() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // 初始設定
        scrollToTopBtn.style.opacity = '0';
        scrollToTopBtn.style.transition = 'opacity 0.3s ease-in-out';
    })();
</script>
