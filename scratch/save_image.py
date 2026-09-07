import shutil
from PIL import Image
import os

src_path = r"C:\Users\LENOVO\.gemini\antigravity-ide\brain\eee1b50c-6a1b-4484-b0a9-d403acc09248\.user_uploaded\media_1788324497698.png"
dest_dir = r"c:\Users\LENOVO\Downloads\elcoding\public\gambar\portofolio"
os.makedirs(dest_dir, exist_ok=True)

dest_png = os.path.join(dest_dir, "kerjasama-lazizmu.png")
dest_webp = os.path.join(dest_dir, "kerjasama-lazizmu.webp")

shutil.copy(src_path, dest_png)
print(f"Copied to {dest_png}")

try:
    im = Image.open(src_path)
    im.save(dest_webp, "WEBP", quality=85)
    print(f"Converted and saved to {dest_webp}")
except Exception as e:
    print(f"Error converting webp: {e}")
