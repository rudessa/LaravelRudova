@extends('layouts.app')

@section('title', 'Тег: ' . $tag->name)

@section('content')
<div style="max-width: 1200px; margin: 0 auto;">
    
    <div style="margin-bottom: 20px; color: #718096; font-size: 14px;">
        <a href="{{ route('home') }}" style="color: #4299e1; text-decoration: none;">Главная</a>
        → Тег: #{{ $tag->name }}
    </div>
    
    <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 30px;">
        <h1 style="font-size: 36px; color: #2d3748; margin: 0;">#{{ $tag->name }}</h1>
    </div>
    
    @if($posts->count() === 0)
        <div style="background-color: #bee3f8; border: 1px solid #4299e1; color: #2c5282; padding: 20px; border-radius: 8px;">
            Постов с этим тегом пока нет.
        </div>
    @else
        @foreach($posts as $post)
            <article style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 25px;">
                <h2 style="margin: 0 0 10px 0;">
                    <a href="{{ route('post.show', $post->slug) }}" style="color: #2d3748; text-decoration: none; font-size: 28px; font-weight: bold;">
                        {{ $post->title }}
                    </a>
                </h2>
                
                <div style="color: #718096; font-size: 14px; margin-bottom: 15px;">
                    <span>📅 {{ $post->published_at->format('d.m.Y') }}</span>
                    <span style="margin-left: 15px;">📁 
                        <a href="{{ route('category.show', $post->category->slug) }}" style="color: #4299e1; text-decoration: none;">
                            {{ $post->category->name }}
                        </a>
                    </span>
                    <span style="margin-left: 15px;">👁️ {{ $post->views_count }}</span>
                </div>
                
                @if($post->excerpt)
                    <p style="color: #4a5568; line-height: 1.6; margin-bottom: 15px;">
                        {{ $post->excerpt }}
                    </p>
                @endif
                
                @if($post->tags->count() > 0)
                    <div style="margin-bottom: 15px;">
                        @foreach($post->tags as $postTag)
                            <a href="{{ route('tag.show', $postTag->slug) }}" style="display: inline-block; background: #edf2f7; color: #4a5568; padding: 5px 12px; border-radius: 4px; text-decoration: none; font-size: 14px; margin-right: 8px; margin-bottom: 5px;">
                                #{{ $postTag->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
                
                <a href="{{ route('post.show', $post->slug) }}" style="color: #4299e1; text-decoration: none; font-weight: bold;">
                    Читать далее →
                </a>
            </article>
        @endforeach
        
        @if($posts->hasPages())
            <div style="margin-top: 30px; display: flex; justify-content: center; align-items: center; gap: 10px;">
                
                @if($posts->onFirstPage())
                    <span style="padding: 10px 15px; background: #e2e8f0; color: #a0aec0; border-radius: 6px; cursor: not-allowed;">
                        ← Предыдущая
                    </span>
                @else
                    <a href="{{ $posts->previousPageUrl() }}" style="padding: 10px 15px; background: #4299e1; color: white; border-radius: 6px; text-decoration: none; font-weight: bold;">
                        ← Предыдущая
                    </a>
                @endif
                
                @foreach(range(1, $posts->lastPage()) as $page)
                    @if($page == $posts->currentPage())
                        <span style="padding: 10px 15px; background: #2d3748; color: white; border-radius: 6px; font-weight: bold;">
                            {{ $page }}
                        </span>
                    @else
                        <a href="{{ $posts->url($page) }}" style="padding: 10px 15px; background: #edf2f7; color: #4a5568; border-radius: 6px; text-decoration: none;">
                            {{ $page }}
                        </a>
                    @endif
                @endforeach
                
                @if($posts->hasMorePages())
                    <a href="{{ $posts->nextPageUrl() }}" style="padding: 10px 15px; background: #4299e1; color: white; border-radius: 6px; text-decoration: none; font-weight: bold;">
                        Следующая →
                    </a>
                @else
                    <span style="padding: 10px 15px; background: #e2e8f0; color: #a0aec0; border-radius: #6px; cursor: not-allowed;">
                        Следующая →
                    </span>
                @endif
                
            </div>
        @endif
    @endif
    
</div>
@endsection