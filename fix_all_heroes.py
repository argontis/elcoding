import re
import os
import glob

# Mappings for background URLs
bg_map = {
    'layanan.blade.php': 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1920&q=80',
    'program-kursus.blade.php': 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=1920&q=80',
    'event-webinar.blade.php': 'https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?auto=format&fit=crop&w=1920&q=80',
    'tentang-kami.blade.php': 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=1920&q=80',
    'portofolio.blade.php': 'https://images.unsplash.com/photo-1522542550221-31fd19575a2d?auto=format&fit=crop&w=1920&q=80',
    'kontak.blade.php': 'https://images.unsplash.com/photo-1423666639041-f56000c27a9a?auto=format&fit=crop&w=1920&q=80',
    'artikel.blade.php': 'https://images.unsplash.com/photo-1499750310107-5fef28a66643?auto=format&fit=crop&w=1920&q=80',
}

files = glob.glob('resources/views/*.blade.php')

for f in files:
    filename = os.path.basename(f)
    if filename in bg_map:
        url = bg_map[filename]
        with open(f, 'r') as file:
            content = file.read()
        
        # Replace the preload link
        preload_pattern = r"<link rel=\"preload\" as=\"image\" href=\"\{\{ asset\('gambar/aset/Untitled-1\.png'\) \}\}\">"
        new_preload = f"<link rel=\"preload\" as=\"image\" href=\"{url}\">"
        content = re.sub(preload_pattern, new_preload, content)
        
        # Replace the background image if it hasn't been replaced yet
        bg_pattern = r"style=\"background-image:url\('\{\{ asset\('gambar/aset/Untitled-1\.png'\) \}\}'\);\""
        new_bg = f"style=\"background-image:url('{url}');\""
        content = re.sub(bg_pattern, new_bg, content)
        
        with open(f, 'w') as file:
            file.write(content)
        print(f"Updated {filename}")

