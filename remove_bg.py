from PIL import Image
import sys

def make_transparent(input_path, output_path):
    img = Image.open(input_path)
    img = img.convert("RGBA")
    datas = img.getdata()

    newData = []
    # threshold for near white
    for item in datas:
        # If the pixel is mostly white, make it transparent
        # 235 is a good threshold for jpeg artifacts in white backgrounds
        if item[0] > 230 and item[1] > 230 and item[2] > 230:
            newData.append((255, 255, 255, 0))
        else:
            newData.append(item)

    img.putdata(newData)
    # Optional: crop the transparent bounding box so it's larger
    bbox = img.getbbox()
    if bbox:
        img = img.crop(bbox)
        
    img.save(output_path, "PNG")
    print(f"Saved to {output_path}")

if __name__ == '__main__':
    make_transparent("logo.png", "logo.png")
