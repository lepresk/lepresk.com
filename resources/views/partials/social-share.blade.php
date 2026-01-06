<div class="flex items-center gap-3">
    <span class="text-sm font-medium text-muted-foreground">{{ __('share.title') }}:</span>

    <!-- LinkedIn -->
    <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url()->current()) }}"
       target="_blank"
       rel="noopener noreferrer"
       class="flex h-10 w-10 items-center justify-center rounded-full border border-border transition-colors hover:border-[#0077B5] hover:bg-[#0077B5] hover:text-white"
       aria-label="Share on LinkedIn">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"/><rect width="4" height="12" x="2" y="9"/><circle cx="4" cy="4" r="2"/>
        </svg>
    </a>

    <!-- Twitter/X -->
    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode(__('meta.home.title')) }}"
       target="_blank"
       rel="noopener noreferrer"
       class="flex h-10 w-10 items-center justify-center rounded-full border border-border transition-colors hover:border-black dark:hover:border-white hover:bg-black dark:hover:bg-white hover:text-white dark:hover:text-black"
       aria-label="Share on X (Twitter)">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M4 4l11.733 16h4.267l-11.733 -16z"/><path d="M4 20l6.768 -6.768m2.46 -2.46l6.772 -6.772"/>
        </svg>
    </a>

    <!-- Facebook -->
    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
       target="_blank"
       rel="noopener noreferrer"
       class="flex h-10 w-10 items-center justify-center rounded-full border border-border transition-colors hover:border-[#1877F2] hover:bg-[#1877F2] hover:text-white"
       aria-label="Share on Facebook">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
        </svg>
    </a>

    <!-- WhatsApp -->
    <a href="https://wa.me/?text={{ urlencode(__('meta.home.title') . ' - ' . url()->current()) }}"
       target="_blank"
       rel="noopener noreferrer"
       class="flex h-10 w-10 items-center justify-center rounded-full border border-border transition-colors hover:border-[#25D366] hover:bg-[#25D366] hover:text-white"
       aria-label="Share on WhatsApp">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M3 21l1.65 -3.8a9 9 0 1 1 3.4 2.9l-5.05 .9"/><path d="M9 10a.5 .5 0 0 0 1 0v-1a.5 .5 0 0 0 -1 0v1a5 5 0 0 0 5 5h1a.5 .5 0 0 0 0 -1h-1a.5 .5 0 0 0 0 1"/>
        </svg>
    </a>

    <!-- Copy Link -->
    <button onclick="navigator.clipboard.writeText('{{ url()->current() }}'); alert('{{ __('share.copied') }}')"
            class="flex h-10 w-10 items-center justify-center rounded-full border border-border transition-colors hover:border-primary hover:bg-primary hover:text-primary-foreground"
            aria-label="Copy link">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
        </svg>
    </button>
</div>
