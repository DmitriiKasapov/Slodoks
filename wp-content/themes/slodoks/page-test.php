<?php
/**
 * Template Name: Тест — кнопки
 *
 * Design reference page: every button variant in every state, side by side.
 * Applies automatically to a page with the slug "test", or can be picked in
 * the page editor.
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;

/**
 * Variants shown on the page: css class => label.
 */
const SLODOKS_TEST_BUTTONS = [
	'btn-cta'    => 'Главная',
	'btn-second' => 'Вторичная',
	'btn-white'  => 'Белая с бордером',
];

/**
 * Prints one row: resting state, frozen hover, disabled.
 *
 * @param string $variant Button variant class.
 * @param string $label   Human readable name.
 * @param string $extra   Extra classes, e.g. a size or shape modifier.
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
			<h1>Кнопки</h1>

			<p class="mt-4 max-w-prose">
				Три состояния в каждой строке: обычное, наведение и заблокированное.
				Наведение показано застывшим — второй элемент в ряду.
				Наведи курсор на первую кнопку, чтобы увидеть переход.
			</p>

			<p class="mt-2 text-muted text-sm">
				Проверь также клавиатуру: <kbd>Tab</kbd> должен рисовать заметное
				кольцо фокуса вокруг каждой кнопки.
			</p>
		</div>
	</section>

	<section class="container-grid py-8">
		<div class="content">
			<h2>На светлом фоне</h2>

			<div class="mt-6">
				<?php
				foreach ( SLODOKS_TEST_BUTTONS as $variant => $label ) {
					slodoks_test_button_row( $variant, $label );
				}
				?>
			</div>
		</div>
	</section>

	<section class="container-grid py-8">
		<div class="content">
			<h2>На сером фоне</h2>

			<div class="mt-6 bg-surface-soft rounded-xl px-6">
				<?php
				foreach ( SLODOKS_TEST_BUTTONS as $variant => $label ) {
					slodoks_test_button_row( $variant, $label );
				}
				?>
			</div>
		</div>
	</section>

	<section class="container-grid py-8">
		<div class="content">
			<h2>На тёмном фоне</h2>

			<p class="mt-2 text-muted text-sm">
				Так выглядит баннер. Здесь вторичная кнопка сливается с фоном —
				вместо неё берём контурную светлую.
			</p>

			<div class="mt-6 bg-brand-900 rounded-xl px-6">
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
			<h2>Варианты наведения</h2>

			<p class="mt-2 text-muted text-sm max-w-prose">
				Четыре подхода. В каждой строке слева живая кнопка — наведи курсор,
				справа то же состояние застывшим. Нажми, чтобы увидеть нажатие.
			</p>

			<?php
			$slodoks_hovers = [
				'hv-tint' => 'Тон — меняется только цвет, ничего не двигается',
				'hv-lift' => 'Подъём — кнопка приподнимается, тень в её же цвете',
				'hv-ring' => 'Кольцо — мягкая волна расходится и гаснет',
				'hv-fill'   => 'Заливка — красная темнеет, синяя светлеет',
				'hv-slide'  => 'Градиент со сдвигом — слева наезжает светлый насыщенный',
				'hv-cursor' => 'Волна от курсора — тёмный оттенок',
				'hv-cursor hv-bright' => 'Волна от курсора — светлый насыщенный оттенок',
			];

			foreach ( $slodoks_hovers as $hover => $description ) :
				?>
				<div class="mt-8">
					<p class="font-semibold"><?php echo esc_html( $description ); ?></p>

					<div class="mt-3 flex flex-wrap items-center gap-4">
						<?php foreach ( SLODOKS_TEST_BUTTONS as $variant => $label ) : ?>
							<button type="button" class="btn <?php echo esc_attr( $variant . ' ' . $hover ); ?>">
								<?php echo esc_html( $label ); ?>
							</button>
						<?php endforeach; ?>
					</div>

					<div class="mt-3 flex flex-wrap items-center gap-4 bg-brand-900 rounded-xl p-4">
						<button type="button" class="btn btn-cta <?php echo esc_attr( $hover ); ?>">
							Главная
						</button>
						<button type="button" class="btn btn-outline-light <?php echo esc_attr( $hover ); ?>">
							Контурная светлая
						</button>
					</div>
				</div>
			<?php endforeach; ?>
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
			<h2>Форма углов</h2>

			<p class="mt-2 text-muted text-sm">
				Что выберем — станет значением по умолчанию в <code>.btn</code>,
				отдельные классы уйдут.
			</p>

			<div class="mt-6">
				<?php
				slodoks_test_button_row( 'btn-cta hv-cursor', '4px', 'btn-r4' );
				slodoks_test_button_row( 'btn-cta hv-cursor', '5px', 'btn-r5' );
				slodoks_test_button_row( 'btn-cta hv-cursor', '6px', 'btn-r6' );
				slodoks_test_button_row( 'btn-cta hv-cursor', '12px — сейчас', '' );
				slodoks_test_button_row( 'btn-cta hv-cursor', 'Капсула', 'btn-pill' );
				slodoks_test_button_row( 'btn-cta hv-cursor', 'Прямая', 'btn-sharp' );
				?>
			</div>

			<p class="mt-6 text-muted text-sm">Те же радиусы на белой кнопке:</p>

			<div class="mt-2">
				<?php
				slodoks_test_button_row( 'btn-white hv-cursor', '4px', 'btn-r4' );
				slodoks_test_button_row( 'btn-white hv-cursor', '5px', 'btn-r5' );
				slodoks_test_button_row( 'btn-white hv-cursor', '6px', 'btn-r6' );
				?>
			</div>
		</div>
	</section>

	<section class="container-grid py-8">
		<div class="content">
			<h2>Ссылки</h2>

			<p class="mt-2 text-muted text-sm max-w-prose">
				Наведи на каждую. Первые три отличаются только цветом наведения,
				остальные — поведением подчёркивания.
			</p>

			<?php
			$slodoks_links = [
				'link link-light'                     => 'Цвет светлеет — как у кнопок',
				'link link-dark'                      => 'Цвет темнеет — уходит в цвет заголовков',
				'link link-cta'                       => 'Цвет уходит в красный — для ссылок-действий',
				'link link-light link-underline'      => 'Линия выезжает слева',
				'link link-light link-underline-through' => 'Линия проходит насквозь: входит слева, выходит справа',
				'link link-light link-underline-hover'   => 'Обычное подчёркивание при наведении, без выезда',
			];

			foreach ( $slodoks_links as $classes => $description ) :
				?>
				<div class="grid gap-2 md:grid-cols-[1fr_22rem] md:items-baseline py-4 border-b border-line">
					<span>
						<?php // Text sits tight against the tags: whitespace inside an inline element is part of its box, and the underline would run past the words. ?>
						<a class="<?php echo esc_attr( $classes ); ?>" href="#">Как оформить налоговое резидентство в Словении</a>
					</span>
					<span class="text-muted text-sm"><?php echo esc_html( $description ); ?></span>
				</div>
			<?php endforeach; ?>

			<p class="mt-8 max-w-prose">
				Так ссылка выглядит внутри абзаца:
				<a class="link link-light link-underline" href="#">подчёркивание выезжает</a>,
				а рядом <a class="link link-dark" href="#">ссылка без линии</a> —
				чтобы видеть, как обе ведут себя в потоке текста.
			</p>

			<div class="mt-8 bg-brand-900 rounded-xl p-6">
				<p class="text-surface">
					На тёмном фоне:
					<a class="link link-underline text-surface" href="#">подчёркивание выезжает</a>,
					<a class="link text-surface link-underline-hover" href="#">подчёркивание при наведении</a>.
				</p>
			</div>
		</div>
	</section>

	<section class="container-grid py-8">
		<div class="content">
			<h2>Пара кнопок в баннере</h2>

			<p class="mt-2 text-muted text-sm">
				Как это будет выглядеть в деле: главное действие и второстепенное
				рядом. Разница в весе читается без чтения текста.
			</p>

			<div class="mt-6 bg-brand-900 rounded-xl p-10">
				<p class="text-surface text-2xl font-montserrat font-bold max-w-2xl">
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
