<?php
/**
 * "About me" block.
 *
 * Static for now: the text is written here and the photo is a placeholder.
 * Both are wired to the admin later.
 *
 * @package SloDoks
 */

defined( 'ABSPATH' ) || exit;
?>

<section class="section about" aria-labelledby="about-title">
	<div class="container-grid">
		<div class="content about__inner">

			<?php // Placeholder until the real portrait is in; roughly 4:5. ?>
			<div class="about__media about__media--empty" aria-hidden="true">
				<svg class="about__placeholder" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.25">
					<circle cx="12" cy="8.5" r="3.75" />
					<path d="M4.5 20.5c0-3.6 3.4-6 7.5-6s7.5 2.4 7.5 6" stroke-linecap="round" />
				</svg>
				<span class="about__placeholder-label"><?php esc_html_e( 'Фото', 'slodoks' ); ?></span>
			</div>

			<div class="about__body">
				<p class="about__eyebrow"><?php esc_html_e( 'Обо мне', 'slodoks' ); ?></p>

				<h2 id="about-title" class="about__title">
					<?php esc_html_e( 'Помогаю переехать учиться в Словению', 'slodoks' ); ?>
				</h2>

				<div class="about__text">
					<p><?php esc_html_e( 'Я сам прошёл этот путь и знаю, как он выглядит изнутри: документы, сроки, разговоры с чиновниками на чужом языке.', 'slodoks' ); ?></p>
					<p><?php esc_html_e( 'Поэтому объясняю простыми словами, что делать дальше, и остаюсь на связи, пока вопрос не решён.', 'slodoks' ); ?></p>
				</div>

				<ul class="about__facts">
					<li><?php esc_html_e( 'Переехал в 2023 году', 'slodoks' ); ?></li>
					<li><?php esc_html_e( 'Опыт успешных переездов', 'slodoks' ); ?></li>
					<li><?php esc_html_e( 'Получилось у нас — получится и у вас', 'slodoks' ); ?></li>
				</ul>

				<div class="about__actions">
					<a class="btn btn-cta" href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">
						<?php esc_html_e( 'Запишись на бесплатную консультацию', 'slodoks' ); ?>
					</a>
				</div>
			</div>

		</div>
	</div>
</section>
