@echo off
cd "%~dp0"

echo Running application with explicit module path...

"C:\Users\Baha Ayadi\.jdks\openjdk-23.0.2\bin\java.exe" ^
--module-path "C:\Users\Baha Ayadi\Desktop\javafx-sdk-23.0.2\lib;%~dp0\target\classes;%~dp0\target\dependency" ^
--add-modules javafx.controls,javafx.fxml,java.sql ^
-m com.user.demo/com.user.demo.MainLauncher

if %errorlevel% neq 0 (
  echo Application exited with error code: %errorlevel%
  echo.
  echo Trying alternative run method...
  echo.
  "C:\Users\Baha Ayadi\.jdks\openjdk-23.0.2\bin\java.exe" ^
  --module-path "C:\Users\Baha Ayadi\Desktop\javafx-sdk-23.0.2\lib;%~dp0\target\classes;%~dp0\target\dependency" ^
  --add-modules javafx.controls,javafx.fxml,java.sql ^
  --class-path "%~dp0\target\classes;%~dp0\target\dependency\*" ^
  com.user.demo.MainLauncher
)

pause