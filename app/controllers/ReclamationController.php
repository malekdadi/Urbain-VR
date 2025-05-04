<?php
require_once '../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dompdf\Dompdf;
use Dompdf\Options;
require_once(__DIR__ . '/../models/ReclamationModel.php');
require_once(__DIR__ . '/../models/Reclamation.php');
class ReclamationController {
    public function create() {
        $reclamationModel = new Reclamation();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = $_POST['nom'] ?? '';
            $email = $_POST['email'] ?? '';
            $message = $_POST['message'] ?? '';
            $reclamationModel->create($nom, $email, $message);
            header('Location: index.php?action=create');
            exit;
        }
        $reclamations = $reclamationModel->getAll();
        require __DIR__ . '/../views/reclamation/create.php';
    }

    public function update($id) {
        $reclamationModel = new Reclamation();
        $reclamation = $reclamationModel->getById($id);
    
        if (!$reclamation) {
            header("Location: index.php?action=create&error=notfound");
            exit;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Traitement de la mise à jour
            $nom = $_POST['nom'] ?? '';
            $email = $_POST['email'] ?? '';
            $message = $_POST['message'] ?? '';
            
            $reclamationModel->updateReclamation($id, $nom, $email, $message);
            header("Location: index.php?action=create&update=success");
            exit;
        }
    
        // Chemin CORRECT vers la vue
        $viewPath = __DIR__ . '/../../app/controllers/update.php';
        
        if (!file_exists($viewPath)) {
            die("Erreur: Le fichier de vue devrait être à: " . $viewPath);
        }
    
        require $viewPath;
    }
    public function delete($id) {
        $reclamationModel = new Reclamation();
        $reclamationModel->deleteReclamation($id);
        header("Location: index.php?action=create");
        exit;
    }
   
    public function index() {
        $order = $_GET['order'] ?? 'ASC';
        $model = new Reclamation();
        $reclamations = $model->getAllSortedByName($order);
        require_once '../app/views/reclamation/liste.php';
    }
public function downloadPdf() {
    $model = new Reclamation();
    $reclamations = $model->getAll();

    ob_start();
    require '../app/views/reclamation/reclamations_pdf.php';
    $html = ob_get_clean();

    $options = new Options();
    $options->set('defaultFont', 'Arial');

    $dompdf = new Dompdf($options);
    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait');
    $dompdf->render();

    $dompdf->stream("reclamations.pdf", ["Attachment" => true]); // Change to false to open in browser
}
public function downloadExcel() {
    $model = new Reclamation();
    $reclamations = $model->getAll();

    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=reclamations.xls");
    header("Pragma: no-cache");
    header("Expires: 0");

    echo "<table border='1'>";
    echo "<tr><th>Nom</th><th>Email</th><th>Message</th></tr>";

    foreach ($reclamations as $rec) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($rec['nom']) . "</td>";
        echo "<td>" . htmlspecialchars($rec['email']) . "</td>";
        echo "<td>" . htmlspecialchars($rec['message']) . "</td>";
        echo "</tr>";
    }

    echo "</table>";
    exit;
}
   private ReclamationModel $model;

    public function __construct() {
        $this->reclamationModel = new ReclamationModel();
    }

    
    public function afficherStatistiquesMessages() {
        $model = new ReclamationModel();
        $stats = $model->getStatistiquesMessages();
        require __DIR__ . '/../views/reclamation/stats.php';
    }
    public function sendMail() {
        if (isset($_GET['email']) && isset($_GET['message'])) {
            try {
                $mail = new PHPMailer(true);
    
                // Server settings
                $mail->isSMTP();
                $mail->Host       = 'smtp.gmail.com';
                $mail->SMTPAuth   = true;
                $mail->Username   = 'malekabdnbei.dadi@esprit.tn';
                $mail->Password   = 'uvdpcsoejsozhods';
                $mail->SMTPSecure = 'ssl';
                $mail->Port       = 465;
    
                // Inputs (depuis GET)
                $email = filter_input(INPUT_GET, 'email', FILTER_SANITIZE_EMAIL);
                $message = filter_input(INPUT_GET, 'message', FILTER_SANITIZE_STRING);
    
                if (!$email || !$message) {
                    throw new Exception('Invalid input data');
                }
    
                // Recipients
                $mail->setFrom('malekabdnbei.dadi@esprit.tn', 'Admin Reclamation');
                $mail->addAddress($email); // On envoie au client, pas à toi
                $mail->addReplyTo('malekabdnbei.dadi@esprit.tn', 'Admin');
    
                // Content
                $mail->isHTML(true);
                $mail->Subject = 'Réponse à votre réclamation';
                $mail->Body    = $message;
    
                // Send email
                if ($mail->send()) {
                    echo "<script>
                        alert('Le message a été envoyé avec succès ✅ ');
                        window.location.href = 'index.php';
                    </script>";
                } else {
                    throw new Exception('Mailer Error: ' . $mail->ErrorInfo);
                }
            } catch (Exception $e) {
                error_log('Email sending failed: ' . $e->getMessage());
                echo "<script>
                    alert('Failed to send message. Please try again later.');
                    window.location.href = 'index.php';
                </script>";
            }
        }
    }
    public function rechercher()
    {
        // Récupérer le nom à rechercher dans le formulaire (méthode GET)
        $searchNom = isset($_GET['nom']) ? $_GET['nom'] : '';
    
        // Appeler la méthode de recherche dans le modèle
        $reclamations = $this->reclamationModel->rechercherReclamations($searchNom);
    
        // Vérifier si des réclamations ont été trouvées
        if (empty($reclamations)) {
            echo '<p>Aucune réclamation trouvée.</p>';
        } else {
            // Afficher les résultats dans un tableau
          
            
            echo '</tbody></table>';
        }
        require __DIR__ . '/../views/reclamation/recherch.php';
    }
    
}
