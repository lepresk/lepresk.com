<div
    class="fixed inset-0 z-100 hidden items-center justify-center bg-background/95 backdrop-blur-xl"
    data-lightbox-overlay
    role="dialog"
    aria-modal="true"
    aria-label="Galerie d'images"
    hidden
>
    <button
        type="button"
        class="absolute right-4 top-4 z-10 flex h-11 w-11 items-center justify-center rounded-full border border-border bg-background/80 text-foreground transition-colors hover:bg-primary hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-primary"
        data-lightbox-close
        aria-label="Fermer la galerie"
    >
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
        </svg>
    </button>

    <button
        type="button"
        class="absolute left-4 z-10 flex h-11 w-11 items-center justify-center rounded-full border border-border bg-background/80 text-foreground transition-colors hover:bg-primary hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-primary md:left-8"
        data-lightbox-prev
        aria-label="Image précédente"
    >
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
        </svg>
    </button>

    <button
        type="button"
        class="absolute right-4 z-10 flex h-11 w-11 items-center justify-center rounded-full border border-border bg-background/80 text-foreground transition-colors hover:bg-primary hover:text-white focus:outline-none focus-visible:ring-2 focus-visible:ring-primary md:right-8"
        data-lightbox-next
        aria-label="Image suivante"
    >
        <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
            <path stroke-linecap="round" stroke-linejoin="round" d="m8.25 4.5 7.5 7.5-7.5 7.5" />
        </svg>
    </button>

    <figure class="flex max-h-full w-full max-w-6xl flex-col items-center gap-4 px-4 py-16" data-lightbox-figure>
        <img
            src=""
            alt=""
            class="max-h-[80vh] w-auto max-w-full rounded-xl object-contain shadow-2xl"
            data-lightbox-image
        >
        <figcaption class="flex flex-col items-center gap-1 text-center">
            <span class="text-sm text-muted-foreground" data-lightbox-caption></span>
            <span class="text-sm font-medium text-foreground" data-lightbox-counter></span>
        </figcaption>
    </figure>
</div>
