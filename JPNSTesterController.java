import java.awt.image.BufferedImage;
import java.io.File;
import java.io.IOException;
import java.net.URL;
import java.util.ResourceBundle;
import javafx.event.ActionEvent;
import javafx.fxml.FXML;
import javafx.fxml.Initializable;
import javafx.scene.control.Button;
import javafx.scene.control.Label;
import javafx.scene.control.TextField;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.stage.FileChooser;
import javax.imageio.ImageIO;
import java.lang.Integer;
import javafx.scene.control.MenuButton;
import javafx.scene.control.RadioMenuItem;
import java.util.Random;
import java.io.File;
import java.io.IOException;
import javafx.scene.text.TextFlow;
import java.util.ArrayList;
import java.io.BufferedReader;
import java.io.FileNotFoundException;
import java.util.Scanner; 
import java.util.List;
import java.lang.Math;

public class JPNSTesterController implements Initializable{
    @FXML
    private MenuButton fileDropdown;

    @FXML
    private RadioMenuItem lesson5;
    @FXML
    private RadioMenuItem lesson6;
    @FXML
    private RadioMenuItem lesson7;

    @FXML
    private Label questionText;

    @FXML
    private TextField translation;

    @FXML
    private Button submit;

    @FXML
    private Button next;

    @FXML
    private ImageView checkmark;

    @FXML
    private Label outputText;

    private String lesson;
    private int question = 0;
    private int grade = 0;
    private ArrayList<String[]> definitions = new ArrayList<String[]>();
    private ArrayList<String[]> test = new ArrayList<String[]>();
    private List<Integer> used = new ArrayList<Integer>();
    Random r = new Random();

    private void openFile(){
        //System.out.println("attempting to read file");
        try {
            File myObj = new File(lesson);
            Scanner myReader = new Scanner(myObj, "UTF-8");
            //System.out.println("attempting to get new line");
            while (myReader.hasNextLine()) {
              String data = myReader.nextLine();
              String[] parts = data.split("~");
              definitions.add(parts);
            }
            myReader.close();
            //System.out.println("Successfully read file");
        } 
        catch (FileNotFoundException e) {
            System.out.println("An error occurred.");
            e.printStackTrace();
        }
    }

    private void createTest(){
        grade = 0;
        int length = (int) Math.ceil(definitions.size()*0.6);
        while (test.size()<length){
            int num = r.nextInt(definitions.size());
            if(!used.contains(num)){
                test.add(definitions.get(num));
                used.add(num);
            }
        }
    }

    private void startTest(){
        submit.setVisible(true);
        translation.setVisible(true);
        questionText.setVisible(true);
        questionText.setText(test.get(question)[0]);
    }


    @Override
    public void initialize(URL url, ResourceBundle rb){
        next.setVisible(false);
        outputText.setVisible(false);
        checkmark.setVisible(false);
        submit.setVisible(false);
        translation.setVisible(false);
        questionText.setVisible(false);
    } 

    @FXML
    public void submitQuestion(ActionEvent event){
        submit.setVisible(false);
        String userAns = translation.getText();
        userAns = userAns.toLowerCase();
        int correct = userAns.compareTo(test.get(question)[1].toLowerCase());
        //correct answer
        if (correct == 0){
            grade++;
            outputText.setText("Correct!");
            checkmark.setImage(new Image("check.png"));
            outputText.setStyle("-fx-text-fill: green;");
            next.setVisible(true);
            outputText.setVisible(true);
            checkmark.setVisible(true);
            
        }
        //wrong answer
        else{
            outputText.setText("Incorrect, the correct answer is: " + test.get(question)[1].toLowerCase());
            checkmark.setImage(new Image("x.png"));
            outputText.setStyle("-fx-text-fill: red;");
            next.setVisible(true);
            outputText.setVisible(true);
            checkmark.setVisible(true);
        }
    }

    @FXML
    public void nextQuestion(ActionEvent event){
        submit.setVisible(true);
        next.setVisible(false);
        outputText.setVisible(false);
        checkmark.setVisible(false);
        translation.clear();
        question++;
        if(question != test.size()){
            questionText.setText(test.get(question)[0]);
        }
        else{
            submit.setVisible(false);
            outputText.setText("You got " + Integer.toString(grade) + " correct.");
            outputText.setVisible(true);
        }
    }

    @FXML
    private void lesson5Action(ActionEvent event){
        lesson = "lesson5.dat";
        definitions.clear();
        test.clear();
        used.clear();
        question = 0;
        openFile();
        createTest();
        startTest();
        
    }

    @FXML
    private void lesson6Action(ActionEvent event){
        lesson = "lesson6.dat";
        definitions.clear();
        test.clear();
        question = 0;
        openFile();
        createTest();
        startTest();
        
    }

    @FXML
    private void lesson7Action(ActionEvent event){
        lesson = "lesson7.dat";
        definitions.clear();
        test.clear();
        question = 0;
        openFile();
        createTest();
        startTest();
        
    }

}