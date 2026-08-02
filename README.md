# WordPress boilerplate

Заготовка сайта на WordPress: Docker для локальной разработки, кастомная тема
с ручными PHP-шаблонами, сборка на Vite + Tailwind CSS v4.

Без конструкторов страниц — вся вёрстка пишется руками.

## Требования

- Docker с Docker Compose v2
- Node.js 20.11 или новее (нужен `import.meta.dirname` в конфиге Vite)

## Запуск

```bash
# 1. Поднять окружение
docker compose up -d

# 2. Собрать ассеты темы
cd wp-content/themes/slodoks
npm install
npm run build
```

Открыть http://localhost:8002 и пройти установку WordPress.

После установки:

1. **Внешний вид → Темы** — активировать тему.
2. **Настройки → Постоянные ссылки** — выбрать «Название записи» и сохранить.
   Обязательный шаг: на «простых» ссылках несуществующие адреса отдают 200
   вместо 404.

## Разработка

Команды выполняются из папки темы `wp-content/themes/slodoks`:

| Команда | Что делает |
|---|---|
| `npm run dev` | Dev-сервер Vite с HMR, правки видны без перезагрузки |
| `npm run build` | Сборка в `dist/` |

Пока `npm run dev` работает, в папке темы лежит файл `.vite-hot`, и тема
берёт ассеты с dev-сервера. Останавливается dev-сервер — файл удаляется,
тема переключается на `dist/`.

**Перед заливкой на хостинг всегда `npm run build`.** Папка `dist/`
коммитится в репозиторий, потому что на обычном хостинге нет Node.

## Структура

```
docker-compose.yml        окружение: WordPress + MySQL
.htaccess                 правила ЧПУ, примонтирован в контейнер
plan/                     планы проекта: global.md, work.md, ended.md
wp-content/
  mu-plugins/             логика уровня сайта, не отключается из админки
  themes/slodoks/
    functions.php         только константы и подключение модулей из inc/
    inc/                  setup.php, enqueue.php, template-tags.php
    template-parts/       переиспользуемые куски вывода
    src/                  исходники: css/ (base, utilities, components), js/
    dist/                 сборка Vite, коммитится
```

**Куда что писать.** Критерий — переживёт ли это смену темы:

- логика сайта (правки админки, типы записей, разрешённые типы файлов) →
  `mu-plugins/`;
- внешний вид (подключение ассетов, меню, размеры изображений, хелперы
  вывода) → `inc/` темы.

## Новый проект из этой заготовки

1. Переименовать папку темы `wp-content/themes/slodoks`. Конфиг Vite берёт
   имя из названия папки, править его не нужно.
2. Заменить префикс `slodoks_` в PHP-коде темы и mu-plugin, а также text
   domain `'slodoks'` на свой.
3. Обновить шапку `wp-content/themes/<тема>/style.css`: Theme Name, Theme URI,
   Description, Text Domain.
4. В `docker-compose.yml` заменить имя проекта, имена сервисов, базы и
   пользователя. Проверить, что порт `8002` свободен.
5. Заменить `screenshot.png`.
6. Почистить `plan/` под новый проект.

## Локальное окружение

- Сайт: http://localhost:8002
- База: `slodoks` / `slodoks_user` / `slodoks_pass`
- `WP_DEBUG` включён, ошибки пишутся в `wp-content/debug.log`
- `WP_ENVIRONMENT_TYPE=local` — от этого зависит, доверяет ли тема маркеру
  dev-сервера Vite
- Ядро WordPress живёт внутри контейнера, с хоста смонтирован только
  `wp-content` и `.htaccess`

## Что не версионируется

Ядро WordPress, сторонние плагины, стандартные темы, `uploads`, `debug.log`,
`node_modules`, `.vite-hot`.
