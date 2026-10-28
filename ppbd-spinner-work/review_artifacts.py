from pathlib import Path
from PIL import Image, ImageOps, ImageDraw
from pypdf import PdfReader

root = Path(__file__).parent
pages = sorted((root / 'review').glob('final-[0-9][0-9].png'))
print('PDF pages:', len(PdfReader(root / 'Laporan Latex/main.pdf').pages))
print('Rendered pages:', len(pages))
for start in range(0, len(pages), 5):
    canvas = Image.new('RGB', (1500, 1420), '#dddddd')
    draw = ImageDraw.Draw(canvas)
    for index, path in enumerate(pages[start:start + 5]):
        x, y = (index % 3) * 500, (index // 3) * 710
        page = ImageOps.contain(Image.open(path).convert('RGB'), (480, 680))
        canvas.paste(page, (x, y + 25))
        draw.text((x + 10, y + 5), path.name, fill='black')
    canvas.save(root / f'review/final-pages-{start // 5}.png')

for path in (root / 'Laporan Latex/kode').glob('*'):
    candidates = list((root / 'PresensiApp/app').rglob(path.name))
    assert any(p.read_bytes() == path.read_bytes() for p in candidates), path.name
print('Listing sources match the Android project.')
