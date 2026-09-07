import shutil
from PIL import Image
import os

user_dir = r"C:\Users\LENOVO\.gemini\antigravity-ide\brain\eee1b50c-6a1b-4484-b0a9-d403acc09248\.user_uploaded"
img1_src = os.path.join(user_dir, "media_1788325729729.jpg")
img2_src = os.path.join(user_dir, "media_1788325903308.jpg")

dest_dir = r"c:\Users\LENOVO\Downloads\elcoding\public\gambar\artikel"
os.makedirs(dest_dir, exist_ok=True)

# Save Image 1
img1_webp = os.path.join(dest_dir, "training-pelatihan-elrhea-1.webp")
img1_jpg = os.path.join(dest_dir, "training-pelatihan-elrhea-1.jpg")
shutil.copy(img1_src, img1_jpg)
im1 = Image.open(img1_src)
im1.save(img1_webp, "WEBP", quality=85)
print(f"Saved {img1_webp}")

# Save Image 2
img2_webp = os.path.join(dest_dir, "training-pelatihan-elrhea-2.webp")
img2_jpg = os.path.join(dest_dir, "training-pelatihan-elrhea-2.jpg")
shutil.copy(img2_src, img2_jpg)
im2 = Image.open(img2_src)
im2.save(img2_webp, "WEBP", quality=85)
print(f"Saved {img2_webp}")

print("Both images processed successfully!")
