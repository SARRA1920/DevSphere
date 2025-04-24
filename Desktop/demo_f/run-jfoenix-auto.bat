@echo off
cd "%~dp0"

echo Running application via JFoenixCompatLauncher...

"C:\Users\Baha Ayadi\.jdks\openjdk-23.0.2\bin\java.exe" ^
--module-path "C:\Users\Baha Ayadi\Desktop\javafx-sdk-23.0.2\lib" ^
--add-modules javafx.controls,javafx.fxml,java.sql ^
-classpath "target\classes;target\dependency\*" ^
com.user.demo.JFoenixCompatLauncher

pause