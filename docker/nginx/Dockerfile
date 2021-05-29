FROM nginx

# подменим дефолтный default.conf на наш кастомный
ADD ./default.conf /etc/nginx/conf.d/default.conf
# создадим папки в дефолтовой структуре nginx, если их нет.
RUN mkdir -p /etc/nginx/sites-available
RUN mkdir -p /etc/nginx/sites-enabled

# прокидываем конфиг сайта
ADD ./phpqa.conf /etc/nginx/sites-available/phpqa.conf
RUN ln -s /etc/nginx/sites-available/phpqa.conf /etc/nginx/sites-enabled/


#RUN nginx -s reload

WORKDIR /var/www