<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RunGame v2 - Login</title>
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
 ?>
<h2>Liste des Jeux</h2>
<div class="flex">
    <button class="ml-auto inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-green-400 to-blue-600 group-hover:from-green-400 group-hover:to-blue-600 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-green-200 dark:focus:ring-green-800">
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
                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Modifier</a>'; ?>
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