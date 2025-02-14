<?php
require 'config.php';

// Vérifier si un quiz_id est passé en paramètre
if (isset($_POST['quiz_id'])) {
    $quizId = $_POST['quiz_id'];

    try {
        // Démarrer une transaction pour garantir l'intégrité des données
        $conn->begin_transaction();

        // Supprimer les réponses associées au quiz
        $stmt = $conn->prepare("DELETE FROM reponse WHERE question_id IN (SELECT id FROM question WHERE quiz_id = ?)");
        $stmt->bind_param("i", $quizId);
        $stmt->execute();

        // Supprimer les questions associées au quiz
        $stmt = $conn->prepare("DELETE FROM question WHERE quiz_id = ?");
        $stmt->bind_param("i", $quizId);
        $stmt->execute();

        // Supprimer le quiz lui-même
        $stmt = $conn->prepare("DELETE FROM quizzes WHERE id = ?");
        $stmt->bind_param("i", $quizId);
        $stmt->execute();

        // Valider la transaction
        $conn->commit();

        echo "Quiz supprimé avec succès.";
    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $conn->rollback();
        echo "Erreur lors de la suppression : " . $e->getMessage();
    }
}
?>
