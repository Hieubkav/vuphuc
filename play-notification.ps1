# Script phát âm thanh thông báo khi agent hoàn thành task
Write-Host "🎵 Agent task completed! 🎵" -ForegroundColor Green

# Phát âm thanh hệ thống
[System.Media.SystemSounds]::Asterisk.Play()
Start-Sleep -Milliseconds 500

# Phát thêm một âm thanh nữa để rõ hơn
[System.Media.SystemSounds]::Exclamation.Play()
Start-Sleep -Milliseconds 300

# Phát âm thanh cuối
[System.Media.SystemSounds]::Hand.Play()

Write-Host "✅ Notification sound played successfully!" -ForegroundColor Cyan
