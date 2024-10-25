<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RunGame v2 - gestion</title>
    <style type="text/tailwindcss">
        @layer utilities {
          .content-auto {
            content-visibility: auto;
          }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="./asset/css/logform.css">
</head>
<body>
<?php 
    require_once('includes/navbar.php');
    require_once('./database/requete.php');
    $editeurs = ShowEditor();
    $genres = ShowGenre();
 ?>
<h2>Liste des Jeux</h2>
<div class="flex">
    <button data-modal-target="ajoutJeuxModal" data-modal-toggle="ajoutJeuxModal" class="ml-auto inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
        <span class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
            Ajouter un jeux
        </span>
    </button>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">ID</th>
                <th scope="col" class="px-6 py-3">Titre</th>
                <th scope="col" class="px-6 py-3">Description</th>
                <th scope="col" class="px-6 py-3">Date de Sortie</th>
                <th scope="col" class="px-6 py-3">Image</th>
                <th scope="col" class="px-6 py-3">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Appel à la fonction pour récupérer les jeux
            $jeux = ShowGames();
            if ($jeux && $jeux->rowCount() > 0) {
                // Boucle sur chaque jeu pour l'afficher dans le tableau
                while($row = $jeux->fetch(PDO::FETCH_ASSOC)) {
                    echo '<tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">';
                    echo '<td class="px-6 py-4">' . $row['id'] . '</td>';
                    echo '<td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">' . $row['titre'] . '</td>';
                    echo '<td class="px-6 py-4">' . $row['description'] . '</td>';
                    echo '<td class="px-6 py-4">' . $row['dateDeSortie'] . '</td>';
                    echo '<td class="px-6 py-4">' . $row['image'] . '</td>';
                    echo '<td class="px-6 py-4">
                    <a href="modif.php?id='.$row["id"].'" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Modifier</a>'; ?>
                    <a href="#" onclick="confirmDelete(<?=$row['id']?>, '<?=addslashes($row['titre'])?>');" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Supprimer</a>
                    </td>
                    <?php echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="6" class="text-center px-6 py-4">Aucun jeu disponible</td></tr>';
            }
            ?>
        </tbody>
    </table>
</div>
<div id="ajoutJeuxModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Formulaire d'ajout Jeux
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="ajoutJeuxModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Fermer</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form method="POST" name="formAjoutJeux" action="./includes/AjoutJeux.php" class="space-y-4">
                        <div class="mb-4">
                            <label for="titre" class="block mb-2 text-sm font-medium text-gray-900">Titre du jeux</label>
                            <input type="text" name="titre" maxlength="50" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="ex: COD" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Descriptions du jeux</label>
                            <textarea name="description" maxlength="300" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="idEditeur" class="block mb-2 text-sm font-medium text-gray-900">Éditeur</label>
                            <select name="idEditeur" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                <option value="">Sélectionnez un éditeur</option>
                                <?php foreach ($editeurs as $editeur): ?>
                                    <option value="<?= htmlspecialchars($editeur['id']); ?>"><?= htmlspecialchars($editeur['nom']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="idGenre" class="block mb-2 text-sm font-medium text-gray-900">Genre</label>
                            <select name="idGenre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                                <option value="">Sélectionnez un genre</option>
                                <?php foreach ($genres as $genre): ?>
                                    <option value="<?= htmlspecialchars($genre['id']); ?>"><?= htmlspecialchars($genre['libelle']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="dateDeSortie" class="block mb-2 text-sm font-medium text-gray-900">Date de sortie</label>
                            <input type="date" name="dateDeSortie" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" required>
                        </div>

                        <div class="mb-4">
                            <label for="tarifJeux" class="block mb-2 text-sm font-medium text-gray-900">Tarif (€)</label>
                            <input type="number" step="0.01" name="tarifJeux" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="ex: 49.99" required>
                        </div>

                        <div class="flex items-center justify-end space-x-4">
                            <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10" data-modal-hide="ajoutJeuxModal">Annuler</button>
                            <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Ajouter le jeu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- <div id="editJeuxModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        
    </div> -->


<!-- <?php require_once('./includes/footer.php') ?>     -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
          theme: {
            extend: {
              colors: {
                clifford: '#da373d',
              }
            }
          }
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
    <script>
    function confirmDelete(id, titre) {
        if (confirm(`Êtes-vous sûr de vouloir supprimer le jeu : ${titre} ?`)) {
            // Si l'utilisateur confirme, redirige vers le script PHP pour supprimer le jeu
            window.location.href = "./includes/supJeux.php?id=" + id;
        }
    }
  </script>
</body>
</html>