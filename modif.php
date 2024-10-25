<?php session_start() ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RunGame v2 - Modif jeux</title>
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
    require_once('database/requete.php');
      $idJeu = $_GET['id'];
      $jeu = ShowGamesId($idJeu);
      $editeurs = ShowEditor();
      $genres = ShowGenre();

  ?>
      <div class="flex justify-center items-center min-h-screen">

<div class="relative p-4 w-full max-w-2xl max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900">
                            Modification du jeu
                        </h3>
                        <p class="mt-1 text-sm text-gray-600">
                            <?=$jeu["Titre"] ?>
                        </p>
                    </div>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form method="POST" name="formModifJeux" action="./includes/ModifJeux.php" class="space-y-4">
                        <input type="hidden" name="idJeu" value="<?php echo htmlspecialchars($_GET['id']); ?>">

                        <div class="mb-4">
                            <label for="titre" class="block mb-2 text-sm font-medium text-gray-900">Titre du jeu</label>
                            <input type="text" name="titre" maxlength="50" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" placeholder="ex: COD" required value="<?=$jeu["Titre"]?>">
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block mb-2 text-sm font-medium text-gray-900">Description du jeu</label>
                            <textarea name="description" maxlength="300" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" required><?=$jeu["Description"]?></textarea>
                        </div>

                        <div class="mb-4">
                            <label for="idEditeur" class="block mb-2 text-sm font-medium text-gray-900">Éditeur</label>
                            <select name="idEditeur" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" required>
                                <option value="<?=$jeu["EditeurID"]?>"><?=$jeu["Editeur"]?></option>
                                <?php foreach ($editeurs as $editeur): 
                                    if ($editeur['id'] != $jeu["EditeurID"]): ?>
                                        <option value="<?= htmlspecialchars($editeur['id']); ?>"><?= htmlspecialchars($editeur['nom']); ?></option>
                                    <?php endif; 
                                endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="idGenre" class="block mb-2 text-sm font-medium text-gray-900">Genre</label>
                            <select name="idGenre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" required>
                                <option value="<?=$jeu["GenreID"]?>"><?=$jeu["Genre"]?></option>
                                <?php foreach ($genres as $genre): 
                                    if ($genre['id'] != $jeu["GenreID"]): ?>
                                        <option value="<?= htmlspecialchars($genre['id']); ?>"><?= htmlspecialchars($genre['libelle']); ?></option>
                                    <?php endif; 
                                endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="dateDeSortie" class="block mb-2 text-sm font-medium text-gray-900">Date de sortie</label>
                            <input type="date" name="dateDeSortie" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" required value="<?=$jeu["DateDeSortie"]?>">
                        </div>

                        <div class="mb-4">
                            <label for="tarifJeux" class="block mb-2 text-sm font-medium text-gray-900">Tarif (€)</label>
                            <div class="relative">
                                <input type="number" step="0.01" name="tarifJeux" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5" placeholder="ex: 49.99" required value="<?=$jeu["Tarif"]?>">
                                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                    <span class="text-gray-500">€</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-end space-x-4 pt-4">
                            <a href="./gestionJeux.php">
                                <button type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-yellow-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10" data-modal-hide="editJeuxModal">
                                    Annuler
                                </button>
                            </a>
                            <button type="submit" class="text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                Sauvegarder les modifications
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
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
</body>
</html>