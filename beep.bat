@echo off
echo Agent task completed!
echo 
powershell -Command "[System.Media.SystemSounds]::Asterisk.Play()"
timeout /t 1 /nobreak >nul
powershell -Command "[System.Media.SystemSounds]::Exclamation.Play()"
echo Notification sound played!
pause
