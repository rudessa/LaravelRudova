@extends('layouts.app')

@section('title', 'Категория: ' . $category->name)

@section('content')
<div style="max-width: 1200px; margin: 0 auto;">
    
    <div style="margin-bottom: 20px; color: #718096; font-size: 14px;">
        <a href="{{ route('home') }}" style="color: #4299e1; text-decoration: none;">Главная</a>
        → Категория: {{ $category->name }}
    </div>
    
    <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 30px;">
        <h1 style="font-size: 36px; color: #2d3748; margin: 0 0 10px 0;">{{ $category->name }}</h1>
        @if($category->description)
            <p style="color: #718096; margin: 0; font-size: 16px;">{{ $category->description }}</p>
        @endif
    </div>
    
    @if($posts->count() === 0)
        <div style="background-color: #bee3f8; border: 1px solid #4299e1; color: #2c5282; padding: 20px; border-radius: 8px;">
            В этой категории пока нет опубликованных постов.
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
                    <span style="margin-left: 15px;">👁️ {{ $post->views_count }}</span>
                </div>
                
                @if($post->excerpt)
                    <p style="color: #4a5568; line-height: 1.6; margin-bottom: 15px;">
                        {{ $post->excerpt }}
                    </p>
                @endif
                
                @if($post->tags->count() > 0)
                    <div style="margin-bottom: 15px;">
                        @foreach($post->tags as $tag)
                            <a href="{{ route('tag.show', $tag->slug) }}" style="display: inline-block; background: #edf2f7; color: #4a5568; padding: 5px 12px; border-radius: 4px; text-decoration: none; font-size: 14px; margin-right: 8px; margin-bottom: 5px;">
                                #{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                @endif
                
                <a href="{{ route('post.show', $post->slug) }}" style="color: #4299e1; text-decoration: none; font-weight: bold;">
                    Читать далее →
                </a>
            </article>
        @endforeach
        
        <div style="margin-top: 30px;">
            {{ $posts->links() }}
        </div>
    @endif
    
</div>
@endsection