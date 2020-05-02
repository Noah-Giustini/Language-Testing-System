javac *.java
echo Main-Class: JPNS >manifest.txt
jar cfm LanguageTester.jar manifest.txt *.class *.png *.dat *.fxml