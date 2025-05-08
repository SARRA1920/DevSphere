@echo off
cd "%~dp0"

echo Running application with Java 23 compatibility settings for JFoenix...

"C:\Users\Baha Ayadi\.jdks\openjdk-23.0.2\bin\java.exe" ^
--module-path "C:\Users\Baha Ayadi\Desktop\javafx-sdk-23.0.2\lib" ^
--add-modules javafx.controls,javafx.fxml,java.sql,javafx.swing ^
--add-opens=java.base/java.lang.reflect=ALL-UNNAMED ^
--add-opens=javafx.graphics/javafx.scene=ALL-UNNAMED ^
--add-opens=javafx.base/com.sun.javafx.runtime=ALL-UNNAMED ^
--add-opens=javafx.controls/com.sun.javafx.scene.control.behavior=ALL-UNNAMED ^
--add-opens=javafx.controls/com.sun.javafx.scene.control=ALL-UNNAMED ^
--add-opens=javafx.base/com.sun.javafx.binding=ALL-UNNAMED ^
--add-opens=javafx.base/com.sun.javafx.event=ALL-UNNAMED ^
--add-opens=javafx.graphics/com.sun.javafx.stage=ALL-UNNAMED ^
-classpath "C:\Users\Baha Ayadi\Desktop\Anas\demo\target\classes;^
C:\Users\Baha Ayadi\.m2\repository\org\openjfx\javafx-controls\22.0.1\javafx-controls-22.0.1.jar;^
C:\Users\Baha Ayadi\.m2\repository\org\openjfx\javafx-controls\22.0.1\javafx-controls-22.0.1-win.jar;^
C:\Users\Baha Ayadi\.m2\repository\org\openjfx\javafx-graphics\22.0.1\javafx-graphics-22.0.1.jar;^
C:\Users\Baha Ayadi\.m2\repository\org\openjfx\javafx-graphics\22.0.1\javafx-graphics-22.0.1-win.jar;^
C:\Users\Baha Ayadi\.m2\repository\org\openjfx\javafx-base\22.0.1\javafx-base-22.0.1.jar;^
C:\Users\Baha Ayadi\.m2\repository\org\openjfx\javafx-base\22.0.1\javafx-base-22.0.1-win.jar;^
C:\Users\Baha Ayadi\.m2\repository\org\openjfx\javafx-fxml\22.0.1\javafx-fxml-22.0.1.jar;^
C:\Users\Baha Ayadi\.m2\repository\org\openjfx\javafx-fxml\22.0.1\javafx-fxml-22.0.1-win.jar;^
C:\Users\Baha Ayadi\.m2\repository\mysql\mysql-connector-java\8.0.28\mysql-connector-java-8.0.28.jar;^
C:\Users\Baha Ayadi\.m2\repository\com\google\protobuf\protobuf-java\3.11.4\protobuf-java-3.11.4.jar;^
C:\Users\Baha Ayadi\.m2\repository\de\jensd\fontawesomefx-fontawesome\4.7.0-9.1.2\fontawesomefx-fontawesome-4.7.0-9.1.2.jar;^
C:\Users\Baha Ayadi\.m2\repository\de\jensd\fontawesomefx-commons\9.1.2\fontawesomefx-commons-9.1.2.jar;^
C:\Users\Baha Ayadi\.m2\repository\com\jfoenix\jfoenix\9.0.10\jfoenix-9.0.10.jar" ^
com.user.demo.MainLauncher

pause