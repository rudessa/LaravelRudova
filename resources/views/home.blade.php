@extends('layouts.app')

@section('title', 'Главная - Блог')

@section('content')
<div style="max-width: 1200px; margin: 0 auto;">
    <div style="display: grid; grid-template-columns: 1fr 300px; gap: 30px;">
        
        <div>
            <h1 style="font-size: 36px; color: #2d3748; margin-bottom: 30px;">Последние статьи</h1>
            
            @if($posts->count() === 0)
                <div style="background-color: #bee3f8; border: 1px solid #4299e1; color: #2c5282; padding: 20px; border-radius: 8px;">
                    Пока нет опубликованных постов. Добавьте их через API или создайте через сидер.
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
                            <span style="padding: 10px 15px; background: #e2e8f0; color: #a0aec0; border-radius: 6px; cursor: not-allowed;">
                                Следующая →
                            </span>
                        @endif
                        
                    </div>
                @endif
            @endif
        </div>
        
        <aside>
            <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 20px;">
                <h3 style="font-size: 20px; margin: 0 0 15px 0; color: #2d3748;">Категории</h3>
                <ul style="list-style: none; padding: 0; margin: 0;">
                    @foreach($categories as $category)
                        <li style="margin-bottom: 10px;">
                            <a href="{{ route('category.show', $category->slug) }}" style="color: #4a5568; text-decoration: none; display: flex; justify-content: space-between;">
                                <span>{{ $category->name }}</span>
                                <span style="color: #a0aec0;">{{ $category->posts_count }}</span>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            
            <div style="background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                <h3 style="font-size: 20px; margin: 0 0 15px 0; color: #2d3748;">Популярные теги</h3>
                <div>
                    @foreach($popularTags as $tag)
                        <a href="{{ route('tag.show', $tag->slug) }}" style="display: inline-block; background: #edf2f7; color: #4a5568; padding: 6px 14px; border-radius: 4px; text-decoration: none; font-size: 14px; margin-right: 8px; margin-bottom: 8px;">
                            #{{ $tag->name }} ({{ $tag->posts_count }})
                        </a>
                    @endforeach
                </div>
            </div>
        </aside>
        
    </div>
</div>
@endsection