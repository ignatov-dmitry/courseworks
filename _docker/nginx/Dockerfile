FROM nginx:latest

# Установка часового пояса
RUN ln -sf /usr/share/zoneinfo/Europe/Minsk /etc/localtime

# Установка утилиты openssl
RUN apt-get update && apt-get install -y openssl

# Создание директории для хранения сертификата
RUN mkdir /etc/nginx/ssl

# Генерация самоподписанного сертификата
#RUN openssl req -x509 -nodes -days 365 -newkey rsa:2048 -keyout /etc/nginx/ssl/key.key -out /etc/nginx/ssl/certificate.crt \
#    -subj "/CN=chat.loc/O=MyOrganization/OU=MyUnit"

EXPOSE 80
EXPOSE 443
