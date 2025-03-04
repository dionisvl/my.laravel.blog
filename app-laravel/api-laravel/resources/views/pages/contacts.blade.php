@extends('layout', ['title' => 'Contacts BWP'])

@section('content')
    <?php

    function protect($email)
    {
        $result = "";
        for ($i = 0; $i < strlen($email); $i++) $result .= "&#" . ord(substr($email, $i, 1)) . ";";
        return $result;
    }
    //echo protect("a@bc.ru");
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
                    <h1 class="new-products-title">Contacts</h1>

                    <p><strong>Our address:</strong> 10 Rustaveli Avenue, Tbilisi, Georgia</p>

                    <p>Mon-Fri 9.00 - 19.00</p>

                    <p>
                        <b>E-mail:</b>
                        <a href="mailto:<?=protect("info@" . $_SERVER['HTTP_HOST'])?>">
                            <?=protect("info@" . $_SERVER['HTTP_HOST'])?>
                        </a>
                    </p>

                    <div id="map_container" class="map container-fluid">
                        <script id="ymap_lazy" data-skip-moving="true" async=""
                                data-src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A09fb52cdf1297e9cde612f27192a2ce7671dc4dc5ae01806ce6cf9a18b719793&amp;width=1280&amp;height=400&amp;lang=ru_RU&amp;scroll=true"></script>
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
