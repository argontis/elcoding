import sys
from PIL import Image
import base64
import os

try:
    # Open image
    img = Image.open('ELCoding.id.jpeg').convert("RGBA")
    data = img.getdata()
    
    new_data = []
    # threshold for white
    threshold = 240
    
    for item in data:
        # Change all white (also shades of whites)
        # to transparent
        if item[0] >= threshold and item[1] >= threshold and item[2] >= threshold:
            new_data.append((255, 255, 255, 0))
        else:
            new_data.append(item)
            
    img.putdata(new_data)
    
    # Crop the image to the bounding box of non-transparent pixels
    bbox = img.getbbox()
    if bbox:
        img = img.crop(bbox)
        
    # Save as PNG
    png_path = 'public/gambar/logo-elcoding.png'
    os.makedirs(os.path.dirname(png_path), exist_ok=True)
    img.save(png_path, "PNG")
    
    # Read the saved PNG and convert to base64
    with open(png_path, "rb") as f:
        img_b64 = base64.b64encode(f.read()).decode("utf-8")
        
    width, height = img.size
    
    # Create SVG wrapper
    svg_content = f"""<svg xmlns="http://www.w3.org/2000/svg" width="{width}" height="{height}" viewBox="0 0 {width} {height}">
    <image href="data:image/png;base64,{img_b64}" width="{width}" height="{height}" />
</svg>"""
    
    svg_path = 'public/gambar/logo-elcoding.svg'
    with open(svg_path, "w") as f:
        f.write(svg_content)
        
    print(f"Successfully processed logo! PNG saved at {png_path} and SVG saved at {svg_path}")

except Exception as e:
    print(f"Error processing image: {e}")
