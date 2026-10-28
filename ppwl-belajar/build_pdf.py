from pathlib import Path
from reportlab.lib import colors
from reportlab.lib.enums import TA_CENTER
from reportlab.lib.pagesizes import A4
from reportlab.lib.styles import getSampleStyleSheet, ParagraphStyle
from reportlab.lib.units import mm
from reportlab.platypus import SimpleDocTemplate, Paragraph, Spacer, PageBreak, Preformatted, Table, TableStyle
from xml.sax.saxutils import escape
import re

ROOT = Path(__file__).parent
OUT = ROOT / 'PPWL_Cheatsheet_dan_Latihan.pdf'

styles = getSampleStyleSheet()
styles.add(ParagraphStyle(name='Cover', parent=styles['Title'], alignment=TA_CENTER, fontSize=22, leading=28, spaceAfter=18))
styles.add(ParagraphStyle(name='Sub', parent=styles['Normal'], alignment=TA_CENTER, fontSize=11, leading=16, textColor=colors.HexColor('#444444')))
styles.add(ParagraphStyle(name='H1x', parent=styles['Heading1'], fontSize=16, leading=20, spaceBefore=14, spaceAfter=8, textColor=colors.HexColor('#17365D')))
styles.add(ParagraphStyle(name='H2x', parent=styles['Heading2'], fontSize=12, leading=15, spaceBefore=10, spaceAfter=5, textColor=colors.HexColor('#1F4E79')))
styles.add(ParagraphStyle(name='Bodyx', parent=styles['BodyText'], fontSize=8.4, leading=11.2, spaceAfter=4))
styles.add(ParagraphStyle(name='Smallx', parent=styles['BodyText'], fontSize=7.5, leading=9.5, textColor=colors.HexColor('#555555')))
styles.add(ParagraphStyle(name='Codex', parent=styles['Code'], fontName='Courier', fontSize=7.2, leading=9, leftIndent=8, backColor=colors.HexColor('#F3F5F7'), borderPadding=5, spaceBefore=3, spaceAfter=6))

def inline(s):
    parts = re.split(r'(`[^`]*`)', s)
    out = ''
    for p in parts:
        if len(p) >= 2 and p.startswith('`') and p.endswith('`'):
            out += '<font name="Courier">' + escape(p[1:-1]) + '</font>'
        else:
            out += escape(p)
    return out

def parse_md(path, story):
    lines = path.read_text(encoding='utf-8').splitlines()
    i = 0
    while i < len(lines):
        line = lines[i]
        if not line.strip(): i += 1; continue
        if line.startswith('```'):
            buf=[]; i+=1
            while i < len(lines) and not lines[i].startswith('```'):
                buf.append(lines[i]); i+=1
            story.append(Preformatted('\n'.join(buf), styles['Codex'])); i+=1; continue
        if line.startswith('|'):
            rows=[]
            while i < len(lines) and lines[i].startswith('|'):
                cells=[c.strip() for c in lines[i].strip('|').split('|')]
                if not all(set(c) <= set('-: ') for c in cells): rows.append([Paragraph(inline(c), styles['Bodyx']) for c in cells])
                i+=1
            if rows:
                n=max(len(r) for r in rows); rows=[r+['']*(n-len(r)) for r in rows]
                t=Table(rows, repeatRows=1, colWidths=[(A4[0]-32*mm)/n]*n)
                t.setStyle(TableStyle([('BACKGROUND',(0,0),(-1,0),colors.HexColor('#D9EAF7')),('GRID',(0,0),(-1,-1),0.3,colors.HexColor('#9AA9B8')),('VALIGN',(0,0),(-1,-1),'TOP'),('LEFTPADDING',(0,0),(-1,-1),4),('RIGHTPADDING',(0,0),(-1,-1),4)]))
                story += [t, Spacer(1,4)]; continue
        if line.startswith('# '): story.append(Paragraph(inline(line[2:]), styles['H1x']))
        elif line.startswith('## '): story.append(Paragraph(inline(line[3:]), styles['H2x']))
        elif line.startswith('### '): story.append(Paragraph(inline(line[4:]), styles['H2x']))
        elif line.startswith('- '): story.append(Paragraph('• '+inline(line[2:]), styles['Bodyx']))
        elif line[:2].isdigit() and line[2:3]=='.': story.append(Paragraph(inline(line), styles['Bodyx']))
        else: story.append(Paragraph(inline(line), styles['Bodyx']))
        i += 1

def footer(canvas, doc):
    canvas.saveState(); canvas.setFont('Helvetica', 7); canvas.setFillColor(colors.grey)
    canvas.drawString(16*mm, 10*mm, 'PPWL - persiapan quiz live coding')
    canvas.drawRightString(A4[0]-16*mm, 10*mm, f'Halaman {doc.page}')
    canvas.restoreState()

story=[Spacer(1,45*mm), Paragraph('PPWL', styles['Cover']), Paragraph('Cheatsheet, Latihan, dan Kunci Jawaban', styles['Sub']), Spacer(1,8*mm), Paragraph('Persiapan quiz live coding Laravel, PHP native, CRUD, migration, seeder, Blade, controller, dan query.', styles['Sub']), PageBreak()]
parse_md(ROOT/'CHEATSHEET.md', story)
story.append(PageBreak()); parse_md(ROOT/'LATIHAN.md', story)
story.append(PageBreak()); parse_md(ROOT/'KUNCI.md', story)
doc=SimpleDocTemplate(str(OUT), pagesize=A4, rightMargin=16*mm, leftMargin=16*mm, topMargin=14*mm, bottomMargin=16*mm, title='PPWL Cheatsheet dan Latihan')
doc.build(story, onFirstPage=footer, onLaterPages=footer)
print(OUT)
