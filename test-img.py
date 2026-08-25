from PIL import Image
import base64
from io import BytesIO

img = Image.open('public/gambar/aset/Untitled-1.png')
img.thumbnail((200, 200))
buffered = BytesIO()
img.save(buffered, format="JPEG")
img_str = base64.b64encode(buffered.getvalue()).decode()
print("data:image/jpeg;base64," + img_str)
