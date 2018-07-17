# Тестовое задание для PHP-разработчика — Разработка API

## Описание задачи

Необходимо написать простейшее API для каталога товаров. Приложение должно содержать:
- Категории товаров
- Конкретные товары, которые принадлежат к какой-то категории (один товар может принадлежать нескольким категориям)
- Пользователей, которые могут авторизоваться

Возможные действия:
- Получение списка всех категорий
- Получение списка товаров в конкретной категории
- Авторизация пользователей
- Добавление/Редактирование/Удаление категории (для авторизованных пользователей)
- Добавление/Редактирование/Удаление товара (для авторизованных пользователей)

## Технические требования
1. Приложение должно быть написано на PHP
2. Приложение не должно быть написано с помощью какого-либо фреймворка, однако можно устанавливать для него различные пакеты через compоser
3. Результаты запросов должны быть представлены в формате JSON
4. Результат задания должен быть выложен на github, должна быть инструкция по запуску проекта. 

## Критерии оценки
- Архитектурная организация API
- Грамотное применение ООП и паттернов проектирования
- Корректная обработка внештатных ситуаций
- Код-стайл и соблюдение стандартов

# Public API

## Add user
`POST` http://localhost/user  
### Input Example

**Headers**  
- Authorization: "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJodHRwOi8vc2NoZW1hcy54bWxzb2FwLm9yZy93cy8yMDA1LzA1L2lkZW50aXR5L2NsYWltcy9uYW1lIjoic3lzQWRtaW5AcGF5dGFiLmNvbSIsImh0dHA6Ly9zY2hlbWFzLm1pY3Jvc29mdC5jb20vd3MvMjAwOC8wNi9pZGVudGl0eS9jbGFpbXMvcm9sZSI6IlN5c0FkbWluIiwiRnVsbE5hbWUiOiJTeXMgQWRtaW4iLCJVc2VyS2V5IjoiMTAwMDAwMSIsIlVzZXJJZCI6IjI0MDY3ZTlhLTkzMGQtNGMyOS04OWM4LTA4ZDU0ZGYwNWQ0ZiIsIm5iZiI6MTUxNDQ2NDkyNywiZXhwIjoxNTE0NTUxMzI3LCJpc3MiOiJQYXlUYWIuQ2xpZW50IiwiYXVkIjoiUGF5VGFiLlNlcnZlciJ9.jnokDSIBgwnvF2Vcc1hHyzLtjUOPFc7vCdznNrxgCJY"

**Body**
```json 
{
source: 1,
extension: fb,
email: test@test.com,
comments: “some comments”,
notifyMe: true,
likedItems:[ ”22493F93-E749-4D22-D5C4-08D53B13B808”, “12d2a2c2-8a58-4928-edbe-08d58e4bd03e” ]
}
```

## Get users
.........


# @todo:KerimJobs hany API lar???? Dine men goshanym barlay???? 
# Galanlaram gosha