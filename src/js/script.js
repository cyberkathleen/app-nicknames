// Affiche un popup pour confirmer la suppression d'un enseignant et redirige vers la suppression si true
function confirmDelete(id) {
  if (confirm("Êtes-vous sûr de vouloir supprimer l'enseignant?") === true) {
    window.location.href = "./deleteTeacher.php?idTeacher=" + id;
  }
}