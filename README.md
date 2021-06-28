# Тестовое задание PHP-разработчика

На любом современном PHP-фреймворке реализовать одностраничное приложение – поиск товаров по заданным тегам. На странице должны быть 2 списка с множественным выбором: какие теги должны входить, и какие не должны. После отправки поискового запроса необходимо выбрать из базы данных (MySQL, PostgreSQL) товары, удовлетворяющие заданному условию, используя SQL-запрос. Также подходящим товарам необходимо увеличить счетчик «просмотра» (поле show_count). Использование ORM при работе с базой будет преимуществом! После этого полученный список необходимо отправить в ответе как CSV-файл следующего формата: «идентификатор_товара – название_товара». Исходный код проекта выложить в открытый доступ на GitHub или Bitbucket.

База данных содержит таблицы (и примерные данные):

1. item - товары

     id | name | show_count
     --- | --- |---
    1 | Кроссовки Nike | 5 
    2|Джинсы Levi's|10
    3|Куртка NORMANN|0
    4|Футболка Adidas|1

2. tag - теги
    
    id|name
    ---|---
    1|одежда
    2|обувь
    3|стиль
    4|повседневное
    5|черное
    6|белое

3. item_tag_link – сопоставление товаров с тегами «многие-ко-многим»
    
    item_id|tag_id
    ---|---
    1|2
    1|3
    1|5
    2|1
    2|4
    3|1
    3|4
    3|6
    4|1
    4|6

**Пример**: Необходимо найти и вывести товары по включающим тегам 1 и 4 (#одежда#повседневная) и исключающему 6 (не-#белое). Выходной CSV будет:
2;“Джинсы Levi's”

## Запуск и использование

Для запуска потребуется наличие докера и докер-композа

### Команды make
команда | действие
--- | ---
init | Собирает контейнеры
up | Запускает контейнеры
down | Останавливает запущенные контейнеры

Для выполнения команды в консоли контейнера:

```bash
docker-compose run --rm <имя контейнера> <команда>
```
