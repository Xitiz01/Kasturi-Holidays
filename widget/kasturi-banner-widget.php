<?php
/**
 * Kasturi Banner Widget
 *
 * @package Kasturi
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

/**
 * Kasturi Banner Widget Class
 */
class Kasturi_Banner_Widget extends \Elementor\Widget_Base {

    /**
     * Get widget name.
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'kasturi_banner';
    }

    /**
     * Get widget title.
     *
     * @return string Widget title.
     */
    public function get_title() {
        return esc_html__('Kasturi Banner', 'kadence-child');
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-banner';
    }

    /**
     * Get widget categories.
     *
     * @return array Widget categories.
     */
    public function get_categories() {
        return ['basic'];
    }

    /**
     * Get widget keywords.
     *
     * @return array Widget keywords.
     */
    public function get_keywords() {
        return ['banner', 'slider', 'carousel', 'kasturi'];
    }
    
    // public function get_script_depends() {
    //     return [
    //         'kadence-child-swiper-bundle',
    //     ];
    // }
    // public function get_style_depends() {
    //     return [
    //         'kadence-child-swiper',
    //         'kadence-child-banner-widget'
    //     ];
    // }

    /**
     * Register widget controls.
     */
    protected function register_controls() {
        // Content Section
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'kadence-child'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'slide_title',
            [
                'label' => esc_html__('Title', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Driving Excellence In Every Business Sector', 'kadence-child'),
                'label_block' => true,
            ]
        );

        $repeater->add_control(
            'slide_description',
            [
                'label' => esc_html__('Description', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => esc_html__('We aim to deliver quality training and academic programs related with Financial Institutions in the region.', 'kadence-child'),
            ]
        );

        $repeater->add_control(
            'slide_image',
            [
                'label' => esc_html__('Background Image', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Image_Size::get_type(),
            [
                'name' => 'slide_image',
                'default' => 'large',
                'separator' => 'none',
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Button Text', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => esc_html__('Let\'s Get Started', 'kadence-child'),
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => esc_html__('Button Link', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::URL,
                'placeholder' => esc_html__('https://your-link.com', 'kadence-child'),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $repeater->add_control(
            'stats_number',
            [
                'label' => esc_html__('Stats Number', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '80k +',
            ]
        );

        $repeater->add_control(
            'stats_text',
            [
                'label' => esc_html__('Stats Text', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Banking Professionals Trained',
            ]
        );

        $repeater->add_control(
            'programs_number',
            [
                'label' => esc_html__('Programs Number', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '2k +',
            ]
        );

        $repeater->add_control(
            'programs_text',
            [
                'label' => esc_html__('Programs Text', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Training Programs Conducted',
            ]
        );

        $repeater->add_control(
            'team_member_1',
            [
                'label' => esc_html__('Team Member 1', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'team_member_2',
            [
                'label' => esc_html__('Team Member 2', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' =>\Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'team_member_3',
            [
                'label' => esc_html__('Team Member 3', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'label' => esc_html__('Slides', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'slide_title' => esc_html__('Driving Excellence In Every Business Sector', 'kadence-child'),
                        'slide_description' => esc_html__('We aim to deliver quality training and academic programs related with Financial Institutions in the region.', 'kadence-child'),
                        'button_text' => esc_html__('Let\'s Get Started', 'kadence-child'),
                        'stats_number' => '80k +',
                        'stats_text' => 'Banking Professionals Trained',
                        'programs_number' => '2k +',
                        'programs_text' => 'Training Programs Conducted',
                    ],
                ],
                'title_field' => '{{{ slide_title }}}',
            ]
        );

        $this->add_control(
            'phone_number_title',
            [
                'label' => esc_html__('Phone Number Title', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Let\'s Talk',
            ]
        );
        $this->add_control(
            'phone_number',
            [
                'label' => esc_html__('Phone Number', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '01-4522805',
            ]
        );

        $this->end_controls_section();

        // Slider Settings Section
        $this->start_controls_section(
            'section_slider_settings',
            [
                'label' => esc_html__('Slider Settings', 'kadence-child'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'kadence-child'),
                'label_off' => esc_html__('No', 'kadence-child'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => esc_html__('Autoplay Speed', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1000,
                'max' => 10000,
                'step' => 500,
                'default' => 3000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'infinite',
            [
                'label' => esc_html__('Infinite Loop', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'kadence-child'),
                'label_off' => esc_html__('No', 'kadence-child'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'effect',
            [
                'label' => esc_html__('Transition Effect', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'fade',
                'options' => [
                    'slide' => esc_html__('Slide', 'kadence-child'),
                    'fade' => esc_html__('Fade', 'kadence-child'),
                ],
            ]
        );

        $this->end_controls_section();

        // Style Section
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Style', 'kadence-child'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#2A5794',
                'selectors' => [
                    '{{WRAPPER}} .banner-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .banner-title',
            ]
        );

        $this->add_control(
            'description_color',
            [
                'label' => esc_html__('Description Color', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#666666',
                'selectors' => [
                    '{{WRAPPER}} .banner-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'description_typography',
                'selector' => '{{WRAPPER}} .banner-description',
            ]
        );

        $this->add_control(
            'button_background_color',
            [
                'label' => esc_html__('Button Background Color', 'kadence-child'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#F9A825',
                'selectors' => [
                    '{{WRAPPER}} .banner-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    /**
     * Render widget output on the frontend.
     */
    protected function render() {
        $settings = $this->get_settings_for_display();
        if (empty($settings['slides'])) {
            return;
        }

        $slider_options = [
            'effect' => $settings['effect'],
            'autoplay' => $settings['autoplay'] === 'yes',
            'autoplaySpeed' => absint($settings['autoplay_speed']),
            'loop' => $settings['infinite'] === 'yes',
        ];
        ?>
        <div class="kadence-child-banner-slider swiper" data-slider='<?php echo esc_attr(json_encode($slider_options)); ?>'>
            <div class="swiper-wrapper">
                <?php foreach ($settings['slides'] as $index => $slide) : ?>
                    <div class="swiper-slide" data-swiper-slide-index="<?php echo esc_attr($index); ?>">
                        <div class="banner-slide-content">
                            <div class="banner-slide-content-wrap">
                                <div class="banner-content-wrap">
                                    <?php if (!empty($slide['slide_title'])) : ?>
                                        <h2 class="banner-title"><?php echo esc_html($slide['slide_title']); ?></h2>
                                    <?php endif; ?>
                                    
                                    <?php if (!empty($slide['slide_description'])) : ?>
                                        <div class="banner-description"><?php echo wp_kses_post($slide['slide_description']); ?></div>
                                    <?php endif; ?>

                                    <div class="banner-cta">
                                        <?php if (!empty($slide['button_link']['url'])) : ?>
                                            <a href="<?php echo esc_url($slide['button_link']['url']); ?>" 
                                               class="banner-button"
                                               <?php echo $slide['button_link']['is_external'] ? 'target="_blank"' : ''; ?>
                                               <?php echo $slide['button_link']['nofollow'] ? 'rel="nofollow"' : ''; ?>>
                                                <?php echo esc_html($slide['button_text']); ?>
                                            </a>
                                        <?php endif; ?>

                                        <div class="banner-contact">
                                            <div class="banner-contact-icon">
                                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M13.23 10.06L10.54 9.75C10.1 9.69 9.66 9.85 9.37 10.14L8.21 11.3C6.11 10.23 4.39 8.52 3.32 6.41L4.49 5.24C4.78 4.95 4.94 4.51 4.88 4.07L4.57 1.39C4.47 0.65 3.85 0.11 3.1 0.11H1.7C0.86 0.11 0.16 0.81 0.22 1.65C0.78 8.17 6.05 13.43 12.56 13.99C13.4 14.05 14.1 13.35 14.1 12.51V11.11C14.11 10.37 13.57 9.75 13.23 10.06Z" fill="white"/>
                                                </svg>
                                            </div>
                                            <div class="contact-information">
                                                <span><?php echo esc_html($settings['phone_number_title']); ?></span>
                                                <a href="tel:<?php echo esc_html($settings['phone_number']); ?>"><?php echo esc_html($settings['phone_number']); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="banner-right-content">
                                <?php if (!empty($slide['slide_image']['url'])) : ?>
                                <div class="banner-slide-image">
                                    <?php echo \Elementor\Group_Control_Image_Size::get_attachment_image_html($slide, 'slide_image'); ?>
                                </div>
                            <?php endif; ?>
                                    <?php if (!empty($slide['stats_number']) && !empty($slide['stats_text'])) : ?>
									    <div class="banner-details-flex">	
											<div class="banner-stats">
												<div class="stats-wrapper">
													<div class="banner-team-images">
														<?php if (!empty($slide['team_member_1']['url'])) : ?>
															<div class="team-image">
																<img src="<?php echo esc_url($slide['team_member_1']['url']); ?>" alt="Team Member 1">
															</div>
														<?php endif; ?>

														<?php if (!empty($slide['team_member_2']['url'])) : ?>
															<div class="team-image">
																<img src="<?php echo esc_url($slide['team_member_2']['url']); ?>" alt="Team Member 2">
															</div>
														<?php endif; ?>

														<?php if (!empty($slide['team_member_3']['url'])) : ?>
															<div class="team-image">
																<img src="<?php echo esc_url($slide['team_member_3']['url']); ?>" alt="Team Member 3">
															</div>
														<?php endif; ?>
													</div>
													<div class="stats-number"><?php echo esc_html($slide['stats_number']); ?></div>
												</div>
												<div class="stats-text"><?php echo esc_html($slide['stats_text']); ?></div>
											</div>
										<?php endif; ?>

										<?php if (!empty($slide['programs_number']) && !empty($slide['programs_text'])) : ?>
											<div class="banner-programs">
												<div class="programs-number"><?php echo esc_html($slide['programs_number']); ?></div>
												<div class="programs-text"><?php echo esc_html($slide['programs_text']); ?></div>
											</div>
										</div>		
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <!-- Navigation -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
            <!-- Pagination -->
            <div class="swiper-pagination"></div>
        </div>
        <?php
    }
}


