@echo off
cd "%~dp0"

rem Set JVM options
set JAVA_OPTS=--enable-native-access=javafx.graphics --add-opens java.base/java.lang=ALL-UNNAMED --add-opens javafx.graphics/com.sun.glass.utils=ALL-UNNAMED --add-opens javafx.graphics/com.sun.marlin=ALL-UNNAMED

rem Run with Maven
call mvn clean javafx:run -Djavafx.jvmargs="%JAVA_OPTS%"

pause 