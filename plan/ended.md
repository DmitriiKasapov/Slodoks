# ended.md — Отчёт о выполнении

Формат записи:
`[дата] [ID задачи] [описание] — [статус]`

---

[2026-08-02] [окружение] Docker-окружение поднято: WordPress + MySQL 8.0, порт 8002 (8001 занят другим локальным проектом). WP_DEBUG и запись в wp-content/debug.log включены, wp-content смонтирован с хоста — выполнено

[2026-08-02] [окружение] Переименование с заготовки старого проекта: compose-проект slodoks, сервисы slodoks_wp и slodoks_db, БД slodoks / slodoks_user / slodoks_pass, том slodoks_db_data. Старые тома удалены, база создана заново — выполнено

[2026-08-02] [документация] Корневой CLAUDE.md переписан под проект: миграция Laravel → WordPress с редизайном, домен slodocs.si остаётся прежним, шаблон Consal от TemplateMonster, раздел «SEO: главный приоритет проекта» с 4 правилами и чек-листом дня переезда — выполнено

[2026-08-02] [документация] CLAUDE.md внутри темы переписан: структура темы, правила (enqueue вместо хардкода тегов, экранирование вывода, a11y, i18n с доменом slodoks), ссылка на корневой SEO-раздел — выполнено

[2026-08-02] [git] Репозиторий инициализирован в корне проекта, remote https://github.com/DmitriiKasapov/Slodoks. Версионируется только свой код: тема slodoks, docker-compose.yml, mu-plugins, документация. Вне git: ядро WP, сторонние плагины, стандартные темы, uploads, debug.log, node_modules, vendor — выполнено

[2026-08-02] [git] Все служебные файлы Claude Code исключены из репозитория: CLAUDE.md, CLAUDE.local.md, AGENTS.md, .claude/, .claude.json, .mcp.json, .vscode/. Правила без слеша — работают на любом уровне вложенности. Проверено через git ls-files: 0 совпадений — выполнено

[2026-08-02] [git] links.txt добавлен в .gitignore как /links.txt — правило со слешем ловит только файл в корне — выполнено

[2026-08-02] [чистка] Удалена папка wp-content/themes/slodoks/plugins — вложенный git-репозиторий старого учебного проекта Elementor-plagin с одной заглушкой index.php. Правило игнора после удаления убрано — выполнено

[2026-08-02] [админка] Создан mu-plugin wp-content/mu-plugins/slodoks-general.php — очистка дашборда и загрузка SVG. Портирован из проекта gamestore с исправлениями: remove_meta_box() вместо unset($wp_meta_boxes), приоритет хука 100 (иначе виджеты Rank Math/Elementor ещё не зарегистрированы), убраны мёртвые id виджетов (dashboard_incoming_links удалён из ядра в 3.8; plugins/recent_comments/recent_drafts слиты в dashboard_activity), SVG разрешён только администраторам (SVG это XML, можно вложить скрипт → XSS у авторов), webp убран как поддерживаемый ядром с 5.8, CSS-селектор превью сужен до img[src$=".svg"]. Синтаксис проверен php -l в контейнере — выполнено

[2026-08-02] [окружение] WordPress установлен, админка доступна. Название сайта Slodoks, home http://localhost:8002 — выполнено

[2026-08-02] [тема] Тема slodoks активна (template и stylesheet в wp_options = slodoks), активация выполнена при установке WordPress — выполнено
