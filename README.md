# 🏖️ Kasturi Holidays - WordPress Child Theme

<div align="center">

![WordPress](https://img.shields.io/badge/WordPress-21759B?style=for-the-badge&logo=wordpress&logoColor=white)
![Elementor](https://img.shields.io/badge/Elementor-92003B?style=for-the-badge&logo=elementor&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)

[![License: GPL v3](https://img.shields.io/badge/License-GPLv3-blue.svg?style=for-the-badge)](https://www.gnu.org/licenses/gpl-3.0)
[![Version](https://img.shields.io/badge/version-1.0.0-brightgreen?style=for-the-badge)](https://github.com/yourusername/kasturi-holidays)
[![Maintenance](https://img.shields.io/badge/Maintained%3F-yes-green.svg?style=for-the-badge)](https://github.com/yourusername/kasturi-holidays/graphs/commit-activity)

*A premium WordPress child theme for travel and holiday websites, featuring custom Elementor widgets and modern design elements.*

</div>

---

## ✨ Features

### 🎨 Custom Elementor Widgets
- **Travel Packages Widget** - Display holiday packages in grid or slider layouts
- **Kasturi Banner Widget** - Create stunning hero sections with statistics and team members
- **Responsive Design** - Mobile-first approach with adaptive layouts
- **Swiper Integration** - Smooth slider functionality with touch support

### 🚀 Performance & UX
- **Custom Preloader** - Branded loading experience with logo integration
- **Optimized Assets** - Minified CSS/JS for faster loading
- **Modern Animations** - Smooth transitions and hover effects
- **Accessibility Ready** - WCAG compliant design elements

### 🛠️ Developer Friendly
- **Clean Code Structure** - Well-organized, commented codebase
- **WordPress Standards** - Follows WordPress coding standards
- **Child Theme Safe** - Update-proof customizations
- **Extensible Architecture** - Easy to modify and extend

---

## 🎯 Widget Showcase

### Travel Packages Widget
```php
// Features:
✅ Grid & Slider Layouts
✅ Responsive Columns (1-6)
✅ Custom Package Images
✅ Pricing & Duration Display
✅ Call-to-Action Buttons
✅ Hover Effects & Animations
```

### Kasturi Banner Widget
```php
// Features:
✅ Multi-Slide Support
✅ Statistics Display
✅ Team Member Showcase
✅ Custom Background Images
✅ Call-to-Action Buttons
✅ Autoplay & Navigation Controls
```

---

## 📦 Installation

### Method 1: Manual Installation
```bash
# Clone the repository
git clone https://github.com/yourusername/kasturi-holidays.git

# Copy to WordPress themes directory
cp -r kasturi-holidays /wp-content/themes/
```

### Method 2: WordPress Admin
1. Download the theme as ZIP file
2. Go to **Appearance > Themes** in WordPress admin
3. Click **Add New > Upload Theme**
4. Upload and activate the theme

---

## 🔧 Setup & Configuration

### Prerequisites
- WordPress 5.0+
- Kadence Theme (Parent)
- Elementor Plugin (Free/Pro)
- PHP 7.4+

### Quick Start
1. **Activate the Child Theme**
   ```php
   // Automatically loads parent theme styles
   add_action('wp_enqueue_scripts', 'kadence_child_style');
   ```

2. **Widgets Auto-Registration**
   ```php
   // Widgets are automatically registered
   add_action('elementor/widgets/register', 'register_kasturi_package_widget');
   ```

3. **Custom Preloader**
   ```php
   // Branded loading experience
   add_action('wp_body_open', 'kadence_child_preloader_markup');
   ```

---

## 🎨 Usage Examples

### Travel Packages Widget
```php
// Grid Layout (3 columns)
[elementor-template id="travel-packages-grid"]

// Slider Layout (3 slides, autoplay)
[elementor-template id="travel-packages-slider"]
```

### Banner Widget
```php
// Hero Section with Statistics
[elementor-template id="kasturi-banner-hero"]

// Multi-Slide Banner
[elementor-template id="kasturi-banner-slider"]
```

---

## 🏗️ Project Structure

```
Kasturi-Holidays/
├── 📁 assets/
│   ├── 📁 css/
│   └── 📁 js/
├── 📁 widget/
│   ├── 🎯 kasturi-package-widget.php
│   └── 🎨 kasturi-banner-widget.php
├── 📄 functions.php
├── 📄 style.css
└── 📄 README.md
```

---

## 🛠️ Customization

### Adding New Widgets
```php
// In functions.php
function register_custom_widget($widgets_manager) {
    require_once get_stylesheet_directory() . '/widget/your-widget.php';
    $widgets_manager->register(new \Your_Widget());
}
add_action('elementor/widgets/register', 'register_custom_widget');
```

### Styling Customization
```css
/* In style.css */
.kasturi-packages {
    /* Your custom styles */
}

.kasturi-banner {
    /* Your custom styles */
}
```

---

## 🚀 Performance Optimization

### Asset Loading
- **Conditional Loading** - Widgets load only when needed
- **CDN Integration** - Swiper library from CDN
- **Minified Assets** - Optimized for production

### Caching Ready
- **WordPress Compatible** - Works with all caching plugins
- **CDN Friendly** - Optimized for content delivery networks

---

## 🤝 Contributing

We welcome contributions! Please follow these steps:

1. **Fork the repository**
2. **Create a feature branch**
   ```bash
   git checkout -b feature/amazing-feature
   ```
3. **Commit your changes**
   ```bash
   git commit -m 'Add amazing feature'
   ```
4. **Push to the branch**
   ```bash
   git push origin feature/amazing-feature
   ```
5. **Open a Pull Request**

### Development Guidelines
- Follow WordPress coding standards
- Add proper documentation
- Test on multiple devices
- Ensure accessibility compliance

---

## 📄 License

This project is licensed under the **GNU General Public License v3.0** - see the [LICENSE](LICENSE) file for details.

---

## 🙏 Acknowledgments

- **WordPress Community** - For the amazing platform
- **Elementor Team** - For the powerful page builder
- **Kadence Theme** - For the excellent parent theme
- **Open Source Contributors** - For inspiration and resources

---

## 📞 Support

- **Documentation**: [Wiki](https://github.com/yourusername/kasturi-holidays/wiki)
- **Issues**: [GitHub Issues](https://github.com/yourusername/kasturi-holidays/issues)
- **Discussions**: [GitHub Discussions](https://github.com/yourusername/kasturi-holidays/discussions)

---

<div align="center">

**Made with ❤️ By Xitiz for the WordPress community**

[![GitHub stars](https://img.shields.io/github/stars/yourusername/kasturi-holidays?style=social)](https://github.com/yourusername/kasturi-holidays)
[![GitHub forks](https://img.shields.io/github/forks/yourusername/kasturi-holidays?style=social)](https://github.com/yourusername/kasturi-holidays)
[![GitHub issues](https://img.shields.io/github/issues/yourusername/kasturi-holidays)](https://github.com/yourusername/kasturi-holidays/issues)

</div> 