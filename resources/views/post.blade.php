@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div style="max-width: 900px; margin: 0 auto;">
    
    <div style="margin-bottom: 20px; color: #718096; font-size: 14px;">
        <a href="{{ route('home') }}" style="color: #4299e1; text-decoration: none;">Главная</a>
        →
        <a href="{{ route('category.show', $post->category->slug) }}" style="color: #4299e1; text-decoration: none;">
            {{ $post->category->name }}
        </a>
        → {{ $post->title }}
    </div>
    
    <article style="background: white; padding: 40px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
        
        <h1 style="font-size: 36px; color: #2d3748; margin: 0 0 15px 0; line-height: 1.2;">
            {{ $post->title }}
        </h1>
        
        <div style="color: #718096; font-size: 14px; margin-bottom: 25px; padding-bottom: 20px; border-bottom: 2px solid #e2e8f0;">
            <span>📅 {{ $post->published_at->format('d.m.Y H:i') }}</span>
            <span style="margin-left: 20px;">📁 
                <a href="{{ route('category.show', $post->category->slug) }}" style="color: #4299e1; text-decoration: none;">
                    {{ $post->category->name }}
                </a>
            </span>
            <span style="margin-left: 20px;">👁️ {{ $post->views_count }}</span>
            <span style="margin-left: 20px;">💬 {{ $post->comments->count() }}</span>
        </div>
        
        @if($post->images->count() > 0)
            <div style="margin-bottom: 30px;">
                @foreach($post->images as $image)
                    <img src="{{ $image->url }}" alt="{{ $image->alt_text }}" style="width: 100%; border-radius: 8px; margin-bottom: 15px;">
                @endforeach
            </div>
        @endif
        
        <div style="color: #2d3748; line-height: 1.8; font-size: 16px; margin-bottom: 30px;">
            {!! nl2br(e($post->content)) !!}
        </div>
        
        @if($post->tags->count() > 0)
            <div style="padding-top: 20px; border-top: 2px solid #e2e8f0;">
                <strong style="color: #4a5568; margin-right: 10px;">Теги:</strong>
                @foreach($post->tags as $tag)
                    <a href="{{ route('tag.show', $tag->slug) }}" style="display: inline-block; background: #edf2f7; color: #4a5568; padding: 6px 14px; border-radius: 4px; text-decoration: none; font-size: 14px; margin-right: 8px; margin-bottom: 8px;">
                        #{{ $tag->name }}
                    </a>
                @endforeach
            </div>
        @endif
        
    </article>
    
    <div style="margin-top: 40px;">
        <h2 style="font-size: 28px; color: #2d3748; margin-bottom: 20px;">
            Комментарии ({{ $post->comments->count() }})
        </h2>
        
        <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 30px;">
            <h3 style="font-size: 20px; color: #2d3748; margin: 0 0 20px 0;">Оставить комментарий</h3>
            
            @if(session('success'))
                <div style="background-color: #c6f6d5; border: 1px solid #48bb78; color: #22543d; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif
            
            @if($errors->any())
                <div style="background-color: #fed7d7; border: 1px solid #f56565; color: #742a2a; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    <ul style="list-style: none; padding: 0; margin: 0;">
                        @foreach($errors->all() as $error)
                            <li style="margin-bottom: 5px;">• {{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            <form action="{{ route('comment.store', $post->slug) }}" method="POST">
                @csrf
                
                <div style="margin-bottom: 20px;">
                    <label for="author_name" style="display: block; font-weight: bold; margin-bottom: 8px; color: #2d3748;">Ваше имя:</label>
                    <input type="text" id="author_name" name="author_name" value="{{ old('author_name') }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 6px; font-size: 16px;">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="author_email" style="display: block; font-weight: bold; margin-bottom: 8px; color: #2d3748;">Email:</label>
                    <input type="email" id="author_email" name="author_email" value="{{ old('author_email') }}" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 6px; font-size: 16px;">
                </div>
                
                <div style="margin-bottom: 20px;">
                    <label for="content" style="display: block; font-weight: bold; margin-bottom: 8px; color: #2d3748;">Комментарий:</label>
                    <textarea id="content" name="content" rows="5" style="width: 100%; padding: 10px; border: 1px solid #cbd5e0; border-radius: 6px; font-size: 16px; resize: vertical;">{{ old('content') }}</textarea>
                </div>
                
                <button type="submit" style="background-color: #4299e1; color: white; padding: 12px 30px; border: none; border-radius: 8px; font-size: 16px; font-weight: bold; cursor: pointer; transition: background-color 0.3s;">
                    Отправить комментарий
                </button>
            </form>
        </div>
        
        @if($post->comments->count() > 0)
            @foreach($post->comments as $comment)
                <div style="background: white; padding: 25px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); margin-bottom: 20px;">
                    <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                        <strong style="color: #2d3748; font-size: 16px;">{{ $comment->author_name }}</strong>
                        <span style="color: #a0aec0; font-size: 14px;">{{ $comment->created_at->format('d.m.Y H:i') }}</span>
                    </div>
                    <p style="color: #4a5568; line-height: 1.6; margin: 0;">
                        {{ $comment->content }}
                    </p>
                </div>
            @endforeach
        @else
            <div style="background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 8px rgba(0,0,0,0.1); text-align: center; color: #718096;">
                Пока нет комментариев. Будьте первым!
            </div>
        @endif
    </div>
    
</div>
@endsection