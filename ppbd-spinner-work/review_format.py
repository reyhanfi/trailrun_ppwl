from pathlib import Path
from PIL import Image, ImageOps, ImageDraw
root = Path(__file__).parent / 'review'
pages = sorted(root.glob('ppwl-style-[0-9][0-9].png'))
for start in range(0, len(pages), 6):
    sheet = Image.new('RGB', (1500, 1460), '#ddd')
    draw = ImageDraw.Draw(sheet)
    for i, path in enumerate(pages[start:start+6]):
        x, y = i % 3 * 500, i // 3 * 730
        img = ImageOps.contain(Image.open(path), (480, 700))
        sheet.paste(img, (x, y+25))
        draw.text((x+10, y+5), path.name, fill='black')
    sheet.save(root / f'format-contact-{start//6}.png')
