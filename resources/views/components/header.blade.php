<header>
    <div class="collapse bg-dark" id="navbarHeader">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-7 py-4">
                    <h4 class="text-white">О сайте</h4>
                    <p class="text-muted">Добро пожаловать на сайт о новостях со всех концов света</p>
                </div>
                <div class="col-sm-4 offset-md-1 py-4">
                    <h4 class="text-white">Навигация по сайту</h4>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('index') }}" class="text-white">На главную</a></li>
                        <li><a href="{{ route('news.index') }}" class="text-white">Все новости</a></li>
                        <li><a href="{{ route('news.categories') }}" class="text-white">Категории</a></li>
                        <li><a href="{{ route('feedback') }}" class="text-white">Обратная связь</a></li>
                        <li><a href="{{ route('order') }}" class="text-white">Заказ на выгрузку данных</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container">
            <a href="#" class="navbar-brand d-flex align-items-center">
                <strong>GeekBrains News</strong>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarHeader" aria-controls="navbarHeader" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </div>
</header>
