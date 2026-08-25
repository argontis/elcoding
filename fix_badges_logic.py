import os
import glob

# Search all blade files for the badge logic block
files = glob.glob('resources/views/**/*.blade.php', recursive=True)

old_logic = """$badgeText = strtolower(trim($layanan->badge));
                            $badgeClass = '';
                            $badgeIcon = 'fa-star';
                            if (str_contains($badgeText, 'terlaris')) { $badgeClass = 'badge-terlaris'; $badgeIcon = 'fa-fire'; }
                            elseif (str_contains($badgeText, 'unggulan') || str_contains($badgeText, 'recommended')) { $badgeClass = 'badge-unggulan'; $badgeIcon = 'fa-thumbs-up'; }
                            elseif (str_contains($badgeText, 'upcoming')) { $badgeClass = 'badge-upcoming'; $badgeIcon = 'fa-clock'; }
                            elseif (str_contains($badgeText, 'special')) { $badgeClass = 'badge-special'; $badgeIcon = 'fa-gem'; }
                            elseif (str_contains($badgeText, 'hands-on')) { $badgeClass = 'badge-handson'; $badgeIcon = 'fa-laptop-code'; }
                            elseif (str_contains($badgeText, 'design')) { $badgeClass = 'badge-design'; $badgeIcon = 'fa-paint-brush'; }
                            elseif (str_contains($badgeText, 'crash')) { $badgeClass = 'badge-crash'; $badgeIcon = 'fa-rocket'; }"""

new_logic = """$badgeText = strtolower(trim($layanan->badge));
                            $badgeClass = 'badge-special'; // Default color
                            $badgeIcon = 'fa-star'; // Default icon
                            if (str_contains($badgeText, 'terlaris') || str_contains($badgeText, 'populer')) { $badgeClass = 'badge-terlaris'; $badgeIcon = 'fa-fire'; }
                            elseif (str_contains($badgeText, 'unggulan') || str_contains($badgeText, 'recommended') || str_contains($badgeText, 'rekomendasi')) { $badgeClass = 'badge-unggulan'; $badgeIcon = 'fa-thumbs-up'; }
                            elseif (str_contains($badgeText, 'upcoming') || str_contains($badgeText, 'baru')) { $badgeClass = 'badge-upcoming'; $badgeIcon = 'fa-clock'; }
                            elseif (str_contains($badgeText, 'special') || str_contains($badgeText, 'promo') || str_contains($badgeText, 'diskon')) { $badgeClass = 'badge-special'; $badgeIcon = 'fa-gem'; }
                            elseif (str_contains($badgeText, 'hands-on') || str_contains($badgeText, 'praktek')) { $badgeClass = 'badge-handson'; $badgeIcon = 'fa-laptop-code'; }
                            elseif (str_contains($badgeText, 'design') || str_contains($badgeText, 'desain')) { $badgeClass = 'badge-design'; $badgeIcon = 'fa-paint-brush'; }
                            elseif (str_contains($badgeText, 'crash') || str_contains($badgeText, 'kilat')) { $badgeClass = 'badge-crash'; $badgeIcon = 'fa-rocket'; }"""

for f in files:
    with open(f, 'r') as file:
        content = file.read()
    
    if "str_contains($badgeText, 'terlaris')" in content:
        # We replace for $layanan, $program, and $event
        # Let's do it dynamically based on the variable name
        import re
        # Find the block
        pattern = r"(\$badgeText = strtolower\(trim\(([^)]+)\)\);)\s*\$badgeClass = '';\s*\$badgeIcon = 'fa-star';\s*if \(str_contains\(\$badgeText, 'terlaris'\)\) \{ \$badgeClass = 'badge-terlaris'; \$badgeIcon = 'fa-fire'; \}\s*elseif \(str_contains\(\$badgeText, 'unggulan'\) \|\| str_contains\(\$badgeText, 'recommended'\)\) \{ \$badgeClass = 'badge-unggulan'; \$badgeIcon = 'fa-thumbs-up'; \}\s*elseif \(str_contains\(\$badgeText, 'upcoming'\)\) \{ \$badgeClass = 'badge-upcoming'; \$badgeIcon = 'fa-clock'; \}\s*elseif \(str_contains\(\$badgeText, 'special'\)\) \{ \$badgeClass = 'badge-special'; \$badgeIcon = 'fa-gem'; \}\s*elseif \(str_contains\(\$badgeText, 'hands-on'\)\) \{ \$badgeClass = 'badge-handson'; \$badgeIcon = 'fa-laptop-code'; \}\s*elseif \(str_contains\(\$badgeText, 'design'\)\) \{ \$badgeClass = 'badge-design'; \$badgeIcon = 'fa-paint-brush'; \}\s*elseif \(str_contains\(\$badgeText, 'crash'\)\) \{ \$badgeClass = 'badge-crash'; \$badgeIcon = 'fa-rocket'; \}"
        
        def replacer(match):
            var_part = match.group(2)
            return f"""$badgeText = strtolower(trim({var_part}));
                            $badgeClass = 'badge-special'; // Default color
                            $badgeIcon = 'fa-star'; // Default icon
                            if (str_contains($badgeText, 'terlaris') || str_contains($badgeText, 'populer')) {{ $badgeClass = 'badge-terlaris'; $badgeIcon = 'fa-fire'; }}
                            elseif (str_contains($badgeText, 'unggulan') || str_contains($badgeText, 'recommended') || str_contains($badgeText, 'rekomendasi')) {{ $badgeClass = 'badge-unggulan'; $badgeIcon = 'fa-thumbs-up'; }}
                            elseif (str_contains($badgeText, 'upcoming') || str_contains($badgeText, 'baru')) {{ $badgeClass = 'badge-upcoming'; $badgeIcon = 'fa-clock'; }}
                            elseif (str_contains($badgeText, 'special') || str_contains($badgeText, 'promo') || str_contains($badgeText, 'diskon')) {{ $badgeClass = 'badge-special'; $badgeIcon = 'fa-gem'; }}
                            elseif (str_contains($badgeText, 'hands-on') || str_contains($badgeText, 'praktek')) {{ $badgeClass = 'badge-handson'; $badgeIcon = 'fa-laptop-code'; }}
                            elseif (str_contains($badgeText, 'design') || str_contains($badgeText, 'desain')) {{ $badgeClass = 'badge-design'; $badgeIcon = 'fa-paint-brush'; }}
                            elseif (str_contains($badgeText, 'crash') || str_contains($badgeText, 'kilat')) {{ $badgeClass = 'badge-crash'; $badgeIcon = 'fa-rocket'; }}"""

        new_content = re.sub(pattern, replacer, content)
        if new_content != content:
            with open(f, 'w') as file:
                file.write(new_content)
            print(f"Updated badges in {f}")

