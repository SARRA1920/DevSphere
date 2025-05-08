@echo off
cd "%~dp0"

echo Running application via Maven JavaFX plugin...
call mvn clean javafx:run

pause