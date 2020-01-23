http_path = "/" # целевой путь корневого уровня
css_dir = "/assets/css/" # устанавливает наш файл style.css по умолчанию на корневом уровне нашей темы
sass_dir = "/assets/scss/server" # определяет sass директорию
images_dir = "/assets/images" # определяет предварительный каталог изображений
javascripts_dir = "/assets/js" # определяет JavaScript каталог
# Здесь вы можете выбрать предпочитаемый стиль вывода (может быть переопределен через командную строку):
output_style = :nested
# output_style = :expanded или :nested или :compact или :compressed
# Разрешить использование относительных путей к ресурсам посредством вспомогательных функций Compass.  
# примечание: это важно в темах WordPress для спрайтов
 relative_assets = true