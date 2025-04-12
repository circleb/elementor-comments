<?php
class Comment_Form_Widget extends \Elementor\Widget_Base
{
	public function get_name()
	{
		return 'comment_form_widget';
	}

	public function get_title()
	{
		return esc_html__('Comment Form', 'elementor-comments');
	}

	public function get_icon()
	{
		return 'eicon-comments';
	}

	public function get_categories()
	{
		return ['basic'];
	}

	public function get_keywords()
	{
		return ['comment', 'form'];
	}

	protected function register_controls()
	{
		$helplink = site_url('/wp-comments-post.php');
		// Content Tab Start

		$this->start_controls_section(
			'section_title',
			[
				'label' => esc_html__('Field Placeholder Text', 'elementor-comments'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label' => esc_html__('Name Field Text', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Name*', 'elementor-comments'),
			]
		);
		$this->add_control(
			'show_email',
			[
				'label' => esc_html__('Show Email', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'description' => esc_html__('', 'elementor-comments'),
				'label_on' => esc_html__('Show', 'elementor-comments'),
				'label_off' => esc_html__('Hide', 'elementor-comments'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'comment_error_message',
			[
				'type' => \Elementor\Controls_Manager::RAW_HTML,
				'raw' => sprintf(
					/* translators: 1: Link opening tag, 2: Link closing tag. */
					esc_html__('If you want to hide email you must first go to %1$s Settings Link %2$s and uncheck "Comment author must fill out name and email" then save.', 'elementor-comments'),
					sprintf('<a href="%s" target="_blank">',  site_url() . '/wp-admin/options-discussion.php'),
					'</a>'
				),
				'content_classes' => 'elementor-panel-alert elementor-panel-alert-warning',
			]
		);
		$this->add_control(
			'email',
			[
				'label' => esc_html__('Email Field Text', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Email*', 'elementor-comments'),
			]
		);
		$this->add_control(
			'web',
			[
				'label' => esc_html__('Web Field Text', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Web', 'elementor-comments'),
			]
		);
		$this->add_control(
			'show_web',
			[
				'label' => esc_html__('Show Web', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('Show', 'elementor-comments'),
				'label_off' => esc_html__('Hide', 'elementor-comments'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->add_control(
			'comment',
			[
				'label' => esc_html__('Comment Field Text', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Comment here...', 'elementor-comments'),
			]
		);
		$this->add_control(
			'button',
			[
				'label' => esc_html__('Button Text', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('Submit', 'elementor-comments'),
			]
		);
		$this->end_controls_section();

		// Content Tab End


		// Style Tab Start

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => esc_html__('Title', 'elementor-comments'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => esc_html__('Text Color', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-field' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'border_color',
			[
				'label' => esc_html__('Border Color', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#C44966',
				'selectors' => [
					'{{WRAPPER}} .elementor-field' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'text_font_family',
			[
				'label' => esc_html__('Font Family', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::FONT,
				'default' => "'Open Sans', sans-serif",
				'selectors' => [
					'{{WRAPPER}} .elementor-field' => 'font-family: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label' => esc_html__('Button', 'elementor-comments'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label' => esc_html__('Button Text Color', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'{{WRAPPER}} .comment-form .form-submit input#submit' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_bg_color',
			[
				'label' => esc_html__('Button Backgraund Color', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#C44966',
				'selectors' => [
					'{{WRAPPER}} .comment-form .form-submit input#submit' => 'background-color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_font_family',
			[
				'label' => esc_html__('Font Family', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::FONT,
				'default' => "'Open Sans', sans-serif",
				'selectors' => [
					'{{WRAPPER}} .comment-form .form-submit input#submit' => 'font-family: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();

		// Style Tab End

	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
?>
		<form action="<?php echo esc_html(site_url('/wp-comments-post.php')); ?>" method="post" id="ast-commentform" class="comment-form ">
			<div style="margin-bottom: 10px;" class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-name elementor-col-100 elementor-field-required">
				<label for="form-field-name" class="elementor-field-label elementor-screen-only"> Imię i nazwisko* </label>
				<input size="30" type="text" name="author" id="author" class="elementor-field elementor-size-sm  elementor-field-textual" value="" placeholder="<?php echo esc_html($settings['title']); ?>" required="required" aria-required="true">
			</div>
			<?php if ('yes' === $settings['show_email']) { ?>
				<div style="margin-bottom: 10px;" class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-name elementor-col-100 elementor-field-required">
					<label for="form-field-name" class="elementor-field-label elementor-screen-only"> Email* </label>
					<input size="30" type="text" id="email" name="email" class="elementor-field elementor-size-sm  elementor-field-textual" value="" placeholder="<?php echo esc_html($settings['email']); ?>" required="required" aria-required="true">
				</div>
			<?php } ?>
			<?php if ('yes' === $settings['show_web']) { ?>
				<div style="margin-bottom: 10px;" class="elementor-field-type-text elementor-field-group elementor-column elementor-field-group-name elementor-col-100 elementor-field-required">
					<label for="form-field-name" class="elementor-field-label elementor-screen-only"> Website </label>
					<input size="30" type="text" id="url" name="url" class="elementor-field elementor-size-sm  elementor-field-textual" value="" placeholder="<?php echo esc_html($settings['web']); ?>" aria-required="true">
				</div>
			<?php } ?>
			<div style="margin-bottom: 10px;" class="elementor-field-type-textarea elementor-field-group elementor-column elementor-field-group-message elementor-col-100">
				<label for="form-field-message" class="elementor-field-label elementor-screen-only"> Treść wiadomości* </label>
				<textarea class="elementor-field-textual elementor-field  elementor-size-sm" id="comment" name="comment" rows="9" placeholder="<?php echo esc_html($settings['comment']); ?>" aria-required="true"></textarea>
			</div>
			<p class="form-submit">
				<input name="submit" type="submit" id="submit" class="submit" value="<?php echo esc_html($settings['button']); ?>"> <input type="hidden" name="comment_post_ID" class="comment_post_ID" value="<?php $post_id = get_the_ID();
																																																																																																				echo esc_html($post_id) ?>" id="comment_post_ID">
				<input type="hidden" name="comment_parent" id="comment_parent" value="0">
			</p>
		</form>
<?php
	}
}
