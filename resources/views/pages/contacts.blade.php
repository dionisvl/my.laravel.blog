@extends('layout', ['title' => 'Contacts BWP'])

@section('content')
    <?php
    /** Защита e-mail на сайте от спамеров */
    function protect($email)
    {
        $result = "";
        for ($i = 0; $i < strlen($email); $i++) $result .= "&#" . ord(substr($email, $i, 1)) . ";";
        return $result;
    }
    //echo protect("a@bc.ru"); // В нужном месте преобразуем и выводим e-mail
    ?>

    <style>
        .map.container-fluid {
            height: 400px;
            padding: 0;
            background-image: url(/storage/uploads/common/ymap0.png);
            background-position: center center;
            margin-bottom: 30px;
        }
    </style>

    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1 class="new-products-title">Контакты</h1>

                    <p><strong>Наш адрес:</strong> г. Москва, ул. Б. Черемушкинская, 1</p>

                    <?/*<p><strong>Телефон отдела продаж </strong>8 (916) 211-88-30</p>*/?>

                    <p>Пн-Пт 9.00 - 19.00</p>

                    <p><b>Электронный ящик:</b>
                        <a href="mailto:<?=protect("info@" . $_SERVER['HTTP_HOST'])?>">
                            <?=protect("info@" . $_SERVER['HTTP_HOST'])?>
                        </a></p>


                    <div id="map_container" class="map container-fluid">
                        <script id="ymap_lazy" data-skip-moving="true" async=""
                                data-src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A1ad4887964fc2e0a6f07c6246ffe638b138f8baacc8983f9a6a0f401a02e833a&amp;width=1280&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
                    </div>
                    <script>
                        let map_container = document.getElementById('map_container');
                        let options_map = {
                            once: true,//once start, thereafter destroy listener
                            passive: true,
                            capture: true
                        };
                        map_container.addEventListener('click', start_lazy_map, options_map);
                        map_container.addEventListener('mouseover', start_lazy_map, options_map);
                        map_container.addEventListener('touchstart', start_lazy_map, options_map);
                        map_container.addEventListener('touchmove', start_lazy_map, options_map);

                        let map_loaded = false;

                        function start_lazy_map() {
                            if (!map_loaded) {
                                let map_block = document.getElementById('ymap_lazy');
                                map_loaded = true;
                                map_block.setAttribute('src', map_block.getAttribute('data-src'));
                                map_block.removeAttribute('data_src');
                                console.log('YMAP LOADED');
                            }
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection
