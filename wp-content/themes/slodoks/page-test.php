<?php
/**
 * Template Name: Тест — кнопки
 *
 * Design reference page. Shows the button and link system as decided, plus
 * the alternative button hover kept in reserve.
 *
 * Applies automatically to a page with the slug "test", or can be picked in
 * the page editor.
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;

/**
 * Button variants: css class => label.
 */
const SLODOKS_TEST_BUTTONS = [
	'btn-cta'    => 'Главная',
	'btn-second' => 'Вторичная',
	'btn-white'  => 'Белая с бордером',
];

/**
 * Prints one row: resting state and disabled.
 *
 * @param string $variant Button variant class.
 * @param string $label   Human readable name.
 * @param string $extra   Extra classes, e.g. a size modifier.
 */
function slodoks_test_button_row( string $variant, string $label, string $extra = '' ): void {
	$classes = trim( 'btn ' . $variant . ' ' . $extra );
	?>
	<div class="grid gap-4 md:grid-cols-[10rem_1fr] md:items-center py-5 border-b border-line">
		<span class="text-muted text-sm"><?php echo esc_html( $label ); ?></span>

		<div class="flex flex-wrap items-center gap-4">
			<button type="button" class="<?php echo esc_attr( $classes ); ?>">
				Оценить шансы
			</button>

			<button type="button" class="<?php echo esc_attr( $classes ); ?>" disabled>
				Оценить шансы
			</button>
		</div>
	</div>
	<?php
}

get_header();
?>

<main id="primary" class="site-main">

	<section class="container-grid py-12">
		<div class="content">
			<h1>Элементы интерфейса</h1>

			<p class="mt-4 max-w-prose">
				Принятые решения: радиус кнопок 5px, наведение — градиент со
				сдвигом, заголовки Montserrat, текст DM Sans, у ссылок линия
				выезжает слева.
			</p>

			<p class="mt-2 text-muted text-sm">
				Проверь клавиатуру: <kbd>Tab</kbd> должен рисовать заметное кольцо
				фокуса вокруг каждой кнопки и ссылки.
			</p>
		</div>
	</section>

	<section class="container-grid py-8">
		<div class="content">
			<h2>Кнопки</h2>

			<div class="mt-6">
				<?php
				foreach ( SLODOKS_TEST_BUTTONS as $variant => $label ) {
					slodoks_test_button_row( $variant, $label );
				}
				?>
			</div>

			<p class="mt-6 text-muted text-sm">На сером фоне:</p>

			<div class="mt-2 bg-surface-soft rounded-xl px-6">
				<?php
				foreach ( SLODOKS_TEST_BUTTONS as $variant => $label ) {
					slodoks_test_button_row( $variant, $label );
				}
				?>
			</div>

			<p class="mt-6 text-muted text-sm">
				На тёмном фоне вторичная сливается, вместо неё контурная светлая:
			</p>

			<div class="mt-2 bg-brand-900 rounded-xl px-6">
				<?php
				slodoks_test_button_row( 'btn-cta', 'Главная' );
				slodoks_test_button_row( 'btn-white', 'Белая с бордером' );
				slodoks_test_button_row( 'btn-outline-light', 'Контурная светлая' );
				?>
			</div>
		</div>
	</section>

	<section class="container-grid py-8">
		<div class="content">
			<h2>Размеры</h2>

			<div class="mt-6">
				<?php
				slodoks_test_button_row( 'btn-cta', 'Маленькая', 'btn-sm' );
				slodoks_test_button_row( 'btn-cta', 'Обычная' );
				slodoks_test_button_row( 'btn-cta', 'Крупная', 'btn-lg' );
				?>
			</div>
		</div>
	</section>

	<section class="container-grid py-8">
		<div class="content">
			<h2>Запасное наведение: волна от курсора</h2>

			<p class="mt-2 text-muted text-sm max-w-prose">
				Класс <code>btn-wave</code>. Заливка растёт из точки, где указатель
				пересёк край кнопки. В основной раскладке не используется, оставлен
				на случай, если градиент со сдвигом надоест.
			</p>

			<div class="mt-6">
				<?php
				foreach ( SLODOKS_TEST_BUTTONS as $variant => $label ) {
					slodoks_test_button_row( $variant . ' btn-wave', $label );
				}
				?>
			</div>
		</div>
	</section>

	<section class="container-grid py-8">
		<div class="content">
			<h2>Ссылки</h2>

			<p class="mt-2 text-muted text-sm max-w-prose">
				Линия выезжает слева. В тексте из редактора, где классов нет,
				подчёркивание просто появляется при наведении.
			</p>

			<div class="mt-6 grid gap-4">
				<span>
					<a class="link" href="#">Обычная ссылка — линия выезжает слева</a>
				</span>
				<span>
					<a class="link link-dark" href="#">Тот же выезд, цвет уходит в тёмный</a>
				</span>
				<span>
					<a class="link link-cta" href="#">Ссылка-действие — цвет уходит в красный</a>
				</span>
				<span>
					<a class="link-plain" href="#">Без выезда — так ведут себя ссылки в тексте из редактора</a>
				</span>
			</div>

			<p class="mt-8 max-w-prose">
				Внутри абзаца: <a class="link" href="#">длинная ссылка, которая может перенестись на вторую строку и подчеркнуться по каждой строке отдельно</a>, а рядом <a class="link link-dark" href="#">короткая</a>.
			</p>

			<div class="mt-8 bg-brand-900 rounded-xl p-6">
				<p class="text-surface">
					На тёмном фоне: <a class="link text-surface" href="#">линия выезжает слева</a>.
				</p>
			</div>
		</div>
	</section>

	<section class="container-grid py-8">
		<div class="content">
			<h2>Типографика</h2>

			<p class="mt-2 text-muted text-sm">Заголовки Montserrat, текст DM Sans.</p>

			<p class="h1 mt-6">Помогу с переездом в Словению по учёбе</p>

			<p class="h3 mt-4">Поступление, документы, вид на жительство</p>

			<p class="mt-4 max-w-prose">
				Переехал три года назад и прошёл весь путь сам: подача документов
				в университет, нострификация диплома, запись в очередь на ВНЖ,
				налоговое резидентство и поиск личного врача. Разберём вашу
				ситуацию и составим план — от выбора программы до заселения
				в общежитие.
			</p>

			<p class="mt-3 text-sm text-muted max-w-prose">
				Мелкий текст: сноски, подписи под формами, служебные пояснения —
				osnovna šola, EMŠO, FURS, eDavki.
			</p>
		</div>
	</section>

	<section class="container-grid py-8">
		<div class="content">
			<h2>Пара кнопок в баннере</h2>

			<div class="mt-6 bg-brand-900 rounded-xl p-10">
				<p class="h3 text-surface max-w-2xl">
					Помогу с переездом в Словению по учёбе
				</p>

				<div class="mt-6 flex flex-wrap gap-4">
					<a href="#" class="btn btn-cta">Оценить шансы на поступление</a>
					<a href="#" class="btn btn-outline-light">Почитать мой опыт</a>
				</div>
			</div>
		</div>
	</section>

</main><!-- #main -->

<?php
get_footer();
