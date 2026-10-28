from pathlib import Path
import subprocess

root = Path(__file__).parent
ffmpeg = root / 'tools/imageio_ffmpeg/binaries/ffmpeg-win-x86_64-v7.1.exe'
video = root / 'Video'
files = [video / '01-pengisian-presensi.mp4', video / '02-hasil-dan-dialog.mp4', video / '03-konfirmasi-keluar.mp4']
command = [str(ffmpeg), '-hide_banner', '-loglevel', 'error', '-y']
for source in files:
    command += ['-i', str(source)]
filters = ';'.join(f'[{i}:v]setpts=(PTS-STARTPTS)/2,fps=30[v{i}]' for i in range(3))
filters += ';[v0][v1][v2]concat=n=3:v=1:a=0[v]'
command += ['-filter_complex', filters, '-map', '[v]', '-c:v', 'libx264', '-preset', 'fast', '-crf', '22', '-pix_fmt', 'yuv420p', '-movflags', '+faststart', str(video / 'demo-presensi.mp4')]
subprocess.run(command, check=True)
print(video / 'demo-presensi.mp4')
