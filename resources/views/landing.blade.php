<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-..." crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    @vite(['resources/css/app.css'])
    @vite(['resources/css/landing.css'])
    <title>Гостевая</title>
</head>
<body>
            <header class="header">
                <nav class="navigation">
                    <div class="logo__wrap"><a href="#"><img src="./images/Logo.svg" alt="Logo"></a></div>
                    <div class="menu-burger__header">
                      <span></span>
                      <span></span>
                      <span></span>
                    </div>
                    <div class="container">
                      <ul class="ul__wrapp">
                        <li><a href="#">Экскурсии</a></li>
                        <li><a href="#">О нас</a></li>
                        <li><a href="#">Галерея</a></li>
                        <li><a href="#">Конкурсы</a></li>
                        <li><a href="#">Достопримечательности</a></li>
                        @if (Route::has('login'))
                    @auth
                        <li id="links__videl"><a href="{{ url('/user/dashboard') }}">Home</a></li>
                    @else
                        <li id="links__videl"><a href="{{ route('login') }}">Авторизация</a></li>

                        @if (Route::has('register'))
                            <li id="links__videl"><a href="{{ route('register') }}">Регистрация</a></li>
                        @endif
                    @endauth
           
            @endif
                      </ul>
                    </div>
                  </nav>
              </header>
              
            
              <div class="swiper mySwiper">
                <div class="swiper-wrapper">
                  <div class="swiper-slide">
                    <img src="{{ asset('images/6305741532.jpg') }}" />
                  </div>
                  <div class="swiper-slide">
                    <img src="{{ asset('images/SPB1.png') }}" />
                  </div>
                  <div class="swiper-slide">
                    <img src="{{ asset('images/SPB3.png') }}" />
                  </div>
                </div>
                <div class="swiper-pagination custom-pagination"></div>
              </div>


            
                  <div class="title__excursion">
                    <h1>Экскурсии</h1>
                  </div>
                  <div class="flex__container">
                        @foreach($excursions as $excursion)
                        <a href="{{ route('login') }}" style="text-decoration: none">
                            <div class="inner__col">
                                @if($excursion->photo)
                                    <img src="{{ asset('storage/' . $excursion->photo) }}" alt="{{ $excursion->title }}" 
                                         style="width: 100%; height: 100%; position: absolute; top: 0; left: 0; object-fit: cover; border-radius: 40px;">
                                @endif
                                <div class="black__description" style="position: relative; z-index: 1; background-color: rgba(0, 0, 0, 0.9); padding: 20px; border-radius: 0 0 40px 40px;">
                                    <h2>{{ $excursion->title }}</h2>
                                    <p>{{ $excursion->description }}</p>
                                    <strong>От {{ number_format($excursion->price, 0, ',', ' ') }} ₽</strong>
                                    <div class="time__ui">
                                        <div class="icon__wrap">
                                            <img src="{{ asset('images/time-ui.svg') }}" alt="time">
                                        </div>
                                        <div class="text__wrap">
                                            <p>{{ $excursion->duration }}ч.</p> 
                                        </div>
                                    </div>
                                </div>
                            </div></a>
                        @endforeach
                    </div>
                    
                </div>
            
                  <div class="button__center"><a href="{{ route('login') }}">
                  <button class="btn__excursion">Выбрать экскурсию</button></a></div>
            
                  
                      <!-- Модальное окно -->
                      @if(session('success'))
    <div class="alert alert-success" id="success-alert">
        {{ session('success') }}
        <span class="close" onclick="this.parentElement.style.display='none';">&times;</span>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" id="error-alert">
        {{ session('error') }}
        <span class="close" onclick="this.parentElement.style.display='none';">&times;</span>
    </div>
@endif


                  

                  <div class="form__wrapper">
                    <form action="{{ route('bookings.store') }}" method="POST" id="form__excursion">
                      @csrf
                      <div class="center__exc">
                          <h1>Заполнить форму <br> отправки</h1>
                      </div>
                      <div class="center__form__group">
                          <div class="wrap__form__group">
                              <div class="form__group">
                                <select name="excursion" id="excursion" required>
                                  <option data-id="1" value="">Выбрать экскурсию:</option>
                                  <option data-id="2" value="Экскурсия по Петергофу">Экскурсия по Петергофу</option>
                                  <option data-id="3" value="Экскурсия по Набережной">Экскурсия по Набережной</option>
                                  <option data-id="4" value="Экскурсия по Авроре">Экскурсия по Авроре</option>
                                  <option data-id="5" value="Экскурсия по Эрмитажу">Экскурсия по Эрмитажу</option>
                              </select>
                              
                              </div>
                              <div class="form__group">
                                  <input type="text" name="surname" id="surname" placeholder="Фамилия*" required>
                              </div>
                              <div class="form__group">
                                  <input type="text" name="name" id="name" placeholder="Имя*" required>
                              </div>
                              <div class="form__group">
                                  <input type="text" name="patronymic" id="patronomyc" placeholder="Отчество*" required>
                              </div>
                              <div class="form__group">
                                  <input type="text" name="phone" id="phone" placeholder="Номер телефона*" required>
                              </div>
                              <div class="form__group">
                                  <input type="email" name="email" id="email" placeholder="Электронная почта*" required>
                              </div>
                              <div class="form__group">
                                  <input type="date" name="date" id="date" placeholder="Дата">
                              </div>
                  
                              <div class="itog">
                                <h1 id="total-price">Итого: 0 ₽</h1>
                                <button type="submit" class="sending__bron">Забронировать</button>
                              </div>
                          </div>
                      </div>
                  </form>
                  </div>
                
            <div class="scroll-up" title="Вернуться к шапке..."><img src="{{ asset('images/arrow-up.svg') }}"></div>
                
            
            <footer class="footer">
              <div class="center__footer">
              <div class="nav__footer">
                <div class="logo__footer"><a href="#"><img src="{{ asset('images/Logo.svg') }}"></a></div>
                <ul class="footer__nav">
                  <li><a href="#">Главная</a></li>
                  <li><a href="#">Галерея</a></li>
                  <li><a href="#">Достопримечательности</a></li>
                  <li><a href="#">О нас</a></li>
                  <li><a href="#">Конкурсы</a></li>
                </ul>
                <div class="social__media__wrap">
                  <ul class="social">
                    <li><a href="#"><img src="{{ asset('images/Telegram.svg') }}" alt="Telegram"></a></li>
                    <li><a href="#"><img src="{{ asset('images/vk.svg') }}" alt="Vk"></a></li>
                  </ul>
                <div class="btn__submit">
                  <button class="sub">Отправить заявку</button>
                </div></div>
              </div></div>
            </footer>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://unpkg.com/@tailwindcss/browser@4"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js"></script>
<script src="{{ asset('js/landing.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>