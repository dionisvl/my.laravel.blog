@extends('layout')

@section('content')
    <div class="main-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">


                    <h1 class="new-products-title">Контакты</h1>

                    <p><strong>Наш адрес </strong>г. Москва, ул. Б. Черемушкинская, 1 стр.2</p>

                    <?/*<p><strong>Телефон отдела продаж </strong>8 (916) 211-88-30</p>*/?>

                    <p>Пн-Пт 9.00 - 19.00</p>

                    <p>Электронный ящик:</p>

                    <table border="0" cellpadding="0" cellspacing="0" width="147">
                        <colgroup>
                            <col width="147">
                        </colgroup>
                        <tbody>
                        <tr height="20">
                            <?
                            /** Защита e-mail на сайте от спамеров */
                            function protect($email)
                            {
                                $result = "";
                                for ($i = 0; $i < strlen($email); $i++) $result .= "&#" . ord(substr($email, $i, 1)) . ";";
                                return $result;
                            }
                            //echo protect("a@bc.ru"); // В нужном месте преобразуем и выводим e-mail
                            ?>
                            <td class="xl65" height="20" style="height:15.0pt;width:110pt" width="147">
                                <a href="mailto:<?=protect("info@") . $_SERVER['HTTP_HOST']?>">
                                    <?=protect("info@") . $_SERVER['HTTP_HOST']?>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection