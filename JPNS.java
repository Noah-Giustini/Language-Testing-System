import javafx.application.Application;
import javafx.scene.Scene;
import javafx.stage.Stage;
import javafx.fxml.FXMLLoader;
import javafx.scene.Parent;
import java.io.IOException;


/** This class GUI, runs the gui game of the slot machine using an FXMLDocument and calling to an FXML document
 * controller, therefore it is the main class for the GUI version of the game
 */
public class JPNS extends Application {

    /** The method, start, is used to set up the GUI game, it does this by creating a primary Parent 
     * grouping of all GUI elements called root. Root loads the GUI using an FXMLDocument loader
     * which loads the FXML document that starts the FXMLDocument controller class. The method
     * than sets the scene to have this root (Parent) Next, the method sets the title on the screen 
     * to "SLOTS" and sets the stage to have the scene, the stage is then shown. Exception handeling of the IOException
     * is used to ensure that the GUI class loads properly, if the class does not load properly than a descriptive
     * message will print and the game will exit.
     *
     * @param         stage - the stage where everythin is shown in the GUI
     */
    @Override
    public void start(Stage stage) {
        try{
            Parent root = FXMLLoader.load(getClass().getResource("JPNSTester.fxml"));
            Scene scene = new Scene(root);
            stage.setTitle("JPNS");
            stage.setScene(scene);
            stage.show();
        }
        catch (IOException e) {
            System.out.println("There was an exception in loading the GUI, most likely you did not compile" +
                " the FXDocumentController class.");
                e.printStackTrace();
            System.exit(0);
        }
    }

    /** The main method of the GUI game that runs the GUI game, the launch method within main
     * is inherited from Application
     *
     * @param          args - a string array of arguments taken from the command prompt
     */
    public static void main(String[] args) {
        launch(args);
    }

}