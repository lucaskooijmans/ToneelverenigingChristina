<?php
use App\Models\Post;
$posts = Post::orderBy('created_at', 'desc')->take(2)->get();
?>

<section class="aankondigingen">
    <div class="container">
        <h1>Recent nieuws</h1>
        <div class="items">
            @if ($posts->isEmpty())
                <p>Er is op dit moment geen nieuws...</p>
            @else
                @foreach ($posts as $post)
                    <div class="aankondiging">
                        <h1>{{ $post->title }}</h1>
                        <p class="date">Aangemaakt: {{ $post->created_at->format('j-n-Y H:i') }}</p>
                        <p class="body">{{ $post->body }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    @if ($posts->isNotEmpty())
        <div class="meerzien">
            <a href="/nieuws" tabindex="3">
                Meer
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2">
                    <path d="M0 0 L10 10 L0 20" fill="none" stroke="white" stroke-width="2" />
                </svg>
            </a>
        </div>
    @endif
</section>
