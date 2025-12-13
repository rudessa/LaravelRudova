<header style="background-color: #4a5568; color: white; padding: 15px 0; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
    <div style="max-width: 1200px; margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 0 20px;">
        <div style="display: flex; align-items: center; gap: 10px;">
            <div style="width: 40px; height: 40px; background-color: #ed8936; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 20px;">
                S
            </div>
            <h1 style="font-size: 24px; font-weight: bold;">SvetlanaApp</h1>
        </div>
        <nav>
            <ul style="list-style: none; display: flex; gap: 25px; margin: 0; padding: 0;">
                <li><a href="{{ route('home') }}" style="color: white; text-decoration: none; font-weight: 500; transition: color 0.3s;">Главная</a></li>
                <li><a href="{{ route('form.show') }}" style="color: white; text-decoration: none; font-weight: 500; transition: color 0.3s;">Форма</a></li>
                <li><a href="{{ route('data.show') }}" style="color: white; text-decoration: none; font-weight: 500; transition: color 0.3s;">Данные</a></li>
            </ul>
        </nav>
    </div>
</header>