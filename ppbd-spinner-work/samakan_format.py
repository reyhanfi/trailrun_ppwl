from pathlib import Path
import re

root = Path(r'D:\A CURRENT TASK\SEMESTER 3')
reference = (root / 'PPWL/Petemuan 6/Latex/main.tex').read_text(encoding='utf-8-sig')
target = root / 'PPBD/Pertemuan 5 - Spinner/Laporan Latex/main.tex'
text = target.read_text(encoding='utf-8-sig')
text = text.replace('\\usepackage{graphicx}', '\\usepackage[utf8]{inputenc}\n\\usepackage[T1]{fontenc}\n\\usepackage{graphicx}', 1)
start = text.index('\\titleformat{\\chapter}')
end = text.index('% =========================================================\n% HEADER & FOOTER', start)
ref_start = reference.index('\\titleformat{\\chapter}')
ref_end = reference.index('\\lstdefinelanguage', ref_start)
text = text[:start] + reference[ref_start:ref_end] + text[end:]
cover = reference[reference.index('\\begin{titlingpage}'):reference.index('\\end{titlingpage}') + len('\\end{titlingpage}')]
cover = cover.replace('Dinar Nugroho Pratomo, S.Kom., M.IM., M.Cs.', 'Dr. Irkham Huda, S.Kom., M.Cs.')
definitions = r'''\title{Laporan Praktikum \\
Pemrograman Perangkat Bergerak Dasar\\
Pertemuan 5\\
Spinner, Date Picker, Time Picker, Dialog}
\author{Nama Mahasiswa: Reyhan Abelard Fikri\\NIM: 25/562000/SV/26713}

'''
text = text.replace('\\begin{document}', definitions + '\\begin{document}', 1)
text = re.sub(r'\\begin\{titlepage\}.*?\\end\{titlepage\}', lambda _: cover, text, count=1, flags=re.S)
toc_start = reference.index('\\setcounter{tocdepth}')
toc_end = reference.index('\\tableofcontents', toc_start)
text = text.replace('\\tableofcontents', reference[toc_start:toc_end] + '\\tableofcontents', 1)
target.write_text(text, encoding='utf-8')
print('Cover and heading formatting copied from PPWL Pertemuan 6.')
