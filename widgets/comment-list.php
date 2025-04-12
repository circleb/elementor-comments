<?php
class Comment_List_Widget extends \Elementor\Widget_Base
{

	public function get_name()
	{
		return 'comment_list_widget';
	}

	public function get_title()
	{
		return esc_html__('Comment List', 'elementor-comments');
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
		return ['comment', 'list'];
	}
	protected function register_controls()
	{

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__(' Avatar', 'elementor-comments'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'letter_avatar',
			[
				'label' => esc_html__('Avatar', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'letter',
				'options' => [
					'default' => esc_html__('Default', 'elementor-comments'),
					'none' => esc_html__('None', 'elementor-comments'),
					'letter'  => esc_html__('Letter', 'elementor-comments'),

				],
			]
		);

		$this->end_controls_section();

		// Style Tab Start
		$this->start_controls_section(
			'section_text_style',
			[
				'label' => esc_html__('Text', 'elementor-comments'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'text_color',
			[
				'label' => esc_html__('Color', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .comment-list .author-name,{{WRAPPER}} .comment-list .comment-text,{{WRAPPER}} .comment-list .comment-date' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label' => esc_html__('Icon Color', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'return_value' => 'yes',
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label' => esc_html__('Icon Backgraund Color', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#C44966',
				'return_value' => 'yes',
			]
		);
		$this->add_control(
			'divider_color',
			[
				'label' => esc_html__('Divider Color', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#000',
				'selectors' => [
					'{{WRAPPER}} .comment,{{WRAPPER}} .comment-list > :first-child' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_author_style',
			[
				'label' => esc_html__('Avatar', 'elementor-comments'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'avatar_spacing',
			[
				'label' => esc_html__('Avatar Spacing', 'elementor-comments'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 1,
					],
				],
				'default' => [
					'size' => 10,
					'unit' => 'px',
				],
				'tablet_default' => [
					'size' => 5,
					'unit' => 'px',
				],
				'mobile_default' => [
					'size' => 2,
					'unit' => 'px',
				],
			]
		);

		$this->end_controls_section();

		// Style Tab End
	}

	public function render()
	{
		$post_id = get_the_ID();
		$settings = $this->get_settings_for_display();
		$comments = get_comments([
			'post_id' => $post_id,
			'status' => 'approve' // Only get approved comments
		]);
?>
		<div class="comment-list">
			<?php
			foreach ($comments as $comment) {
				$author_image = get_avatar($comment->comment_author_email);
				$author_name = get_comment_author($comment);
				$comment_text = get_comment_text($comment);
				$comment_date = get_comment_date('', $comment);
				$bg_color = $settings['bg_color'];
				$icon_color = $settings['icon_color'];
				$letter_avatar_url = ec_styles_get_custom_avatar_url($author_name, $bg_color, $icon_color);
				$avatar_spacing = $settings['avatar_spacing']['size'] . $settings['avatar_spacing']['unit'];

				// Output HTML with comment details
				echo "<div class='comment'>";
				if ('default' === $settings['letter_avatar']) {
					echo "<div class='author-image'>" . esc_html($author_image) . "</div>";
				} elseif ('letter' === $settings['letter_avatar']) {
					echo "<div class='author-image author-letter'><img src='" . esc_html($letter_avatar_url) . "' alt='Avatar'></div>";
				} else {
				}
				echo "<div style='margin-left: " . $avatar_spacing . "'><div class='author-name'>" . esc_html($author_name) . "</div>";
				echo "<div class='comment-text'>" . nl2br(esc_html($comment_text)) . "</div>";
				echo "<div class='comment-date'>" . esc_html($comment_date) . "</div></div>";
				echo "</div>";
			} ?></div>
<?php
	}
}
function ec_styles_get_custom_avatar_url($author_name, $bg_color, $icon_color)
{
	$bg_color_without_hash = str_replace('#', '', $bg_color);
	$color_without_hash = str_replace('#', '', $icon_color);
	$first_letter = strtoupper(substr($author_name, 0, 1));
	//Avatar make from a letter
	$avatar_url = "https://ui-avatars.com/api/?name=$first_letter&background=$bg_color_without_hash&color=$color_without_hash&length=1"; // Replace with your custom avatar API or URL

	return $avatar_url;
}
