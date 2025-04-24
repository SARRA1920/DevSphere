@echo off
cd "%~dp0"

rem Clean and compile with Maven
call mvn clean compile

rem Run the application with proper module path
java --module-path "%~dp0\target\classes;%~dp0\target\dependency;%JAVAFX_HOME%\lib" ^
     --add-modules javafx.controls,javafx.fxml,java.sql ^
     -m com.user.demo/com.user.demo.HelloApplication

pause