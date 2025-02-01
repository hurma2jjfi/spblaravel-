$(document).ready(function() {
  var swiper = new Swiper(".mySwiper", {
      spaceBetween: 30,
      effect: "fade", // Основной эффект
      fadeEffect: {
          crossFade: true
      },
      speed: 800, // Увеличенная скорость для более плавных переходов
      pagination: {
          el: ".swiper-pagination.custom-pagination",
          clickable: true,
          dynamicBullets: true, // Динамические точки
      },
      navigation: {
          nextEl: '.swiper-button-next', // Кнопка "Следующий"
          prevEl: '.swiper-button-prev', // Кнопка "Предыдущий"
      },
      autoplay: {
          delay: 3000,
          disableOnInteraction: false 
      },
      watchOverflow: true,
      observer: true,
      observeParents: true,
      preloadImages: false,
      
      // Добавление дополнительных эффектов
      on: {
          init: function() {
              console.log('Swiper initialized');
          },
          slideChangeTransitionStart: function() {
              console.log('Slide change started');
          },
          slideChangeTransitionEnd: function() {
              console.log('Slide change ended');
          }
      },
  });
});





  
    const items = document.querySelectorAll(".accordion button");
  
    function toggleAccordion() {
      const itemToggle = this.getAttribute('aria-expanded');
      
      for (i = 0; i < items.length; i++) {
        items[i].setAttribute('aria-expanded', 'false');
      }
      
      if (itemToggle == 'false') {
        this.setAttribute('aria-expanded', 'true');
      }
    }
    
    items.forEach(item => item.addEventListener('click', toggleAccordion));
    
  
    document.addEventListener('DOMContentLoaded', function() {
      const burger = document.querySelector('.menu-burger__header');
      const menu = document.querySelector('.container');
    
      burger.addEventListener('click', function() {
        burger.classList.toggle('open-menu');
      });
    });
    
  
  // Анимация заголовка экскурсий
  gsap.from('.title__excursion', {
    duration: 1,
    y: 100,
    opacity: 0,
    delay: 0.5
  });
  
  // Анимация контейнера с экскурсиями
  gsap.from('.flex__container', {
    duration: 1,
    y: 100,
    opacity: 0,
    delay: 1
  });
  
  // Анимация кнопки выбора экскурсии
  gsap.from('.button__center', {
    duration: 1,
    y: 100,
    opacity: 0,
    delay: 1.5
  });
  
  // Анимация формы
  gsap.from('#form__excursion', {
    duration: 1,
    y: 100,
    opacity: 0,
    delay: 2
  });
  
  // Анимация футера
  gsap.from('.footer', {
    duration: 1,
    y: 100,
    opacity: 0,
    delay: 2.5
  });
  
  
  
  gsap.from('.swiper-slide', {
    duration: 1,
    x: -20, // Начальное положение по вертикали (выше экрана)
    opacity: 0, // Начальная прозрачность
    stagger: 0.2, // Задержка между анимациями слайдов
    ease: 'power2.inOut', // Тип плавности анимации
  });
  
  
  $(document).ready(function() {
    const scroller = $('.scroll-up');
  
    $(window).scroll(function() {
      if ($(window).scrollTop() > 0) {
        scroller.show();
      } else {
        scroller.hide();
      }
    });
  
    scroller.click(function(event) {
      event.preventDefault();
      $('html, body').animate({ scrollTop: 0 }, 'slow');
    });
  });
  
  
  
  document.addEventListener("DOMContentLoaded", function() {
    const successAlert = document.getElementById('success-alert');
    const errorAlert = document.getElementById('error-alert');

    if (successAlert) {
        setTimeout(() => {
            successAlert.classList.add('hide');
            setTimeout(() => {
                successAlert.style.display = 'none'; 
            }, 500); 
        }, 3000); 
    }

    if (errorAlert) {
        setTimeout(() => {
            errorAlert.classList.add('hide');
            setTimeout(() => {
                errorAlert.style.display = 'none'; 
            }, 500); 
        }, 3000); 
    }
});

  

class ExcursionPriceUpdater {
  constructor(selectElementId, priceElementId) {
      this.selectElement = document.getElementById(selectElementId); // Элемент <select>
      this.priceElement = document.getElementById(priceElementId); // Элемент для отображения цены

      if (!this.selectElement || !this.priceElement) {
          throw new Error('Не удалось найти элементы select или price');
      }

      this.init();
  }

  // Инициализация обработчиков событий
  init() {
      this.selectElement.addEventListener('change', (event) => this.handleSelectionChange(event));
  }

  // Обработка изменения выбора
  handleSelectionChange(event) {
      const selectedOption = event.target.options[event.target.selectedIndex]; // Получаем выбранный элемент
      const excursionId = selectedOption.getAttribute('data-id'); // Получаем значение data-id

      if (excursionId) {
          this.fetchPrice(excursionId);
      } else {
          this.updatePrice(0); // Сброс цены, если ничего не выбрано
      }
  }

  // Запрос цены на сервер
  fetchPrice(excursionId) {
      const xhr = new XMLHttpRequest();
      xhr.open('GET', `/excursion-price/${excursionId}`, true);

      xhr.onload = () => {
          if (xhr.status === 200) {
              const data = JSON.parse(xhr.responseText); // Парсим JSON-ответ
              this.updatePrice(data.price); // Обновляем цену
          } else {
              console.error(`Ошибка при получении цены: ${xhr.status}`);
              alert('Ошибка при получении цены.');
          }
      };

      xhr.onerror = () => {
          console.error('Ошибка сети при выполнении запроса.');
          alert('Ошибка сети. Проверьте соединение.');
      };

      xhr.send();
  }

  // Обновление текста с ценой
  updatePrice(price) {
      this.priceElement.textContent = `Итого: ${price} ₽`;
  }
}

// Инициализация класса после загрузки DOM
document.addEventListener('DOMContentLoaded', function () {
  try {
      new ExcursionPriceUpdater('excursion', 'total-price');
  } catch (error) {
      console.error(error.message);
  }
});




