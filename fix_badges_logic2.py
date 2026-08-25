import os
import glob
import re

files = glob.glob('resources/views/**/*.blade.php', recursive=True)

for f in files:
    with open(f, 'r') as file:
        content = file.read()
    
    # We look for the badge logic block
    # It starts with $badgeText = strtolower(trim(
    # and ends with fa-rocket'; }
    
    pattern = r"(\$badgeText = strtolower\(trim\(([^)]+)\)\);).*?(?:fa-rocket';\s*\})"
    
    def replacer(match):
        var_part = match.group(2)
        return f"""$badgeText = strtolower(trim({var_part}));
                            $badgeClass = 'badge-special'; // Default color
                            $badgeIcon = 'fa-star'; // Default icon
                            
                            // Status Badges
                            if (str_contains($badgeText, 'terlaris') || str_contains($badgeText, 'populer')) {{ $badgeClass = 'badge-terlaris'; $badgeIcon = 'fa-fire'; }}
                            elseif (str_contains($badgeText, 'unggulan') || str_contains($badgeText, 'recommended') || str_contains($badgeText, 'rekomendasi')) {{ $badgeClass = 'badge-unggulan'; $badgeIcon = 'fa-thumbs-up'; }}
                            elseif (str_contains($badgeText, 'upcoming') || str_contains($badgeText, 'baru')) {{ $badgeClass = 'badge-upcoming'; $badgeIcon = 'fa-clock'; }}
                            elseif (str_contains($badgeText, 'special') || str_contains($badgeText, 'promo') || str_contains($badgeText, 'diskon')) {{ $badgeClass = 'badge-special'; $badgeIcon = 'fa-gem'; }}
                            
                            // Category Badges (Layanan & Programs)
                            elseif (str_contains($badgeText, 'website') || str_contains($badgeText, 'web')) {{ $badgeClass = 'badge-handson'; $badgeIcon = 'fa-globe'; }}
                            elseif (str_contains($badgeText, 'hosting') || str_contains($badgeText, 'server')) {{ $badgeClass = 'badge-design'; $badgeIcon = 'fa-server'; }}
                            elseif (str_contains($badgeText, 'perpustakaan') || str_contains($badgeText, 'digital')) {{ $badgeClass = 'badge-crash'; $badgeIcon = 'fa-book-reader'; }}
                            elseif (str_contains($badgeText, 'aplikasi') || str_contains($badgeText, 'app')) {{ $badgeClass = 'badge-upcoming'; $badgeIcon = 'fa-mobile-alt'; }}
                            elseif (str_contains($badgeText, 'sistem') || str_contains($badgeText, 'informasi')) {{ $badgeClass = 'badge-unggulan'; $badgeIcon = 'fa-cogs'; }}
                            
                            // Fallbacks for specific course types
                            elseif (str_contains($badgeText, 'hands-on') || str_contains($badgeText, 'praktek')) {{ $badgeClass = 'badge-handson'; $badgeIcon = 'fa-laptop-code'; }}
                            elseif (str_contains($badgeText, 'design') || str_contains($badgeText, 'desain')) {{ $badgeClass = 'badge-design'; $badgeIcon = 'fa-paint-brush'; }}
                            elseif (str_contains($badgeText, 'crash') || str_contains($badgeText, 'kilat')) {{ $badgeClass = 'badge-crash'; $badgeIcon = 'fa-rocket'; }}"""

    new_content = re.sub(pattern, replacer, content, flags=re.DOTALL)
    if new_content != content:
        with open(f, 'w') as file:
            file.write(new_content)
        print(f"Updated badges in {f}")

