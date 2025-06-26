@echo off
echo Generating API documentation...
docker exec tablesheet-app php artisan scribe:generate --verbose
echo.
echo Documentation generated successfully!
echo Visit your docs at: http://localhost:8000/docs
pause
