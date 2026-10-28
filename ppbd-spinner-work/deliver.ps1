$taskSource = 'C:\Users\reyha\trailrun\ppbd-spinner-work'
$taskDestination = 'D:\A CURRENT TASK\SEMESTER 3\PPBD\Pertemuan 5 - Spinner'
$taskProject = Join-Path $taskDestination 'PresensiApp'
$taskReport = Join-Path $taskDestination 'Laporan Latex'
New-Item -ItemType Directory -Force -Path $taskProject,$taskReport,(Join-Path $taskDestination 'APK') | Out-Null
Get-ChildItem -LiteralPath (Join-Path $taskSource 'PresensiApp') -File -Force | Copy-Item -Destination $taskProject -Force
Copy-Item -LiteralPath (Join-Path $taskSource 'PresensiApp\gradle') -Destination $taskProject -Recurse -Force
$taskApp = Join-Path $taskProject 'app'
New-Item -ItemType Directory -Force -Path $taskApp | Out-Null
Get-ChildItem -LiteralPath (Join-Path $taskSource 'PresensiApp\app') -File -Force | Copy-Item -Destination $taskApp -Force
Copy-Item -LiteralPath (Join-Path $taskSource 'PresensiApp\app\src') -Destination $taskApp -Recurse -Force
foreach ($taskFolder in @('Screenshot','Video')) {
    Copy-Item -LiteralPath (Join-Path $taskSource $taskFolder) -Destination $taskDestination -Recurse -Force
}
foreach ($taskFile in @('main.tex','main.pdf','lambang ugm.png')) {
    Copy-Item -LiteralPath (Join-Path $taskSource ('Laporan Latex\' + $taskFile)) -Destination $taskReport -Force
}
foreach ($taskFolder in @('kode','gambar')) {
    Copy-Item -LiteralPath (Join-Path $taskSource ('Laporan Latex\' + $taskFolder)) -Destination $taskReport -Recurse -Force
}
Copy-Item -LiteralPath (Join-Path $taskSource 'Panduan Android Studio.md') -Destination $taskDestination -Force
Copy-Item -LiteralPath (Join-Path $taskSource 'PresensiApp\app\build\outputs\apk\debug\app-debug.apk') -Destination (Join-Path $taskDestination 'APK\presensi-debug.apk') -Force
Get-ChildItem -LiteralPath $taskDestination | Select-Object Name
