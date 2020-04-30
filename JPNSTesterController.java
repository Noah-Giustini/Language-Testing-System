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
import javafx.scene.control.ScrollPane;
import javafx.scene.control.TextArea;
import javafx.scene.control.TextField;
import javafx.scene.image.Image;
import javafx.scene.image.ImageView;
import javafx.stage.FileChooser;
import javax.imageio.ImageIO;
import javafx.scene.layout.VBox;
import javafx.scene.layout.HBox;
import java.lang.Integer;
import java.lang.Double;
import javafx.scene.control.CheckBox;
import javafx.scene.shape.Rectangle;
import javafx.scene.control.MenuButton;
import javafx.scene.control.RadioMenuItem;
import java.util.Random;
import java.io.File;
import java.io.IOException;
import javafx.scene.text.TextFlow;

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
    private TextFlow leftText;

    @FXML
    private TextFlow rightText;

    private String lesson;


    @Override
    public void initialize(URL url, ResourceBundle rb){
        
    } 

    @FXML
    private void lesson5Action(ActionEvent event){
        lesson = "lesson5.dat";
        readFile(lesson);
        List<String> records = new ArrayList<String>();
        try
        {
            BufferedReader reader = new BufferedReader(new FileReader(lesson));
            String line;
            while ((line = reader.readLine()) != null){
                System.out.println(line);
                records.add(line);
            }
            reader.close();
            return records;
        }
        catch (Exception e)
        {
            System.err.format("Exception occurred trying to read '%s'.", filename);
            e.printStackTrace();
            exit(-1);
        }
        
    }

}