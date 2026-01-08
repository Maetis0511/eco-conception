# Script to optimize and convert images to WebP with multiple resolutions
# Creates 400, 800, 1200 px variants plus WebP versions

$imageDir = Join-Path $PSScriptRoot '..\images'
$optimizedDir = Join-Path $imageDir 'optimized'

# Create optimized folder if it doesn't exist
if (-not (Test-Path $optimizedDir)) {
    New-Item -ItemType Directory -Path $optimizedDir | Out-Null
    Write-Host "Created folder: $optimizedDir"
}

# Get all image files (excluding animated GIFs for now)
$images = Get-ChildItem -Path $imageDir -File | Where-Object { $_.Extension -match '\.(jpg|jpeg|png)$' }

Write-Host "Found $($images.Count) images to optimize"

foreach ($img in $images) {
    $baseName = [IO.Path]::GetFileNameWithoutExtension($img.Name)
    Write-Host "Processing: $($img.Name)"
    
    # Create resized JPG variants (400, 800, 1200)
    foreach ($width in 400, 800, 1200) {
        $outJpg = Join-Path $optimizedDir "$baseName-$width.jpg"
        & magick "$($img.FullName)" -resize "${width}x${width}>" -quality 85 -strip "$outJpg"
        Write-Host "  -> Created: $baseName-$width.jpg"
        
        # Create WebP variant from the JPG
        $outWebp = Join-Path $optimizedDir "$baseName-$width.webp"
        & magick "$outJpg" -quality 80 -strip "$outWebp"
        Write-Host "  -> Created: $baseName-$width.webp"
    }
}

# Handle scierie.gif - convert to MP4 poster + JPG fallback
$gifPath = Join-Path $imageDir 'scierie.gif'
if (Test-Path $gifPath) {
    Write-Host "Processing: scierie.gif"
    $baseGif = 'scierie'
    
    # Extract first frame as JPG and optimize
    foreach ($width in 400, 800, 1200) {
        $outJpg = Join-Path $optimizedDir "$baseGif-$width.jpg"
        & magick "$gifPath[0]" -resize "${width}x${width}>" -quality 85 -strip "$outJpg"
        Write-Host "  -> Created: $baseGif-$width.jpg (from first frame)"
        
        $outWebp = Join-Path $optimizedDir "$baseGif-$width.webp"
        & magick "$outJpg" -quality 80 -strip "$outWebp"
        Write-Host "  -> Created: $baseGif-$width.webp"
    }
}

Write-Host "`nOptimization complete! Files saved to: $optimizedDir"
Get-ChildItem -Path $optimizedDir | Measure-Object -Property Length -Sum | ForEach-Object {
    $sizeMB = [math]::Round($_.Sum / 1MB, 2)
    Write-Host "Total optimized size: $sizeMB MB"
}
